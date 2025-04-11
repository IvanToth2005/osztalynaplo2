<?php

namespace App\Http\Controllers;


use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        // Egyedi évek lekérése
        $years = SchoolClass::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        return view('subjects.index', compact('years'));
    }

    public function create()
    {
      
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
      
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
       
    }

    public function getClasses($year)
    {
        $classes = SchoolClass::where('year', $year)->orderBy('name')->get();
        return response()->json($classes);
    }

    public function getSubjects($classId)
    {
        try {
            $class = SchoolClass::with('subjects')->findOrFail($classId);
            return response()->json($class->subjects);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
    public function showResults(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        $class = SchoolClass::with('students')->findOrFail($request->class_id);
        $subject = Subject::findOrFail($request->subject_id);

        // Hatékonyabb lekérdezés az osztályátlaghoz
        $classAverage = Mark::where('subject_id', $request->subject_id)
                        ->whereIn('student_id', $class->students->pluck('id'))
                        ->avg('mark');

        // Tanulók betöltése jegyekkel és átlag számítással
        $students = $class->students->map(function($student) use ($request) {
            $student->load(['marks' => function($query) use ($request) {
                $query->where('subject_id', $request->subject_id);
            }]);
            
            $student->average = $student->marks->avg('mark') ?? 0;
            return $student;
        });

        return view('subjects.results', [
            'year' => $request->year,
            'class' => $class,
            'subject' => $subject,
            'classAverage' => $classAverage ? round($classAverage, 2) : 0,
            'students' => $students
        ]);
    }
   
}
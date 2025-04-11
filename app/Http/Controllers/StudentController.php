<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; 
use App\Models\SchoolClass; 

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $years = SchoolClass::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        
        return view('students.index', compact('students', 'years'));
    }

    public function studentsPage()
    {
        $years = SchoolClass::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        return view('students', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|numeric',
            'class_id' => 'required|exists:school_classes,id'
        ]);

        $student = Student::create([
            'name' => $request->name,
            'year' => $request->year,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id); // 404 hiba, ha nem található
        $years = SchoolClass::select('year')->distinct()->pluck('year'); // Évek beszerzése
        $classes = SchoolClass::all(); // Minden osztály beszerzése

        return view('students.edit', compact('student', 'years', 'classes')); // Az évek és osztályok átadása
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|numeric',
            'class_id' => 'required|exists:school_classes,id'
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'year' => $request->year,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Error deleting student.');
        }
    }

    public function getClasses($year)
    {
        $classes = SchoolClass::where('year', $year)->get();
        return response()->json($classes);
    }

    public function getStudentsByClass($classId)
    {
        $students = Student::where('class_id', $classId)->get();
        return response()->json($students);
    }
    
}
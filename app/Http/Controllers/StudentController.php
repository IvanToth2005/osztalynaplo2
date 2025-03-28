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
        $students = Student::all(); // Lekérdezi az összes diákot
        return view('students.index', compact('students')); // Visszaadja a megfelelő nézetet
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all(); // Lekérdezi az összes osztályt
        return view('students.create', compact('classes')); // Átadja az osztályokat a nézetnek
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
        $student = Student::findOrFail($id); // Használj findOrFail() a hibás ID kezeléséhez
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = SchoolClass::all();
        dd($student, $classes); // Ellenőrizd, hogy a változók helyesek-e
        return view('students.edit', compact('student', 'classes'));
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
        $student = Student::findOrFail($id); // Diák keresése
        $student->delete(); // Diák törlése

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.'); // Visszairányít
    }

    public function getClasses($year)
    {
        // Feltételezve, hogy az osztályok tartalmaznak egy 'year' mezőt
        $classes = SchoolClass::where('year', $year)->get(); // Változtasd meg a lekérdezést, ha a mező neve más
        return response()->json($classes);
    }

    public function getStudentsByClass($classId)
{
    $students = Student::where('class_id', $classId)->get(); // Feltételezve, hogy van 'class_id' mező a Student modellben
    return response()->json($students);
}

}
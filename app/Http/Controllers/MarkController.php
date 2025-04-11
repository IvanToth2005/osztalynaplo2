<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marks = Mark::with(['student', 'subject'])->get();
        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('marks.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|exists:students,id',
            'mark' => 'required|integer|min:1|max:5', // Javítva: 'marks' -> 'mark'
            'date' => 'required|date',
        ]);

        Mark::create([
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
            'mark' => $request->mark,
            'date' => $request->date
        ]);

        return redirect()->route('marks.index')->with('success', 'Grade added!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mark = Mark::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
        return view('marks.edit', compact('mark', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'mark' => 'required|integer|between:1,5',
            'date' => 'required|date'
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($validated);

        return redirect()->route('marks.index')->with('success', 'Grade updated succesfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();
    
        return redirect()->route('marks.index')->with('success', 'Mark deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;


class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::all();
        return view('SchoolClass.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SchoolClass.create'); // Kicsi betűs nézetnév
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|numeric'
        ]);
    
        $class = SchoolClass::create($validated);
    
        return redirect()->route('school-class.index')
            ->with('success', 'Class created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('SchoolClass.show', compact('class')); // Kicsi betűs nézetnév
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('SchoolClass.edit', compact('class')); // Kicsi betűs nézetnév
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
        ]);

        $class = SchoolClass::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('school-class.index')->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->delete();

        return redirect()->route('school-class.index')->with('success', 'Class deleted successfully.');
    }

    
}

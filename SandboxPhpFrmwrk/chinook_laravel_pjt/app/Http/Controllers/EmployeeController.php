<?php

// app/Http/Controllers/EmployeeController.php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'LastName' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'Title' => 'nullable|string|max:255',
            'BirthDate' => 'nullable|date',
            'Country' => 'required|string|max:255',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès !');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'LastName' => 'required|string|max:255',
            'FirstName' => 'required|string|max:255',
            'Title' => 'nullable|string|max:255',
            'BirthDate' => 'nullable|date',
            'Country' => 'required|string|max:255',
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employé modifié avec succès !');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès !');
    }
}

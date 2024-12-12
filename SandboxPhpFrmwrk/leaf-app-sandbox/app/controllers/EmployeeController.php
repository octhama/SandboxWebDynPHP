<?php

namespace App\Controllers;

class EmployeeController extends \Leaf\Controller {
    public function index() {
        $titre = 'Employees';
        $employees = Employee::all();
        render ("employee.index", compact("titre", "employees"));
    }

    function create() {
        render('employee.create');
    }

    function store() {
        $data = request()->postData();
        $employee = new Employee();
        $employee->FirstName = $data["FirstName"];
        $employee->LastName = $data["LastName"];
        $employee->Title = $data["Title"];
        $employee->BirthDate = $data["BirthDate"];
        $employee->Country = $data["Country"];
        $employee->save();
        response()->redirect('employee');

    }

    function edit($id) {
        $employee = Employee::find($id);
        render('employee.edit', compact('employee'));
    }

    function update($id) {
        $data = request()->postData();
        $employee = Employee::find($id);
        $employee->FirstName = $data["FirstName"];
        $employee->LastName = $data["LastName"];
        $employee->Title = $data["Title"];
        $employee->BirthDate = $data["BirthDate"];
        $employee->Country = $data["Country"];
        $employee->save();
        response()->redirect('employee');
    }

    function delete($id) {
        $employee = Employee::find($id);
        $employee->delete();
        response()->redirect('employee');
    }

    function show($id) {
        $employee = Employee::find($id);
        render('employee.show', compact('employee'));
    }

    function search() {
        $search = request()->get('search');
        $employees = Employee::where('FirstName', 'like', "%$search%")->orWhere('LastName', 'like', "%$search%")->get();
        render('employee.index', compact('employees'));
    }

    function sort() {
        $sort = request()->get('sort');
        $employees = Employee::orderBy($sort)->get();
        render('employee.index', compact('employees'));
    }

    function filter() {
        $filter = request()->get('filter');
        $employees = Employee::where('Country', $filter)->get();
        render('employee.index', compact('employees'));
    }

}

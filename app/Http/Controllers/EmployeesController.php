<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesStoreRequest;
use App\Models\Employee;
use App\Models\Company;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('employees.index', ['employees' => (new Employee)->index()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('employees.create',["companies"=>(new Company)->index()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesStoreRequest $request)
    {
        (new Employee)->creatEmployee($request);
        return redirect('employees')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->view('employees.show', ['employee'=> (new Employee)->getEmployeeById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = (new Employee)->getEmployeeById($id);
        $companies = (new Company)->index();
        return response()->view('employees.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesStoreRequest $request, $id)
    {

        (new Employee)->updateEmployee($request, $id);
        return redirect('employees')->with('success', 'Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
        return redirect('companies')->with('success', 'Data is successfully deleted');
    }
}

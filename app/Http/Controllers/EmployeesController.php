<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Companies;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::all();
        // dd($companies);
        return view('employees.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'company_id'	=>	'required',
            'email'         =>  ['nullable', 'email'],
            
        ]);

        $form_data = array(
            'first_name'     =>   $request->first_name,
            'last_name'      =>   $request->last_name,
            'email'			 =>   $request->email,
            'phone'			 =>   $request->phone,
            'company_id'     => $request->company_id
        );

       Employees::create($form_data);


        return redirect('employees')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $employee = Employees::findOrFail($id);
        $companies = Companies::all();;
        return view('employees.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'     =>  'required',
            'phone'     =>  'required',
            'company_id'     =>  'required',

            
        ]);

  $form_data = array(
        'first_name'    =>  $request->first_name,
        'last_name'     =>  $request->last_name,
        'email'         =>  $request->email,
        'phone'         =>  $request->phone,
        'company_id'    =>  $request->company_id,
    );

 

   Employees::whereId($id)->update($form_data);
    return redirect('employees')->with('success', 'Data is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employees::findOrFail($id);
        $data->delete();
        return redirect('companies')->with('success', 'Data is successfully deleted');
    }
}

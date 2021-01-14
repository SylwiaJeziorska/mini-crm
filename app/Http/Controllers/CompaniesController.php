<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::all();
        return view('companies.index', ["companies"=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name'    =>  ['required'],
            'email'    =>  ['nullable', 'email'],
            'website'  =>  ['nullable'],
            'logo'    =>  ['nullable', 'file', 'dimensions:min_width=100,min_height=100']
        ]);

        $form_data = array(
            'name'       =>   $request->name,
            'email'      =>   $request->email,
            'website'    =>   $request->website,
        );

        if($request->file('logo')){
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $form_data['logo'] = $new_name;
        }
        Companies::create($form_data);
        return redirect('companies')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Companies::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    =>  ['required'],
            'email'    =>  ['nullable', 'email'],
            'website'  =>  ['nullable'],
            'logo'    =>  ['nullable', 'file', 'dimensions:min_width=100,min_height=100']
        ]);

        $form_data = array(
            'name'       =>   $request->name,
            'email'      =>   $request->email,
            'website'    =>   $request->website,
        );

        if($request->file('logo')){
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $form_data['logo'] = $new_name;
        }

        Companies::whereId($id)->update($form_data);
        return redirect('companies')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        
        $company = Companies::findOrFail($id);
        $company->delete();
        return redirect('companies')->with('success', 'Data is successfully deleted');
    }
}

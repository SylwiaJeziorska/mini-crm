<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesStoreRequest;
use App\Models\Company;
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
        return response()->view('companies.index', ["companies"=>(new Company)->index()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesStoreRequest $request)
    {
        (new Company)->store($request);

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
        $company = (new Company)->getCompany($id);
        return response()->view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = (new Company)->getCompany($id);
        return response()->view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesStoreRequest $request, $id)
    {
        (new Company)->updateCompany($request, $id);

        return redirect('companies')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        $company = Company::findOrFail($id);
        $company->delete();
        return redirect('companies')->with('success', 'Data is successfully deleted');
    }
}

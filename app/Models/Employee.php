<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;


class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name','email', 'phone','company_id'
       ];

    /**
     * Add relation to company.
     */
    public function companies(){

       return $this->belongsTo(Company::class, 'company_id');
   }

    /**
     * @return Employee Collection.
     */
    public function index(){
        return Employee::latest()->paginate(10);
   }

    /**
     * Create a new employee.
     * @param $request object
     */
    public function creatEmployee($request){

       $form_data = $this->createEmployeeArray($request);
       Employee::create($form_data);

   }

    /**
     * Update an existing employee.
     * @param $request object
     * @param $id int
     */
    public function updateEmployee($request, $id){

       $form_data = $this->createEmployeeArray($request);
       Employee::whereId($id)->update($form_data);

   }

    /**
     * Create an array of a data from the request to update or create an employee.
     * @param $request object
     * @return array
     */
    public function createEmployeeArray($request){
        return array(
            'first_name'     =>   $request->first_name,
            'last_name'      =>   $request->last_name,
            'email'			 =>   $request->email,
            'phone'			 =>   $request->phone,
            'company_id'     => $request->company_id
        );
   }

   public function getEmployeeById($id){
       return Employee::findOrFail($id);

   }

}

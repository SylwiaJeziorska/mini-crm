<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Companies
 * @package App\Models
 */
class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'logo','website'
       ];

   /**
     * Get collection of companies.
     * @return Company Collection
     */
    public function index(){
        return Company::all();
   }

    /**
     * Create a new company.
     * @param $request object
     */
    public function store($request){

        $form_data = $this->creatCompanyArray($request);

        if($request->file('logo')){
           $form_data['logo'] =  $this->companyImg($request->file('logo'));
       }
       Company::create($form_data);
   }

    /** update an existing company id db.
     * @param $request object
     * @param $id int
     */
    public function updateCompany($request, $id){

       $form_data = $this->creatCompanyArray($request);

       if($request->file('logo')){
           $form_data['logo'] =  $this->companyImg($request->file('logo'));
       }

       Company::whereId($id)->update($form_data);
   }

    /** Preper array of data to creat or update company.
     * @param $request
     * @return array
     */
    public function creatCompanyArray($request){

       return array(
           'name'       =>   $request->name,
           'email'      =>   $request->email,
           'website'    =>   $request->website,
       );
   }

    /**
     * Move company image with new name.
     * @param $request object
     *
     * @return string
     */
    public function companyImg($request){

        $new_name = rand() . '.' . $request->getClientOriginalExtension();
        $request->move(public_path('images'), $new_name);
        return $new_name;
    }

    /**
     * Get company by id.
     * @param $id int
     * @return Company object
     */
    public function getCompany($id){
        return Company::findOrFail($id);
    }

    /**
     * Add relation to employees.
     */
    public function employees(){

        return $this->hasMany(Employee::class);
    }
}

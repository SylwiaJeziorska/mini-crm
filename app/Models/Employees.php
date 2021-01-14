<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;


class Employees extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name','email', 'phone','company_id'
       ];
   
       public function companies(){
   
           return $this->belongsTo(Companies::class, 'company_id');
       }
}

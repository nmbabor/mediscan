<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospital';
   protected $fillable = ['technologist_contact','manager_contact','reception_contact','user_id','created_by'];
   public function user(){
   	return $this->belongsTo('App\User','user_id','id');
   } 
   public function modality(){
   	return $this->hasMany('App\Models\HospitalModality','hospital_id','id');
   }
   public function radiologist(){
   	return $this->hasMany('App\Models\HospitalRadiologist','hospital_id','id');
   }
   public function price(){
   	return $this->hasMany('App\Models\HospitalBillPrice','hospital_id','id');
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radiologist extends Model
{
   protected $table = 'radiologist';
   protected $fillable = ['signature','gender','created_by','user_id'];
   public function user(){
   	return $this->belongsTo('App\User','user_id','id');
   } 
   public function speciality(){
   	return $this->hasMany('App\Models\RadiologistSpeciality','radiologist_id','id');
   } 
   public function price(){
   	return $this->hasMany('App\Models\RadiologistBillPrice','radiologist_id','id');
   }

   public function studylist(){
      return $this->hasMany(AssignToRadiologist::class,'radiologist_id','id');
   }
}

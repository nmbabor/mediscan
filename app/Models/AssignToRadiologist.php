<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignToRadiologist extends Model
{
   protected $table = 'hospital_assign_to_radiologist';
   protected $fillable = ['radiologist_id','entry_id','created_by','pre_radiologist_id','assign_date'];

   public function radiologist(){
   	return $this->belongsTo(Radiologist::class,'radiologist_id','id');
   }

   public function entry(){
   	return $this->belongsTo(HospitalEntry::class,'entry_id','id');
   }


}

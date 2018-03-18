<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;

class HospitalEntry extends Model
{
   protected $table = 'hospital_entry';
   protected $fillable = ['hospital_id','procedure_id','procedure_type_id','date','patient_age','ref_doctor','gender','clinical_history','status','patient_name'];

   public function images(){
   	return $this->hasMany(HospitalEntryImage::class,'entry_id','id');
   } 
   public function hospital(){
   	return $this->belongsTo(Hospital::class,'hospital_id','id');
   }
   public function procedure(){
   	return $this->belongsTo(Procedure::class,'procedure_id','id');
   }
   public function procedureType(){
      return $this->belongsTo(ProcedureType::class,'procedure_type_id','id');
   }
   public function assign(){
   	return $this->hasOne(AssignToRadiologist::class,'entry_id','id');
   }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
   protected $table = 'set_procedure';
   protected $fillable = ['name','modality_id','created_by','status','procedure_type_id'];

   public function modality(){
   	return $this->belongsTo('App\Models\Modality','modality_id','id');
   }
   public function type(){
   	return $this->belongsTo('App\Models\ProcedureType','procedure_type_id','id');
   }
}

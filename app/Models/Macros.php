<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Macros extends Model
{
    protected $table = 'set_macros';
   protected $fillable = ['procedure_id','modality_id','details','created_by','status'];

   public function modality(){
   	return $this->belongsTo('App\Models\Modality','modality_id','id');
   }
   public function procedure(){
   	return $this->belongsTo('App\Models\Procedure','procedure_id','id');
   }
}

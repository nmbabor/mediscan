<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologistMacros extends Model
{
   protected $table = 'radiologist_macros';
   protected $fillable = ['radiologist_id','procedure_id','details','modality_id','status'];

   public function modality(){
   	return $this->belongsTo('App\Models\Modality','modality_id','id');
   }
   public function procedure(){
   	return $this->belongsTo('App\Models\Procedure','procedure_id','id');
   }
}

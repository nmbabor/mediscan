<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologistSpeciality extends Model
{
    protected $table = 'radiologist_speciality';
   protected $fillable = ['radiologist_id','modality_id'];

   public function radiologist(){
   	return $this->belongsTo(Radiologist::class,'radiologist_id','id');
   }
}

<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;

class HospitalEntryImage extends Model
{
   protected $table = 'hospital_entry_images';
   protected $fillable = ['photo','entry_id'];
   public function entry(){
   	return $this->belongsTo(HospitalEntry::class,'entry_id','id');
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalRadiologist extends Model
{
    protected $table = 'hospital_radiologist';
   protected $fillable = ['hospital_id','radiologist_id'];
}

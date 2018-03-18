<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalModality extends Model
{
    protected $table = 'hospital_modality';
   protected $fillable = ['hospital_id','modality_id'];
}

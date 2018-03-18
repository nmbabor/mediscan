<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
   protected $table = 'set_modalities';
   protected $fillable = ['name','details','created_by','status'];

   
}

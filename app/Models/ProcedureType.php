<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedureType extends Model
{
    protected $table = 'set_procedure_type';
   protected $fillable = ['name','details','created_by','status'];
}

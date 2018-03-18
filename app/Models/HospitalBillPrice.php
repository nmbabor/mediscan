<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalBillPrice extends Model
{
   protected $table = 'hospital_bill_price';
   protected $fillable = ['hospital_id','procedure_type_id','price'];

   public function type(){
   		return $this->belongsTo('APp\Models\ProcedureType','procedure_type_id','id');
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadiologistBillPrice extends Model
{
   protected $table = 'radiologist_bill_price';
   protected $fillable = ['radiologist_id','procedure_type_id','price'];

   public function type(){
   		return $this->belongsTo('APp\Models\ProcedureType','procedure_type_id','id');
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompanyInfo;
use App\Models\InventoryBranch;
use App\Models\InventoryOrderPayment;
use App\Models\InventoryOrderPaymentItem;
use App\Http\Requests;
use Validator;
use Response;
use DB;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource article table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        return view('index',compact('companyInfo'));

        
    }
     public function databaseTable(){
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $value)
                $accounting[]=$value;       
           DB::statement('ALTER TABLE ' . $value . ' ENGINE = InnoDB'); 
        }
            return $accounting;
    }
    public function branch($id){
        Auth::user()->update(['fk_branch_id'=>$id]);
        return redirect()->back();
    }

    public function allTable(){
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $k => $table) {
            foreach ($table as $key => $value)
                    $allData[$k]['table']=$value;
                    $allData[$k]['row']=DB::table("$value")->count();
        }
        return view('truncate',compact('allData'));
    }
    public function truncateTable($table){

        try {
            DB::statement('DELETE FROM ' . $table); 
            DB::statement('ALTER TABLE ' . $table . ' AUTO_INCREMENT = 1'); 
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','SuccessFully Truncate.');
        }else{
            return redirect()->back()->with('error','Error: '.$bug1);
        }
    }


    public function productOrder(){
        $all=InventoryOrderPayment::leftJoin('inventory_product_add','inventory_order_payment.fk_order_id','inventory_product_add.id')->select('inventory_order_payment.*','inventory_product_add.fk_supplier_id')->get();
        foreach($all as $d){
            InventoryOrderPayment::where('id',$d->id)->update([
                'type'=>1,
            ]);
            InventoryOrderPaymentItem::create([
                'fk_order_id'=>$d->fk_order_id,
                'fk_order_payment_id'=>$d->id,
                'type'=>1,
                'order_last_due'=>$d->last_due,
                'order_paid'=>$d->paid,

            ]);
        }
        return $all;
    }

}

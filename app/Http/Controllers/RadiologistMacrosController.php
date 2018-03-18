<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RadiologistMacros;
use App\Models\Radiologist;
use App\Models\Modality;
use App\Models\Procedure;
use Validator;

class RadiologistMacrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->id)){
            return redirect()->back();
        }

        $id = $request->id;
        $radiologist= Radiologist::where('user_id',$id)->first();
        $allData = RadiologistMacros::orderBy('id','desc')->where('radiologist_id',$radiologist->id)->get();
        $modality = Modality::where('status',1)->pluck('name','id');
        return view('user.radiologist.macros.index', compact('allData','radiologist','modality'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'modality_id' => 'required',
                'procedure_id' => 'required',
                'details' => 'required',
                'radiologist_id' => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        
        try {
            RadiologistMacros::create($input); 
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Created Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedure = Procedure::where(['status'=>1])->pluck('name','id');
        $modality = Modality::where('status',1)->pluck('name','id');
        $data=RadiologistMacros::findOrFail($id);
        $radiologist  = Radiologist::where('id',$data->radiologist_id)->first();
        return view('user.radiologist.macros.edit',compact('data','modality','procedure','radiologist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = RadiologistMacros::findOrFail($id);
         $validator = Validator::make($request->all(),[
                'modality_id' => 'required',
                'procedure_id' => 'required',
                'details' => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $input = $request->all();
           
        try {
            $data->update($input);
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Updated successFully.');
        }else{
            return redirect("macros")->with('error','Something Error Found !, Please try again.'.$bug1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = RadiologistMacros::findOrFail($id);
        
        try {
            
            $data->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success', 'Deleted Successfully .');
        }elseif($bug == 1451){
                return redirect()->back()->with('error','This Data Used AnyWhere.');
            }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
        }


    }

}

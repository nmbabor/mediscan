<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Macros;
use App\Models\Modality;
use App\Models\Procedure;

use Validator;
use Auth;

class SetMacrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $allData = Macros::orderBy('id','desc')->get();
        return view('settings.macros.index', compact('allData'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modality = Modality::where('status',1)->pluck('name','id');
        return view('settings.macros.create',compact('modality'));
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

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['created_by']=Auth::user()->id;
        
        try {
            Macros::create($input); 
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect('macros')->with('success','Created Successfully.');
        }else{
            return redirect('macros')->with('error','Something Error Found !, Please try again.'.$bug1);
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
        $procedure = Procedure::where(['modality_id'=>$id,'status'=>1])->pluck('name','id');
        return view('settings.macros.loadProcedure',compact('procedure'));
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
        $data=Macros::findOrFail($id);
        return view('settings.macros.edit',compact('data','modality','procedure'));
        
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
         $data = Macros::findOrFail($id);
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
        $data = Macros::findOrFail($id);
        
        try {
            
            $data->delete();
            $bug = 0;
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect('macros')->with('success', 'Deleted Successfully .');
        }elseif($bug == 1451){
                return redirect('macros')->with('error','This Data Used AnyWhere.');
            }else{
            return redirect('macros')->with('error','Something Error Found !, Please try again.'.$bug1);
        }


    }

}

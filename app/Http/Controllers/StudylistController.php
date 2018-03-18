<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignToRadiologist;
use App\Models\HospitalEntry;
use App\Models\HospitalEntryImage;

class StudylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = HospitalEntry::findOrFail($id);
        return view('radiologist.viewer',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $input = $request->except('_token','_method');
        $data  = AssignToRadiologist::where('entry_id',$id)->first();
        if($data!=null and $request->radiologist_id!=$data->radiologist_id){
            $input['pre_radiologist_id'] = $data->radiologist_id;
        }
        $input['entry_id'] = $id;
        $input['created_by'] = \Auth::user()->id;
        $input['assign_date'] = date('Y-m-d');
        if($data!=null){

        $result = $data->update($input);
        }else{
        $result = AssignToRadiologist::create($input);
            
        }
        if($result){
            return redirect()->back()->with('success','Successfully assigned to radiologist.');
        }else{
            return redirect()->back()->with('error','Something error found!');
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
        //
    }
}

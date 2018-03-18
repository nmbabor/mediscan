<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\HospitalModality;
use App\Models\HospitalRadiologist;
use App\Models\HospitalBillPrice;
use App\Models\Modality;
use App\Models\Radiologist;
use App\Models\ProcedureType;
use App\Models\RadiologistSpeciality;
use App\User;
use Validator;
use Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers=User::leftJoin('roles','users.type','roles.id')->select('users.*','roles.name as type_name')->where('type',3)->orderBy('users.id','DESC')->paginate(20);

        return view('user.hospital.index',compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!isset($request->id)){
            return redirect()->back();
        }
        $hospital = Hospital::where('user_id',$request->id)->count();
        if($hospital>0){
            return redirect()->back();
        }
        $data = User::where(['type'=>3,'id'=>$request->id])->first();
        $modality = Modality::where('status',1)->pluck('name','id');
        $price  = ProcedureType::where('status',1)->pluck('name','id');
        return view('user.hospital.create',compact('data','modality','price'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
            $input = $request->except('_token');
            $input['created_by']=Auth::user()->id;
           
           $hosId=Hospital::create($input)->id;
           for ($i=0; $i <sizeOf($request->procedure_type_id) ; $i++) { 
                HospitalBillPrice::create([
                    'hospital_id'=>$hosId,
                    'procedure_type_id'=>$request->procedure_type_id[$i],
                    'price'=>$request->price[$i],
                ]);
           }
           for ($i=0; $i <sizeOf($request->modality) ; $i++) { 
                HospitalModality::create([
                    'hospital_id'=>$hosId,
                    'modality_id'=>$request->modality[$i],
                ]);
           }
           for ($i=0; $i <sizeOf($request->radiologist_id) ; $i++) { 
                HospitalRadiologist::create([
                    'hospital_id'=>$hosId,
                    'radiologist_id'=>$request->radiologist_id[$i],
                ]);
           }
            try{

            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
            if($bug==0){
            return redirect('hospital')->with('success','Data Successfully Inserted');
            }elseif($bug==1062){
                return redirect()->back()->with('error','The Email has already been taken.');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
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
        $vals  = explode(',',$id);
        $radiologist = RadiologistSpeciality::leftJoin('radiologist','radiologist_id','radiologist.id')->leftJoin('users','user_id','users.id')->whereIn('modality_id',$vals)->groupBy('radiologist_id')->pluck('users.name','radiologist_id');
        return view('user.hospital.loadRadiologist',compact('radiologist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Hospital::where('user_id',$id)->first();
        $modality = Modality::where('status',1)->pluck('name','id');
        $price  = ProcedureType::where('status',1)->pluck('name','id');
        $availabelModality = $data->modality->pluck('modality_id')->toArray();
        $radiologist = RadiologistSpeciality::leftJoin('radiologist','radiologist_id','radiologist.id')->leftJoin('users','user_id','users.id')->whereIn('modality_id',$availabelModality)->groupBy('radiologist_id')->pluck('users.name','radiologist_id');

        $availabelRadiologist = $data->radiologist->pluck('radiologist_id')->toArray();
        return view('user.hospital.edit',compact('data','modality','price','availabelModality','radiologist','availabelRadiologist'));
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
        $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
            $input = $request->except('_token','_method');
            $hospital = Hospital::where('user_id',$id)->first();
            $data = User::where('id',$id)->first();
           $hospital->update($input);
           $data->update($input);

           for ($i=0; $i <sizeOf($request->bill_id) ; $i++) { 
                HospitalBillPrice::where('id',$request->bill_id[$i])->update([
                    'price'=>$request->price[$i],
                ]);
           }
        HospitalModality::where('hospital_id',$hospital->id)->delete();
           for ($i=0; $i <sizeOf($request->modality) ; $i++) { 
                HospitalModality::create([
                    'hospital_id'=>$hospital->id,
                    'modality_id'=>$request->modality[$i],
                ]);
           }
        HospitalRadiologist::where('hospital_id',$hospital->id)->delete();
           for ($i=0; $i <sizeOf($request->radiologist_id) ; $i++) { 
                HospitalRadiologist::create([
                    'hospital_id'=>$hospital->id,
                    'radiologist_id'=>$request->radiologist_id[$i],
                ]);
           }
            try{

            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect()->back()->with('success','Successfully Updated');
            }elseif($bug==1062){
                return redirect()->back()->with('error','The Email has already been taken.');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
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

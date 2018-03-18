<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modality;
use App\Models\Procedure;
use App\Models\Radiologist;
use App\Models\RadiologistSpeciality;
use App\Models\ProcedureType;
use App\Models\RadiologistBillPrice;
use App\User;
use Validator;
use Auth;
use Image;
class RadiologistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers=User::leftJoin('role_user','users.id','role_user.user_id')->leftJoin('roles','role_user.role_id','roles.id')->select('users.*','roles.name as type_name')->where('type',2)->orderBy('users.id','DESC')->paginate(20);

        return view('user.radiologist.index',compact('allUsers'));
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
        $rad = Radiologist::where('user_id',$request->id)->count();
        if($rad>0){
            return redirect()->back();
        }
        $data = User::where(['type'=>2,'id'=>$request->id])->first();
        $modality = Modality::where('status',1)->pluck('name','id');
        $price  = ProcedureType::where('status',1)->pluck('name','id');
        return view('user.radiologist.create',compact('data','modality','price'));
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
                    'speciality' => 'required',
                    'signature' => 'required',
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
            $input = $request->except('_token');
            $input['created_by']=Auth::user()->id;
           
            if ($request->hasFile('signature')) {
                $signature=$request->file('signature');
                $fileType=$signature->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/signature/';
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($signature);
                $img->resize(150, 75);
                $img->save('images/signature/'.$fileName);
                $input['signature']='images/signature/'.$fileName;
            }
           $radId=Radiologist::create($input)->id;
            for ($i=0; $i <sizeOf($request->procedure_type_id) ; $i++) { 
                RadiologistBillPrice::create([
                    'radiologist_id'=>$radId,
                    'procedure_type_id'=>$request->procedure_type_id[$i],
                    'price'=>$request->price[$i],
                ]);
           }
           for ($i=0; $i <sizeOf($request->speciality) ; $i++) { 
                RadiologistSpeciality::create([
                    'radiologist_id'=>$radId,
                    'modality_id'=>$request->speciality[$i],

                ]);
           }
            try{

            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('radiologist')->with('success','Data Successfully Inserted');
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
        $data = Radiologist::where('user_id',$id)->first();
        $modality = Modality::where('status',1)->pluck('name','id');
        $price  = ProcedureType::where('status',1)->pluck('name','id');
        return view('user.radiologist.edit',compact('data','modality','price'));
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
                    'speciality' => 'required',
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
            $input = $request->except('_token');
            $radiologist = Radiologist::where('user_id',$id)->first();
            $data = User::where('id',$id)->first();
           
            if ($request->hasFile('signature')) {
                $signature=$request->file('signature');
                $fileType=$signature->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/signature/';
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($signature);
                $img->resize(150, 75);
                $img->save('images/signature/'.$fileName);
                $input['signature']='images/signature/'.$fileName;
                if($radiologist->signature !=null and file_exists($radiologist->signature)){
                    unlink($radiologist->signature);
                }

            }
           $radiologist->update($input);
           $data->update($input);
           for ($i=0; $i <sizeOf($request->bill_id) ; $i++) { 
                 RadiologistBillPrice::where('id',$request->bill_id[$i])->update([
                    'price'=>$request->price[$i],
                ]);
           }
        RadiologistSpeciality::where('radiologist_id',$radiologist->id)->delete();

           for ($i=0; $i <sizeOf($request->speciality) ; $i++) { 
                RadiologistSpeciality::create([
                    'radiologist_id'=>$radiologist->id,
                    'modality_id'=>$request->speciality[$i],

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
        $data=User::findOrFail($id);
        $radiologist = Radiologist::where('user_id',$id)->first();
        if($radiologist!=null){

        RadiologistSpeciality::where('radiologist_id',$radiologist->id)->delete();

        if($radiologist->signature !=null and file_exists($radiologist->signature)){
                unlink($radiologist->signature);
            }
            $radiologist->delete();
        }
            \DB::table('role_user')->where('user_id',$id)->delete();
            $data->delete();
       try{
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect()->back()->with('success','Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This user is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }
}

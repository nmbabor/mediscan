<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\Hospital;
use App\Models\HospitalEntry;
use App\Models\HospitalEntryImage;
use App\Models\AssignToRadiologist;
use App\Models\RadiologistSpeciality;
use App\Models\Radiologist;
use Image;
use Auth;
use Validator;

class HospitalEntryController extends Controller
{
    public function __construct(){
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = HospitalEntry::orderBy('id','DESC');
        if(Auth::user()->isRole('administrator')){
            $allData=$allData->paginate(10);
        }elseif(Auth::user()->isRole('hospital')){
            $hospital  =Hospital::where('user_id',Auth::user()->id)->first();
            $allData=$allData->where('hospital_id',$hospital->id)->paginate(10);
            
        }else{
            $rad = Radiologist::where('user_id',Auth::user()->id)->value('id');
            $assign  = AssignToRadiologist::where('radiologist_id',$rad)->pluck('entry_id');
            $allData=$allData->whereIn('id',$assign)->paginate(10);
        }
        return view('hospital.entry.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospital  =Hospital::where('user_id',Auth::user()->id)->first();
        if($hospital==null){
            return redirect()->back();
        }

        $procedure = Procedure::where(['status'=>1])->pluck('name','id');
        $type = ProcedureType::where(['status'=>1])->pluck('name','id');
        return view('hospital.entry.create',compact('procedure','type','hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hospitalId  =Hospital::where('user_id',Auth::user()->id)->value('id');
        $validator = Validator::make($request->all(),[
                'procedure_id'      => 'required',
                'procedure_type_id' => 'required',
                'gender'            => 'required',
                'date'              => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['hospital_id']=$hospitalId;
        $input['date']=date('Y-m-d',strtotime($request->date));
        
        try {
            $id = HospitalEntry::create($input)->id; 
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect("hospital-entry/$id")->with('success','Created Successfully.');
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
        $hospital  =Hospital::where('user_id',Auth::user()->id)->first();
        if($hospital==null){
            return redirect()->back();
        }
        $photos = HospitalEntryImage::leftJoin('hospital_entry','hospital_entry_images.entry_id','hospital_entry.id')->where(['entry_id'=>$id,'hospital_id'=>$hospital->id])->pluck('hospital_entry_images.photo','hospital_entry_images.id');
        return view('hospital.entry.image',compact('id','photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->isRole('administrator')){
            $data = HospitalEntry::findOrFail($id);
        }elseif(Auth::user()->isRole('hospital')){
            $hospital = $hospital  =Hospital::where('user_id',Auth::user()->id)->first();
            $data = HospitalEntry::where(['id'=>$id,'hospital_id'=>$hospital->id])->first();
        }else{
            return redirect()->back();
        }
        if($data==null){
            return redirect()->back();
        }
        $procedure = Procedure::where(['status'=>1])->pluck('name','id');
        $type = ProcedureType::where(['status'=>1])->pluck('name','id');
        return view('hospital.entry.edit',compact('procedure','type','data'));
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
        $data=HospitalEntry::findOrFail($id);
        $input = $request->except('_token','_method');
        $validator = Validator::make($request->all(),[
                'procedure_id'      => 'required',
                'procedure_type_id' => 'required',
                'gender'            => 'required',
                'date'              => 'required',

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['date']=date('Y-m-d',strtotime($request->date));
        
        try {
            $data->update($input); 
            $bug = 0;
            
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }
        
        if($bug == 0){
            return redirect()->back()->with('success','Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.'.$bug1);
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
        $data = HospitalEntry::findOrFail($id);
        $photos = HospitalEntryImage::where('entry_id',$id)->get();
        foreach($photos as $photo){
            if($photo->photo!=null and file_exists($photo->photo)){
                unlink($photo->photo);
            }
            $photo->delete();
        }            
            $data->delete();
        try {
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

    
    public function uploadImages(Request $request, $id)
    {
        $imgId=0;
        $entry=HospitalEntry::findOrFail($id);
         if ($request->hasFile('file')) {
            
                $file=$request->file('file');
                $fileType=$file->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $path=base_path().'/images/entry'.date('/Y/m/d/');
                $filePath ='images/entry'.date('/Y/m/d/').$fileName; 
                if (!is_dir($path)) {
                    mkdir("$path",0777,true);
                    }
                $img = Image::make($file);
                $img->resize(500,500);
                $img->save($filePath);
                $imgId = $entry->images()->create(['photo'=>$filePath])->id;
            }
        return $imgId;
    }

    public function deletePhoto($id){
        $photo = HospitalEntryImage::findOrFail($id);
        if($photo->photo!=null and file_exists($photo->photo)){
            unlink($photo->photo);
        }
        $photo->delete();
        return 'Delete';
    }
     public function single($id)
    {
        
        $data = HospitalEntry::findOrFail($id);
        $assign  = AssignToRadiologist::where('entry_id',$id)->first();
        $modality = RadiologistSpeciality::where('modality_id',$data->procedure->modality_id)->get();
        return view('hospital.entry.show',compact('data','modality','assign'));
    }

}

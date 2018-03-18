
	@extends('layout.app')
		@section('content')
		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	<a class="btn btn-info btn-xs" href="{{URL::to('/hospital-entry')}}">View All</a>
                                
                            </div>
                            <h4 class="panel-title">Show Uploaded Data</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="30%"><b>Hospital Name: </b></td>
                                        <td>{{$data->hospital->user->name}}</td>
                                     </tr>
                                     <tr>
                                        <td><b>Patient Name: </b></td>
                                        <td>{{$data->patient_name}}</td>
                                    </tr>
                                     <tr>
                                        <td><b>Patient Age: </b></td>
                                        <td>{{$data->patient_age}}</td>
                                    </tr>
                                     <tr>
                                        <td><b>Gender: </b></td>
                                        <td>{{$data->gender}}</td>
                                        
                                    </tr>
                                     <tr>   
                                        <td><b>Date: </b></td>
                                        <td>{{date('d-m-Y',strtotime($data->date))}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Procedure: </b></td>
                                        <td>{{$data->procedure->name}}</td>
                                    </tr>
                                     <tr>
                                        <td><b>Procedure Type: </b></td>
                                        <td>{{$data->procedureType->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Modality: </b></td>
                                        <td>{{$data->procedure->modality->name}}</td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><b>Ref. Doctor: </b></td>
                                        <td>{{$data->ref_doctor}}</td>
                                    </tr>
                                     <tr>
                                        <td><b>Clinical History: </b></td>
                                        <td>{{$data->clinical_history}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if(Auth::user()->isRole('administrator'))
                                
                                <div class="panel panel-success">
                                  <div class="panel-heading">Assign to Radiologist @if($assign!=null) ({{$assign->radiologist->user->name}}) @endif</div>
                                  <div class="panel-body">
                                    {!! Form::open(['route'=>['studylist.update',$data->id],'method'=>'PUT']) !!}
                                    <ul class="list-group">
                                        @foreach($modality as $mod)
                                        <li class="list-group-item"><label><input required type="radio" name="radiologist_id" @if($assign!=null) {{($assign->radiologist_id == $mod->radiologist->id)?'checked':''}}  @endif value="{{$mod->radiologist->id}}"> {{$mod->radiologist->user->name}} ({{$mod->radiologist->studylist->where('status',0)->count()}})</label></li>
                                        @endforeach    
                                    </ul>
                                      <button class="btn btn-info">Submit</button>
                                      {!! Form::close() !!}
                                  </div>
                                </div>
                                @endif

                                @if(Auth::user()->isRole('radiologist'))
                                <a href='{{URL::to("studylist/$data->id")}}' class="btn btn-warning btn-lg" style="padding: 60px;font-size: 30px;"><i class="fa fa-eye"></i> Dicom Viewer</a>
                                @endif
                            </div>
                            <br>
                        @if(Auth::user()->isRole('administrator'))
                            @if(count($data->images)>0)
                            <div class="col-md-12">
                                <p>Uploaded Images</p>
                                @foreach($data->images as $photo)
                                    <div class="col-md-1 min-padding text-center image-load-entry">
                                        <img src="{{asset($photo->photo)}}" class="img-responsive" alt="Hospital Report">
                                        
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        @endif
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
   
    @endsection



@extends('layout.app')
    @section('content')
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{route('radiologist.index')}}" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> View all</a>
                        
                    </div>
                    <h4 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> Radiologist Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => ['radiologist.update',$data->user->id],'class'=>'form-horizontal','files'=>'true','method'=>'PUT')) !!}
                                    
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="fullName" class="col-sm-3 control-label">Name &amp; Email : </label>
                        <div class="col-sm-3">
                            <input type="text" name="name" parsley-trigger="change" required
                               placeholder="Enter Full Name" class="form-control" id="fullName" value="{{$data->user->name}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="email" name="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $data->user->email}}">
                        </div>
                    </div>
                   
                    <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                        <label for="phone_number" class="col-sm-3 control-label">Mobile Number* : </label>
                        <div class="col-sm-7">
                            <input type="text" name="phone_number" parsley-trigger="change" required
                               placeholder="Mobile number" class="form-control" id="phone_number" value="{{ $data->user->phone_number}}">
                               @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        {{Form::label('address','Address :',['class'=>'col-sm-3 control-label'])}}
                        <div class="col-md-7">
                            {{Form::textArea('address',$data->user->address,['class'=>'form-control','placeholder'=>'Address','rows'=>'2'])}}
                             @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{$data->user_id}}">
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                        <label for="gender" class="col-sm-3 control-label">Gender : </label>
                        <div class="col-sm-2">
                           {{Form::select('gender',['Male'=>'Male','Female'=>'Female'],$data->gender,['class'=>'form-control'])}}
                               @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group ">
                        {{Form::label('speciality','Speciality :',['class'=>'col-sm-3 control-label'])}}
                        <div class="col-md-3">
                            @foreach($modality as $id => $mod)
                                <div class="min-padding">
                                    <label class="control-label">
                                        <? $input = '<input type="checkbox" name="speciality[]" value="'.$id.'">' ?>
                                        @foreach($data->speciality as $spec)
                                        @if($spec->modality_id == $id)
                                        <? $input = '<input type="checkbox" checked name="speciality[]" value="'.$id.'">';
                                        break;
                                         ?>

                                        @endif
                                        @endforeach
                                        <? echo $input; ?>
                                        {{$mod}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <p><b>Upload Signature :</b></p>
                            <label class="img_upload" for="file">
                                @if($data->signature!=null)
                                <img class="img-responsive" id="image_load" src="{{asset($data->signature)}}" alt="Upload Your signature" title="Upload Your signature">

                                @else
                                <img class="img-responsive" id="image_load" src="{{asset('images/signature.png')}}" alt="Upload Your signature" title="Upload Your signature">

                                @endif
                               <p class="text-center"><small>Click Here</small></p>
                            </label>
                        {{Form::file('signature',array('id'=>'file','style'=>'display:none'))}}
                         @if ($errors->has('signature'))
                                <span class="help-block" style="display:block">
                                    <strong>{{ $errors->first('signature') }}</strong>
                                </span>
                            @endif
                                </div>      
                    </div>
                    <hr>
                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label for="price" class="col-sm-3 control-label">Billing Price: </label>
                        <div class="col-sm-7 no-padding">
                        @foreach($data->price as $key => $prc)
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{$prc->type->name}} : </label>
                                <div class="col-md-7">
                                    <input type="hidden" name="procedure_type_id[]" value="{{$prc->procedure_type_id}}">
                                    <input type="hidden" name="bill_id[]" value="{{$prc->id}}">
                                    <input type="number" name="price[]" min="0" parsley-trigger="change" required
                                   placeholder="{{$prc->type->name}}" class="form-control" value="{{$prc->price}}">
                                </div>
                            </div>
                        @endforeach
                        
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
                                Update
                            </button>
                        </div>
                    </div>
                        {!! Form::close() !!}      
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection
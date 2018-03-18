@extends('layout.app')
    @section('content')
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{route('hospital.index')}}" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> View all</a>
                        
                    </div>
                    <h4 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> Hospital Information</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => ['hospital.update',$data->user->id],'class'=>'form-horizontal','files'=>'true','method'=>'PUT')) !!}
                                    
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
                    <div class="form-group {{ $errors->has('technologist_contact') ? 'has-error' : '' }}">
                        <label for="technologist_contact" class="col-sm-3 control-label">Technologist contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Technologist contact No" value="{{$data->technologist_contact}}" name="technologist_contact" class="form-control" id="technologist_contact" >
                               @if ($errors->has('technologist_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('technologist_contact') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('manager_contact') ? 'has-error' : '' }}">
                        <label for="manager_contact" class="col-sm-3 control-label">Manager contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Manager contact No" value="{{$data->manager_contact}}" name="manager_contact" class="form-control" id="manager_contact" >
                               @if ($errors->has('manager_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manager_contact') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('reception_contact') ? 'has-error' : '' }}">
                        <label for="reception_contact" class="col-sm-3 control-label">Reception contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Reception contact No" value="{{$data->reception_contact}}" name="reception_contact" class="form-control" id="reception_contact">
                               @if ($errors->has('reception_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reception_contact') }}</strong>
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
                    <hr>
                    <div class="form-group ">
                        {{Form::label('modality','Available Modality :',['class'=>'col-sm-3 control-label'])}}
                        <div class="col-md-3">
                            @foreach($modality as $id => $mod)
                                <div class="min-padding">
                                    <label class="control-label"><input id="modality-{{$id}}" class="modality-check" type="checkbox" {{ in_array($id, $availabelModality)?'checked':'' }} name="modality[]" value="{{$id}}"> {{$mod}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <p><b>Radiologist :</b></p>
                            <div id="radiologist">
                                @foreach($radiologist as $id => $rad)
                                    <div class="min-padding">
                                        <label class="control-label"><input class="radio-check" type="checkbox" name="radiologist_id[]" {{ in_array($id, $availabelRadiologist)?'checked':'' }} value="{{$id}}"> {{$rad}}</label>
                                    </div>
                                @endforeach
                            </div>
                            
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
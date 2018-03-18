@extends('layout.app')
    @section('content')
    @if ($errors->has('email'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>{{ $errors->first('email') }}</b> 
           </div>
        </div>
    @endif
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{route('users.create')}}" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> Add new</a>
                        
                    </div>
                    <h4 class="panel-title">View Radiologist </h4>
                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th>Macros</th>
                                <th width="3%">Status</th>
                                <th width="10%">Created At</th>
                                <th colspan="2" width="5%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <? $i=1; ?>
                    @foreach($allUsers as $data)
                            <tr>
                        <td>{{$i++}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->type_name}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td><a href='{{URL::to("radiologist-macro?id=$data->id")}}' class="btn btn-warning btn-xs">Macros</a></td>
                        <td><i class="{{($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle text-danger'}}"></i></td>
                        <td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
                        <td><a href='{{URL::to("radiologist/$data->id/edit")}}' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i></a>
                        </td>
                        <td>
                    {!! Form::open(array('route' => ['radiologist.destroy',$data->id],'method'=>'DELETE')) !!}
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirmDelete();"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                                                       
                        </tbody>
                    </table>
                    <div class="pull-right">
                    {{$allUsers->render()}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
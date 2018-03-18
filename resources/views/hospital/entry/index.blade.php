@extends('layout.app')
    @section('content')
    
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{route('hospital-entry.create')}}" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> Add new</a>
                        
                    </div>
                    <h4 class="panel-title">View Hospital Upload Entry</h4>
                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Hospital</th>
                                <th>Procedure</th>
                                <th>Image Count</th>
                                <th>Date</th>
                                <th>Radiologist</th>
                                <th width="3%">Status</th>
                                <th colspan="2" width="10%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <? $i=1; ?>
                    @foreach($allData as $data)
                            <tr>
                        <td>{{$i++}}</td>
                        <td><a href='{{URL::to("hospital-entry-show/$data->id")}}'> {{$data->hospital->user->name}} </a></td>
                        <td>{{$data->procedure->name}}</td>
                        <td>{{$data->images->count()}}</td>
                        <td>{{date('d-M-Y',strtotime($data->date))}}</td>
                        <td>
                            @if($data->assign!=null)
                            {{$data->assign->radiologist->user->name}}</td>
                            @else
                            <b class="text-danger">Unassigned</b>
                            @endif
                        <td>
                            @if($data->status==0)
                            <b class="text-success">Processing</b>
                            @elseif($data->status==1)
                            <a href="" class="btn btn-info btnxs">Report</a>
                            @else
                            <b class="text-warning">Re-checking</b>
                            @endif
                            </td>
                        <td>
                            <a href='{{URL::to("hospital-entry-show/$data->id/")}}' title="View" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            <a title="Edit" href='{{URL::to("hospital-entry/$data->id/edit")}}' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i></a>
                        </td>
                        <td>
                    {!! Form::open(array('route' => ['hospital-entry.destroy',$data->id],'method'=>'DELETE')) !!}
                        <button title="Delete" type="submit" class="btn btn-xs btn-danger" onclick="return confirmDelete();"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                                                       
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{$allData->render()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
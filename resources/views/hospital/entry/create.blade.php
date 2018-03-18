
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
                            <h4 class="panel-title">Upload Entry</h4>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('route' => 'hospital-entry.store','class'=>'form-horizontal','method'=>'POST','files'=>'true', 'role'=>'form','data-parsley-validate novalidate')) !!}
                            <div class="col-md-6 no-padding">
                                <div class="form-group {{ $errors->has('ref_doctor') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="ref_doctor">Ref Doctor:</label>
                                    <div class="col-md-8">
                                        {{Form::text('ref_doctor','',['class'=>'form-control','placeholder'=>'Ref Doctor'])}}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('patient_name') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="patient_name">Patient Name:</label>
                                    <div class="col-md-8">
                                        {{Form::text('patient_name','',['class'=>'form-control','placeholder'=>'Patient Name'])}}
                                    </div>
                                </div>
                                

                                <div class="form-group {{ $errors->has('procedure_id') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="procedure_id">Procedure :</label>
                                    <div class="col-md-8">
                                        {{Form::select('procedure_id',$procedure,'',['class'=>'form-control select','placeholder'=>'Select Procedure','id'=>'procedure_id','required'])}}
                                    </div>
                                     @if ($errors->has('procedure_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('procedure_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('procedure_type_id') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="procedure_type_id">Procedure Type:</label>
                                    <div class="col-md-8" id="loadProcedure">
                                        {{Form::select('procedure_type_id',$type,'',['class'=>'form-control','placeholder'=>'Procedure Type','id'=>'procedure_type_id','required'])}}
                                    </div>
                                     @if ($errors->has('procedure_type_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('procedure_type_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               <div class="form-group {{ $errors->has('date') ? ' has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="date">Date:</label>
                                    <div class="col-md-8">
                                        {{Form::text('date',date('d-m-Y'),['class'=>'form-control datepicker','placeholder'=>'Date'])}}
                                    </div>
                                </div>
                                <input type="hidden" name="hospital_id" value="{{$hospital->id}}">
                                 <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-info"> Continue</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-padding">
                            	<div class="form-group {{ $errors->has('patient_age') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="patient_age">Patient Age:</label>
                                    <div class="col-md-8">
                                        {{Form::text('patient_age','',['class'=>'form-control','placeholder'=>'Patient Age'])}}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="gender">Gender:</label>
                                    <div class="col-md-8">
                                        <label>{{Form::radio('gender','Male','',['required'])}} Male &nbsp; </label>
                                        <label>{{Form::radio('gender','Female','',['required'])}} Female </label>
                                    </div>
                                </div>
								<div class="form-group {{ $errors->has('clinical_history') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" for="clinical_history">Clinical History:</label>
                                    <div class="col-md-8">
                                        {{Form::textarea('clinical_history','',['class'=>'form-control','placeholder'=>'Clinical History','rows'=>'4'])}}
                                    </div>
                                </div>
                               
                            </div>
							<div class="col-md-12">
								
                               
							</div>		
                            {!! Form::close(); !!}
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
   
    @endsection
@section('script')
    
<script type="text/javascript">
   
    $(document).on('change','#procedure_id',function(){
        var id = $(this).val();
         
         $.ajax({
            url:"{{URL::to('procedure')}}/"+id,
            success: function(result){
                $('#procedure_type_id option').removeAttr('selected')
                .filter('[value='+result+']')
                .attr('selected', true);
                $("#procedure_type_id").val(result).change();
            }
         });
    });
</script>
@endsection


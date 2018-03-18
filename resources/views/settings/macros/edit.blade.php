
	@extends('layout.app')
		@section('content')
		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	<a class="btn btn-info btn-xs" href="{{URL::to('/macros')}}">View All</a>
                                
                            </div>
                            <h4 class="panel-title">Macros Edit</h4>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('route' => ['macros.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','role'=>'form','data-parsley-validate novalidate')) !!}
                            <div class="col-md-12 no-padding">
                            	
                            	<div class="form-group col-md-4 {{ $errors->has('modality_id') ? ' has-error' : '' }}">
									<label class="col-md-12" for="modality_id">Modality :</label>
									<div class="col-md-12">
										{{Form::select('modality_id',$modality,$data->modality_id,['class'=>'form-control','placeholder'=>'Select Modality','required','id'=>'modality_id'])}}
										 @if ($errors->has('modality_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('modality_id') }}</strong>
                                            </span>
                                        @endif
									</div>
								</div>
								<div class="form-group col-md-4 {{ $errors->has('procedure_id') ? ' has-error' : '' }}">
									<label class="col-md-12" for="procedure_id">Procedure :</label>
									<div class="col-md-12" id="loadProcedure">
										{{Form::select('procedure_id',$procedure,$data->procedure_id,['class'=>'form-control','placeholder'=>'Select Procedure','required','id'=>'procedure_id'])}}
									</div>
									 @if ($errors->has('procedure_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('procedure_id') }}</strong>
                                        </span>
                                    @endif
								</div>
                                <div class="form-group col-md-4 {{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label class="col-md-12" for="status">Status :</label>
                                    <div class="col-md-12">
                                        {{Form::select('status',['1'=>'Active','2'=>'Inactive'],$data->status,['class'=>'form-control','required','id'=>'status'])}}
                                         @if ($errors->has('status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                                    <label class="col-md-12" for="details"> Macro  :</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control tinymce" id="details" name="details" rows="4"  placeholder="Macro"><? echo $data->details ?></textarea>
                                         @if ($errors->has('details'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('details') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
								
								
                                <div class="form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
									</div>
								</div>
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
    $(document).on('change','#modality_id',function(){
        var id = $(this).val();
        $('#loadProcedure').load('{{URL::to("macros")}}/'+id);
    });
</script>
@endsection
	
        

		<?php $__env->startSection('content'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	<a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/hospital-entry')); ?>">View All</a>
                                
                            </div>
                            <h4 class="panel-title">Upload Entry</h4>
                        </div>
                        <div class="panel-body">
                            <?php echo Form::open(array('route' => ['hospital-entry.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>'true', 'role'=>'form','data-parsley-validate novalidate')); ?>

                            <div class="col-md-6 no-padding">
                                <div class="form-group <?php echo e($errors->has('ref_doctor') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="ref_doctor">Ref Doctor:</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::text('ref_doctor',$data->ref_doctor,['class'=>'form-control','placeholder'=>'Ref Doctor'])); ?>

                                    </div>
                                </div>
                                <div class="form-group <?php echo e($errors->has('patient_name') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="patient_name">Patient Name:</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::text('patient_name',$data->patient_name,['class'=>'form-control','placeholder'=>'Patient Name'])); ?>

                                    </div>
                                </div>

                                <div class="form-group <?php echo e($errors->has('procedure_id') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="procedure_id">Procedure :</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::select('procedure_id',$procedure,$data->procedure_id,['class'=>'form-control select','placeholder'=>'Select Procedure','id'=>'procedure_id','required'])); ?>

                                    </div>
                                     <?php if($errors->has('procedure_id')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('procedure_id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e($errors->has('procedure_type_id') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="procedure_type_id">Procedure Type:</label>
                                    <div class="col-md-8" id="loadProcedure">
                                        <?php echo e(Form::select('procedure_type_id',$type,$data->procedure_type_id,['class'=>'form-control','placeholder'=>'Procedure Type','id'=>'procedure_type_id','required'])); ?>

                                    </div>
                                     <?php if($errors->has('procedure_type_id')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('procedure_type_id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                               <div class="form-group <?php echo e($errors->has('date') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="date">Date:</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::text('date',date('d-m-Y',strtotime($data->date)),['class'=>'form-control datepicker','placeholder'=>'Date'])); ?>

                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-info"> Update</button>
                                        <a href='<?php echo e(URL::to("hospital-entry/$data->id")); ?>' class="btn btn-warning"> Image Upload</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-padding">
                            	<div class="form-group <?php echo e($errors->has('patient_age') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="patient_age">Patient Age:</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::text('patient_age',$data->patient_age,['class'=>'form-control','placeholder'=>'Patient Age'])); ?>

                                    </div>
                                </div>
                                <div class="form-group <?php echo e($errors->has('gender') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="gender">Gender:</label>
                                    <div class="col-md-8">
                                        <? 
                                        $male = ($data->gender=='Male')?1:0;
                                        $female = ($data->gender=='Female')?1:0;
                                         ?>
                                        <label><?php echo e(Form::radio('gender','Male',$male,['required'])); ?> Male &nbsp; </label>
                                        <label><?php echo e(Form::radio('gender','Female',$female,['required'])); ?> Female </label>
                                    </div>
                                </div>
								<div class="form-group <?php echo e($errors->has('clinical_history') ? ' has-error' : ''); ?>">
                                    <label class="col-md-4 control-label" for="clinical_history">Clinical History:</label>
                                    <div class="col-md-8">
                                        <?php echo e(Form::textarea('clinical_history',$data->clinical_history,['class'=>'form-control','placeholder'=>'Clinical History','rows'=>'4'])); ?>

                                    </div>
                                </div>
                               
                            </div>
							<div class="col-md-12">
								
                               
							</div>		
                            <?php echo Form::close();; ?>

                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
   
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    
<script type="text/javascript">
   
    $(document).on('change','#procedure_id',function(){
        var id = $(this).val();
         
         $.ajax({
            url:"<?php echo e(URL::to('procedure')); ?>/"+id,
            success: function(result){
                $('#procedure_type_id option').removeAttr('selected')
                .filter('[value='+result+']')
                .attr('selected', true);
                $("#procedure_type_id").val(result).change();
            }
         });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
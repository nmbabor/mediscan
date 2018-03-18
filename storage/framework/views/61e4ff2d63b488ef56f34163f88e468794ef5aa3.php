	
		<?php $__env->startSection('content'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	<a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/radiologist-macro?id='.$radiologist->user_id)); ?>">View All</a>
                                
                            </div>
                            <h4 class="panel-title">Edit Macro of "<?php echo e($radiologist->user->name); ?>"</h4>
                        </div>
                        <div class="panel-body">
                            <?php echo Form::open(array('route' => ['radiologist-macro.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','role'=>'form','data-parsley-validate novalidate')); ?>

                            <div class="col-md-12 no-padding">
                            	
                            	<div class="form-group col-md-4 <?php echo e($errors->has('modality_id') ? ' has-error' : ''); ?>">
									<label class="col-md-12" for="modality_id">Modality :</label>
									<div class="col-md-12">
										<?php echo e(Form::select('modality_id',$modality,$data->modality_id,['class'=>'form-control','placeholder'=>'Select Modality','required','id'=>'modality_id'])); ?>

										 <?php if($errors->has('modality_id')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('modality_id')); ?></strong>
                                            </span>
                                        <?php endif; ?>
									</div>
								</div>
								<div class="form-group col-md-4 <?php echo e($errors->has('procedure_id') ? ' has-error' : ''); ?>">
									<label class="col-md-12" for="procedure_id">Procedure :</label>
									<div class="col-md-12" id="loadProcedure">
										<?php echo e(Form::select('procedure_id',$procedure,$data->procedure_id,['class'=>'form-control','placeholder'=>'Select Procedure','required','id'=>'procedure_id'])); ?>

									</div>
									 <?php if($errors->has('procedure_id')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('procedure_id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
								</div>
                                <div class="form-group col-md-4 <?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                    <label class="col-md-12" for="status">Status :</label>
                                    <div class="col-md-12">
                                        <?php echo e(Form::select('status',['1'=>'Active','2'=>'Inactive'],$data->status,['class'=>'form-control','required','id'=>'status'])); ?>

                                         <?php if($errors->has('status')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('status')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group <?php echo e($errors->has('details') ? ' has-error' : ''); ?>">
                                    <label class="col-md-12" for="details"> Macro  :</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control tinymce" id="details" name="details" rows="4"  placeholder="Macro"><? echo $data->details ?></textarea>
                                         <?php if($errors->has('details')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('details')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
								
								
                                <div class="form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
									</div>
								</div>
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
    $(document).on('change','#modality_id',function(){
        var id = $(this).val();
        $('#loadProcedure').load('<?php echo e(URL::to("macros")); ?>/'+id);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
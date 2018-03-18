	
		<?php $__env->startSection('content'); ?>
        
		<!-- begin #content -->
		<div id="content" class="content">
		
			<!-- end page-header -->
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a class="btn btn-warning btn-xs" href="#add-new">Add New</a>
                            </div>
                            <h4 class="panel-title">Private Macros of "<?php echo e($radiologist->user->name); ?>"</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Procedure Name</th>
                                        <th>Modality</th>
                                        <th width="8%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($allData)==0): ?>
                                        <tr>
                                            <td colspan="5"><h4 class="text-center text-danger">Empty Record Found!</h4></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php $i=0; ?>
                                <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++; ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($data->modality->name); ?></td>
                                        <td><?php echo e($data->procedure->name); ?></td>
                                        <td>
                                            <?php echo e(($data->status==1)?'Active':'Inactive'); ?>

                                        </td>
                                        <td>
                                        <!-- edit section -->
                                            <a href='<?php echo e(URL::to("radiologist-macro/$data->id/edit")); ?>' class="btn btn-xs btn-success"><i class="fa fa-pencil-square-o" ></i></a>

                                            <!-- delete section -->
                                            <?php echo Form::open(array('route'=> ['radiologist-macro.destroy',$data->id],'method'=>'DELETE')); ?>

                                                <?php echo e(Form::hidden('id',$data->id)); ?>

                                                <button type="submit" onclick="return confirmDelete();" class="btn btn-danger btn-xs">
                                                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            <?php echo Form::close(); ?>

                                            <!-- delete section end -->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="panel panel-default" id="add-new">
                          <div class="panel-heading">Add New Macros</div>
                          <div class="panel-body">
                            
                            <?php echo Form::open(array('route' => 'radiologist-macro.store','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true', 'id'=>'commentForm','role'=>'form','data-parsley-validate novalidate')); ?>

                            <div class="col-md-12 no-padding">
                                <input type="hidden" name="radiologist_id" value="<?php echo e($radiologist->id); ?>">
                                <div class="form-group col-md-4 <?php echo e($errors->has('modality_id') ? ' has-error' : ''); ?>">
                                    <label class="col-md-12" for="modality_id">Modality :</label>
                                    <div class="col-md-12">
                                        <?php echo e(Form::select('modality_id',$modality,'',['class'=>'form-control','placeholder'=>'Select Modality','required','id'=>'modality_id'])); ?>

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
                                        <span class="form-control">Modality select first!</span>
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
                                        <?php echo e(Form::select('status',['1'=>'Active','2'=>'Inactive'],'1',['class'=>'form-control','required','id'=>'status'])); ?>

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
                                        <textarea class="form-control tinymce" id="details" name="details" rows="4"  placeholder="Macro"></textarea>
                                         <?php if($errors->has('details')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('details')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                                
                                
                            <?php echo Form::close();; ?>

                        
                          </div>
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
	
		<?php $__env->startSection('content'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                            </div>
                            <h4 class="panel-title">Procedure</h4>
                        </div>
                        <div class="panel-body">
                        	<div class="col-md-12 no-padding">
                        		<?php echo Form::open(array('route' => 'procedure.store','class'=>'form-horizontal author_form','method'=>'POST','role'=>'form','data-parsley-validate novalidate')); ?>

                                <div class="form-group col-md-4">
									<label class="col-md-12" for="name"> Name<span class="text-danger">* </span> :</label>
									<div class="col-md-12">
										<input class="form-control" type="text" id="name" name="name" placeholder="Name" data-parsley-required="true" required />
									</div>
								</div>
                                <div class="form-group col-md-3">
                                    <label class="col-md-12" for="details">Modality<span class="text-danger">* </span> :</label>
                                    <div class="col-md-12">
                                    <?php echo e(Form::select('modality_id',$modality,'',['class'=>'form-control','placeholder'=>'Select Modality','required'])); ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="col-md-12" for="details">Type<span class="text-danger">* </span> :</label>
                                    <div class="col-md-12">
                                    <?php echo e(Form::select('procedure_type_id',$type,'',['class'=>'form-control','placeholder'=>'Select procedure type','required'])); ?>

                                    </div>
                                </div>

                                <input type="hidden" name="status" value="1">
			                    <div class="form-group col-md-1">
                                    <label class="col-md-12" > &nbsp; </label>
			                    	<button class="btn btn-success" type="submit">Save</button>
			                    </div>     
			                <?php echo e(Form::close()); ?> 
                        	</div>
                        	<div class="col-md-12">
                        		
	                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
	                                <thead>
	                                    <tr>
	                                        <th width="5%">Sl</th>
	                                        <th>Name</th>
	                                        <th width="12%">Modality</th>
	                                        <th width="25%">Type</th>
	                                        <th width="10%">Status</th>
	                                        <th width="10%">Action</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                <?php if(count($allData)==0): ?>
	                                <tr>
	                                	<td colspan="5" class=" text-center"><h3 class="text-danger">There is no record here.</h3></td>
	                                </tr>
	                                <?php endif; ?>
	                                <?php $i=0; ?>
	                                <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                <?php $i++; ?>
	                                    <tr class="odd gradeX">
	                                        <td><?php echo e($i); ?></td>
	                                        <td><?php echo e($data->name); ?></td>
	                                        <td><?php echo e($data->modality->name); ?></td>
	                                        <td><?php echo e($data->type->name); ?></td>
	                                        <td>
	                                        	<?php if($data->status=="1"): ?>
	                                        		<span class="text-success">Active</span>
	                                        	<?php else: ?>
	                                        		<b class='text-danger'>Inactive</b>
	                                        	<?php endif; ?>
	                                        </td>
	                                        <td>
	                                        <!-- edit section -->
	                                            <a href="ui_modal_notification.html#modal-dialog<?php echo $data->id;?>" class="btn btn-xs btn-success" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
	                                            <!-- #modal-dialog -->
	                                            <div class="modal fade" id="modal-dialog<?php echo $data->id;?>">
	                                                <div class="modal-dialog">
	                                                    <div class="modal-content">
	                                                    <?php echo Form::open(array('route' => ['procedure.update',$data->id],'class'=>'form-horizontal author_form','method'=>'PUT','files'=>'true', 'id'=>'commentForm','role'=>'form','data-parsley-validate novalidate')); ?>

	                                                        <div class="modal-header">
	                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                                            <h4 class="modal-title">Edit Procedure</h4>
	                                                        </div>
	                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4 col-sm-4" for="name"> Name</label>
                                                                <div class="col-md-8 col-sm-8">
                                                                    <input class="form-control" type="text" id="name" name="name" value="<?php echo $data->name; ?>" data-parsley-required="true" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
							                                    <label class="control-label col-md-4 col-sm-4" for="details">Modality :</label>
							                                    <div class="col-md-8">
							                                    <?php echo e(Form::select('modality_id',$modality,$data->modality_id,['class'=>'form-control','placeholder'=>'Select Modality','required'])); ?>

							                                    </div>
							                                </div>
                                                           <div class="form-group">
							                                    <label class="control-label col-md-4 col-sm-4" for="details">Type :</label>
							                                    <div class="col-md-8">
							                                    <?php echo e(Form::select('procedure_type_id',$type,$data->procedure_type_id,['class'=>'form-control','placeholder'=>'Select procedure type','required'])); ?>

							                                    </div>
							                                </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4 col-sm-4"> Status :</label>
                                                                <div class="col-md-3 col-sm-3">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" <?php if($data->status=="1"): ?><?php echo e("checked"); ?><?php endif; ?>> Active
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" name="status" id="radio-required2" value="0" <?php if($data->status=="0"): ?><?php echo e("checked"); ?><?php endif; ?>> Inactive
                                                                        </label>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                             
                                                        </div>
	                                                        
	                                                        <div class="modal-footer">
	                                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
	                                                            <button type="submit" class="btn btn-sm btn-success">Update</button>
	                                                        </div>
	                                                    <?php echo Form::close();; ?>

	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <!-- end edit section -->

	                                            <!-- delete section -->
	                                            <?php echo Form::open(array('route'=> ['procedure.destroy',$data->id],'method'=>'DELETE')); ?>

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
                        	     
                                           
                        </div>
                       
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
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
                            <h4 class="panel-title">Show Uploaded Data</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="30%"><b>Hospital Name: </b></td>
                                        <td><?php echo e($data->hospital->user->name); ?></td>
                                     </tr>
                                     <tr>
                                        <td><b>Patient Name: </b></td>
                                        <td><?php echo e($data->patient_name); ?></td>
                                    </tr>
                                     <tr>
                                        <td><b>Patient Age: </b></td>
                                        <td><?php echo e($data->patient_age); ?></td>
                                    </tr>
                                     <tr>
                                        <td><b>Gender: </b></td>
                                        <td><?php echo e($data->gender); ?></td>
                                        
                                    </tr>
                                     <tr>   
                                        <td><b>Date: </b></td>
                                        <td><?php echo e(date('d-m-Y',strtotime($data->date))); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Procedure: </b></td>
                                        <td><?php echo e($data->procedure->name); ?></td>
                                    </tr>
                                     <tr>
                                        <td><b>Procedure Type: </b></td>
                                        <td><?php echo e($data->procedureType->name); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Modality: </b></td>
                                        <td><?php echo e($data->procedure->modality->name); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td><b>Ref. Doctor: </b></td>
                                        <td><?php echo e($data->ref_doctor); ?></td>
                                    </tr>
                                     <tr>
                                        <td><b>Clinical History: </b></td>
                                        <td><?php echo e($data->clinical_history); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <?php if(Auth::user()->isRole('administrator')): ?>
                                
                                <div class="panel panel-success">
                                  <div class="panel-heading">Assign to Radiologist <?php if($assign!=null): ?> (<?php echo e($assign->radiologist->user->name); ?>) <?php endif; ?></div>
                                  <div class="panel-body">
                                    <?php echo Form::open(['route'=>['studylist.update',$data->id],'method'=>'PUT']); ?>

                                    <ul class="list-group">
                                        <?php $__currentLoopData = $modality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item"><label><input required type="radio" name="radiologist_id" <?php if($assign!=null): ?> <?php echo e(($assign->radiologist_id == $mod->radiologist->id)?'checked':''); ?>  <?php endif; ?> value="<?php echo e($mod->radiologist->id); ?>"> <?php echo e($mod->radiologist->user->name); ?> (<?php echo e($mod->radiologist->studylist->where('status',0)->count()); ?>)</label></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </ul>
                                      <button class="btn btn-info">Submit</button>
                                      <?php echo Form::close(); ?>

                                  </div>
                                </div>
                                <?php endif; ?>

                                <?php if(Auth::user()->isRole('radiologist')): ?>
                                <a href='<?php echo e(URL::to("studylist/$data->id")); ?>' class="btn btn-warning btn-lg" style="padding: 60px;font-size: 30px;"><i class="fa fa-eye"></i> Dicom Viewer</a>
                                <?php endif; ?>
                            </div>
                            <br>
                        <?php if(Auth::user()->isRole('administrator')): ?>
                            <?php if(count($data->images)>0): ?>
                            <div class="col-md-12">
                                <p>Uploaded Images</p>
                                <?php $__currentLoopData = $data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-1 min-padding text-center image-load-entry">
                                        <img src="<?php echo e(asset($photo->photo)); ?>" class="img-responsive" alt="Hospital Report">
                                        
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
		
   
    <?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
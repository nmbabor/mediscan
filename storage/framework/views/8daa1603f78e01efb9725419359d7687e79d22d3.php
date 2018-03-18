    <?php $__env->startSection('content'); ?>
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="<?php echo e(route('hospital.index')); ?>" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> View all</a>
                        
                    </div>
                    <h4 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> Hospital Information</h4>
                </div>
                <div class="panel-body">
                    <?php echo Form::open(array('route' => 'hospital.store','class'=>'form-horizontal','files'=>'true')); ?>

                                    
                    <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                        <label for="fullName" class="col-sm-3 control-label">Name &amp; Email : </label>
                        <div class="col-sm-3">
                            <input type="text" readonly parsley-trigger="change" required
                               placeholder="Enter Full Name" class="form-control" id="fullName" value="<?php echo e($data->name); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="email" readonly required parsley-type="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo e($data->email); ?>">
                        </div>
                    </div>
                   
                    <div class="form-group <?php echo e($errors->has('phone_number') ? 'has-error' : ''); ?>">
                        <label for="phone_number" class="col-sm-3 control-label">Mobile Number* : </label>
                        <div class="col-sm-7">
                            <input type="text" readonly parsley-trigger="change" required
                               placeholder="Mobile number" class="form-control" id="phone_number" value="<?php echo e($data->phone_number); ?>">
                               <?php if($errors->has('phone_number')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
                        <?php echo e(Form::label('address','Address :',['class'=>'col-sm-3 control-label'])); ?>

                        <div class="col-md-7">
                            <?php echo e(Form::textArea('address',$data->address,['class'=>'form-control','placeholder'=>'Address','rows'=>'2','readonly'])); ?>

                             <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo e($data->id); ?>">
                    <div class="form-group <?php echo e($errors->has('technologist_contact') ? 'has-error' : ''); ?>">
                        <label for="technologist_contact" class="col-sm-3 control-label">Technologist contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Technologist contact No" name="technologist_contact" class="form-control" id="technologist_contact" >
                               <?php if($errors->has('technologist_contact')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('technologist_contact')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('manager_contact') ? 'has-error' : ''); ?>">
                        <label for="manager_contact" class="col-sm-3 control-label">Manager contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Manager contact No" name="manager_contact" class="form-control" id="manager_contact" >
                               <?php if($errors->has('manager_contact')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('manager_contact')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('reception_contact') ? 'has-error' : ''); ?>">
                        <label for="reception_contact" class="col-sm-3 control-label">Reception contact No: </label>
                        <div class="col-sm-7">
                            <input type="number" min="0" parsley-trigger="change" required
                               placeholder="Reception contact No" name="reception_contact" class="form-control" id="reception_contact">
                               <?php if($errors->has('reception_contact')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('reception_contact')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group <?php echo e($errors->has('price') ? 'has-error' : ''); ?>">
                        <label for="price" class="col-sm-3 control-label">Billing Price: </label>
                        <div class="col-sm-7 no-padding">
                        <?php $__currentLoopData = $price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo e($pr); ?> : </label>
                                <div class="col-md-7">
                                    <input type="hidden" name="procedure_type_id[]" value="<?php echo e($key); ?>">
                                    <input type="number" name="price[]" min="0" parsley-trigger="change" required
                                   placeholder="<?php echo e($pr); ?>" class="form-control" value="0">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group ">
                        <?php echo e(Form::label('modality','Available Modality :',['class'=>'col-sm-3 control-label'])); ?>

                        <div class="col-md-3">
                            <?php $__currentLoopData = $modality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="min-padding">
                                    <label class="control-label"><input id="modality-<?php echo e($id); ?>" class="modality-check" type="checkbox" name="modality[]" value="<?php echo e($id); ?>"> <?php echo e($mod); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-4">
                            <p><b>Radiologist :</b></p>
                            <div id="radiologist">
                                <span class="form-control">Modality Select first!</span>
                            </div>
                            
                        </div>      
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
                                Save
                            </button>
                        </div>
                    </div>
                        <?php echo Form::close(); ?>      
                </div>
            </div>
        </div>
    </div>
</div>
        
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).on('click','.modality-check',function(){
        
        var allVals = [];
        $('.modality-check:checked').each(function(){
            allVals.push($(this).val());
        });
        var vals = allVals.join(",");
        $('#radiologist').load('<?php echo e(URL::to("hospital")); ?>/'+vals);
    })



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->startSection('content'); ?>
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="<?php echo e(route('radiologist.index')); ?>" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> View all</a>
                        
                    </div>
                    <h4 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> Radiologist Information</h4>
                </div>
                <div class="panel-body">
                    <?php echo Form::open(array('route' => ['radiologist.update',$data->user->id],'class'=>'form-horizontal','files'=>'true','method'=>'PUT')); ?>

                                    
                    <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                        <label for="fullName" class="col-sm-3 control-label">Name &amp; Email : </label>
                        <div class="col-sm-3">
                            <input type="text" name="name" parsley-trigger="change" required
                               placeholder="Enter Full Name" class="form-control" id="fullName" value="<?php echo e($data->user->name); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="email" name="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo e($data->user->email); ?>">
                        </div>
                    </div>
                   
                    <div class="form-group <?php echo e($errors->has('phone_number') ? 'has-error' : ''); ?>">
                        <label for="phone_number" class="col-sm-3 control-label">Mobile Number* : </label>
                        <div class="col-sm-7">
                            <input type="text" name="phone_number" parsley-trigger="change" required
                               placeholder="Mobile number" class="form-control" id="phone_number" value="<?php echo e($data->user->phone_number); ?>">
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
                            <?php echo e(Form::textArea('address',$data->user->address,['class'=>'form-control','placeholder'=>'Address','rows'=>'2'])); ?>

                             <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo e($data->user_id); ?>">
                    <div class="form-group <?php echo e($errors->has('gender') ? 'has-error' : ''); ?>">
                        <label for="gender" class="col-sm-3 control-label">Gender : </label>
                        <div class="col-sm-2">
                           <?php echo e(Form::select('gender',['Male'=>'Male','Female'=>'Female'],$data->gender,['class'=>'form-control'])); ?>

                               <?php if($errors->has('gender')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('gender')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <?php echo e(Form::label('speciality','Speciality :',['class'=>'col-sm-3 control-label'])); ?>

                        <div class="col-md-3">
                            <?php $__currentLoopData = $modality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="min-padding">
                                    <label class="control-label">
                                        <? $input = '<input type="checkbox" name="speciality[]" value="'.$id.'">' ?>
                                        <?php $__currentLoopData = $data->speciality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($spec->modality_id == $id): ?>
                                        <? $input = '<input type="checkbox" checked name="speciality[]" value="'.$id.'">';
                                        break;
                                         ?>

                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <? echo $input; ?>
                                        <?php echo e($mod); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-4">
                            <p><b>Upload Signature :</b></p>
                            <label class="img_upload" for="file">
                                <?php if($data->signature!=null): ?>
                                <img class="img-responsive" id="image_load" src="<?php echo e(asset($data->signature)); ?>" alt="Upload Your signature" title="Upload Your signature">

                                <?php else: ?>
                                <img class="img-responsive" id="image_load" src="<?php echo e(asset('images/signature.png')); ?>" alt="Upload Your signature" title="Upload Your signature">

                                <?php endif; ?>
                               <p class="text-center"><small>Click Here</small></p>
                            </label>
                        <?php echo e(Form::file('signature',array('id'=>'file','style'=>'display:none'))); ?>

                         <?php if($errors->has('signature')): ?>
                                <span class="help-block" style="display:block">
                                    <strong><?php echo e($errors->first('signature')); ?></strong>
                                </span>
                            <?php endif; ?>
                                </div>      
                    </div>
                    <hr>
                    <div class="form-group <?php echo e($errors->has('price') ? 'has-error' : ''); ?>">
                        <label for="price" class="col-sm-3 control-label">Billing Price: </label>
                        <div class="col-sm-7 no-padding">
                        <?php $__currentLoopData = $data->price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><?php echo e($prc->type->name); ?> : </label>
                                <div class="col-md-7">
                                    <input type="hidden" name="procedure_type_id[]" value="<?php echo e($prc->procedure_type_id); ?>">
                                    <input type="hidden" name="bill_id[]" value="<?php echo e($prc->id); ?>">
                                    <input type="number" name="price[]" min="0" parsley-trigger="change" required
                                   placeholder="<?php echo e($prc->type->name); ?>" class="form-control" value="<?php echo e($prc->price); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5">
                                Update
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
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->startSection('content'); ?>
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <?php if(Auth::user()->type==1): ?><a href="<?php echo e(route('users.index')); ?>" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> View all user</a><?php endif; ?>
                        
                    </div>
                    <h4 class="panel-title"><i class="fa fa-pencil" aria-hidden="true"></i> User Information</h4>
                </div>
                <div class="panel-body">
                    <?php echo Form::open(array('route' => ['users.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)); ?>

                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">      
                    <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                        <label for="fullName" class="col-sm-3 control-label">Full Name* : </label>
                        <div class="col-sm-7">
                            <input type="text" name="name" parsley-trigger="change" value="<?php echo e($data->name); ?>" required
                               placeholder="Enter Full Name" class="form-control" id="fullName">
                               <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                        <label for="inputEmail3" class="col-sm-3 control-label">Email* :</label>
                        <div class="col-sm-7">
                            <input type="email" name="email" value=" <?php echo e($data->email); ?> " required parsley-type="email" class="form-control"
                                   id="inputEmail3" placeholder="Email">
                                   <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo e($errors->has('phone_number') ? 'has-error' : ''); ?>">
                        <label for="phone_number" class="col-sm-3 control-label">Mobile Number* : </label>
                        <div class="col-sm-7">
                            <input type="text" name="phone_number" parsley-trigger="change" required
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
                            <?php echo e(Form::textArea('address',$data->address,['class'=>'form-control','placeholder'=>'Address','rows'=>'2','required'])); ?>

                             <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo e($errors->has('type') ? 'has-error' : ''); ?>">
                        <?php echo e(Form::label('type','User Roles * :',['class'=>'col-sm-3 control-label'])); ?>

                        <div class="col-md-7">
                            <?php echo e(Form::select('type',$roles,$data->type,['class'=>'form-control','placeholder'=>'Select role','required'])); ?>

                             <?php if($errors->has('type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <a class="btn btn-warning btn-trans waves-effect w-md waves-success m-b-5" href="<?php echo e(route('users.edit',$data->id)); ?>" >Change Password</a>
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
<script src="<?php echo e(asset('public/plugins/jquery/jquery-1.9.1.min.js')); ?>"></script>
<script type="text/javascript">
      $(document).ready(function() {
          App.init();
          DashboardV2.init();
          //
      });
</script>                
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
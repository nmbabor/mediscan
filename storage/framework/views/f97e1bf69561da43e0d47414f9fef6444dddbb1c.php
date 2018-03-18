    <?php $__env->startSection('content'); ?>
    <style type="text/css">
        .chosen-container {width: 736px !important;}
    </style>
    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header"></h1>
        <!-- end page-header -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/my-profile')); ?>">View My Profile</a>
                        </div>
                        <h4 class="panel-title">My Profile Info Page </h4>
                    </div>
                    <div class="panel-body">
                        <?php echo Form::open(array('url' => 'change-my-password','class'=>'form-horizontal author_form','method'=>'POST','files'=>'true', 'id'=>'commentForm','role'=>'form','data-parsley-validate novalidate')); ?>

                            <div class="company_info_section">
                                <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?> ">
                                  <label class="col-sm-4 control-label">Old Password  <star> *</star></label>
                                  <div class="col-sm-8">
                                    <?php echo e(Form::password('old_password', ['class' => 'form-control','placeholder'=>'Old Password','required'])); ?>


                                    <?php if($errors->has('old_password')): ?>
                                      <span class="help-block">
                                        <strong><?php echo e($errors->first('old_password')); ?></strong>
                                      </span>
                                    <?php endif; ?>
                                    
                                  </div>
                                </div>
                                <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?> ">
                                  <label class="col-sm-4 control-label">New Password  <star> *</star></label>
                                  <div class="col-sm-8">
                                    <?php echo e(Form::password('password', ['class' => 'form-control','placeholder'=>'New Password','required'])); ?>


                                    <?php if($errors->has('password')): ?>
                                      <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <div class="form-group <?php echo e($errors->has('password_confirmation') ? 'has-error' : ''); ?> ">
                                  <label class="col-sm-4 control-label">Confirm New Password : <star> *</star></label>
                                  <div class="col-sm-8">
                                    <?php echo e(Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Confirm Password','required'])); ?>

                                    
                                    <?php if($errors->has('password_confirmation')): ?>
                                      <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <?php echo e(Form::hidden('id',Auth::user()->id)); ?>

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
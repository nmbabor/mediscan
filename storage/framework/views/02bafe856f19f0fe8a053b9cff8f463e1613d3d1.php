    <?php $__env->startSection('content'); ?>
    
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> Add new</a>
                        
                    </div>
                    <h4 class="panel-title">View Hospital </h4>
                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th width="3%">Status</th>
                                <th width="10%">Created At</th>
                                <th colspan="2" width="5%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <? $i=1; ?>
                    <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($data->name); ?></td>
                        <td><?php echo e($data->email); ?></td>
                        <td><?php echo e($data->type_name); ?></td>
                        <td><?php echo e($data->phone_number); ?></td>
                        <td><i class="<?php echo e(($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle text-danger'); ?>"></i></td>
                        <td><?php echo e(date('d-M-Y',strtotime($data->created_at))); ?></td>
                        <td><a href='<?php echo e(URL::to("hospital/$data->id/edit")); ?>' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i></a>
                        </td>
                        <td>
                    <?php echo Form::open(array('route' => ['hospital.destroy',$data->id],'method'=>'DELETE')); ?>

                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirmDelete();"><i class="fa fa-trash"></i></button>
                    <?php echo Form::close(); ?>

                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       
                        </tbody>
                    </table>
                    <div class="pull-right">
                    <?php echo e($allUsers->render()); ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->startSection('content'); ?>
    
<div id="content" class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="<?php echo e(route('hospital-entry.create')); ?>" class="btn btn-default btn-xs pull-right"> <i class="ion ion-navicon-round"></i> Add new</a>
                        
                    </div>
                    <h4 class="panel-title">View Hospital Upload Entry</h4>
                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Hospital</th>
                                <th>Procedure</th>
                                <th>Image Count</th>
                                <th>Date</th>
                                <th>Radiologist</th>
                                <th width="3%">Status</th>
                                <th colspan="2" width="10%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <? $i=1; ?>
                    <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><a href='<?php echo e(URL::to("hospital-entry-show/$data->id")); ?>'> <?php echo e($data->hospital->user->name); ?> </a></td>
                        <td><?php echo e($data->procedure->name); ?></td>
                        <td><?php echo e($data->images->count()); ?></td>
                        <td><?php echo e(date('d-M-Y',strtotime($data->date))); ?></td>
                        <td>
                            <?php if($data->assign!=null): ?>
                            <?php echo e($data->assign->radiologist->user->name); ?></td>
                            <?php else: ?>
                            <b class="text-danger">Unassigned</b>
                            <?php endif; ?>
                        <td>
                            <?php if($data->status==0): ?>
                            <b class="text-success">Processing</b>
                            <?php elseif($data->status==1): ?>
                            <a href="" class="btn btn-info btnxs">Report</a>
                            <?php else: ?>
                            <b class="text-warning">Re-checking</b>
                            <?php endif; ?>
                            </td>
                        <td>
                            <a href='<?php echo e(URL::to("hospital-entry-show/$data->id/")); ?>' title="View" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            <a title="Edit" href='<?php echo e(URL::to("hospital-entry/$data->id/edit")); ?>' class="btn btn-xs btn-info"><i class="fa fa-pencil-square"></i></a>
                        </td>
                        <td>
                    <?php echo Form::open(array('route' => ['hospital-entry.destroy',$data->id],'method'=>'DELETE')); ?>

                        <button title="Delete" type="submit" class="btn btn-xs btn-danger" onclick="return confirmDelete();"><i class="fa fa-trash"></i></button>
                    <?php echo Form::close(); ?>

                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <?php echo e($allData->render()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
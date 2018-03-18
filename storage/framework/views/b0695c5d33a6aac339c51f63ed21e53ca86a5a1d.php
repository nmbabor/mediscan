	
		<?php $__env->startSection('content'); ?>
        
		<!-- begin #content -->
		<div id="content" class="content">
		
			<!-- end page-header -->
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to('/macros/create')); ?>">Add New</a>
                            </div>
                            <h4 class="panel-title">Macros</h4>
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
                                            <a href='<?php echo e(URL::to("macros/$data->id/edit")); ?>' class="btn btn-xs btn-success"><i class="fa fa-pencil-square-o" ></i></a>

                                            <!-- delete section -->
                                            <?php echo Form::open(array('route'=> ['macros.destroy',$data->id],'method'=>'DELETE')); ?>

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
		<!-- end #content -->
		
    <script src="<?php echo e(asset('public/plugins/jquery/jquery-1.9.1.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            TableManageResponsive.init();
        });
    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
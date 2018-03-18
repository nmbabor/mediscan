<?php $__currentLoopData = $radiologist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $rad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="min-padding">
        <label class="control-label"><input class="radio-check" type="checkbox" name="radiologist_id[]" value="<?php echo e($id); ?>"> <?php echo e($rad); ?></label>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
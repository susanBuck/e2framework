<?php $__env->startSection('title'); ?>
    <?php echo e($welcome); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <h2><?php echo e($welcome); ?></h2>

    <p>Hello and welcome! This is the boilerplate splash page for my application built with  <a href='https://github.com/susanBuck/e2framework'>e2framework</a>.</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/Susan/Sites/hes/e2framework/views/index.blade.php ENDPATH**/ ?>
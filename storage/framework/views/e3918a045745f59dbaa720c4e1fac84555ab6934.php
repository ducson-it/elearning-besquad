
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.dashboards'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <h1>HELLO</h1>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.js')); ?>"></script>
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\Backend-Web07\resources\views/index.blade.php ENDPATH**/ ?>
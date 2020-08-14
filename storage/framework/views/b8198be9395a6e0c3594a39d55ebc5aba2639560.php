 
<?php $__env->startSection('title',  'vue'); ?>
<?php $__env->startSection('pagecss'); ?>
 

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div id="app">
<example-component></example-component>
    
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script src="public/js/app.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
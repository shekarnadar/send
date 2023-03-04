<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <?php echo $__env->make('layouts.scriptheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body>
        <?php if(!empty(getAuthGaurd())): ?>
        <!-- Begin page -->

        <?php if(Request::segment(1) != 'redeem'): ?>
            <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
            <main id="main" class="main">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i
      class="bi bi-arrow-up-short"></i></a> --&gt;

        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div> -->
        <?php else: ?>
            <?php echo $__env->yieldContent('content'); ?>
        <?php endif; ?>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>

</html>
<?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/app1.blade.php ENDPATH**/ ?>
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

    <?php echo $__env->make('layouts.scriptheader_old', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body class="text-left">
        <?php if(!empty(getAuthGaurd())): ?>
        <!-- Begin page -->

       <div class="app-admin-wrap layout-sidebar-large">
        <?php if(Request::segment(1) != 'redeem'): ?>
            <?php echo $__env->make('layouts.header_old', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts.sidebar_old', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo e(getFormatedDate('','Y')); ?> © EM-Send.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div> -->
        <?php else: ?>
            <?php echo $__env->yieldContent('content'); ?>
        <?php endif; ?>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>

</html>
<?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/app.blade.php ENDPATH**/ ?>
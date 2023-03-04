<?php
$urlPrefix = '';
if(getAuthGaurd() == 'super_admin'){
$urlPrefix = 'super-admin';
} else if(getAuthGaurd() == 'client_admin'){
$urlPrefix = 'client-admin';
}else if(getAuthGaurd() == 'manager'){
$urlPrefix = 'manager';
}

$userData = getLoggedInUserDetails();

?>
<style type="text/css">
    .layout-sidebar-large .main-header .logo img {
        width: 100%;
        height: 100%;
        margin: 0 auto;
        display: block;
        max-width: 200px;
        max-height: 200px;
    }

    .menu-active {
        background-color: #bcbbdd !important;
    }
</style>
<div class="main-header">
    <div class="logo">
        <?php
        $defult=url('assets/images/send-logo.jpeg');
        $logoUrl = getLogo($urlPrefix,$userData['client_admin_logo']);

        ?>
        <a href="<?php echo e(url("$urlPrefix")); ?>"><img src="<?php echo e(url($logoUrl)); ?>" alt="" onerror="this.onerror=null;this.src='<?php echo e($defult); ?>'"></a>
    </div>
    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div style="margin: auto"></div>
    <div class="header-part-right">

        <?php $notifications = notifcationCount('today') ?>
        <!-- Notificaiton -->
        <div class="dropdown">
            <!-- Notification dropdown -->
            <?php if($urlPrefix != 'super-admin'): ?>
            <a id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notification(<?php echo e(count($notifications)); ?>)</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo e(@$userData->client->name); ?>



            <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span><?php echo e($noti->campaignInfo->name); ?></span>
                            <span class="badge badge-pill badge-success ml-1 mr-1"><?php echo e($noti->type); ?></span>
                            <span class="flex-grow-1"></span>
                            <!-- <span class="text-small text-muted ml-auto">10 sec ago</span> -->
                        </p>
                        <!-- <p class="text-small text-muted m-0">James: Hey! are you busy?</p> -->
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <!-- Notificaiton End -->
        <!-- User avatar dropdown -->


        <div class="dropdown">
            <div class="user col align-self-end">
                <?php if($urlPrefix == 'super-admin'): ?>
                <?php echo e(@$userData->first_name); ?> <?php echo e(@$userData->last_name); ?>

                <?php endif; ?>
                <img src="<?php echo e(url('assets/images/default-user.jpg')); ?>" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <!-- <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> 
 
                    </div> -->

                    <?php if($urlPrefix == 'super-admin'): ?>
                    <form method="POST" action="<?php echo e(url("$urlPrefix/logout")); ?>">
                        <?php else: ?>
                        <?php if(getAuthGaurd() != 'manager'): ?>
                        <a class="dropdown-item" href="<?php echo e(url("$urlPrefix/managers")); ?>">Add User</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(url("$urlPrefix/client-settings")); ?>">Account settings</a>
                        <a class="dropdown-item" href="<?php echo e(url("$urlPrefix/email-settings")); ?>">Email Settings</a>
                        <a class="dropdown-item" href="<?php echo e(url("$urlPrefix/whatsapp-settings")); ?>">Whatsapp Settings</a>
                        <a class="dropdown-item" href="<?php echo e(url("changePassword")); ?>">Change Pasword</a>
                        <form method="POST" action="<?php echo e(url("logout")); ?>">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item">
                                Sign out
                            </button>
                        </form>
                        <!-- <a class="dropdown-item" href="signin.html">Sign out</a> -->
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/header_old.blade.php ENDPATH**/ ?>
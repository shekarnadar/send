<?php
$urlPrefix = urlPrefix();
$campagiancount = getTotalCampaingsCount('today');
$leadCount = getLeadCount('today');
\Session::put('redeemed_count_client', totalRedeemedCountClient(\Auth::guard(getAuthGaurd())->user()->client_id));

?>

<link rel="stylesheet" href="https://gull-html-laravel.ui-lib.com/assets/styles/vendor/perfect-scrollbar.css">
<div class="dropdown mega-menu d-none d-md-block">

    <div style="margin: auto"></div> 

    <div class="header-part-right">

        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <?php if(getAuthGaurd() == 'super_admin'): ?>
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/dashboard')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix")); ?>'><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Analytics</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/clients', $urlPrefix.'/add-client-admin', $urlPrefix.'/view-client/*', $urlPrefix.'/edit-client/*', $urlPrefix.'/clientcampaigns/*')? 'menu-active' : ''); ?>" href="<?php echo e(route('client')); ?>"><i class="nav-icon i-Library"></i><span class="nav-text">Clients</span></a></li>
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/products', $urlPrefix.'/add-prelisted-product')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/products")); ?>'><i class="nav-icon i-Suitcase"></i><span class="nav-text">Gift Store</span></a>
                    <li class="nav-item"><a class="nav-item-hold" href='https://ekmatra.swag1.in' target="_blank"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Swag Store</span></a></li>
                    <li class="nav-item"><a class="nav-item-hold campcount <?php echo e(request()->is($urlPrefix.'/campaigns', $urlPrefix.'/view-campaign/*')? 'menu-active' : ''); ?>" id="campCount" href='<?php echo e(url("$urlPrefix/campaigns")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Send Gift<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('campaign_count')); ?></span></span></a></li>
                 
                    <li class="nav-item"><a class="nav-item-hold leadcount <?php echo e(request()->is($urlPrefix.'/leads', $urlPrefix.'/view-lead/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/leads")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Leads<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('lead_count')); ?></span></span></a></li>

                    <li class="nav-item"><a class="nav-item-hold redeemedcount <?php echo e(request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/redeemed")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Redeemed<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('redeemed_count')); ?></span></span></a></li>

                    <li class="nav-item"><a class="nav-item-hold logcount <?php echo e(request()->is($urlPrefix.'/logs')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/logs")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Logs<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('log_count')); ?></span></span></a></li>
                    <li class="nav-item"><a class="nav-item-hold ordercount <?php echo e(request()->is($urlPrefix.'/order-logs', $urlPrefix.'/trackorder/*')? 'menu-active' : ''); ?>" onclick="orderCount()" href='<?php echo e(url("$urlPrefix/order-logs")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Order Logs<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('order_count')); ?></span></span></a></li>

                    <?php else: ?>
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/products', $urlPrefix.'/view-product/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/products")); ?>'><i class="nav-icon i-Suitcase"></i><span class="nav-text">Gift Store</span></a></li>
                    <li class="nav-item"><a class="nav-item-hold" href='<?php echo e(url("$urlPrefix/swag-store")); ?>' target="_blank"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Swag Store</span></a></li>

                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/campaigns',$urlPrefix.'/add-campaign', $urlPrefix.'/step-2', $urlPrefix.'/step-3' , $urlPrefix.'/view-campaign/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/campaigns")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Send Gift</span></a></li>

                   <!--  <li class="nav-item"><a class="nav-item-hold campcount <?php echo e(request()->is($urlPrefix.'/ecampaigns', $urlPrefix.'/view-ecampaign/*')? 'menu-active' : ''); ?>" id="campCount" href='<?php echo e(url("$urlPrefix/ecampaigns")); ?>?type=egift'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Send eGift<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('campaign_count')); ?></span></span></a></li> -->
                 
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/recipients', $urlPrefix.'/add-recipient', $urlPrefix.'/edit-recipient/*', $urlPrefix.'/importExcelView')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/recipients")); ?>'><i class="nav-icon i-Administrator"></i><span class="nav-text">Recipients</span></a></li>


                    
                    <!--                     <li class="nav-item"><a class="nav-item-hold" href='<?php echo e(url("$urlPrefix/managers")); ?>'><i class="nav-icon i-Suitcase"></i><span class="nav-text">Manager</span></a></li> -->
                    
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/groups',$urlPrefix.'/add-recipient-group',$urlPrefix.'/edit-group/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/groups")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Recipient Group</span></a></li>

                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/order-logs')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/order-logs")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Track Gifts</span></a></li>

                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/dashboard')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix")); ?>'><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Analytics</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item"><a class="nav-item-hold <?php echo e(request()->is($urlPrefix.'/logs')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/logs")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Activity</span></a></li>

                    <li class="nav-item"><a class="nav-item-hold redeemedcount <?php echo e(request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'menu-active' : ''); ?>" href='<?php echo e(url("$urlPrefix/redeemed/")); ?>'><i class="nav-icon i-Windows-2"></i><span class="nav-text">Redeemed<span class="badge badge-danger">&nbsp;<?php echo e(Session::get('redeemed_count_client')); ?></span></span></a></li>

                    <?php endif; ?>
            </div>
            <div class="sidebar-overlay"></div>
        </div>

        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="childNav" data-parent="product">
                <li class="nav-item"><a href="<?php echo e(url('super-admin/products')); ?>"><i class="nav-icon i-Crop-2"></i><span class="item-name">Store Products</span></a></li>
                <li class="nav-item"><a href="<?php echo e(route('company-products')); ?>"><i class="nav-icon i-Loading-3"></i><span class="item-name">Company Products</span></a></li>
            </ul>

            <!-- <ul class="childNav" data-parent="recipient">
                    <li class="nav-item"><a href="<?php echo e(url('super-admin/listname')); ?>"><i class="nav-icon i-Crop-2"></i><span class="item-name">Add Recipient List</span></a></li>
                    <li class="nav-item"><a href="<?php echo e(route('recipients')); ?>"><i class="nav-icon i-Loading-3"></i><span class="item-name">Recipients</span></a></li>
        </ul> -->

        </div>


        <div class="sidebar-overlay"></div>
    </div>
    <script type="text/javascript">
        $(".campcount").click(function() {
            $.ajax({
                url: "<?php echo e(url('sessionSet/camp')); ?>",
                type: 'get',
            });
        });

        $(".leadcount").click(function() {
            $.ajax({
                url: "<?php echo e(url('sessionSet/lead')); ?>",
                type: 'get',

            });
        });

        $(".redeemedcount").click(function() {
            $.ajax({
                url: "<?php echo e(url('sessionSet/redeemed')); ?>",
                type: 'get',

            });
        });

        $(".logcount").click(function() {
            $.ajax({
                url: "<?php echo e(url('sessionSet/log')); ?>",
                type: 'get',

            });
        });

        $(".ordercount").click(function() {
            $.ajax({
                url: "<?php echo e(url('sessionSet/order')); ?>",
                type: 'get',

            });
        });
    </script><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/sidebar_old.blade.php ENDPATH**/ ?>
<?php
$urlPrefix = urlPrefix();
$campagiancount = getTotalCampaingsCount('today');
$leadCount = getLeadCount('today');
\Session::put('redeemed_count_client', totalRedeemedCountClient(\Auth::guard(getAuthGaurd())->user()->client_id));

?>
<style>
	.menu-active {
		color: #B03138;
	}
</style>
<aside id="sidebar" class="sidebar">
	<ul class="sidebar-nav" id="sidebar-nav">

		<?php if(getAuthGaurd() == 'super_admin'): ?>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix")); ?>'>
				<i class="bi bi-bar-chart-fill"></i>
				<span class=" <?php echo e(request()->is($urlPrefix.'/dashboard')? 'span' : ''); ?>">Analytics</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="<?php echo e(route('client')); ?>">
				<i class="bi bi-person-lines-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/clients', $urlPrefix.'/add-client-admin', $urlPrefix.'/view-client/*', $urlPrefix.'/edit-client/*', $urlPrefix.'/clientcampaigns/*')? 'span' : ''); ?>">Clients</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/products")); ?>'>
				<i class="bi bi-shop-window"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/products', $urlPrefix.'/add-prelisted-product')? 'span' : ''); ?>">Gift Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='https://ekmatra.swag1.in' target="_blank">
				<i class="bi bi-grid"></i>
				<span class="nav-text">Swag Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" id="campCount" href='<?php echo e(url("$urlPrefix/campaigns")); ?>'>
				<i class="bi bi-gift-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/campaigns', $urlPrefix.'/view-campaign/*')? 'span' : ''); ?>">Send Gift
					<span class="notication-badge font-size-11"><?php echo e(Session::get('campaign_count')); ?></span>
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link leadcount" href='<?php echo e(url("$urlPrefix/leads")); ?>'>
				<i class="bi bi-chat-left-text-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/leads', $urlPrefix.'/view-lead/*')? 'span' : ''); ?>">Leads<span class="notication-badge font-size-11"><?php echo e(Session::get('lead_count')); ?></span>
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link redeemedcount" href='<?php echo e(url("$urlPrefix/redeemed")); ?>'>
				<i class="bi bi-box2-heart-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'span' : ''); ?>">Redeemed<span class="notication-badge font-size-11"><?php echo e(Session::get('redeemed_count')); ?></span>
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link logcount" href='<?php echo e(url("$urlPrefix/logs")); ?>'>
				<i class="bi bi-list-task"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/logs')? 'span' : ''); ?>">Logs<span class="notication-badge font-size-11"><?php echo e(Session::get('log_count')); ?></span>
				</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link ordercount" onclick="orderCount()" href='<?php echo e(url("$urlPrefix/order-logs")); ?>'>
				<i class="bi bi-card-checklist"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/order-logs', $urlPrefix.'/trackorder/*')? 'span' : ''); ?>">Order Logs<span class="notication-badge font-size-11"><?php echo e(Session::get('order_count')); ?></span>
				</span>
			</a>
		</li>

		<?php else: ?>

		<!-- client sidebar menu -->
		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/products")); ?>'>
				<i class="bi bi-shop-window"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/products', $urlPrefix.'/view-product/*')? 'span' : ''); ?>">Gift Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/swag-store")); ?>' target="_blank">
				<i class="bi bi-grid"></i>
				<span>Swag Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link " href='<?php echo e(url("$urlPrefix/campaigns")); ?>'>
				<i class="bi bi-gift-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/campaigns',$urlPrefix.'/add-campaign', $urlPrefix.'/step-2', $urlPrefix.'/step-3' , $urlPrefix.'/view-campaign/*')? 'span' : ''); ?>">Send Gift</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link " href='<?php echo e(url("$urlPrefix/recipients")); ?>'>
				<i class="bi bi-person-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/recipients', $urlPrefix.'/add-recipient', $urlPrefix.'/edit-recipient/*', $urlPrefix.'/importExcelView')? 'span' : ''); ?>">Recipients</span>
			</a>
		</li>


		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/groups")); ?>'>
				<i class="bi bi-people-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/groups',$urlPrefix.'/add-recipient-group',$urlPrefix.'/edit-group/*')? 'span' : ''); ?>">Recipient Group</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/order-logs")); ?>'>
				<i class="bi bi-mailbox2"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/order-logs')? 'span' : ''); ?>">Track Gifts</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix")); ?>'>
				<i class="bi bi-bar-chart-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/dashboard')? 'span' : ''); ?>">Analytics</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/logs")); ?>'>
				<i class="bi bi-activity"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/logs')? 'span' : ''); ?>">Activity</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='<?php echo e(url("$urlPrefix/redeemed/")); ?>'>
				<i class="bi bi-box2-heart-fill"></i>
				<span class="<?php echo e(request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'span' : ''); ?>">Redeemed
					<span class="notication-badge font-size-11"><?php echo e(Session::get('redeemed_count_client')); ?></span>
				</span>
			</a>
		</li>
		<?php endif; ?>
		<li class="nav-item">
			<a class="nav-link" href='#'>
				<img width="30px" src="<?php echo e(url('assets/images/default-user.jpg')); ?>">
				<p class="mb-0 enterpeice"><?php echo e(\Auth::guard(getAuthGaurd())->user()->first_name); ?> <?php echo e(\Auth::guard(getAuthGaurd())->user()->last_name); ?>

					<br>
					<span>Enterprise plan </span>
				</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href='#'>
				<form method="POST" action="<?php echo e(url('logout')); ?>">
                	<?php echo csrf_field(); ?>
                    <button class="dropdown-item">Sign out</button>
                </form>
			</a>
		</li>
 
		

		
	</ul>
</aside><!-- End Sidebar--><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>
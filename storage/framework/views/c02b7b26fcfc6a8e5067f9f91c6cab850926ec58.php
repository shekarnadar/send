<?php
	if(getUrl() === 'super-admin/'){

		if($url == 'product'){
			$is_allow = 1; 
			$is_delete = 1; 
		}else{
			$is_allow = 1;
			$is_delete = 0; 
		}
		if($url == 'lead'){
			$is_allow = 0;
			$is_delete = 1; 
		}
		if($url == 'campaign' || $url == 'redeemed'){
			$is_allow = 0;
		}
		$is_view = 1;
	}else{
		$is_view = 1;
		if($url == 'product'){
			$is_allow = 0;
			$is_delete = 0;
		} else {
			 $is_allow = 1;
			 $is_delete = 0;
		}
		if($url == 'manager' || $url == 'recipient'){
			$is_view = 0;
			$is_delete = 0;
			$is_edit =  1;
		}
		if($url == 'campaign'){
			$is_allow = 0;
		}
		
		if($url == 'group') {
			$is_view = 0;
		}
	}
?>
<?php if($is_allow == 1): ?>
	<?php if($status == 1): ?>
			<button class="btn btn-danger"  onClick="statusData(<?php echo e($id); ?>)">Deactivate</button>
	<?php else: ?>
			<button class="btn btn-success"  onClick="statusData(<?php echo e($id); ?>)">Activate</button>
	<?php endif; ?>
<?php endif; ?>
<?php if(getUrl() === 'super-admin/'): ?>
<?php if($url == 'campaign' || $url == 'redeemed'): ?>
	<?php if($status == 1 || $status == 2): ?>
		<button class="btn btn-default" disabled><?php echo e(($url == 'redeemed' ? 'Dispatch' : 'Approve')); ?> </button>
		<button class="btn btn-default" disabled>Reject </button>
	<?php else: ?>
		<button class="btn btn-default"  onClick="changeStatus(<?php echo e($id); ?>,1)"><?php echo e(($url == 'redeemed' ? 'Dispatch' : 'Approve')); ?>  </button>
		<button class="btn btn-default"  onClick="changeStatus(<?php echo e($id); ?>,2)">Reject </button>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if($url == 'lead'): ?>
<button class="btn btn-primary"   onClick="comment(<?php echo e($id); ?>)">Comment</button>
<?php endif; ?>
<?php if($is_view == 1): ?>
	<a href="<?php echo e(url(getUrl().'view-'.$url.'/'.$id)); ?>" class="btn btn-default"> View</a>
<?php endif; ?>
<?php if($url == 'redeemed' && $status == 1): ?>
	<a type="button" href="<?php echo e(url(getUrl().'view-pdf'.'/'.$id)); ?>" class="btn btn-primary">Label</a>
<?php endif; ?>
<?php if($is_allow == 1): ?>
	<a href="<?php echo e(url(getUrl().'edit-'.$url.'/'.$id)); ?>" class="btn btn-default"> Edit</a>
<?php endif; ?>
<?php if($url == 'group'): ?>
		 <a href="#" type="button" class="btn btn-primary" onClick="shareLink(<?php echo e($id); ?>)">Onboarding Link</a>
<?php endif; ?>
<?php if($is_delete == 1): ?>
	<button class="btn btn-default" onClick="deleteData(<?php echo e($id); ?>)">Delete</button>
<?php endif; ?>
<?php if($url == 'client'): ?>
<a href="<?php echo e(url(getUrl().'clientcampaigns/'.$id)); ?>" class="btn btn-default"> campaign</a>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/options.blade.php ENDPATH**/ ?>
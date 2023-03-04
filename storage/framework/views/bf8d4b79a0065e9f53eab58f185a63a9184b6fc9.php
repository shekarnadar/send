<?php if($type == 'egift'): ?>
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	<div class="list-item col-md-3">
	        <div class="card o-hidden mb-4 d-flex flex-column">
	            <div class="list-thumb d-flex mt-2">
	              	<img alt="" src="<?php echo e(json_decode($pro->json_response)->images->base); ?>"/>
	            </div>
                <div class="flex-grow-1 d-bock">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                        <a class="w-40 w-sm-100" href="javascript:void(0)">
                            <div class="item-title">
                            <?php echo e($pro->name); ?>

                            </div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            ₹' <?php echo e($pro->min_price); ?> To <?php echo e($pro->max_price); ?>

                        </p>
                        <p>
                        <input type="checkbox" class="addPro" value='<?php echo e($pro->id); ?>' onclick="addProduct('<?php echo e($pro->id); ?>',this)">
                        </p>
                    </div>
                </div>
	        </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if ($pro->visibility == 1) {
                if (in_array($pro->id, $compproduct)) {
                    $isshowing = true;
                } else {
                    $isshowing = false;
                }
            } else {
                $isshowing = true;
            }
        ?>
        <?php if($isshowing == true): ?>
            <div class="list-item col-md-3">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex mt-2">
                      <img alt="" src="<?php echo e(getImage(@$pro->productDefaultImage->image, 'product')); ?>"/>
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="javascript:void(0)">
                                <div class="item-title">
                                <?php echo e($pro->name); ?>

                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                ₹' <?php echo e($pro->price); ?>

                            </p>
                            <p>
                            <input type="checkbox" class="addPro" value='<?php echo e($pro->id); ?>' onclick="addProduct('<?php echo e($pro->id); ?>',this)">
                            </p>
                        </div>
                    </div>
                </div>
            </div>';
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/campaigns/_product_card.blade.php ENDPATH**/ ?>
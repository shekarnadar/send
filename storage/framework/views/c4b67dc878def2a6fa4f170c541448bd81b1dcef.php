
<?php $__env->startSection('title', 'Send Gift'); ?>
<?php $__env->startSection('content'); ?>
<?php
$urlPrefix = urlPrefix();
?>
 <div class="col-sm-12">
      <img src="<?php echo e(url('backend/img/dash1.png')); ?>" class="dash1" alt="">
    </div>
    <br>
    <h1>All listings</h1>
    <nav>
      <div class="row">
        <div class="col-sm-4">
          <!-- <button class="desh_btn"> <a href="#">Physical Gifts</a></button> -->
          <ul class="nav">
            <li class="nav-item">
              <button class="desh_btn"> <a href="#">Physical Gifts</a></button>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">egifts</a>
            </li>
        
          </ul>
        </div>
        <div class="col-sm-4">
          <div class="search">
            <span class="fa fa-search"><img src="<?php echo e(url('backend/img/search.png')); ?>" alt=""></span>
            <input placeholder="Search term">
          </div>

        </div>
        <div class="col-sm-4">
          <ul id="navee" class="nav">
            <li  class="nav-item">
              <a class="nav-link" href="#">View All</a>
            </li>
         
        
          </ul>

        </div>

      </div>



    </nav>
    <section class="mt-4">
      <div class="row">
        <div class="col-sm-12">
          <h5>What's the Occasion?</h5>
        </div>
      </div>
      <ul class="nav">
        <li id="Nav" class="nav-item">
          <a class="nav-link " aria-current="page" href="#">Any</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link" href="#">Festivals</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link" href="#">Referrals</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link active">Birthday</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link ">Anniversary</a>
        </li>
        <li id="Nav" class="nav-item">
          <a class="nav-link ">Other Event</a>
        </li>
      </ul>
    </section>
    <section class="mt-4">
      <div class="row">
        <div class="col-sm-12">
          <h5>Select Your Price Range for Gifting :</h5>
        </div>
      </div>
      <ul class="nav">
        <li id="Navv" class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Any</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link" href="#">Rs.500 - 1000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link" href="#">Rs.1000 - 2000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link ">Rs.2000 - 3000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link ">Rs.3000 - 4000</a>
        </li>
        <li id="Navv" class="nav-item">
          <a class="nav-link ">Rs.4000 - 5000</a>
        </li>
      </ul>
    </section>

    <!-- End Page Title -->

    <section class="section dashboard mt-3">
      <!-- vijay -->
      <div class="row">
        <?php $__currentLoopData = $compproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $__currentLoopData = $pro->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
            <div class="col-sm-4">
              <div class="card" style="width: 18rem;">
                <img src="<?php echo e(url('backend/img/card1.png')); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo e($value['name']); ?> </h5>
                  <p class="card-text"><?php echo e($value['description']); ?></p>
                  <div class="row">
                    <div class="col-sm-6">
                      <p>Physical Gift</p>
                    </div>
                    <div class="col-sm-6">
                      <p class="pera">Rs.<?php echo e($value['price']); ?> /-</p>
                    </div>
                  </div>
                  <a href="#" id="sendgift" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/campaigns/index.blade.php ENDPATH**/ ?>
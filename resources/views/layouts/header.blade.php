 <header id="header" class="header fixed-top d-flex align-items-center header-scrolled">

   <div class="d-flex align-items-center justify-content-between">
     @php
     $defult=url('assets/images/send-logo.jpeg');
     $logoUrl = getLogo($urlPrefix,\Auth::guard(getAuthGaurd())->user()->client_admin_logo);

     @endphp
 

     <a href="{{url("$urlPrefix")}}" class="logo d-flex align-items-center">
       <img src="{{url($logoUrl)}}" alt="" onerror="this.onerror=null;this.src='{{$defult}}'">
     </a>
     <i class="bi bi-list toggle-sidebar-btn"></i>
   </div><!-- End Logo -->

   <div class="search-bar">

     <span>SEND</span>
   </div><!-- End Search Bar -->

   <nav class="header-nav ms-auto">
     <ul class="d-flex align-items-center">

       <li class="nav-item d-block d-lg-none">
         <a class="nav-link nav-icon search-bar-toggle " href="#">
           <i class="bi bi-search"></i>
         </a>
       </li><!-- End Search Icon-->
       <li class="nav-item dropdown">

         <a class="nav-link nav-icon" id="contact" href="#" data-bs-toggle="dropdown">
           <strong>Contact</strong>
         </a>


         <!-- End Notification Dropdown Items -->

       </li><!-- End Notification Nav -->
       <li class="nav-item dropdown">

         <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
           <img src="{{url('backend/img/BELL.png')}}" alt="">
           <!-- <span class="badge bg-primary badge-number">4</span> -->
         </a><!-- End Notification Icon -->

         <!-- End Notification Dropdown Items -->

       </li><!-- End Notification Nav -->

       <li class="nav-item dropdown">

         <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
           <img src="{{url('backend/img/search.png')}}" alt="">
         </a><!-- End Messages Icon -->

         <!-- End Messages Dropdown Items -->

       </li><!-- End Messages Nav -->



     </ul>
   </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
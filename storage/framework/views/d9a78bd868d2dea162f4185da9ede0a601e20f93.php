
<?php $__env->startSection('title', 'Add Campaign'); ?>
<?php $__env->startSection('content'); ?>
<?php
$urlPrefix = urlPrefix();
?>
<div class="main-content-wrap d-flex flex-column sidenav-open">
	<div class="breadcrumb">
		<h1>Add Campaign</h1>
		<h1> : Step 1 : Select Price Range</h1>

	</div>
	<div class="separator-breadcrumb border-top"></div>
	<form method="post" id="form" action="<?php echo e(url($urlPrefix.'/step-2')); ?>">
		<?php echo csrf_field(); ?>
		<?php if(!empty($user)): ?>
			<input name="id" type="hidden" value="<?php echo e(@$user->id); ?>">
		<?php endif; ?>
		<div class="row mb-4">
			<div class="col-md-12 mb-4">
				<div class="card text-left">
					<div class="card-body p-4">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-3 col-md-3">
										<!-- <div class="col-md-3">  -->
										<input class="campaigntype" type="radio" name="campaign_type" value="instant" checked> &nbsp;&nbsp;Instant
										<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="If you want to send gifts immediately after approval"></i>
										<!-- </div> -->
									</div>
									<div class="col-lg-3 col-md-3">
										<!-- <div class="col-md-5"> -->
										<input class="campaigntype" type="radio" name="campaign_type" value="individual"> &nbsp;&nbsp;Individual

										<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="If you want to Schedule Birthdays ,Anniversary etc. in mass"></i>
										<!-- </div> -->
									</div>
									<div class="col-lg-3 col-md-3">
										<!-- <div class="col-md-3"> -->
										<input class="campaigntype" type="radio" name="campaign_type" value="bulk">&nbsp;&nbsp;Bulk
										<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="If you want to Schedule Gifts in bulk at a later date"></i>

									  
									</div>

									<div class="col-lg-3 col-md-3">
										<input class="campaigntype" type="checkbox" name="egift_campaign" id="egift_checkbox" value="egift">&nbsp;&nbsp;Is a eGift Campaign ?
									</div>

								</div>
							</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							
							<div class="col-lg-3">
								<div>
									<input type="hidden" name="product_ids" id="proids">
									<input type="hidden" name="is_egift" id="is_egift" value="0">
									<div class="mb-3">
										<label for="example-name-input" class="form-label">Campaign Name<span class="filed_Mendetory">*<span></label>
										<input class="form-control formField" name="name" type="text" value="" id="name" placeholder="Eg. Diwali Gifting">
										<!--onkeyup="validate(this)"-->
										<span id="name-error" class="error text-danger"></span>
									</div>
								</div>
							</div>
							
							<div class="col-lg-3" id="minpricesection">
								<div class="mb-3">
									<label for="example-text-input" class="form-label">Min.price<span class="filed_Mendetory">*<span></label>
									<input class="form-control" name="minprice" type="number" value="" id="minprice" placeholder="Enter Minimum Price" onkeyup="minPricevalidate(this)">
									<span id="first-postal-error" class="error text-danger"></span>
								</div>
							</div>

							<div class="col-lg-3" id="maxpricesection">
								<div class="mb-3">
									<label for="example-text-input" class="form-label">Max.price<span class="filed_Mendetory">*<span></label>
									<input class="form-control" name="maxprice" type="number" value="" id="maxprice" placeholder="Enter Maximum Price" onkeyup="maxPricevalidate(this)">
									<span id="first-postal-error" class="error text-danger"></span>
								</div>
							</div>

							<div class="col-lg-3" id="video_link">
								<div class="mb-3">
									<label for="example-text-input" class="form-label">Video</label>
									<input class="form-control" name="video" type="text" value="" id="video" placeholder="Enter Embed Video Code">
								</div>
							</div>

							<div class="col-lg-3">

								<div class="mb-3" style="display:none" id="selectoccasionsection">
									<label for="example-text-input" class="form-label">Select Type<span class="filed_Mendetory">*<span></label>
									<select class="form-control formField" name="event_type" value="selectoccasion" id="selectoccasion">
										<option value="">Select</option>
										<option value="anniversary">Anniversary Date</option>
										<option value="birthday">Birthday</option>
										<option value="date1">Date1</option>
										<option value="date2">Date2</option>
										<option value="date3">Date3</option>
										<!-- <option value="diwali">Diwali</option> -->
									</select>
									<span id="first-postal-error" class="error text-danger"></span>
								</div>


								<div class="col-mb-3" id="startdate" style="display:none">
									<label for="example-email-input" class="form-label">Campaign Date<span class="filed_Mendetory">*<span></label>
									<input class="form-control startdate formField" name="start_date" type="text" value="" placeholder="Select start date" readonly>
									<span id="anniversary-error" class="error text-danger"></span>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="col-mb-3" id="enddate" style="display:none">
									<label for="example-email-input" class="form-label">End Date<span class="filed_Mendetory">*<span></label>
									<input class="form-control enddate formField" name="end_date" type="text" value="" placeholder="Select end date" readonly>
									<span id="anniversary-error" class="error text-danger"></span>
								</div>
							</div>

							<div class="col-lg-3" style="display:none" id="beforeday">
								<div class="col-mb-3">
									<label for="example-email-input" class="form-label">Before Days</label>
									<input class="form-control formField" name="before_days" type="number" value="" id="beforedays" placeholder="Select Number Of Days">
									<span id="anniversary-error" class="error text-danger"></span>
								</div>
							</div>
						</div>

						<div class="row justify-content-center mt-5">
							<div class="col-sm-2">
								<div>
									<a href="" class="btn btn-primary w-md showproducts">Show Products</a>
								</div>
							</div>
							<div class="col-sm-2">
								<div>
									<button type="submit" class="btn btn-success w-md" disabled="disabled" id="firstStep">Next Step</button><br><br>

								   
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end col -->
		</div>
		<div class="breadcrumb row">
			<h1 id="serachmsg" style="display:none">Search Result of </h1>
			<div id="serachmsgegift" class="col-12" style="display:none">
				<h1 class="col-3">Search Result of </h1>
				<input type="text" name="egift_price" id="egift_price" placeholder="Enter Denomination" class="form-control formField col-5" value=""/>
			</div>
		</div>
	</form>
	<div class="separator-breadcrumb border-top"></div>


	<section class="product-cart">
		<div class="row list-grid"></div>
	</section>
</div>
</div>

<script src="https://use.fontawesome.com/2edfbebfe6.js"></script>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});

   
	$('.showproducts').on('click', function(e) {
		e.preventDefault();
		let minPrice = $('#minprice').val();
		let maxPrice = $('#maxprice').val();

		var egift = $("#egift_checkbox:checked").val();

		$.ajax({
			url: "<?php echo e(url('client-admin/show-products-list')); ?>",
			data: {
				minPrice: minPrice,
				maxPrice: maxPrice,
				egift: egift
			},

			success: function(response) {
				if (response) {
					$('.list-grid').html('').html(response);
					if(egift){
							$("#serachmsgegift").css('display', 'block');
							$('#serachmsg').css('display', 'none');
					}else{
						$('#serachmsgegift').css('display', 'none');
						 $('#serachmsg').css('display', 'block');
						 $('#serachmsg').html('').html('Search results');
					}
					
				} else {
					$('.list-grid').html('');
					$('#serachmsg').css('display', 'block');
					$('#serachmsg').html('').html('No results found');
				}

			}
		});
	})

	// Add Product
	var proArr = [];

	function addProduct(pro, ds) {
		var egift = $("#egift_checkbox:checked").val();
		var name = $('#name').val();
		if ($(ds).is(':checked')) {
			if(proArr.length == 0){
				proArr.push(pro);
				$('#proids').val(proArr.join());
			}
			$('.addPro').not(':checked').prop('disabled', true);
					   
		} else {
			 $('.addPro').not(':checked').prop('disabled', false);
			const index = proArr.indexOf(pro);
			if (index > -1) {
				proArr.splice(index, 1);
				$('#proids').val(proArr.join());
			}
		}

		let campaign_type = $('input[name="campaign_type"]:checked').val();
		if(egift){
			let egift_price = $("#egift_price").val();
			if(egift_price == ''){
				$('#firstStep').prop('disabled', true);
			}else{
				$('#firstStep').prop('disabled', false  );
			}
		}
		if (campaign_type == 'instant') {
			if ($('#proids').val() != '' && name != '') {
				$('#firstStep').prop('disabled', false);
			} else {
				$('#firstStep').prop('disabled', true);
			}
		} else if (campaign_type == 'individual') {
			let selectoccasion = $('#selectoccasion').val();
			let end_date = $('input[name="end_date"]').val();
			// alert(selectoccasion+end_date);
			if ($('#proids').val() != '' && name != '' && $('#beforedays').val() != '' && end_date != '' &&
				selectoccasion != '') {
				$('#firstStep').prop('disabled', false);
			} else {
				$('#firstStep').prop('disabled', true);
			}
		} else if ((campaign_type == 'bulk')) {

			let start_date = $('input[name="start_date"]').val();
			//alert(selectoccasion+end_date);
			if ($('#proids').val() != '' && name != '' && start_date != '') {
				$('#firstStep').prop('disabled', false);
			} else {
				$('#firstStep').prop('disabled', true);
			}
		} else {
			if ($('#proids').val() != '' && name != '') {
				$('#firstStep').prop('disabled', false);
			}
		}
	}

	
	// validate forms
	$('.formField').on('keyup change', function() {
		let campaign_type = $('input[name="campaign_type"]:checked').val();
		let campaign_name = $('#name').val();

		if (campaign_type == 'instant') {
			if (campaign_name == '' || $('#proids').val() == '') {
				$('#firstStep').prop('disabled', true);
			} else {
				$('#firstStep').prop('disabled', false);
			}
		} else if (campaign_type == 'individual') {
			let end_date = $('input[name="end_date"]').val();
			let selectoccasion = $('#selectoccasion').val();
			if (campaign_name == '' || $('#proids').val() == '' || selectoccasion == '' || $('#beforedays')
				.val() == '' || end_date == '') {
				$('#firstStep').prop('disabled', true);
			} else {
				$('#firstStep').prop('disabled', false);
			}
		} else {
			let selectoccasion = $('#selectoccasion').val();
			let start_date = $('input[name="start_date"]').val();
			if ($('#proids').val() != '' && campaign_name != '' && start_date != '') {
				$('#firstStep').prop('disabled', false);
			} else {
				$('#firstStep').prop('disabled', true);
			}
		}
	})

	function validate(ds) {
		var name = $(ds).val();
		if ($('#proids').val() != '' && name != '') {
			$('#firstStep').prop('disabled', false);
		} else {
			$('#firstStep').prop('disabled', true);
		}
	}

	function minPricevalidate(ds) {
		var minprice = $(ds).val();
		var maxprice = $('#maxprice').val();
		if ($('#proids').val() != '' && minprice != '' && maxprice != '') {
			$('#firstStep').prop('disabled', false);
		} else {
			$('#firstStep').prop('disabled', true);
		}
	}


	function maxPricevalidate(ds) {
		var maxprice = $(ds).val();
		var minprice = $('#minprice').val();
		if ($('#proids').val() != '' && minprice != '' && maxprice != '') {
			$('#firstStep').prop('disabled', false);
		} else {
			$('#firstStep').prop('disabled', true);
		}
	}

	$('.startdate').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "-80:+00",
		dateFormat: "dd-mm-yy",
		minDate: 0
	});
	$('.enddate').datepicker({
		changeMonth: true,
		changeYear: true,
		//yearRange: "-80:+00",
		dateFormat: "dd-mm-yy",
		minDate: 0
	});

	$('#selectoccasion').on('change', function() {
		let occ = $(this).val();
		if (occ != '') {
			if (occ == 'anniversary' || occ == 'birthday') {
				$('#enddate').css('display', 'block');
				$('#beforedays').css('display', 'block');
				$('#startdate').css('display', 'none');
			} 
			let campaign_name = $('#name').val();
			let end_date = $('input[name="end_date"]').val();
			let selectoccasion = $('#selectoccasion').val();
			if (campaign_name == '' || $('#proids').val() == '' || selectoccasion == '' || $('#beforedays')
				.val() == '' || end_date == '') {
				$('#firstStep').prop('disabled', true);
			} else {
				$('#firstStep').prop('disabled', false);
			}

		} else {
			$('#enddate').css('display', 'block');
			$('#beforedays').css('display', 'block');
			
		}
	})

	// show hide form UI
	$('.campaigntype').on('change', function() {
		let campaignOption = $(this).val();
		let campaign_name = $('#name').val();

		if (campaignOption == 'individual') {
			$('#beforeday').css('display', 'block');
			$('#enddate').css('display', 'block');
			$('#startdate').css('display', 'none');
			$('#selectoccasionsection').css('display', 'block');
			$('.startdate').datepicker('destroy').datepicker({
				dateFormat: "dd-mm-yy",
				minDate: 0
			});
			let selectoccasion = $('#selectoccasion').val();
			if ($('#beforedays').val() == '' || $('#enddate').val() == '' || campaign_name == '' ||
				selectoccasion == '' || $('#proids').val() == '') {
				$('#firstStep').prop('disabled', true);
			} else {
				$('#firstStep').prop('disabled', false);
			}
		} else if (campaignOption == 'instant') {
			$('#beforeday').css('display', 'none');
			$('#enddate').css('display', 'none');
			$('#startdate').css('display', 'none');
			$('#selectoccasionsection').css('display', 'none');
			//let campaign_name = $('#name').val();
			if (campaign_name == '' || $('#proids').val() == '') {
				$('#firstStep').prop('disabled', true);
			} else {
				$('#firstStep').prop('disabled', false);
			}

		} else if (campaignOption == 'bulk') {
			$('#enddate').css('display', 'none');
			$('#selectoccasionsection').css('display', 'none');
			$('#beforeday').css('display', 'none');
			$('#startdate').css('display', 'block');
			$('#beforedays').val('');

			$('.startdate').datepicker('destroy').datepicker({
				dateFormat: "dd-mm-yy",
				minDate: "7d"
			});
			let start_date = $('input[name="start_date"]').val();
			if ($('#proids').val() != '' && name != '' && start_date != '') {
				$('#firstStep').prop('disabled', false);
			} else {
				$('#firstStep').prop('disabled', true);
			}

		} else {
			console.log('Campaign Not Available');
		}
	});
</script>

<!-- //// eGift  -->
<script>
	$("#egift_checkbox").click(function() {
		if ($(this).is(":checked")) {
			document.getElementById("is_egift").value = 1;
			$("#video_link").hide();
		} else {
			$("#minpricesection").show();
			$("#maxpricesection").show();
			$("#video_link").show();
			$('#serachmsg').css('display', 'none');
			$("#serachmsgegift").css('display','none'); 
			$('.list-grid').html('');
			document.getElementById("is_egift").value = 0;
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ek-send\resources\views/campaigns/step-1.blade.php ENDPATH**/ ?>
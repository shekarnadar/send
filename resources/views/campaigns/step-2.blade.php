@extends('layouts.app')
@section('title', 'Send List')
@section('content')
@php
$urlPrefix = urlPrefix();
@endphp
	<link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/datatables.min.css">
	<div class="main-content-wrap d-flex flex-column sidenav-open">
		<div class="row">
			<div class="breadcrumb col-md-8">
					<h1>Send List</h1>
					<h1> : Step 2 : Select Recipient</h1>
			</div>
<!--              <div class="col-md-4">
				<h6>Avilable Balance : {{$availableBalance}} &nbsp;&nbsp;Required Amount:<span class="requiredAmount">0</span></h6>
			</div> -->
		</div>

		<div class="separator-breadcrumb border-top">
			
		</div>

		<div class="row mb-4">
			<div class="col-md-12 mb-4">
				<div class="card text-left">
					<div class="card-body p-4">

						<form method="post" id="form" action="{{ url($urlPrefix.'/step-3') }}"
							enctype="multipart/form-data">
								<input type="hidden" name="campaign_name" value="{{ $prevFormData['name'] }}">

							<input type="hidden" name="min_price" value="{{ $prevFormData['minprice'] }}">
							<input type="hidden" name="min_price" value="{{ $prevFormData['minprice'] }}">
							<input type="hidden" name="max_price" value="{{ $prevFormData['maxprice'] }}">
							<input type="hidden" name="video" value="{{ $prevFormData['video'] }}">
							<input type="hidden" name="egift_price" value="{{$prevFormData['egift_price']}}">

							<input type="hidden" name="product_ids" value="{{ $prevFormData['product_ids'] }}">

							<input type="hidden" name="start_date" value="{{ $prevFormData['start_date'] }}">
							<input type="hidden" name="end_date" value="{{ $prevFormData['end_date'] }}">
							<input type="hidden" name="before_days" value="{{ $prevFormData['before_days'] }}">
							<input type="hidden" name="event_type" value="{{ $prevFormData['event_type'] }}">
							<input type="hidden" name="campaign_type" value="{{ $prevFormData['campaign_type'] }}">
							<input type="hidden" name="is_egift" value="{{ $prevFormData['is_egift'] }}">


							@csrf
							@if (!empty($user))
								<input name="id" type="hidden" value="{{ @$user->id }}">
							@endif
							<div class="row">
								<div class="col-lg-6">
									<div>

										<div class="mb-3">
											<input type="hidden" name="recipient_id" id="recipient_id">
											<label for="example-state-input" class="form-label">Select Recipient</label>
											<select class="form-control" name="recipient_type" id="recipient"
												onchange="showRecipientsDiv($(this))">
												<option value="">Select Recipient Option</option>
												<option value="individual">Individual</option>
												<option value="grouplist">Group List</option>
											</select>
										</div>

										<div class="mb-3">
											<div class="containers">
												<div id="individualSelectDiv" class="table-responsive"
													style="overflow-x:auto;display:none">

													<div class="row mb-4">
														<div class="col-md-12 mb-4">
															<div class="card text-left">
																<div class="card-body">
																	<div>
																		<table id="zero_configuration_table"
																			class="display table table-striped table-bordered"
																			style="width:100%">
																			<thead>
																				<tr>
																					<th>Select</th>
																					<th>Name</th>
																				</tr>
																			</thead>
																			<tbody>
																				@foreach ($recipients as $rec)
																					<tr>
																						<td>
																							<input type="checkbox"
																								class="intcls"
																								value="{{ $rec->id }}"

																								onchange="selectRecepient('{{ $rec->id }}',$(this))">
																						</td>
																						<td>
																							{{ $rec->first_name }}
																							{{ $rec->last_name }}
																						</td>
																					</tr>
																				@endforeach
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div id="individualGrouplist" class="Grouplist" style="display: none">
												<select class="form-control grupcls" name="group_id"
													onchange="selectGroup($(this))" />
												<option value="" myTag="">Select Group List</option>
												@foreach ($recipientGroup as $rec)
													<option value="{{ $rec->id }}"
														myTag="{{ $rec->activegroupRecipients->count() }}">
														{{ $rec->group_name }}
														({{ $rec->activegroupRecipients->count() }})
													</option>
												@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="row justify-content-center mt-5">
						<div class="col-sm-2">
							<div>
								<!-- <button type="submit" class="btn btn-primary w-md">Back</button> -->
								<a href="javascript:history.back()" class="btn btn-primary">Back</a>
								<button type="submit" id="btnSubmit" class="btn btn-success w-md" disabled>Next
									Step</button><br><br>
							</div>
						</div>

					</div>
					</form>
				</div>
			</div>
		</div> <!-- end col -->
	</div>
	<!-- end row -->




	</div> <!-- container-fluid -->
	</div>

	<script type="text/javascript">
		// Basic example
		$()
		$(document).ready(function() {
			$('#dtBasicExample').DataTable({
				"paging": false // false to disable pagination (or any other option)
			});
			$('.dataTables_length').addClass('bs-select');
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#individualSelectDiv').hide();
			$('#individualGrouplist').hide();
			$("#btnSubmit").click(function(){
					$("#recipient_id").val(recipientIdsArr);
			});
		});


		function myFunction() {
			var checkBox = document.getElementById("myCheck");
			var text = document.getElementById("text");
			if (checkBox.checked == true) {
				text.style.display = "block";
			} else {
				text.style.display = "none";
			}
		}

		var recipientIdsArr = [];

		function selectRecepient(id, thisEle) {
			let isChecked = thisEle.prop('checked');

			if (isChecked == true) {
				recipientIdsArr.push(id);
			} else {
				recipientIdsArr.pop(id);
			}

			if (recipientIdsArr.length > 0) {
				$('#btnSubmit').prop('disabled', false);
			} else {
				$('#btnSubmit').prop('disabled', true);
			}

			/*match recipient*/
			// let recipientIdCount = recipientIdsArr.length;
			// let abalance = {{ $availableBalance }}
			// let pprice = {{ $productMaxPrice }}
			// let price = abalance / pprice;
			// let numberCount = parseInt(price);
			// $(".requiredAmount").text(recipientIdCount * pprice);
			// // alert(numberCount)
			// if (recipientIdCount > numberCount) {
			//     $('#btnSubmit').prop('disabled', true);
			//     let msg = 'You can select only ' + numberCount + ' recipient.';
			//     message('error', msg);
			//     //alert('You can select only ' + numberCount + ' recipient.') // show in toaster
			// } else {
			//     $('#btnSubmit').prop('disabled', false);
			// }
			/*match recipient*/
		}

		function selectGroup(thisEle) {
			if (thisEle.val()) {
				$('#btnSubmit').prop('disabled', false);
			} else {
				$('#btnSubmit').prop('disabled', true);
			}

			/*match recipient*/
			// let option = $('option:selected', thisEle).attr('mytag');
			// let abalance = {{ $availableBalance }}
			// let pprice = {{ $productMaxPrice }}
			// let price = abalance / pprice;
			// let numberCount = parseInt(price);
			//  $(".requiredAmount").text(option * pprice);
			// if (option > numberCount) {
			//     $('#btnSubmit').prop('disabled', true);
			//     //alert('you have select maximum ' + numberCount + ' members group only')
			//     //alert('You can select maximum ' + numberCount + ' members of group.') // show in toaster
			//     let msg = 'You can select maximum ' + numberCount + ' members of group.';
			//     message('error',msg);
			// } else {
			//     $('#btnSubmit').prop('disabled', false);
			// }
			/*match recipient*/
		}

		function showRecipientsDiv(thisEl) {
			if (thisEl.val() == 'individual') {
				$('#individualSelectDiv').show();
				$('#individualGrouplist').hide();
			} else if (thisEl.val() == 'grouplist') {
				$('#individualSelectDiv').hide();
				$('#individualGrouplist').show();
			} else {
				$('#individualSelectDiv').hide();
				$('#individualGrouplist').hide();
			}
			console.log('val ==>', thisEl.val());
		}
	</script>
	<script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/datatables.min.js"></script>
	<script src="http://gull-html-laravel.ui-lib.com/assets/js/datatables.script.js"></script>

@endsection

{{-- $('#form').on('submit', function(e) {
	$('.error').text('');
	e.preventDefault()
	showButtonLoader('btnSubmit', 'Submit','disable');
	let formValue = new FormData(this);
	$.ajax({
		type: "post",
		url: "{{ url('super-admin/save-send-list') }}",
		data: formValue,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response) {
			console.log('response',response);
			if (response.success) {
				message('success', response.message);
				setTimeout(function(){
					window.location.href = "{{ url('super-admin/clients') }}";
				},2000);
			} else {
				message('error', response.message);
			}
			showButtonLoader('btnSubmit', 'Submit','enable');
		},
		error: function(response) {
			let error = response.responseJSON;
			if(!error){
				error = JSON.parse(response.responseText);
			}
			if (error.errors.first_name) {
				$('#first-name-error').text(error.errors.first_name[0])
			}
			if (error.errors.last_name) {
				$('#last-name-error').text(error.errors.last_name[0])
			}
			if (error.errors.phone) {
				$('#phone-error').text(error.errors.phone[0])
			}
			if (error.errors.email) {
				$('#email-error').text(error.errors.email[0])
			}

			showButtonLoader('btnSubmit', 'Submit','enable');
		},
	});
}) --}}

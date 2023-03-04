@extends('layouts.app')
@section('title', 'Send List')
@section('content')
	<link rel="stylesheet" href="http://gull-html-laravel.ui-lib.com/assets/styles/vendor/datatables.min.css">
	<div class="main-content-wrap d-flex flex-column sidenav-open">
			<div class="row">
					<div class="breadcrumb col-md-8">
									<h1>Send List</h1>
									<h1> Select Recipient</h1>
					</div>

			</div>

			<div class="separator-breadcrumb border-top">
					
			</div>

			<div class="row mb-4">
					<div class="col-md-12 mb-4">
							<div class="card text-left">
									<div class="card-body p-4">

											<form method="post" id="form" action="{{ url('client-admin/saveCampagianRecipent') }}"
													enctype="multipart/form-data">                            @csrf
													@if (!empty($user))
															<input name="id" type="hidden" value="{{ @$user->id }}">
															
													@endif
													<input type="hidden" name="recipient_type" value="{{$recipient_type}}">
													<input type="hidden" name="campgroup_id" value="{{$group_id}}"> 
													<input name="campaign_id" type="hidden" value="{{$id}}">
													<input name="max_price" type="hidden" value="{{$max_price}}">
													
													<input name="checkedData" value="{{implode(',',$getRecipent)}}" type="hidden" id="checkedData">
													<div class="row">
															<div class="col-lg-6">
																	<div>

																			
																			<div class="mb-3">
																					<div class="containers">
																							<div id="individualSelectDiv" class="table-responsive"
																									style="overflow-x:auto;{{($recipient_type === 'individual')? 'display:block' :'display:none' }}">
																									<input type="hidden" name="recipient_id" id="recipient_id">

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
																																															class="intcls" {{(in_array($rec->id,$getRecipent) ? 'checked':'')}}
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

																					<div id="individualGrouplist" class="Grouplist" style="{{($recipient_type === 'grouplist')? 'display:block' :'display:none' }}" >
																							<select class="form-control grupcls" name="group_id"
																									onchange="selectGroup($(this))" />
																							<option value="" myTag="">Select Group List</option>
																							@foreach ($recipientGroup as $rec)
																									<option value="{{ $rec->id }}" {{($group_id == $rec->id) ? 'selected':''}}
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
														
															<button type="submit" id="btnSubmit" class="btn btn-success w-md" disabled>Save</button><br><br>
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
			$(document).ready(function() {
					$('#dtBasicExample').DataTable({
							"paging": false // false to disable pagination (or any other option)
					});
					$('.dataTables_length').addClass('bs-select');
			});
	</script>

	<script>
			$(document).ready(function() {
					
					//$('#individualGrouplist').hide();
					var type = "{{$recipient_type}}";

					$("#btnSubmit").click(function(){
							$("#recipient_id").val(recipientIdsArr);
					});
					showRecipientsDiv(type);
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

		
			}

			function selectGroup(thisEle) {
					if (thisEle.val()) {
							$('#btnSubmit').prop('disabled', false);
					} else {
							$('#btnSubmit').prop('disabled', true);
					}

					
			}

			function showRecipientsDiv(thisEl) {
					if (thisEl == 'individual') {
							var checkval = $("#checkedData").val();
							strx   = checkval.split(',');
							recipientIdsArr = recipientIdsArr.concat(strx);
							if(recipientIdsArr.length > 0){
								$('#btnSubmit').prop('disabled', false);
							}
						
					} else if (thisEl == 'grouplist') {
							$('#btnSubmit').prop('disabled', false);
						
					} 
			}
	</script>
	<script src="http://gull-html-laravel.ui-lib.com/assets/js/vendor/datatables.min.js"></script>
	<script src="http://gull-html-laravel.ui-lib.com/assets/js/datatables.script.js"></script>

@endsection


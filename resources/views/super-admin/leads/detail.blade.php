@extends('layouts.app')
@section('title', 'Lead Details')
@section('content')
 


<div class="main-content-wrap d-flex flex-column sidenav-open">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">Lead Detail</h4>
			</div>
		</div>

		<div class="col-12">
			<div>
				<hr>

				<div class="row">
					<div class="col-md-4">
							<p class="text-primary mb-1"> Name</p>
							<span>{{ $lead['name']}}</span>
					</div>

					<div class="col-md-4">
							<p class="text-primary mb-1"> Company Name</p>
							<span>{{ $lead['company_name']}}</span>
					</div>

					<div class="col-md-4">
							<p class="text-primary mb-1">Email</p>
							<span>{{ $lead['email']}}</span>
					</div>

					<div class="col-md-4 mt-4">
							<p class="text-primary mb-1">Phone</p>
							<span>{{ $lead['phone']}}</span>
					</div>

					<div class="col-md-4 mt-4">
							<p class="text-primary mb-1">Status</p>
							<span>{{ $lead['status']}}</span>
					</div>

					<div class="col-md-4 mt-4">
							<p class="text-primary mb-1">Date</p>
							<span>{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y')}}</span>
					</div>
					<div class="col-md-12 mt-4">
						<p class="text-primary mb-1">Comment</p>
							<span>{{ $lead['comment']}}</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
  
@endsection

@php
$urlPrefix = urlPrefix();
@endphp
@if($isEgift == 0)
	<div class="row productdiv">
				@foreach($compproduct as $pro)
					@foreach($pro['product'] as $value)
						<div class="col-sm-4">
							<div class="card p-2" style="width: 18rem;">
								<img src="{{getImage(@$value->productDefaultImage->image, 'product')}}" class="card-img-top" alt="...">
								<div class="card-body">
									<h5 class="card-title">{{$value['name']}} </h5>
									<p class="card-text">{{$value['description']}}</p>
									<div class="row">
										<div class="col-sm-6">
											<p>Physical Gift</p>
										</div>
										<div class="col-sm-6">
											<p class="pera">Rs.{{$value['price']}} /-</p>
										</div>
									</div>
									<a href="{{ url($urlPrefix.'/add-campaign') }}" id="sendgift" class="btn btn-primary">Send Gift</a>
								</div>
							</div>
						</div>
					@endforeach
				@endforeach
	</div>
@else
	<div class="row productdiv">
		@foreach($compproduct as $pro)
		 <div class="col-sm-4">
			  <div class="card" style="width: 18rem;">
				<img src="{{json_decode($pro->json_response)->images->base}}" class="card-img-top" alt="...">
				<div class="card-body">
				  <h5 class="card-title">{{$pro->name}}</h5>
				  <p class="card-text">{{$pro->sku}}</p>
				  <div class="row">
					<div class="col-sm-6">
					  <p>E-Gift</p>
					</div>
					<div class="col-sm-6">
					  <p class="pera">Rs.  {{$pro->max_price}}/-</p>
					</div>
				  </div>
				  <a href="#" id="sendgift" class="btn btn-primary">Send E-gift</a>
				</div>
			  </div>
		 </div>
		@endforeach

	</div>
	
@endif
<div class="row">  
 		<div class="col-lg-12">
 			{!! $compproduct->links() !!}
 		</div>
	</div>
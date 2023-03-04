@if($type == 'egift')
	@foreach($data as $pro)
    	<div class="list-item col-md-3">
	        <div class="card o-hidden mb-4 d-flex flex-column">
	            <div class="list-thumb d-flex mt-2">
	              	<img alt="" src="{{json_decode($pro->json_response)->images->base}}"/>
	            </div>
                <div class="flex-grow-1 d-bock">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                        <a class="w-40 w-sm-100" href="javascript:void(0)">
                            <div class="item-title">
                            {{$pro->name}}
                            </div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            ₹' {{$pro->min_price}} To {{$pro->max_price}}
                        </p>
                        <p>
                        <input type="checkbox" class="addPro" value='{{$pro->id}}' onclick="addProduct('{{$pro->id}}',this)">
                        </p>
                    </div>
                </div>
	        </div>
        </div>

    @endforeach
@else
    @foreach($data as $pro)
        @php
            if ($pro->visibility == 1) {
                if (in_array($pro->id, $compproduct)) {
                    $isshowing = true;
                } else {
                    $isshowing = false;
                }
            } else {
                $isshowing = true;
            }
        @endphp
        @if ($isshowing == true)
            <div class="list-item col-md-3">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex mt-2">
                      <img alt="" src="{{getImage(@$pro->productDefaultImage->image, 'product')}}"/>
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="javascript:void(0)">
                                <div class="item-title">
                                {{$pro->name}}
                                </div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                ₹' {{$pro->price}}
                            </p>
                            <p>
                            <input type="checkbox" class="addPro" value='{{$pro->id}}' onclick="addProduct('{{$pro->id}}',this)">
                            </p>
                        </div>
                    </div>
                </div>
            </div>';
        @endif
    @endforeach
@endif
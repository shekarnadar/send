@if($data->count() > 0)
    @foreach($data as $val)
        @php
            $image = getImage(@$val->productDefaultImage->image, 'product');
            if(getUrl() === 'super-admin/'){
               $is_allow = 1; 
               $is_delete = 1; 
            }else{
               $is_allow = 0;
               $is_delete = 0;
            }
        @endphp
            <div class="list-item col-md-3">
                <div class="card o-hidden mb-4 d-flex flex-column">
                    <div class="list-thumb d-flex mt-2" style="justify-content: center;">
                        <a href="{{url(getUrl().'view-product'.'/'.$val->id)}}" ><img alt="" src="{{$image}}" /></a>
                    </div>
                    <div class="flex-grow-1 d-bock">
                        <div
                            class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center">
                            <a class="w-40 w-sm-100" href="{{url(getUrl().'view-product'.'/'.$val->id)}}" >
                                <div class="item-title">
                                {{$val->name}}
                                </div>
                            </a>
                            
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                            ₹ {{$val->price}}
                            </p>
                            <a href="{{url(getUrl().'campaigns')}}" class="btn btn-success ul-btn-raised--v2 m-1" style="color:white;"type="button">
                                  Send Gift
                                </a>
                                <a href="{{url(getUrl().'view-product'.'/'.$val->id)}}" class="btn btn-outline-success ul-btn-raised--v2 m-1 float-right">View</a>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@else
    <span>No record found.</span>
@endif
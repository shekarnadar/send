@php
	if(getUrl() === 'super-admin/'){

		if($url == 'product'){
			$is_allow = 1; 
			$is_delete = 1; 
		}else{
			$is_allow = 1;
			$is_delete = 0; 
		}
		if($url == 'lead'){
			$is_allow = 0;
			$is_delete = 1; 
		}
		if($url == 'campaign' || $url == 'redeemed'){
			$is_allow = 0;
		}
		$is_view = 1;
	}else{
		$is_view = 1;
		if($url == 'product'){
			$is_allow = 0;
			$is_delete = 0;
		} else {
			 $is_allow = 1;
			 $is_delete = 0;
		}
		if($url == 'manager' || $url == 'recipient'){
			$is_view = 0;
			$is_delete = 0;
			$is_edit =  1;
		}
		if($url == 'campaign'){
			$is_allow = 0;
		}
		
		if($url == 'group') {
			$is_view = 0;
		}
	}
@endphp
@if($is_allow == 1)
	@if($status == 1)
			<button class="btn btn-danger"  onClick="statusData({{$id}})">Deactivate</button>
	@else
			<button class="btn btn-success"  onClick="statusData({{$id}})">Activate</button>
	@endif
@endif
@if(getUrl() === 'super-admin/')
@if($url == 'campaign' || $url == 'redeemed')
	@if($status == 1 || $status == 2)
		<button class="btn btn-default" disabled>{{($url == 'redeemed' ? 'Dispatch' : 'Approve')}} </button>
		<button class="btn btn-default" disabled>Reject </button>
	@else
		<button class="btn btn-default"  onClick="changeStatus({{$id}},1)">{{($url == 'redeemed' ? 'Dispatch' : 'Approve')}}  </button>
		<button class="btn btn-default"  onClick="changeStatus({{$id}},2)">Reject </button>
	@endif
@endif
@endif

@if($url == 'lead')
<button class="btn btn-primary"   onClick="comment({{$id}})">Comment</button>
@endif
@if($is_view == 1)
	<a href="{{url(getUrl().'view-'.$url.'/'.$id)}}" class="btn btn-default"> View</a>
@endif
@if($url == 'redeemed' && $status == 1)
	<a type="button" href="{{url(getUrl().'view-pdf'.'/'.$id)}}" class="btn btn-primary">Label</a>
@endif
@if($is_allow == 1)
	<a href="{{url(getUrl().'edit-'.$url.'/'.$id)}}" class="btn btn-default"> Edit</a>
@endif
@if($url == 'group')
		 <a href="#" type="button" class="btn btn-primary" onClick="shareLink({{$id}})">Onboarding Link</a>
@endif
@if($is_delete == 1)
	<button class="btn btn-default" onClick="deleteData({{$id}})">Delete</button>
@endif
@if($url == 'client')
<a href="{{url(getUrl().'clientcampaigns/'.$id)}}" class="btn btn-default"> campaign</a>
@endif
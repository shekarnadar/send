@php
$urlPrefix = urlPrefix();
@endphp

<aside id="sidebar" class="sidebar">
	<ul class="sidebar-nav" id="sidebar-nav">

		@if(getAuthGaurd() == 'super_admin')

		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix")}}'>
				<i class="bi bi-bar-chart-fill"></i>
				<span class=" {{ request()->is($urlPrefix.'/dashboard')? 'span' : '' }}">Analytics</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="{{route('client')}}">
				<i class="bi bi-person-lines-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/clients', $urlPrefix.'/add-client-admin', $urlPrefix.'/view-client/*', $urlPrefix.'/edit-client/*', $urlPrefix.'/clientcampaigns/*')? 'span' : '' }}">Clients</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/products")}}'>
				<i class="bi bi-shop-window"></i>
				<span class="{{ request()->is($urlPrefix.'/products', $urlPrefix.'/add-prelisted-product')? 'span' : '' }}">Gift Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='https://ekmatra.swag1.in' target="_blank">
				<i class="bi bi-grid"></i>
				<span class="nav-text">Swag Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" id="campCount" href='{{url("$urlPrefix/campaigns")}}'>
				<i class="bi bi-gift-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/campaigns', $urlPrefix.'/view-campaign/*')? 'span' : '' }}">Send Gift
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link leadcount" href='{{url("$urlPrefix/leads")}}'>
				<i class="bi bi-chat-left-text-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/leads', $urlPrefix.'/view-lead/*')? 'span' : '' }}">Leads
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link redeemedcount" href='{{url("$urlPrefix/redeemed")}}'>
				<i class="bi bi-box2-heart-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'span' : '' }}">Redeemed
				</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link logcount" href='{{url("$urlPrefix/logs")}}'>
				<i class="bi bi-list-task"></i>
				<span class="{{ request()->is($urlPrefix.'/logs')? 'span' : '' }}">Logs
				</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link ordercount" onclick="orderCount()" href='{{url("$urlPrefix/order-logs")}}'>
				<i class="bi bi-card-checklist"></i>
				<span class="{{ request()->is($urlPrefix.'/order-logs', $urlPrefix.'/trackorder/*')? 'span' : '' }}">Order Logs
				</span>
			</a>
		</li>

		@else

		<!-- client sidebar menu -->
		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/products")}}'>
				<i class="bi bi-shop-window"></i>
				<span class="{{ request()->is($urlPrefix.'/products', $urlPrefix.'/view-product/*')? 'span' : '' }}">Gift Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/swag-store")}}' target="_blank">
				<i class="bi bi-grid"></i>
				<span>Swag Store</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link " href='{{url("$urlPrefix/campaigns")}}'>
				<i class="bi bi-gift-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/campaigns',$urlPrefix.'/add-campaign', $urlPrefix.'/step-2', $urlPrefix.'/step-3' , $urlPrefix.'/view-campaign/*')? 'span' : '' }}">Send Gift</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link " href='{{url("$urlPrefix/recipients")}}'>
				<i class="bi bi-person-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/recipients', $urlPrefix.'/add-recipient', $urlPrefix.'/edit-recipient/*', $urlPrefix.'/importExcelView')? 'span' : '' }}">Recipients</span>
			</a>
		</li>


		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/groups")}}'>
				<i class="bi bi-people-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/groups',$urlPrefix.'/add-recipient-group',$urlPrefix.'/edit-group/*')? 'span' : '' }}">Recipient Group</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='{{ url("$urlPrefix/order-logs") }}'>
				<i class="bi bi-mailbox2"></i>
				<span class="{{ request()->is($urlPrefix.'/order-logs')? 'span' : '' }}">Track Gifts</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix")}}'>
				<i class="bi bi-bar-chart-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/dashboard')? 'span' : '' }}">Analytics</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/logs")}}'>
				<i class="bi bi-activity"></i>
				<span class="{{ request()->is($urlPrefix.'/logs')? 'span' : '' }}">Activity</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='{{url("$urlPrefix/redeemed/")}}'>
				<i class="bi bi-box2-heart-fill"></i>
				<span class="{{ request()->is($urlPrefix.'/redeemed', $urlPrefix.'/view-redeemed/*')? 'span' : '' }}">Redeemed
				</span>
			</a>
		</li>
		@endif

		<li class="nav-item">
			<a class="nav-link" href='#'>
				<img width="30px" src="{{url('assets/images/default-user.jpg')}}">
				<p class="mb-0 enterpeice">{{\Auth::guard(getAuthGaurd())->user()->first_name}} {{\Auth::guard(getAuthGaurd())->user()->last_name}}
					<br>
					<span>Enterprise plan </span>
				</p>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href='#'>
				<form method="POST" action="{{url('logout')}}">
                	@csrf
                    <button class="dropdown-item">Sign out</button>
                </form>
			</a>
		</li>

	
		

		
	</ul>
</aside><!-- End Sidebar-->
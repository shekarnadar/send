@php
$urlPrefix = '';
if(getAuthGaurd() == 'super_admin'){
$urlPrefix = 'super-admin';
} else if(getAuthGaurd() == 'client_admin'){
$urlPrefix = 'client-admin';
}else if(getAuthGaurd() == 'manager'){
$urlPrefix = 'manager';
}

$userData = getLoggedInUserDetails();

@endphp
<style type="text/css">
    .layout-sidebar-large .main-header .logo img {
        width: 100%;
        height: 100%;
        margin: 0 auto;
        display: block;
        max-width: 200px;
        max-height: 200px;
    }

    .menu-active {
        background-color: #bcbbdd !important;
    }
</style>
<div class="main-header">
    <div class="logo">
        @php
        $defult=url('assets/images/send-logo.jpeg');
        $logoUrl = getLogo($urlPrefix,$userData['client_admin_logo']);

        @endphp
        <a href="{{url("$urlPrefix")}}"><img src="{{url($logoUrl)}}" alt="" onerror="this.onerror=null;this.src='{{$defult}}'"></a>
    </div>
    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div style="margin: auto"></div>
    <div class="header-part-right">

        @php $notifications = notifcationCount('today') @endphp
        <!-- Notificaiton -->
        <div class="dropdown">
            <!-- Notification dropdown -->
            @if($urlPrefix != 'super-admin')
            <a id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(!empty($notifications))
                    Notification({{count($notifications)}})
                @else
                    Notification(0)
                @endif
                </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            {{@$userData->client->name}}


            <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                @if(!empty($notifications))
                    @foreach($notifications as $noti)
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>{{ $noti->campaignInfo->name }}</span>
                                <span class="badge badge-pill badge-success ml-1 mr-1">{{ $noti->type }}</span>
                                <span class="flex-grow-1"></span>
                                <!-- <span class="text-small text-muted ml-auto">10 sec ago</span> -->
                            </p>
                            <!-- <p class="text-small text-muted m-0">James: Hey! are you busy?</p> -->
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            @endif
        </div>
        <!-- Notificaiton End -->
        <!-- User avatar dropdown -->


        <div class="dropdown">
            <div class="user col align-self-end">
                @if($urlPrefix == 'super-admin')
                {{@$userData->first_name}} {{@$userData->last_name}}
                @endif
                <img src="{{url('assets/images/default-user.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <!-- <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> 
 
                    </div> -->

                    @if($urlPrefix == 'super-admin')
                    <form method="POST" action="{{url("$urlPrefix/logout")}}">
                        @else
                        @if(getAuthGaurd() != 'manager')
                        <a class="dropdown-item" href="{{url("$urlPrefix/managers")}}">Add User</a>
                        @endif
                        <a class="dropdown-item" href="{{url("$urlPrefix/client-settings")}}">Account settings</a>
                        <a class="dropdown-item" href="{{url("$urlPrefix/email-settings")}}">Email Settings</a>
                        <a class="dropdown-item" href="{{url("$urlPrefix/whatsapp-settings")}}">Whatsapp Settings</a>
                        <a class="dropdown-item" href="{{url("changePassword")}}">Change Pasword</a>
                        <form method="POST" action="{{url("logout")}}">
                            @endif
                            @csrf
                            <button class="dropdown-item">
                                Sign out
                            </button>
                        </form>
                        <!-- <a class="dropdown-item" href="signin.html">Sign out</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
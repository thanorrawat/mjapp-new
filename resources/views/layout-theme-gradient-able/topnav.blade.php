<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#" >
                <i class="ti-menu"></i>
            </a>
            <div class="mobile-search">
                <div class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{url('/')}}">
                @if($general_setting->site_logo)
                <img class="img-fluid" src="{{url('public/logo', $general_setting->site_logo)}}" alt="{{url('public/logo', $general_setting->site_logo)}}"  height="30"/>
                @endif
                <span class="logotext">{{$general_setting->site_title}}</span>
                
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>
                {{-- <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </li> --}}
                <li>
                    <a href="#" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                
                <li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        @if(app()->getLocale()=="th")
                        ภาษาไทย
                                @elseif(app()->getLocale()=="en")
                        English
                                @endif <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li> <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a></li>
                      <li><a href="{{ url('language_switch/th') }}" class="btn btn-link"> ภาษาไทย</a></li>
           
                    </ul>
                  </li>
                  <li id="topcart" class="header-notification" >
                 {{-- @include('layout-theme-gradient-able.cart') --}}
                </li>
                <li class="header-notification">
                    <a href="#"  onclick="return false;">
                        <i class="ti-bell"></i>
                        @if($alert_product > 0)  <span class="badge bg-c-pink"></span>  @endif
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger">New</label>
                        </li>
                        
                        @if($alert_product > 0)
                        <li>
                            <a href="{{route('report.qtyAlert')}}" class="btn btn-link"> {{$alert_product}} product exceeds alert quantity</a>

                        </li>
                        @endif
                        {{-- <li>
                            <div class="media">
                                <img class="d-flex align-self-center img-radius" src="{{ asset("assets/images/avatar-4.jpg") }}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">Joseph William</h5>
                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                    <span class="notification-time">30 minutes ago</span>
                                </div>
                            </div>
                        </li> --}}
          
                    </ul>
                </li>
                
                <li class="user-profile header-notification">
                    <a href="javascript:void(0)" >
                        @if(!empty(Auth::user()->image))
                        <img src="{{ url("public/images/users",Auth::user()->image) }}" class="img-radius wid-40" alt="User-Profile-Image" height="40" >
                        @endif
                        {{-- <img src="{{ asset("assets/images/avatar-4.jpg") }}" class="img-radius" alt="User-Profile-Image"> --}}
                        <span>
                            @if(!empty(Auth::user()->fullname))
                            {{ucfirst(Auth::user()->fullname)}}
                            @else
                            {{ucfirst(Auth::user()->name)}}  
                            @endif
                            </span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">




                        <li> 
                            <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="ti-user"></i> {{trans('file.profile')}}</a>
                          </li>
                          {{-- @if($general_setting_permission_active)
                          <li> 
                            <a href="{{route('setting.general')}}"><i class="ti-settings"></i>  {{trans('file.settings')}}</a>
                          </li>
                          @endif --}}
                          {{-- <li> 
                            <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="ti-exchange-vertical"></i> {{trans('file.My Transaction')}}</a>
                          </li>
                          <li> 
                            <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="ti-calendar"></i> {{trans('file.My Holiday')}}</a>
                          </li> --}}
                
                          <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="ti-layout-sidebar-left"></i>
                                {{trans('file.logout')}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </li>






                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
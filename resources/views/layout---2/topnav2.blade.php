        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> --}}

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <?php 
            $add_permission = DB::table('permissions')->where('name', 'sales-add')->first();
            $add_permission_active = DB::table('role_has_permissions')->where([
                ['permission_id', $add_permission->id],
                ['role_id', $role->id]
            ])->first();

            $empty_database_permission = DB::table('permissions')->where('name', 'empty_database')->first();
            $empty_database_permission_active = DB::table('role_has_permissions')->where([
                ['permission_id', $empty_database_permission->id],
                ['role_id', $role->id]
            ])->first();
          ?>
          @if($add_permission_active)
          {{-- <li class="nav-item"><a class="nav-link dropdown-item btn-pos btn-sm" href="{{route('sale.pos')}}"><i class="dripicons-shopping-bag"></i><span> POS</span></a></li> --}}
          @endif      
          <li class="nav-item"><a id="btnFullscreen" class="nav-link"><i class="dripicons-expand"></i></a></li>    
          @if($alert_product > 0)
          <li class="nav-item">
                <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-bell"></i><span class="badge badge-danger">{{$alert_product}}</span>
                </a>
                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default notifications" user="menu">
                    <li class="notifications">
                      <a href="{{route('report.qtyAlert')}}" class="btn btn-link"> {{$alert_product}} product exceeds alert quantity</a>
                    </li>
                </ul>
          </li>
          @endif

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-web"></i> <span>{{__('file.language')}}</span> <i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in" user="menu">
                <li>
                  <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a>
                </li>
               {{--  <li>
                  <a href="{{ url('language_switch/es') }}" class="btn btn-link"> Español</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/ar') }}" class="btn btn-link"> عربى</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/pt_BR') }}" class="btn btn-link"> Portuguese</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/fr') }}" class="btn btn-link"> Français</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/de') }}" class="btn btn-link"> Deutsche</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/id') }}" class="btn btn-link"> Malay</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/hi') }}" class="btn btn-link"> हिंदी</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/vi') }}" class="btn btn-link"> Tiếng Việt</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/ru') }}" class="btn btn-link"> русский</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/tr') }}" class="btn btn-link"> Türk</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/it') }}" class="btn btn-link"> Italiano</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/nl') }}" class="btn btn-link"> Nederlands</a>
                </li>
                <li>
                  <a href="{{ url('language_switch/lao') }}" class="btn btn-link"> Lao</a>
                </li>--}}
                <li>
                  <a href="{{ url('language_switch/th') }}" class="btn btn-link"> ภาษาไทย</a>
                </li>
            </ul>
      </li>


      <li class="nav-item dropdown">
          
          <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
          <i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->name)}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in" user="menu">
            <li> 
              <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
            </li>
            @if($general_setting_permission_active)
            <li> 
              <a href="{{route('setting.general')}}"><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
            </li>
            @endif
            <li> 
              <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>
            </li>
            <li> 
              <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="dripicons-vibrate"></i> {{trans('file.My Holiday')}}</a>
            </li>
            @if($empty_database_permission_active)
            {{-- <li>
              <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')" href="{{route('setting.emptyDatabase')}}"><i class="dripicons-stack"></i> {{trans('file.Empty Database')}}</a>
            </li> --}}
            @endif
            <li>
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                  {{trans('file.logout')}}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
        </ul>
      </li> 


        
          </ul>

        </nav>
        <!-- End of Topbar -->
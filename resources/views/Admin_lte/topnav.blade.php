<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul> 

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-language"></i>
            @if(app()->getLocale()=="th")
            ภาษาไทย
                    @elseif(app()->getLocale()=="en")
            English
                    @endif <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li> <a href="{{ url('language_switch/en') }}" class="dropdown-item"> English</a></li>
          <li><a href="{{ url('language_switch/th') }}" class="dropdown-item"> ภาษาไทย</a></li>

        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
                        @if(!empty(Auth::user()->image))
                        <img src="{{ url("public/images/users",Auth::user()->image) }}" class="img-circle elevation-2 " alt="User-Profile-Image" height="30" width="30" >
                        @endif
                        {{-- <img src="{{ asset("assets/images/avatar-4.jpg") }}" class="img-radius" alt="User-Profile-Image"> --}}
                        <span>
                            @if(!empty(Auth::user()->fullname))
                            {{ucfirst(Auth::user()->fullname)}}
                            @else
                            {{ucfirst(Auth::user()->name)}}  
                            @endif
                            </span>
                            <i class="fas fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">




                        <li> 
                            <a class="dropdown-item" href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="ti-user"></i> {{trans('file.profile')}}</a>
                          </li>
           
                
                          <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
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
  </nav>

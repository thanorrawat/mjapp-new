<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        
        {{-- <div class="pcoded-search">
            <span class="searchbar-toggle">  </span>
            <div class="pcoded-search-box ">
                <input type="text" placeholder="Search">
                <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
            </div>
        </div> --}}
        <div class="pcoded-navigatio-lavel" >Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li  @if(url()->current() == url('/')) class="active" @endif >
                <a href="{{url('/')}}">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" >{{ __('file.dashboard') }}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li><a href="{{  url("create_order") }}"> <span class="pcoded-micon"><i class="dripicons-basket"></i></span>{{ __('file.Create Order/Booking') }}</a></li>


{{-- products --}}

<?php if(Auth::user()->role_id==1  || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7   ){  ?>
 <li class="pcoded-hasmenu @if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create')) pcoded-trigger active  @endif">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext">{{__('file.product')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li  @if(url()->current() == url('/category')) class="active" @endif >
                        <a href="{{route('category.index')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" >{{__('file.category')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                

                  <li @if(url()->current() == url('/products')) class="active" @endif>
                    <a href="{{route('products.index')}}">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" >{{__('file.product_list')}}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                                  <li @if(url()->current() == url('/products/create')) class="active" @endif>
                        <a href="{{route('products.create')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" >{{__('file.add_product')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
                  
{{-- //products --}}
        <?php } if(Auth::user()->role_id==1){  ?>

{{-- Sales --}}


 <li class="pcoded-hasmenu @if(url()->current() == url('/sales')||url()->current() == url('/sales/create')  ) pcoded-trigger active  @endif">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="dripicons-cart"></i></span>
        <span class="pcoded-mtext">{{trans('file.Sale')}}</span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  @if(url()->current() == url('/sales')) class="active" @endif >
            <a href="{{route('sales.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Sale List')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>




        <li  @if(url()->current() == url('/sales/create')) class="active" @endif >
            <a href="{{route('sales.create')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Add Sale')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
      
    


    </ul>
</li>
        
{{-- //Sales --}}
<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7 ){  ?>


{{-- CUSTomer --}}

<li class="pcoded-hasmenu  @if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') )pcoded-trigger active  @endif">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
        <span class="pcoded-mtext">{{trans('file.customer')}}</span>
        <span class="pcoded-mcaret"></span>
    </a>

    <ul class="pcoded-submenu">
        
        <li  @if(url()->current() == route('customer.index') ) class="active" @endif >
            <a href="{{route('customer.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Customer List')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li  @if(url()->current() == route('customer.create')) class="active" @endif >
            <a href="{{route('customer.create')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Add Customer')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>


        <li  @if(url()->current() == route('customer_group.index')) class="active" @endif >
            <a href="{{route('customer_group.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Customer Group')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>




     
    </ul></li>
{{--// CUSTomer --}}
<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2  || Auth::user()->role_id==7){  ?>


    {{-- Purchase --}}



<li class="pcoded-hasmenu  @if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) )pcoded-trigger active  @endif">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="dripicons-card"></i></span>
        <span class="pcoded-mtext">{{trans('file.Purchase')}}</span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  @if(url()->current() == url('/purchases') ) class="active" @endif >
            <a href="{{route('purchases.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Purchase List')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>





        <li  @if(url()->current() == url('/purchases/create')) class="active" @endif >
            <a href="{{route('purchases.create')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Add Purchase')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>

{{--  

     
        <li  @if(url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))) class="active" @endif >
            <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Daily Purchase')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>

        <li  @if(url()->current() == url('report/monthly_purchase/'.date('Y'))) class="active" @endif >
            <a href="{{url('report/monthly_purchase/'.date('Y'))}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Monthly Purchase')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
   


    


      <li  @if(url()->current() == url('purchases/purchase_by_csv')) class="active" @endif >
          <a href="{{url('purchases/purchase_by_csv')}}">
              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
              <span class="pcoded-mtext" >{{trans('file.Import Purchase By CSV')}}</span>
              <span class="pcoded-mcaret"></span>
          </a>
      </li> --}}
    </ul>
</li> 


{{--// Purchase --}}
{{-- Supplier --}}

<li class="pcoded-hasmenu  @if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create') )pcoded-trigger active  @endif">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-industry" aria-hidden="true"></i></span>
        <span class="pcoded-mtext">{{trans('file.Supplier')}}</span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  @if(url()->current() == route('supplier.index')) class="active" @endif >
            <a href="{{route('supplier.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Supplier List')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li  @if(url()->current() == route('supplier.create')) class="active" @endif >
            <a href="{{route('supplier.create')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.Add Supplier')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>

    </ul></li>
      {{--// Supplier --}}

        {{-- User --}}

<li class="pcoded-hasmenu  @if(url()->current() ==route('user.index')|| url()->current() == route('user.create') )pcoded-trigger active  @endif">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-users" aria-hidden="true"></i></span>
        <span class="pcoded-mtext">{{trans('file.User')}}</span>
        <span class="pcoded-mcaret"></span>
    </a>

    <ul class="pcoded-submenu">
        <li  @if(url()->current() == route('user.index')) class="active" @endif >
            <a href="{{route('user.index')}}">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" >{{trans('file.User List')}}</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>


    <li  @if(url()->current() == route('user.create')) class="active" @endif >
        <a href="{{route('user.create')}}">
            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
            <span class="pcoded-mtext" >{{trans('file.Add User')}}</span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>

    </ul><li>


        {{--// User --}}

    <?php }?>



</ul>
</li>
        </ul>

    </div>
</nav>
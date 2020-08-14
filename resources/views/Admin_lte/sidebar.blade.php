<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link navbar-primary">
      <img src="{{url('public/logo', $general_setting->site_logo)}}" alt="{{url('public/logo', $general_setting->site_logo)}}" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{$general_setting->site_title}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

<li  class="nav-item" >
<a href="{{url('/')}}" class="nav-link @if(url()->current() == url('/')) active @endif">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p>{{ __('file.dashboard') }}</p></a>
</li>

<li  class="nav-item" >
    <a href="{{  url("create_order") }}" class="nav-link @if(url()->current() == url('create_order')) active @endif">
    <i class="nav-icon  fas fa-shopping-basket"></i>
    <p>{{ __('file.Create Order/Booking') }}</p></a>
    </li>
    


{{-- products --}}

<?php if(Auth::user()->role_id==1  || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7   ){  ?>

    <li  class="nav-item has-treeview   @if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create')) menu-open @endif" >

        <a href="#" class="nav-link @if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create'))  active @endif">
        <i class="nav-icon fas fa-boxes"></i>
        <p>{{__('file.product')}} <i class="right fas fa-angle-left"></i></p></a>
        
        <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link @if(url()->current() == url('/category'))  active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('file.category')}}</p>
              </a>
            </li>
            <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link @if(url()->current() == url('/products'))  active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('file.product_list')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link @if(url()->current() == url('/products/create'))  active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('file.add_product')}}</p>
                </a>
              </li>


          </ul>
 </li>

                  
{{-- //products --}}
        <?php } if(Auth::user()->role_id==1){  ?>

{{-- Sales --}}

<li  class="nav-item has-treeview @if(url()->current() == url('/sales')||url()->current() == url('/sales/create')  )  menu-open @endif" >
    <a href="#" class="nav-link  @if(url()->current() == url('/sales')||url()->current() == url('/sales/create')) active @endif">
    <i class="nav-icon fas fa-shopping-cart"></i>
    <p>{{trans('file.Sale')}} <i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('sales.index')}}" class="nav-link  @if(url()->current() == url('/sales')) active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>{{trans('file.Sale List')}}</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{route('sales.create')}}" class="nav-link @if(url()->current() == url('/sales/create')) active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>{{trans('file.Add Sale')}}</p>
            </a>
          </li>


    </ul>
</li>
        
{{-- //Sales --}}
<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7 ){  ?>


{{-- CUSTomer --}}




<li  class="nav-item has-treeview @if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') )  menu-open @endif" >
    <a href="#" class="nav-link @if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') ) active @endif">
    <i class="nav-icon far fa-user-circle"></i>
    <p>{{trans('file.customer')}} <i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('customer.index')}}" class="nav-link @if(url()->current() == route('customer.index') ) active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>{{trans('file.Customer List')}}</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{route('customer.create')}}" class="nav-link @if(url()->current() == route('customer.create')) active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>{{trans('file.Add Customer')}}</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('customer_group.index') }}" class="nav-link @if(url()->current() == route('customer_group.index')) active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>{{trans('file.Customer Group')}}</p>
            </a>
          </li>

</ul></li>
{{--// CUSTomer --}}
<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2  || Auth::user()->role_id==7){  ?>


    {{-- Purchase --}}

    <li  class="nav-item has-treeview  @if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) ) active @endif" >
        <a href="#" class="nav-link @if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) ) active @endif">
        <i class="nav-icon far fa-credit-card"></i>
        <p>{{trans('file.Purchase')}}<i class="right fas fa-angle-left"></i></p></a>
        
        <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('purchases.index')}}" class="nav-link @if(url()->current() == url('/purchases') )  active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans('file.Purchase List')}}</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="{{route('purchases.create')}}" class="nav-link @if(url()->current() == url('/purchases/create'))  active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{trans('file.Add Purchase')}}</p>
                </a>
              </li>

    </ul>
</li> 


{{--// Purchase --}}
{{-- Supplier --}}


<li  class="nav-item has-treeview @if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create')) active @endif" >
    <a href="#" class="nav-link @if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create')) active @endif">
    <i class="nav-icon fa fa-industry"></i>
    <p>{{trans('file.Supplier')}}<i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('supplier.index') }}" class="nav-link @if(url()->current() == route('supplier.index')) active @endif">
            <i class="far fa-circle nav-icon"></i>
            <p>{{trans('file.Supplier List')}}</p>
          </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('supplier.create') }}" class="nav-link @if(url()->current() == route('supplier.create')) active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>{{trans('file.Add Supplier')}}</p>
            </a>
          </li>

    </ul></li>
      {{--// Supplier --}}

        {{-- User --}}

        <li  class="nav-item has-treeview @if(url()->current() ==route('user.index')|| url()->current() == route('user.create')) active @endif" >
            <a href="#" class="nav-link @if(url()->current() ==route('user.index')|| url()->current() == route('user.create')) active @endif">
            <i class="nav-icon fa fa-users"></i>
            <p>{{trans('file.User')}}<i class="right fas fa-angle-left"></i></p></a>
            
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('user.index') }}" class="nav-link @if(url()->current() == route('user.index')) active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{trans('file.User List')}}</p>
                  </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.create')}}" class="nav-link @if(url()->current() == route('user.create'))active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{trans('file.Add User')}}</p>
                    </a>
                  </li>



    </ul><li>


        {{--// User --}}

    <?php }?>



</ul>
</li>
        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
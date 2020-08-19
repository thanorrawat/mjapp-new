<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/')); ?>" class="brand-link navbar-primary">
      <img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" alt="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo e($general_setting->site_title); ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

<li  class="nav-item" >
<a href="<?php echo e(url('/')); ?>" class="nav-link <?php if(url()->current() == url('/')): ?> active <?php endif; ?>">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p><?php echo e(__('file.dashboard')); ?></p></a>
</li>

<li  class="nav-item" >
    <a href="<?php echo e(url("create_order")); ?>" class="nav-link <?php if(url()->current() == url('create_order')): ?> active <?php endif; ?>">
    <i class="nav-icon  fas fa-shopping-basket"></i>
    <p><?php echo e(__('file.Create Order/Booking')); ?></p></a>
    </li>

    <li class="nav-item has-treeview ">
      <a href="#" class="nav-link ">
        <i class="nav-icon  fas fa-comments-dollar"></i>
      <p>Memo ขอปรับราคา <i class="right fas fa-angle-left"></i></p></a>
      
      <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo e(url('memo-changprice')); ?>" class="nav-link ">
              <i class="far fa-circle nav-icon"></i>
              <p>รายการขอปรับราคา</p>
            </a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>ขอปรับราคา</p>
              </a>
            </li>
  
      
  
  </ul></li>




<?php if(Auth::user()->role_id==1  || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7   ){  ?>

    <li  class="nav-item has-treeview   <?php if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create')): ?> menu-open <?php endif; ?>" >

        <a href="#" class="nav-link <?php if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create')): ?>  active <?php endif; ?>">
        <i class="nav-icon fas fa-boxes"></i>
        <p><?php echo e(__('file.product')); ?> <i class="right fas fa-angle-left"></i></p></a>
        
        <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo e(route('category.index')); ?>" class="nav-link <?php if(url()->current() == url('/category')): ?>  active <?php endif; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo e(__('file.category')); ?></p>
              </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php if(url()->current() == url('/products')): ?>  active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo e(__('file.product_list')); ?></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(route('products.create')); ?>" class="nav-link <?php if(url()->current() == url('/products/create')): ?>  active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo e(__('file.add_product')); ?></p>
                </a>
              </li>


          </ul>
 </li>

                  

        <?php } if(Auth::user()->role_id==1){  ?>



<li  class="nav-item has-treeview <?php if(url()->current() == url('/sales')||url()->current() == url('/sales/create')  ): ?>  menu-open <?php endif; ?>" >
    <a href="#" class="nav-link  <?php if(url()->current() == url('/sales')||url()->current() == url('/sales/create')): ?> active <?php endif; ?>">
    <i class="nav-icon fas fa-shopping-cart"></i>
    <p><?php echo e(trans('file.Sale')); ?> <i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo e(route('sales.index')); ?>" class="nav-link  <?php if(url()->current() == url('/sales')): ?> active <?php endif; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p><?php echo e(trans('file.Sale List')); ?></p>
          </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('sales.create')); ?>" class="nav-link <?php if(url()->current() == url('/sales/create')): ?> active <?php endif; ?>">
              <i class="far fa-circle nav-icon"></i>
              <p><?php echo e(trans('file.Add Sale')); ?></p>
            </a>
          </li>


    </ul>
</li>
        

<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7 ){  ?>







<li  class="nav-item has-treeview <?php if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') ): ?>  menu-open <?php endif; ?>" >
    <a href="#" class="nav-link <?php if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') ): ?> active <?php endif; ?>">
    <i class="nav-icon far fa-user-circle"></i>
    <p><?php echo e(trans('file.customer')); ?> <i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo e(route('customer.index')); ?>" class="nav-link <?php if(url()->current() == route('customer.index') ): ?> active <?php endif; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p><?php echo e(trans('file.Customer List')); ?></p>
          </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('customer.create')); ?>" class="nav-link <?php if(url()->current() == route('customer.create')): ?> active <?php endif; ?>">
              <i class="far fa-circle nav-icon"></i>
              <p><?php echo e(trans('file.Add Customer')); ?></p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(route('customer_group.index')); ?>" class="nav-link <?php if(url()->current() == route('customer_group.index')): ?> active <?php endif; ?>">
              <i class="far fa-circle nav-icon"></i>
              <p><?php echo e(trans('file.Customer Group')); ?></p>
            </a>
          </li>

</ul></li>

<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2  || Auth::user()->role_id==7){  ?>


    

    <li  class="nav-item has-treeview  <?php if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) ): ?> active <?php endif; ?>" >
        <a href="#" class="nav-link <?php if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) ): ?> active <?php endif; ?>">
        <i class="nav-icon far fa-credit-card"></i>
        <p><?php echo e(trans('file.Purchase')); ?><i class="right fas fa-angle-left"></i></p></a>
        
        <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo e(route('purchases.index')); ?>" class="nav-link <?php if(url()->current() == url('/purchases') ): ?>  active <?php endif; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo e(trans('file.Purchase List')); ?></p>
              </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo e(route('purchases.create')); ?>" class="nav-link <?php if(url()->current() == url('/purchases/create')): ?>  active <?php endif; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo e(trans('file.Add Purchase')); ?></p>
                </a>
              </li>

    </ul>
</li> 






<li  class="nav-item has-treeview <?php if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create')): ?> active <?php endif; ?>" >
    <a href="#" class="nav-link <?php if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create')): ?> active <?php endif; ?>">
    <i class="nav-icon fa fa-industry"></i>
    <p><?php echo e(trans('file.Supplier')); ?><i class="right fas fa-angle-left"></i></p></a>
    
    <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo e(route('supplier.index')); ?>" class="nav-link <?php if(url()->current() == route('supplier.index')): ?> active <?php endif; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p><?php echo e(trans('file.Supplier List')); ?></p>
          </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo e(route('supplier.create')); ?>" class="nav-link <?php if(url()->current() == route('supplier.create')): ?> active <?php endif; ?>">
              <i class="far fa-circle nav-icon"></i>
              <p><?php echo e(trans('file.Add Supplier')); ?></p>
            </a>
          </li>

    </ul></li>
      

        

        <li  class="nav-item has-treeview <?php if(url()->current() ==route('user.index')|| url()->current() == route('user.create')): ?> active <?php endif; ?>" >
            <a href="#" class="nav-link <?php if(url()->current() ==route('user.index')|| url()->current() == route('user.create')): ?> active <?php endif; ?>">
            <i class="nav-icon fa fa-users"></i>
            <p><?php echo e(trans('file.User')); ?><i class="right fas fa-angle-left"></i></p></a>
            
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo e(route('user.index')); ?>" class="nav-link <?php if(url()->current() == route('user.index')): ?> active <?php endif; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo e(trans('file.User List')); ?></p>
                  </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('user.create')); ?>" class="nav-link <?php if(url()->current() == route('user.create')): ?>active <?php endif; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo e(trans('file.Add User')); ?></p>
                    </a>
                  </li>



    </ul><li>


        

    <?php }?>



</ul>
</li>
        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
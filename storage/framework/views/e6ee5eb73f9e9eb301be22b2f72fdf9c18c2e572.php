<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        
        
        <div class="pcoded-navigatio-lavel" >Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li  <?php if(url()->current() == url('/')): ?> class="active" <?php endif; ?> >
                <a href="<?php echo e(url('/')); ?>">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" ><?php echo e(__('file.dashboard')); ?></span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li><a href="<?php echo e(url("create_order")); ?>"> <span class="pcoded-micon"><i class="dripicons-basket"></i></span><?php echo e(__('file.Create Order/Booking')); ?></a></li>




<?php if(Auth::user()->role_id==1  || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7   ){  ?>
 <li class="pcoded-hasmenu <?php if(url()->current() == url('/category') || url()->current() == url('/products') || url()->current() == url('/products/create')): ?> pcoded-trigger active  <?php endif; ?>">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext"><?php echo e(__('file.product')); ?></span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li  <?php if(url()->current() == url('/category')): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo e(route('category.index')); ?>">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" ><?php echo e(__('file.category')); ?></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                

                  <li <?php if(url()->current() == url('/products')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('products.index')); ?>">
                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                        <span class="pcoded-mtext" ><?php echo e(__('file.product_list')); ?></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                                  <li <?php if(url()->current() == url('/products/create')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(route('products.create')); ?>">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" ><?php echo e(__('file.add_product')); ?></span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
                  

        <?php } if(Auth::user()->role_id==1){  ?>




 <li class="pcoded-hasmenu <?php if(url()->current() == url('/sales')||url()->current() == url('/sales/create')  ): ?> pcoded-trigger active  <?php endif; ?>">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="dripicons-cart"></i></span>
        <span class="pcoded-mtext"><?php echo e(trans('file.Sale')); ?></span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  <?php if(url()->current() == url('/sales')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('sales.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Sale List')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>




        <li  <?php if(url()->current() == url('/sales/create')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('sales.create')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Add Sale')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
      
    


    </ul>
</li>
        

<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==6 || Auth::user()->role_id==7 ){  ?>




<li class="pcoded-hasmenu  <?php if(url()->current() == route('customer.index')|| url()->current() == route('customer.create')|| url()->current() == route('customer_group.index') ): ?>pcoded-trigger active  <?php endif; ?>">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
        <span class="pcoded-mtext"><?php echo e(trans('file.customer')); ?></span>
        <span class="pcoded-mcaret"></span>
    </a>

    <ul class="pcoded-submenu">
        
        <li  <?php if(url()->current() == route('customer.index') ): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('customer.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Customer List')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li  <?php if(url()->current() == route('customer.create')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('customer.create')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Add Customer')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>


        <li  <?php if(url()->current() == route('customer_group.index')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('customer_group.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Customer Group')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>




     
    </ul></li>

<?php } if(Auth::user()->role_id==1 || Auth::user()->role_id==2  || Auth::user()->role_id==7){  ?>


    



<li class="pcoded-hasmenu  <?php if(url()->current() == url('/purchases') ||url()->current() == url('/purchases/create')|| url()->current() == url('purchases/purchase_by_csv') || url()->current() == url('report/daily_purchase/'.date('Y').'/'.date('m'))|| url()->current() == url('report/monthly_purchase/'.date('Y')) ): ?>pcoded-trigger active  <?php endif; ?>">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="dripicons-card"></i></span>
        <span class="pcoded-mtext"><?php echo e(trans('file.Purchase')); ?></span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  <?php if(url()->current() == url('/purchases') ): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('purchases.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Purchase List')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>





        <li  <?php if(url()->current() == url('/purchases/create')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('purchases.create')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Add Purchase')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>


    </ul>
</li> 





<li class="pcoded-hasmenu  <?php if(url()->current() == route('supplier.index') || url()->current() == route('supplier.create') ): ?>pcoded-trigger active  <?php endif; ?>">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-industry" aria-hidden="true"></i></span>
        <span class="pcoded-mtext"><?php echo e(trans('file.Supplier')); ?></span>
        <span class="pcoded-mcaret"></span>
    </a>
    <ul class="pcoded-submenu">
        <li  <?php if(url()->current() == route('supplier.index')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('supplier.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Supplier List')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        <li  <?php if(url()->current() == route('supplier.create')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('supplier.create')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.Add Supplier')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>

    </ul></li>
      

        

<li class="pcoded-hasmenu  <?php if(url()->current() ==route('user.index')|| url()->current() == route('user.create') ): ?>pcoded-trigger active  <?php endif; ?>">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="fa fa-users" aria-hidden="true"></i></span>
        <span class="pcoded-mtext"><?php echo e(trans('file.User')); ?></span>
        <span class="pcoded-mcaret"></span>
    </a>

    <ul class="pcoded-submenu">
        <li  <?php if(url()->current() == route('user.index')): ?> class="active" <?php endif; ?> >
            <a href="<?php echo e(route('user.index')); ?>">
                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                <span class="pcoded-mtext" ><?php echo e(trans('file.User List')); ?></span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>


    <li  <?php if(url()->current() == route('user.create')): ?> class="active" <?php endif; ?> >
        <a href="<?php echo e(route('user.create')); ?>">
            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
            <span class="pcoded-mtext" ><?php echo e(trans('file.Add User')); ?></span>
            <span class="pcoded-mcaret"></span>
        </a>
    </li>

    </ul><li>


        

    <?php }?>



</ul>
</li>
        </ul>

    </div>
</nav>
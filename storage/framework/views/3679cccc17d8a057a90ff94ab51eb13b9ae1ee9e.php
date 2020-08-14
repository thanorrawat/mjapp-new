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
            <a href="<?php echo e(url('/')); ?>">
                <?php if($general_setting->site_logo): ?>
                <img class="img-fluid" src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" alt="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>"  height="30"/>
                <?php endif; ?>
                <span class="logotext"><?php echo e($general_setting->site_title); ?></span>
                
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
                
                <li>
                    <a href="#" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                
                <li class="dropdown">
                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php if(app()->getLocale()=="th"): ?>
                        ภาษาไทย
                                <?php elseif(app()->getLocale()=="en"): ?>
                        English
                                <?php endif; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li> <a href="<?php echo e(url('language_switch/en')); ?>" class="btn btn-link"> English</a></li>
                      <li><a href="<?php echo e(url('language_switch/th')); ?>" class="btn btn-link"> ภาษาไทย</a></li>
           
                    </ul>
                  </li>
                  <li id="topcart" class="header-notification" >
                 
                </li>
                <li class="header-notification">
                    <a href="#"  onclick="return false;">
                        <i class="ti-bell"></i>
                        <?php if($alert_product > 0): ?>  <span class="badge bg-c-pink"></span>  <?php endif; ?>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger">New</label>
                        </li>
                        
                        <?php if($alert_product > 0): ?>
                        <li>
                            <a href="<?php echo e(route('report.qtyAlert')); ?>" class="btn btn-link"> <?php echo e($alert_product); ?> product exceeds alert quantity</a>

                        </li>
                        <?php endif; ?>
                        
          
                    </ul>
                </li>
                
                <li class="user-profile header-notification">
                    <a href="javascript:void(0)" >
                        <?php if(!empty(Auth::user()->image)): ?>
                        <img src="<?php echo e(url("public/images/users",Auth::user()->image)); ?>" class="img-radius wid-40" alt="User-Profile-Image" height="40" >
                        <?php endif; ?>
                        
                        <span>
                            <?php if(!empty(Auth::user()->fullname)): ?>
                            <?php echo e(ucfirst(Auth::user()->fullname)); ?>

                            <?php else: ?>
                            <?php echo e(ucfirst(Auth::user()->name)); ?>  
                            <?php endif; ?>
                            </span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">




                        <li> 
                            <a href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><i class="ti-user"></i> <?php echo e(trans('file.profile')); ?></a>
                          </li>
                          
                          
                
                          <li>
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="ti-layout-sidebar-left"></i>
                                <?php echo e(trans('file.logout')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                          </li>






                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
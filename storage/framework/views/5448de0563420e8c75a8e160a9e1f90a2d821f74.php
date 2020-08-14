<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul> 

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-language"></i>
            <?php if(app()->getLocale()=="th"): ?>
            ภาษาไทย
                    <?php elseif(app()->getLocale()=="en"): ?>
            English
                    <?php endif; ?> <i class="fas fa-caret-down"></i></a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <li> <a href="<?php echo e(url('language_switch/en')); ?>" class="dropdown-item"> English</a></li>
          <li><a href="<?php echo e(url('language_switch/th')); ?>" class="dropdown-item"> ภาษาไทย</a></li>

        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
                        <?php if(!empty(Auth::user()->image)): ?>
                        <img src="<?php echo e(url("public/images/users",Auth::user()->image)); ?>" class="img-circle elevation-2 " alt="User-Profile-Image" height="30" width="30" >
                        <?php endif; ?>
                        
                        <span>
                            <?php if(!empty(Auth::user()->fullname)): ?>
                            <?php echo e(ucfirst(Auth::user()->fullname)); ?>

                            <?php else: ?>
                            <?php echo e(ucfirst(Auth::user()->name)); ?>  
                            <?php endif; ?>
                            </span>
                            <i class="fas fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">




                        <li> 
                            <a class="dropdown-item" href="<?php echo e(route('user.profile', ['id' => Auth::id()])); ?>"><i class="ti-user"></i> <?php echo e(trans('file.profile')); ?></a>
                          </li>
           
                
                          <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
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
  </nav>

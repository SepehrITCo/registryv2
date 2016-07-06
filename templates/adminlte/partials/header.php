  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo IW_ROOT; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php echo config("PAGE.MOBILE.LOGO"); ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo config("PAGE.LOGO"); ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php P("TEMPLATE.TOGGLE_NAV"); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
			<?php require "message.notification".php; ?>
         
			<?php require "notification".php; ?>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php 
						if(file_exists(Files.DS."profile".DS.$user->id.".jpg")){
							echo IW_ROOT.DS."files".DS."profile".DS.$user->id.".jpg";
						}else{
							echo IW_ROOT.DS."files".DS."profile".DS."default.jpg";
						}
						?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user->name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php 
						if(file_exists(Files.DS."profile".DS.$user->id.".jpg")){
							echo IW_ROOT.DS."files".DS."profile".DS.$user->id.".jpg";
						}else{
							echo IW_ROOT.DS."files".DS."profile".DS."default.jpg";
						}
						?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user->name; ?>
                  <small>
				  <?php 
					echo T("USERS.MEMBER_SINCE");
					echo Date::forge($user->created_at)->ago();
				  ?>
				  </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo route("users/profile"); ?>" class="btn btn-default btn-flat"><?php P("USERS.PROFILE"); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo route("logout"); ?>" class="btn btn-default btn-flat"><?php P("USERS.SIGN_OUT"); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
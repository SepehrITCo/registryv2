  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php 
						if(file_exists(Files.DS."profile".DS.$user->id.".jpg")){
							echo IW_ROOT.DS."files".DS."profile".DS.$user->id.".jpg";
						}else{
							echo IW_ROOT.DS."files".DS."profile".DS."default.jpg";
						}
						?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user->name; ?></p>
          <a href="<?php echo route("users/profile"); ?>"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="<?php route("search"); ?>" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="<?php P("TEMPLATE.SEARCH_PLACE_HOLDER"); ?>">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
	<?php 
	
	IW::Lib("Modules");
    $menu = Modules::getModule("mod_menu",["menu_id"=>1,"render"=>__DIR__.DS."sidemenu.render".php]);
    echo $menu->getView();

	?>
    </section>
    <!-- /.sidebar -->
  </aside>
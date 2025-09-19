<?php $general = new BasicFunctions(); ?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Welcome <?php echo ucwords($session['name']); ?></h2>
         </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Popular Sections <b></b>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-red set-icon">
                  <i class="fa fa fa-users"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php echo $this->Url->build('/admins/users/users'); ?>"><p class="main-text">Users</p></a>
            <p class="text-muted">All the registered users</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-image"></i>
                  </span>
                  <div class="text-box" >
            <a href="<?php echo $this->Url->build('/admins/ecommerce/products'); ?>"><p class="main-text">Videos</p></a>
            <p class="text-muted"><?php echo $general->countAllProduct(); ?> Videos</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-list"></i>
                  </span>
                  <div class="text-box" >
            <a href="<?php echo $this->Url->build('/admins/ecommerce/orders'); ?>"><p class="main-text">Subscriptions</p></a>
            <p class="text-muted">All the subscription entries.</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-red set-icon">
                  <i class="fa fa-picture-o"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php echo $this->Url->build('/admins/banners/banners'); ?>"><p class="main-text">Banners</p></a>
            <p class="text-muted"> Homepage Banners</p>
            </div>
            </div>
            </a>
         </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Global Section Management <b></b>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa fa-cog"></i>
                  </span>
                  <div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/drop-downs/inner-pages'); ?>"><p class="main-text">Inner Pages</p></a>
                    <p class="text-muted">Inner Pages</p>
				</div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-bars"></i>
                  </span>
                  <div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/drop-downs/packages'); ?>"><p class="main-text">Packages</p></a>
                    <p class="text-muted">Packages</p>
            	</div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               	<div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-question-circle"></i>
                  </span>
                  	<div class="text-box">
                        <a href="<?php echo $this->Url->build('/admins/drop-downs/help-centers'); ?>"><p class="main-text">Help Centers</p></a>
                        <p class="text-muted">Help Centers</p>
                    </div>
            	</div>
            </a>
         </div>
         <?php if($session['type'] == 'Admin'){ ?>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               	<div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-users"></i>
                  </span>
                  	<div class="text-box">
                        <a href="<?php echo $this->Url->build('/admins/users/sub-admins'); ?>"><p class="main-text">Sub Admins</p></a>
                        <p class="text-muted">Sub Admins</p>
                    </div>
            	</div>
            </a>
         </div>
         <?php } ?>
      </div>
      
      <!-- /. ROW  -->
      <hr />
      <!--
      <div class="row">

         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Location Management <b></b>
            </div>
         </div>

      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-globe"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php //echo $this->Url->build('/admins/locations/countries'); ?>"><p class="main-text">Countries</p></a>
            <p class="text-muted"><?php //echo $general->countAllCountry(); ?> Countries</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-globe"></i>
                  </span>
                  <div class="text-box" >
            <a href="<?php //echo $this->Url->build('/admins/locations/states'); ?>"><p class="main-text">States</p></a>
            <p class="text-muted"><?php //echo $general->countAllState(); ?> States</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-globe"></i>
                  </span>
                  <div class="text-box" >
            <a href="<?php //echo $this->Url->build('/admins/locations/cities'); ?>"><p class="main-text">Cities</p></a>
            <p class="text-muted"><?php //echo $general->countAllCity(); ?> Cities</p>
            </div>
            </div>
            </a>
         </div>
      </div>
    -->
      <!-- /. ROW  -->
      <hr />
      <!-- /. ROW  -->
      <div class="row">
         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Categories Management <b></b>
            </div>
         </div>
      </div>
      <div class="row">
         <?php /*?><div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-users"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php echo $this->Url->build('/admins/drop-downs/members'); ?>"><p class="main-text">Our Team</p></a>
            <p class="text-muted"><?php echo $general->countAllCategory(); ?></p>
            </div>
            </div>
            </a>
         </div><?php */?>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-list-alt"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php echo $this->Url->build('/admins/ecommerce/categories'); ?>"><p class="main-text">Categories</p></a>
            <p class="text-muted"><?php echo $general->countAllCategory(); ?> Categories</p>
            </div>
            </div>
            </a>
         </div>
         
         
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-blue set-icon">
                  <i class="fa fa-film"></i>
                  </span>
                  <div class="text-box" >
                    <a href="<?php echo $this->Url->build('/admins/ecommerce/generes'); ?>"><p class="main-text">Generes</p></a>
                    <p class="text-muted">Generes</p>
                  </div>
               </div>
            </a>
         </div>
      </div>
      </hr>

      <!-- /. ROW  -->
      <div class="row">
         <!-- Welcome -->
         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Coupon Codes & Newsletter management<b></b>
            </div>
         </div>
         <!--end  Welcome -->
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-picture-o"></i>
                  </span>
                  	<div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/coupon-codes/index'); ?>"><p class="main-text">Coupon Codes</p></a>
                    <p class="text-muted">Coupon Codes</p>
                	</div>
            	</div>
            </a>
         </div>
         
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-envelope"></i>
                  </span>
                  	<div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/ecommerce/newsletters'); ?>"><p class="main-text">Newsletter Users</p></a>
                    <p class="text-muted">Registered users for newsletter</p>
                	</div>
            	</div>
            </a>
         </div>
         
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-envelope"></i>
                  </span>
                  	<div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/ecommerce/newsletter-email'); ?>"><p class="main-text">Newsletter Email Template</p></a>
                    <p class="text-muted">Newsletter Email Template</p>
                	</div>
            	</div>
            </a>
         </div>
         
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-envelope"></i>
                  </span>
                  	<div class="text-box">
                    <a href="<?php echo $this->Url->build('/admins/ecommerce/newsletter-footer'); ?>"><p class="main-text">Newsletter Footer</p></a>
                    <p class="text-muted">Newsletter Footer</p>
                	</div>
            	</div>
            </a>
         </div>
         
      </div>
      
      <div class="row">
         <!-- Welcome -->
         <div class="col-lg-12">
            <div class="alert alert-info">
               <i class="fa fa-folder-open"></i><b>&nbsp; </b>Header and Footer Navigation<b></b>
            </div>
         </div>
         <!--end  Welcome -->
      </div>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               <div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-red set-icon">
                  <i class="fa fa-picture-o"></i>
                  </span>
                  <div class="text-box">
            <a href="<?php echo $this->Url->build('/admins/banners/footer-apps'); ?>"><p class="main-text">Footer Apps</p></a>
            <p class="text-muted">Footer Apps</p>
            </div>
            </div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               	<div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-bars"></i>
                  </span>
                  	<div class="text-box">
                        <a href="<?php echo $this->Url->build('/admins/drop-downs/footer-navigations'); ?>"><p class="main-text">Footer Navigations</p></a>
                        <p class="text-muted">Footer Navigations</p>
                    </div>
            	</div>
            </a>
         </div>

         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               	<div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa fa-cog"></i>
                  </span>
                  	<div class="text-box">
                        <a href="<?php echo $this->Url->build('/admins/admins/footer'); ?>"><p class="main-text">Footer Content</p></a>
                        <p class="text-muted">Footer Content</p>
                    </div>
            	</div>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-6">
            <a href='#'>
               	<div class="panel panel-back noti-box">
                  <span class="icon-box bg-color-green set-icon">
                  <i class="fa fa-bars"></i>
                  </span>
                  	<div class="text-box">
                        <a href="<?php echo $this->Url->build('/admins/drop-downs/header-navigations'); ?>"><p class="main-text">Header Navigations</p></a>
                        <p class="text-muted">Header Navigations</p>
                    </div>
            	</div>
            </a>
         </div>
      </div>
      <!-- /. ROW  -->
      <hr />
   </div>
   <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->


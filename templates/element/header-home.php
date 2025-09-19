<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
<?php $session = $this->request->getSession(); 
$isSubscribed = 'No';

if($session->check('LoginUser.id')){

	$isSubscribed = $this->Setting->checkSubbscription($session->read('LoginUser.id'));

}
?>

<?php $action = $this->request->getParam('action');?>

<?php if($action == 'index' || $action == 'movies' || $action == 'show' || $action == 'musicVideos' || $action == 'movieDetails' || $action == 'classic' || $action == 'short' || $action == 'feature' || $action == 'liveTv'){?>

<header id="sticky-header" class="main-header sticky-header">

<?php }else{ ?>

<header id="" class="main-header fixed-top">

<?php } ?>

			<span class="header_gradient"></span>

			<div class="top-header">

				<div class="container-fluid">

					<a href="" data-toggle="modal" data-target="#languageModal" class="languages">

						<img src="<?php echo $this->Url->build('/img/language-selection-icon.svg'); ?>"> Languages</a>

					<a href="<?php echo $this->Url->build('/about-us/'); ?>">About us</a>

					<a href="mailto:info@cinemasthan.com"><img  src="<?php echo $this->Url->build('/img/header-support-mail.svg'); ?>"> info@cinemasthan.com</a>

				</div>

			</div>

			<!--main header conetnet-->

			<div class="main-header-content">

				<div class="container-fluid">

					<nav class="navbar navbar-expand-lg ">

						  <a class="navbar-brand" href="<?php echo $this->Url->build('/'); ?>"><img src="<?php echo $this->Url->build('/img/logo.png'); ?>" class="logo-img">

						  	<img src="<?php echo $this->Url->build('/img/mobile_logo.png'); ?>" class="m-logo">

						  </a>

						  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">

						    <span class="navbar-toggler-icon"></span>

						  </button>

						 <?php $headernavigations = $this->Setting->headerNavigations();?>

						  <div class="collapse navbar-collapse" id="navb">
                          
                          <?php if($session->check('LoginUser.id')){?>
                          
                            <div class="userprofile mobileView">
                            
                            <div class="dropdown show">
                            
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                            <span class="user-icon">
                            
                            <?php 
                            $userData = $this->User->getSingleRecord($session->read('LoginUser.id'));
                            if (!empty($userData->profile)) {
                            if (file_exists(WWW_ROOT . 'img/user/' . $userData->profile)) {
                            echo $this->Html->image('user/' . $userData->profile, ['alt' => $userData->profile, 'title' => $userData->profile, 'width' => '100']);
                            }else{
                            echo ucfirst(substr($userData->username,0,1));
                            }
                            }else{
                            echo ucfirst(substr($userData->username,0,1));
                            }
                            ?>
                            
                            </span>
                            
                            <span class="username"><?php echo ucfirst($userData->username)?></span>
                            
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            
                            <!--<a class="dropdown-item" href="#">My Wish List</a>-->
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/my-watch-list/'); ?>">My Watch List</a>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/my-wishlist/'); ?>">My Wishlist</a>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/my-account/'); ?>">My Account</a>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/help-center/'); ?>">Help & Support</a>
                            <?php if($userData->is_film_maker == 1){?>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/submit-your-film/'); ?>">Submit Your Film</a>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/my-films/'); ?>">My Submitted Films</a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo $this->Url->build('/logout/'); ?>">Sign Out</a>
                            
                            </div>
                            
                            </div>
                            
                            </div>
                                  																																																																																																																					
                          <?php } ?>        

						    <ul class="navbar-nav mr-auto">

							  <?php foreach($headernavigations as $key => $headernavigation){?>

						      <li class="nav-item <?php if($headernavigation->param == $action){echo 'active';}?>"><a class="nav-link " href="<?php echo $this->Url->build($headernavigation->link); ?>"><?php echo $headernavigation->title;?></a></li>

							  <?php } ?>
						    </ul>

						    <div class="desk_rt_menu">

							      <span style="cursor:pointer" onclick="window.location.href='<?php echo $this->Url->build('/search/'); ?>'" role="button" class="header-search">

							      		<img class="black_theme_img" tabindex="0" src="<?php echo $this->Url->build('/img/search-icon.svg'); ?>">

							      </span>
								  
								  <?php if($isSubscribed == 'No'){?>

							      <a class="pricing" href="<?php echo $this->Url->build('/pricing/'); ?>"><span>PRICING</span></a>
								  <?php } ?>

								  <?php if(!$session->check('LoginUser.id')){?>

							      <a class="sign_in" href="<?php echo $this->Url->build('/sign-in/'); ?>"> Sign in </a>

							      <a class="sign_up" href="<?php echo $this->Url->build('/sign-up/'); ?>"> Sign Up </a>

									<?php }else{ 

                                    $userData = $this->User->getSingleRecord($session->read('LoginUser.id'));

                                    ?>

                                  <div class="userprofile desktopView">

							      	<div class="dropdown show">

										  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

										  	<span class="user-icon">
											
                                            <?php 
											if (!empty($userData->profile)) {
												if (file_exists(WWW_ROOT . 'img/user/' . $userData->profile)) {
													echo $this->Html->image('user/' . $userData->profile, ['alt' => $userData->profile, 'title' => $userData->profile, 'width' => '100']);
												}else{
													echo ucfirst(substr($userData->username,0,1));
												}
											 }else{
												echo ucfirst(substr($userData->username,0,1));
											}
											?>
                                            
                                            </span>

										    <span class="username"><?php echo ucfirst($userData->username)?></span>

										  </a>

										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

										    <!--<a class="dropdown-item" href="#">My Wish List</a>-->

										    <a class="dropdown-item" href="<?php echo $this->Url->build('/my-watch-list/'); ?>">My Watch List</a>
											<a class="dropdown-item" href="<?php echo $this->Url->build('/my-wishlist/'); ?>">My Wishlist</a>
										    <a class="dropdown-item" href="<?php echo $this->Url->build('/my-account/'); ?>">My Account</a>
										    <a class="dropdown-item" href="<?php echo $this->Url->build('/help-center/'); ?>">Help & Support</a>
                                            <?php if($userData->is_film_maker == 1){?>
                                            <a class="dropdown-item" href="<?php echo $this->Url->build('/submit-your-film/'); ?>">Submit Your Film</a>
                                            <a class="dropdown-item" href="<?php echo $this->Url->build('/my-films/'); ?>">My Submitted Films</a>
                                            <?php } ?>
										    <a class="dropdown-item" href="<?php echo $this->Url->build('/logout/'); ?>">Sign Out</a>

										  </div>

										</div>

							      </div>

                                  <?php } ?>

						 	</div>

						  </div>

						</nav>

				   </div>

				</div>

		</header>
        
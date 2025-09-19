<?php $session = $this->request->getSession(); ?>

<div _ngcontent-fce-c55="" class="ott-sticky-header header-transparent"><span _ngcontent-fce-c55="" class="header_gradient ng-star-inserted"></span><!---->

        <ott-main-header _ngcontent-fce-c55="" _nghost-fce-c53="">

          <div _ngcontent-fce-c53="" class="ott-header">

            <div _ngcontent-fce-c53="" class="top_header">

              <div _ngcontent-fce-c53="" class="container-fluid">

              <a _ngcontent-fce-c53="" class="languages"><img _ngcontent-fce-c53="" src="<?php echo $this->Url->build('/img/language-selection-icon.svg'); ?>"> Languages</a>

              <a _ngcontent-fce-c53="" href="<?php echo $this->Url->build('/about-us/'); ?>">About us</a>

              <a _ngcontent-fce-c53="" href="3"><img _ngcontent-fce-c53="" src="<?php echo $this->Url->build('/img/header-support-mail.svg'); ?>"> support@cinemasthan.com</a>

              </div>

            </div>

            <!---->

            <div _ngcontent-fce-c53="" class="header-top-mobile">

              

              <div _ngcontent-fce-c53="" class="header-top-right"><span _ngcontent-fce-c53="" class="ott-header-search"><img _ngcontent-fce-c53="" routerlink="/custom-search" class="mobile_search black_theme_img" tabindex="0" src="<?php echo $this->Url->build('/img/search.png'); ?>"></span></div>

            </div>

            <div _ngcontent-fce-c53="" class="container-fluid header_nav_cont">

              <div _ngcontent-fce-c53="" class="desktop_header">

                <div _ngcontent-fce-c53="" class="header_logo"><a href="<?php echo $this->Url->build('/'); ?>"><img _ngcontent-fce-c53="" role="button" class="logo_with_tag" tabindex="0" src="<?php echo $this->Url->build('/img/logo.png'); ?>"></a></div>

                <div _ngcontent-fce-c53="" class="header_nav">

                  <ul _ngcontent-fce-c53="" class="nav navbar-nav">

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="home_tv_menu ott-link-active" href="#">Home</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="movies_menu" href="#">Movies</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="music_videos_menu" href="#">Music Videos</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="Series_menu" href="#">Series</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="shows_menu" href="#">SHOWS</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="live_tv_menu" href="#">Live TV</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="drama_menu" href="#">DRAMA</a></li>

                    <li _ngcontent-fce-c53=""><a _ngcontent-fce-c53="" class="feature_menu" href="#">FEATURE</a></li>

                  </ul>

                </div>

                <div _ngcontent-fce-c53="" class="desk_rt_menu">

                <span _ngcontent-fce-c53="" role="button" class="ott-header-search">

                <img _ngcontent-fce-c53="" routerlink="/custom-search" class="black_theme_img" tabindex="0" src="<?php echo $this->Url->build('/img/search-icon.svg'); ?>">

                </span>

                <a _ngcontent-fce-c53="" href="<?php echo $this->Url->build('/pricing/'); ?>" class="pricing"><span _ngcontent-fce-c53="">PRICING</span></a>
                
				<?php if(!$session->check('LoginUser.id')){?>
                <a _ngcontent-fce-c53="" class="sign_in" href="<?php echo $this->Url->build('/sign-in/'); ?>"> Sign in </a>
                <a _ngcontent-fce-c53="" class="sign_up" href="<?php echo $this->Url->build('/sign-up/'); ?>"> Sign Up </a>
				<?php }else{ 
				$userData = $this->User->getSingleRecord($session->read('LoginUser.id'));
				?>
			    <a _ngcontent-fce-c53="" class="sign_in" ><?php echo ucfirst($userData->username)?> </a>
                <a _ngcontent-fce-c53="" class="sign_up" href="<?php echo $this->Url->build('/logout/'); ?>"> Logout </a>
				<?php } ?>
                
                </div>

              </div>

              <!----></div>

          </div>

          </ott-main-header>

      </div>
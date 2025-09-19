<?php $session = $this->request->getSession(); ?>
<div _ngcontent-ytn-c55="" class="ott-sticky-header"><!---->

        <ott-main-header _ngcontent-ytn-c55="" _nghost-ytn-c53="">

          <div _ngcontent-ytn-c53="" class="ott-header">

            <div _ngcontent-ytn-c53="" class="top_header">

              <div _ngcontent-ytn-c53="" class="container-fluid"><a _ngcontent-ytn-c53="" class="languages">
              <img _ngcontent-ytn-c53="" src="<?php echo $this->Url->build('/img/language-selection-icon.svg'); ?>"> Languages</a><a _ngcontent-ytn-c53="" href="<?php echo $this->Url->build('/about-us/'); ?>">About us</a><a _ngcontent-ytn-c53="" href="#"><img _ngcontent-ytn-c53="" src="<?php echo $this->Url->build('/img/header-support-mail.svg'); ?>"> support@cinemasthan.com</a></div>

            </div>

            <!---->

            <div _ngcontent-ytn-c53="" class="header-top-mobile">

              <div _ngcontent-ytn-c53="" class="mega_menu_nav"><span _ngcontent-ytn-c53="" class="bar"></span><span _ngcontent-ytn-c53="" class="bar"></span><span _ngcontent-ytn-c53="" class="bar"></span></div>

             

              <div _ngcontent-ytn-c53="" class="header-top-right"><span _ngcontent-ytn-c53="" class="ott-header-search">

              <img _ngcontent-ytn-c53="" routerlink="/custom-search" class="mobile_search black_theme_img" tabindex="0" src="<?php echo $this->Url->build('/img/search.png'); ?>"></span></div>

            </div>

            

            <!---->

            <div _ngcontent-ytn-c53="" class="container-fluid header_nav_cont">

              <div _ngcontent-ytn-c53="" class="desktop_header">

                <div _ngcontent-ytn-c53="" class="header_logo"><a href="<?php echo $this->Url->build('/'); ?>"><img _ngcontent-ytn-c53="" role="button" class="logo_with_tag" tabindex="0" src="<?php echo $this->Url->build('/img/logo.png'); ?>"></a></div>
				<?php $headernavigations = $this->Setting->headerNavigations();?>
                <div _ngcontent-ytn-c53="" class="header_nav">

                  <ul _ngcontent-ytn-c53="" class="nav navbar-nav">
                  <?php foreach($headernavigations as $key => $headernavigation){?>
                    <li _ngcontent-ytn-c53=""><a _ngcontent-ytn-c53="" class="home_tv_menu" href="<?php echo $this->Url->build($headernavigation->link); ?>"><?php echo $headernavigation->title;?></a></li>
					<?php } ?>

                  </ul>

                </div>

                <div _ngcontent-ytn-c53="" class="desk_rt_menu">

                <span _ngcontent-ytn-c53="" role="button" class="ott-header-search">

                <img _ngcontent-ytn-c53="" routerlink="/custom-search" class="black_theme_img" tabindex="0" src="<?php echo $this->Url->build('/img/search-icon.svg'); ?>">

                </span>

                <a _ngcontent-ytn-c53="" href="<?php echo $this->Url->build('/pricing/'); ?>" class="pricing"><span _ngcontent-ytn-c53="">PRICING</span></a>
                
                <?php if(!$session->check('LoginUser.id')){?>
                 <a _ngcontent-ytn-c53="" class="sign_in" href="<?php echo $this->Url->build('/sign-in/'); ?>"> Sign in </a>
                <a _ngcontent-ytn-c53="" class="sign_up" href="<?php echo $this->Url->build('/sign-up/'); ?>"> Sign Up </a>
				<?php }else{ 
				$userData = $this->User->getSingleRecord($session->read('LoginUser.id'));
				?>
			    <a _ngcontent-ytn-c53="" class="sign_in" ><?php echo ucfirst($userData->username)?> </a>
                <a _ngcontent-ytn-c53="" class="sign_up" href="<?php echo $this->Url->build('/logout/'); ?>"> Logout </a>
				<?php } ?>

               
                
                </div>

              </div>

              <!----></div>

          </div>

          <!----><!----></ott-main-header>

      </div>
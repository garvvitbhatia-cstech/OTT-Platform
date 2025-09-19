<?php $content = $this->Media->getFooterContent();?>
<app-footer _ngcontent-ytn-c55="" _nghost-ytn-c54="">
<?php $footerHeading = $this->Setting->getSetting('footer_heading');?>
<?php $footerSubHeading = $this->Setting->getSetting('footer_subheading');?>

        <div _ngcontent-ytn-c54="" class="footer">

          <div _ngcontent-ytn-c54="" class="col-md-6 dev_img"><img _ngcontent-ytn-c54="" class="img-responsive" src="<?php echo $this->Url->build('/img/ad.jpg'); ?>"><!----></div>

          <div _ngcontent-ytn-c54="" class="col-md-6 dev_info">
			
            <?php if($footerHeading != ""){echo '<h1 _ngcontent-ytn-c54="">'.$footerHeading.'</h1>';}?>
            <?php if($footerSubHeading != ""){echo '<p _ngcontent-ytn-c54="">'.nl2br($footerSubHeading).'</p>';}?>
           

            <div _ngcontent-ytn-c54="" class="sup_ap_bl"><span _ngcontent-ytn-c54="">TV app</span>

              <ul _ngcontent-ytn-c54="">

                <li _ngcontent-ytn-c54="" class="android"><a _ngcontent-ytn-c54="" target="_blank" href="#"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/multi-device-android-tv.png'); ?>"></a></li>

                <li _ngcontent-ytn-c54="" class="amazon"><a _ngcontent-ytn-c54="" target="_blank" href="#"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/multi-device-fire-tv.png'); ?>"></a></li>

                <li _ngcontent-ytn-c54="" class="roku"><a _ngcontent-ytn-c54="" target="_blank" href="#"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/roku-tv.png'); ?>"></a></li>

              </ul>

            </div>

            <div _ngcontent-ytn-c54="" class="sup_ap_bl sup_ap_bl_bottom"><span _ngcontent-ytn-c54="">Mobile app</span>

              <ul _ngcontent-ytn-c54="">

                <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="#"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/multi-device-ios-2.png'); ?>" class="img-responsive yupptv-white-app-image-auto"></a></li>

                <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="#"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/multi-device-android-mobile.png'); ?>" class="img-responsive yupptv-white-app-image-auto"></a></li>

              </ul>

            </div>

          </div>

        </div>
		<?php $footernavigations = $this->Setting->footerNavigations();?>
        <div _ngcontent-ytn-c54="" class="social_footer">

          <ul _ngcontent-ytn-c54=""><?php foreach($footernavigations as $key => $footernavigation){?>            <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" href="<?php echo $this->Url->build($footernavigation->link); ?>"><?php echo $footernavigation->title;?></a></li>			<?php } ?>

          </ul>
          
          <?php $copyright = $this->Setting->getSetting('footer_content');?>
<?php if($copyright != ""){?>
          <ul style="margin-left:6%;" _ngcontent-ytn-c54="">
            <li style="color:#FFF; font-size:12px;" _ngcontent-ytn-c54=""><?php echo $copyright;?></li>			

          </ul>
          <?php } ?>

          <div _ngcontent-ytn-c54="" class="sup_ap_bl sup_ap_bl_bottom share_cont">

           
            <?php if($content->facebook != '' || $content->instagram != '' || $content->twitter != '' || $content->linkedin != '' || $content->youtube != ''){ ?>
            <ul _ngcontent-ytn-c54="" class="sharing">

              <span _ngcontent-ytn-c54="">Connect with us:</span>
			  <?php if($content->facebook != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->facebook; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-facebook-follow.svg'); ?>"></a></li>
<?php }if($content->instagram != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->instagram; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-instagram-follow.svg'); ?>"></a></li>
<?php }if($content->twitter != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->twitter; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-twitter-follow.svg'); ?>"></a></li>
<?php }if($content->linkedin != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" href="<?php echo $content->linkedin; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-linkedin-follow.svg'); ?>"></a></li>
<?php }if($content->youtube != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->youtube; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-youtube-follow.svg'); ?>"></a></li>
<?php } ?>
            </ul>
			<?php } ?>

          </div>

        </div>

      </app-footer>
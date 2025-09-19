<app-footer _ngcontent-fce-c55="" _nghost-fce-c54="">
<?php $footerHeading = $this->Setting->getSetting('footer_heading');?>
<?php $footerSubHeading = $this->Setting->getSetting('footer_subheading');?>

        <div _ngcontent-fce-c54="" class="footer">

          <div _ngcontent-fce-c54="" class="col-md-6 dev_img"><img _ngcontent-fce-c54="" class="img-responsive" src="<?php echo $this->Url->build('/img/ad.jpg'); ?>"><!----></div>

          <div _ngcontent-fce-c54="" class="col-md-6 dev_info">

            <?php if($footerHeading != ""){echo '<h1 _ngcontent-ytn-c54="">'.$footerHeading.'</h1>';}?>
            <?php if($footerSubHeading != ""){echo '<p _ngcontent-ytn-c54="">'.nl2br($footerSubHeading).'</p>';}?>

            <div _ngcontent-fce-c54="" class="sup_ap_bl"><span _ngcontent-fce-c54="">TV app</span>

              <ul _ngcontent-fce-c54="">

                <li _ngcontent-fce-c54="" class="android"><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/multi-device-android-tv.png'); ?>"></a></li>

                <li _ngcontent-fce-c54="" class="amazon"><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/multi-device-fire-tv.png'); ?>"></a></li>

                <li _ngcontent-fce-c54="" class="roku"><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/roku-tv.png'); ?>"></a></li>

              </ul>

            </div>

            <div _ngcontent-fce-c54="" class="sup_ap_bl sup_ap_bl_bottom"><span _ngcontent-fce-c54="">Mobile app</span>

              <ul _ngcontent-fce-c54="">

                <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/multi-device-ios-2.png'); ?>" class="img-responsive yupptv-white-app-image-auto"></a></li>

                <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/multi-device-android-mobile.png'); ?>" class="img-responsive yupptv-white-app-image-auto"></a></li>

              </ul>

            </div>

          </div>

        </div>
		<?php $footernavigations = $this->Setting->footerNavigations();?>
        <div _ngcontent-fce-c54="" class="social_footer">

          <ul _ngcontent-fce-c54="">
			<?php foreach($footernavigations as $key => $footernavigation){?>            <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" href="<?php echo $this->Url->build($footernavigation->link); ?>"><?php echo $footernavigation->title;?></a></li>			<?php } ?>

          </ul>

          <div _ngcontent-fce-c54="" class="sup_ap_bl sup_ap_bl_bottom share_cont">

            <ul _ngcontent-fce-c54="" class="sharing">

              <span _ngcontent-fce-c54="">Connect with us :</span>

              <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/reeldrama-facebook-follow.svg'); ?>"></a></li>

              <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/reeldrama-instagram-follow.svg'); ?>"></a></li>

              <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/reeldrama-twitter-follow.svg'); ?>"></a></li>

              <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/reeldrama-linkedin-follow.svg'); ?>"></a></li>

              <li _ngcontent-fce-c54=""><a _ngcontent-fce-c54="" target="_blank" href="#"><img _ngcontent-fce-c54="" src="<?php echo $this->Url->build('/img/reeldrama-youtube-follow.svg'); ?>"></a></li>

            </ul>

          </div>

        </div>

      </app-footer>
<?php $content = $this->Media->getFooterContent();?>
<app-footer _ngcontent-ytn-c55="" _nghost-ytn-c54="">		<?php $footernavigations = $this->Setting->footerNavigations();?>
        <div _ngcontent-ytn-c54="" class="social_footer">

          <ul _ngcontent-ytn-c54="">
			<?php foreach($footernavigations as $key => $footernavigation){?>
            <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" href="<?php echo $this->Url->build($footernavigation->link); ?>"><?php echo $footernavigation->title;?></a></li>			<?php } ?>

          </ul>
          

          <div _ngcontent-ytn-c54="" class="sup_ap_bl sup_ap_bl_bottom share_cont">
			<?php if($content->facebook != '' || $content->instagram != '' || $content->twitter != '' || $content->linkedin != '' || $content->youtube != ''){ ?>
            <ul _ngcontent-ytn-c54="" class="sharing">

              <span _ngcontent-ytn-c54="">Connect with us:</span>
			  <?php if($content->facebook != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->facebook; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-facebook-follow.svg'); ?>"></a></li>
<?php }if($content->instagram != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->instagram; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-instagram-follow.svg'); ?>"></a></li>
<?php }if($content->twitter != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" hre													f="<?php echo $content->twitter; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-twitter-follow.svg'); ?>"></a></li>
<?php }if($content->linkedin != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" href="<?php echo $content->linkedin; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-linkedin-follow.svg'); ?>"></a></li>
<?php }if($content->youtube != ''){ ?>
              <li _ngcontent-ytn-c54=""><a _ngcontent-ytn-c54="" target="_blank" href="<?php echo $content->youtube; ?>"><img _ngcontent-ytn-c54="" src="<?php echo $this->Url->build('/img/reeldrama-youtube-follow.svg'); ?>"></a></li>
<?php } ?>
            </ul>
			<?php } ?>
          </div>
          
          <?php $copyright = $this->Setting->getSetting('footer_content');?>
<?php if($copyright != ""){?>
          <ul class="copyright_text" style="margin-left:6%; float:right" _ngcontent-ytn-c54="">
            <li style="color:#FFF; font-size:14px;" _ngcontent-ytn-c54=""><?php echo $copyright;?></li>			

          </ul>
          <?php } ?>

        </div>

      </app-footer>
      <style>
      @media(max-width: 992px){
		  .copyright_text{ float:none !important}
		 }
      </style>
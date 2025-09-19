<?php $content = $this->Media->getFooterContent();?>
<footer class="main-footer">
<div class="footer-top">
<div class="col-md-6 dev_img">
<?php if(file_exists(WWW_ROOT.'img/logo/'.$content->footer_logo) && !empty($content->footer_logo)){?>
    <img _ngcontent-oas-c58="" class="img-responsive" src="<?php echo $this->Url->build('/img/logo/'.$content->footer_logo); ?>">
<?php }else{?>	
    <img _ngcontent-oas-c58="" class="img-responsive" src="<?php echo $this->Url->build('/img/ad1.jpg'); ?>">
<?php }  ?>
</div>
<div class="col-md-6 dev_info">
<h1 ><?php echo $content->heading ?></h1>
<p><?php echo nl2br($content->sub_heading); ?></p>

<?php if($content->coming_soon_text!=""){?><p style="color: #ff0; margin-bottom:10px;"><?php echo $content->coming_soon_text; ?></p><?php } ?>


<?php $mobileApps = $this->Setting->getApplications('Mobile');?>
<?php if($mobileApps->count() > 0){?>
<div class="sup_ap_bl sup_ap_bl_bottom">
<span>Mobile app</span>
<ul >
<?php foreach($mobileApps as $key => $mobileApp){?>	
<li >
<a  href="<?php echo $mobileApp->url;?>">
<img src="<?php echo $this->Url->build('/img/banners/'.$mobileApp->icon); ?>" class="img-responsive yupptv-white-app-image-auto">
</a>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>

<?php $tvApps = $this->Setting->getApplications('TV');?>
<?php if($tvApps->count() > 0){?>
<div class="sup_ap_bl">
<span >TV app</span>
<ul >
<?php foreach($tvApps as $key => $tvApp){?>	
<li class="android">
<a href="<?php echo $tvApp->url;?>">
<img src="<?php echo $this->Url->build('/img/banners/'.$tvApp->icon); ?>">
</a>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>




</div>
</div>
<div style="background:#18182f">
<div class="col-md-12">
<div class="newsletter_div">
<div style="text-align:center">
	<span style="color:#ff0;">Sign Up Newsletter</span><br />
    <span style="font-size:12px; color:#999">Get updates by subscribe our Daily/Weekly/Monthly newsletter</span><br />
    <div id="newsResponse">
    <input type="text" class="newsletter_email" id="newsEmail" onkeyup="$('#newsEmailErrorMessage').html('');" placeholder="Your Email Address for Newsletter" />
    <input type="button" class="newsletter_btn" id="newsletter_btn" onclick="saveNewsletter();" value="SUBSCRIBE" /><br />
    <span id="newsEmailErrorMessage" style="color:#FCC"></span>
    </div>
    </div>
    </div>
    </div>
</div>
<div class="bottom_footer">
<?php $footernavigations = $this->Setting->footerNavigations();?>
<ul>
<?php foreach($footernavigations as $key => $footernavigation){?>	
<li><a href="<?php echo $this->Url->build($footernavigation->link); ?>"><?php echo $footernavigation->title;?></a></li>
<?php } ?>
</ul>

<a class="mobile_email" href="mailto:info@cinemasthan.com"><img src="<?php echo SITEURL; ?>img/header-support-mail.svg"> info@cinemasthan.com</a>

<a href="" style="margin: 10px 0;" data-toggle="modal" data-target="#languageModal" class="languages mobile_email"><img src="<?php echo SITEURL; ?>img/language-selection-icon.svg"> Languages</a>



<div class="sup_ap_bl sup_ap_bl_bottom share_cont">
<?php if($content->facebook != '' || $content->instagram != '' || $content->twitter != '' || $content->linkedin != '' || $content->youtube != ''){ ?>
<ul class="sharing">
<span >Connect with us:</span>
<?php if($content->facebook != ''){ ?>
<li><a target="_blank" href="<?php echo $content->facebook; ?>"><img src="<?php echo $this->Url->build('/img/reeldrama-facebook-follow.svg'); ?>"></a></li>
<?php }if($content->instagram != ''){ ?>
<li><a target="_blank" href="<?php echo $content->instagram; ?>"><img src="<?php echo $this->Url->build('/img/reeldrama-instagram-follow.svg'); ?>"></a></li>
<?php }if($content->twitter != ''){ ?>
<li><a target="_blank" href="<?php echo $content->twitter; ?>"><img src="<?php echo $this->Url->build('/img/reeldrama-twitter-follow.svg'); ?>"></a></li>
<?php }if($content->linkedin != ''){ ?>
<li><a target="_blank" href="<?php echo $content->linkedin; ?>"><img src="<?php echo $this->Url->build('/img/reeldrama-linkedin-follow.svg'); ?>"></a></li>
<?php }if($content->youtube != ''){ ?>
<li><a target="_blank" href="<?php echo $content->youtube; ?>"><img src="<?php echo $this->Url->build('/img/reeldrama-youtube-follow.svg'); ?>"></a></li>
<?php } ?>
</ul>
<?php } ?>
</div>


<?php $copyright = $this->Setting->getSetting('footer_content');?>
<?php if($copyright != ""){?>
<div class="clearfix"></div>
<ul class="copyright_text" style="display:block;width: 100%;">
<li style="color:#FFF; font-size:14px; margin:0px; width:100%; text-align:center;"><?php echo $copyright;?></li>
</ul>
<div class="clearfix"></div>
<?php } ?>

</div>
</footer>
<style>
.select-language[_ngcontent-prq-c56] li[_ngcontent-prq-c56] label[_ngcontent-prq-c56] {
    background-color: #2c2c70;
    padding: 12px 20px;
    width: 100%;
    color: #9ea2ac;
    border-radius: 2px;
    font-size: 14px;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 35%); cursor:pointer
}
.language-control[_ngcontent-prq-c56] input[_ngcontent-prq-c56]:checked ~ .language-control__indicator[_ngcontent-prq-c56] {
    background: #2a5bff;
    border: 2px solid #2a5bff;
}
.language-control__indicator[_ngcontent-prq-c56] {
    border: 2px solid #1d1d3e;
    position: absolute;
    top: 11px;
    right:25px;
    height: 22px;
    width: 22px;
    border-radius: 50px;
}
.language-control[_ngcontent-prq-c56] input[_ngcontent-prq-c56] {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    padding: 0;
}
.language-control--checkbox[_ngcontent-prq-c56] .language-control__indicator[_ngcontent-prq-c56]:after {
    left: 6px;
    top: 3px;
    width: 6px;
    height: 10px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(
45deg
);
    -webkit-transform: rotate(
45deg
);
}
.language-control__indicator[_ngcontent-prq-c56]:after {
    content: "";
    position: absolute;
    display: none;
}
.control[_ngcontent-prq-c56], .language-control[_ngcontent-prq-c56] input[_ngcontent-prq-c56]:checked ~ .language-control__indicator[_ngcontent-prq-c56]:after {
    display: block;
}
 .wish_sign_in{    
		background: #2c2c70;
    padding: 10px 20px; color:#FFF !important;
    margin: 20px;
    cursor: pointer;}
	.wish_sign_up{    
	background: #d99200; color:#FFF !important;
    padding: 10px 20px;
    margin: 20px;
    cursor: pointer;}
</style>
<?php $languages = $this->Setting->getLanguages();?>
<div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="background-color:#18182f;" class="modal-content">
      <div style="border-bottom:0px;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="<?php echo SITEURL; ?>img/lan-popup-close.png" />
        </button>
      </div>
      <div style="text-align:center; color:#FFF;" class="modal-body">
      
        <div _ngcontent-prq-c56="" class="main">
          <div _ngcontent-prq-c56="" class="modal-content">
            <div _ngcontent-prq-c56="" class="modal-content_inner">
              <h3 _ngcontent-prq-c56="">Choose your preferred languages</h3>
              <p _ngcontent-prq-c56=""> This will help us to suggest you relevant content </p>
              <br />
              <div _ngcontent-prq-c56="" class="select-language">
                <ul _ngcontent-prq-c56="" class="languages row">
                	<?php foreach($languages as $key => $language){?>
                  <li _ngcontent-prq-c56="" class="ng-scope col-lg-3 col-md-4 col-sm-4 col-xs-6 ng-star-inserted">
                    <label _ngcontent-prq-c56="" class="language-control language-control--checkbox active">
                    <div _ngcontent-prq-c56="" class="ng-binding"><?php echo ucwords($language->title);?></div>
                    <input _ngcontent-prq-c56="" type="checkbox" checked="checked" name="tagOptions" id="MAL">
                    <div _ngcontent-prq-c56="" class="language-control__indicator"></div>
                    </label>
                  </li>
                  <?php } ?>
                  <!---->
                </ul>
              </div>
            </div>
            
          </div>
        </div>
                
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal" aria-label="Close" class="wish_sign_in">Cancel</a>
        <a  data-dismiss="modal" aria-label="Close" class="wish_sign_up">Apply</a>
</div>
    </div>
  </div>
</div>
<style>
@media(max-width: 992px){
.copyright_text{ float:none !important}
}
</style>
<script>
function saveNewsletter(){
	
	var nitam = 1;
	var newsEmail = $('#newsEmail').val();
	if($.trim(newsEmail) == ''){
		$('#newsEmailErrorMessage').html('Please enter your email address');
		$('#newsEmail').focus(); return false;
	}else{
		var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!filter.test(newsEmail)){
			$('#newsEmailErrorMessage').html('Invalid email address');
			$('#newsEmail').focus(); return false;     
		}  
	}
	if(nitam == 1){
		$('#newsletter_btn').val('SAVING....');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->Url->build('/save-newsletter/'); ?>',
			data: {newsEmail:newsEmail},
			success: function(msg){
				$('#newsEmail').val('');
				$('#newsletter_btn').val('SUBSCRIBE');
				if(msg == 'Success'){
					$('#newsResponse').html('<span style="color: #093;">Your email address saved successfully for newsletter.</span>');
					setTimeout(function(){ $('#newsResponse').html('<input type="text" class="newsletter_email" id="newsEmail" placeholder="Your Email Address for Newsletter" /><input type="button" class="newsletter_btn" id="newsletter_btn" onclick="saveNewsletter();" value="SUBSCRIBE" />'); }, 5000);
				}else if(msg == 'Already'){
					$('#newsResponse').html('<span style="color: #F00;">Your email address already registered for newsletter.</span>');
					setTimeout(function(){ $('#newsResponse').html('<input type="text" class="newsletter_email" id="newsEmail" placeholder="Your Email Address for Newsletter" /><input type="button" class="newsletter_btn" id="newsletter_btn" onclick="saveNewsletter();" value="SUBSCRIBE" />'); }, 5000);
				}else{
					$('#newsResponse').html('<span style="color: #F00;">Error..! Try again later.</span>');
					setTimeout(function(){ $('#newsResponse').html('<input type="text" class="newsletter_email" id="newsEmail" placeholder="Your Email Address for Newsletter" /><input type="button" class="newsletter_btn" id="newsletter_btn" onclick="saveNewsletter();" value="SUBSCRIBE" />'); }, 5000);
				}
			}
	  	});
	}
}
</script>
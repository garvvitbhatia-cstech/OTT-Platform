<?php

if(isset($pageData->seo_title)){

    #set page meta content

    $this->assign('title', $pageData->seo_title);

    $this->assign('meta_keywords', $pageData->seo_keyword);

    $this->assign('meta_description', $pageData->seo_description);

    $this->assign('meta_robot', $pageData->robot_tags);

}

?>
<ott-app _nghost-ovl-c55="" ng-version="11.2.14">

  <div _ngcontent-ovl-c55="" class="ott-theme page_auth/signin ott-theme-no-header-footer page-scroll mobile-no-sub-menu">

    <div _ngcontent-ovl-c55="" id="content_body" class="content_body"><!---->

      <div _ngcontent-ovl-c55="" class="ott-main-body no-header">

        <router-outlet _ngcontent-ovl-c55=""></router-outlet>

        <ott-signin _nghost-ovl-c59="" class="ng-star-inserted">

          <div _ngcontent-ovl-c59="" id="signin_cont" class="signin_cont_new">

         <a href="<?php echo $this->Url->build('/'); ?>"><img _ngcontent-ovl-c59="" class="logo" tabindex="0" src="<?php echo $this->Url->build('/img/logo.png'); ?>"></a>

            <div _ngcontent-ovl-c59="" class="signin_inner ng-star-inserted">

              <h2 _ngcontent-ovl-c59="">Forgot Password?</h2>
              
              <?php echo($this->Flash->render()); ?>

              <?= $this->Form->create(NULL,array('id' => 'regForm', 'action' => SITEURL.'forgot-password-check', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>

                <div _ngcontent-ovl-c59="" class="form_rows">

                  <label _ngcontent-ovl-c59="" class="email">
                  <span _ngcontent-ovl-c59="" class="title">Email ID</span>
                  <input _ngcontent-ovl-c59="" id="email_address" name="email_address" class="form-control ng-untouched ng-pristine ng-invalid" onkeyup="$('#email_addressError').html('');" type="text">
                  <span class="form_error_msg" id="email_addressError"></span>
                  </label>

                  </label>

                </div>

                <button _ngcontent-ovl-c59="" id="forgotpasswordBtn" class="btn btn-grey">Send</button>

              <?= $this->Form->end(); ?>

              <div _ngcontent-ovl-c59="" class=""><a _ngcontent-ovl-c59=""  href="<?php echo $this->Url->build('/sign-in/'); ?>">Back to Sign In</a></div>

              </div>

            </div>

          </ott-signin>

        </div>

      </div>

  </div>

</ott-app>
<script>
$(document).ready(function(e) {
    $('#forgotpasswordBtn').click(function(e) {
		var nitam = 1;
		var email = $('#email_address').val();
        if($.trim(email) == ''){
			$('#email_addressError').html('Please enter email address');
			$('#email_address').focus(); return false;
		}else{
			var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!filter.test(email)){
				$('#email_addressError').html('Please enter valid email address');
				$('#email_address').focus(); return false;     
			}  
		}
		if(nitam == 1){
			$('#forgotpasswordBtn').html('Processing...');
			$('#regForm').submit();
		}
    });
});
</script>
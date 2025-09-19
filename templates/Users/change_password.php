<?php

if(isset($pageData->seo_title)){

    #set page meta content
    $this->assign('title', $pageData->seo_title);
    $this->assign('meta_keywords', $pageData->seo_keyword);
    $this->assign('meta_description', $pageData->seo_description);
    $this->assign('meta_robot', $pageData->robot_tags);

}

?>

<?= $this->Html->css(array('my_account')) ?>
<style>
.inner_page_btn{    border: 1px solid #d99200;
    background: #d99200;
    color: #fff;}
</style>
<div _ngcontent-ytn-c55="" class="ott-main-body has-header">

<router-outlet _ngcontent-ytn-c55=""></router-outlet>

<app-packages _nghost-ytn-c61="" class="ng-star-inserted">

  <div _ngcontent-ytn-c61="">

    <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">

      <div _ngcontent-kgi-c59="" class="ott-main-body has-header">
<router-outlet _ngcontent-kgi-c59=""></router-outlet>
<app-settings _nghost-kgi-c53="" class="ng-tns-c53-397 ng-star-inserted">
  <div _ngcontent-kgi-c53="" class="settings ng-tns-c53-397 ng-trigger ng-trigger-fadeInAnimation">
    <div _ngcontent-kgi-c53="" class="container-fluid ng-tns-c53-397">
      <div _ngcontent-kgi-c53="" class="inner-container ng-tns-c53-397">
        <div _ngcontent-kgi-c53="" class="setting__details ng-tns-c53-397">
          <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen">Change Password</h2>
          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">
			<?= $this->Form->create(NULL,array('id' => 'changePassword', 'action' => SITEURL.'change-password', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>
            <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">
            
            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Old Password</label>
            <input id="old_pass" onkeyup="$('#old_passError').html('');" name="old_pass" type="password" />
            <span class="form_error_msg" id="old_passError"></span>
            </div>
            
            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">New Password</label>
            <input id="new_password" onkeyup="$('#passwordError').html('');" name="new_password" type="password" />
            <span class="form_error_msg" id="passwordError"></span>
            </div>
            
             <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Confirm Password</label>
            <input id="confirm_pass" onkeyup="$('#confirm_passError').html('');" name="confirm_pass" type="password" />
            <span class="form_error_msg" id="confirm_passError"></span>
            </div>
            <button id="changePassBtn" class="btn btn-grey inner_page_btn">Update Password</button>
            
            </div>
            <?= $this->Form->end(); ?>
          </div>
        </div>
        </div>
    </div>
  </div>
  <div _ngcontent-kgi-c53="" class="ng-tns-c53-397"></div>
</app-settings>
</div>
</div>
</div>
</app-packages>
</div>
<script>
$(document).ready(function(e) {
    $('#changePassBtn').click(function(e) {
		var nitam = 1;
		var password = $('#new_password').val();
		var old_pass = $('#old_pass').val();

		if($.trim(old_pass) == ''){
			$('#old_passError').html('Please enter old password');
			$('#old_pass').focus(); return false;
		}
		if($.trim(password) == ''){
			$('#passwordError').html('Please enter password');
			$('#new_password').focus(); return false;
		}
		if($.trim($('#confirm_pass').val()) == ''){
			$('#confirm_passError').html('Please enter confirm password');
			$('#confirm_pass').focus(); return false;
		}
		if($.trim($('#confirm_pass').val()) != $.trim(password)){
			$('#confirm_passError').html('Confirm password do not match');
			$('#confirm_pass').focus(); return false;
		}
		if(nitam == 1){
			$('#changePassBtn').html('Processing...');
			$('#changePassword').submit();
		}
    });
});
</script>


        
        
<?php
if(isset($pageData->seo_title)){
    #set page meta content
    $this->assign('title', 'Edit Profile');
    $this->assign('meta_keywords', 'Edit Profile');
    $this->assign('meta_description', 'Edit Profile');
    $this->assign('meta_robot', 'Edit Profile');
}
?>



<?= $this->Html->css(array('my_account')) ?>

<style>

.inner_page_btn{    border: 1px solid #d99200;

    background: #d99200;

    color: #fff;}

    .success{text-align: center;

    padding: 10px;}
	
	.is_film{    border: 1px solid #3f3f50;
    padding: 10px;
    padding-bottom: 1px;
    margin-bottom: 12px;
    background: #262630;
    border-radius: 4px;
}
.ott-main-body{ padding-top:50px;}

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

          <?php echo($this->Flash->render()); ?>

          <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen">Update Profile</h2>

          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">

			<?= $this->Form->create(NULL,array('id' => 'changePassword', 'action' => SITEURL.'edit-profile', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>

            <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">

			<input value="<?php echo $userData->profile;?>" name="current_profile" type="hidden" />

            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">

            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Name</label>

            <input id="name" onkeyup="$('#nameError').html('');" value="<?php echo $userData->name;?>" name="name" type="text" />

            <span class="form_error_msg" id="nameError"></span>

            </div>
            
            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">

            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Phone</label>

            <input id="contact" onkeyup="$('#contactError').html('');" value="<?php echo $userData->contact;?>" name="contact" type="text" />

            <span class="form_error_msg" id="contactError"></span>

            </div>



            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">

            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">City/Location</label>

            <input id="city" onkeyup="$('#cityError').html('');" value="<?php echo $userData->city;?>" name="city" type="text" />

            <span class="form_error_msg" id="cityError"></span>

            </div>
            
            <div id="" class="text-left is_film">
            <input name="is_film_maker" <?php if($userData->is_film_maker == 1) echo('checked');?> value="1" class="is_film_maker" type="checkbox" />
            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Film Maker</label>

            </div>
            
            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397 msg2">

            <?php

				 if (!empty($userData->profile)) {
					if (file_exists(WWW_ROOT . 'img/user/' . $userData->profile)) {
						echo $this->Html->image('user/' . $userData->profile, ['alt' => $userData->profile, 'title' => $userData->profile, 'width' => '100']);
					}
				 }
			?>

            </div>
            
            <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">

            <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Profile Image</label>

            <input onchange="profile_image();" id="UserProfile" type="file" />
            <input type="hidden" value="<?php echo $userData->profile;?>" id="old-image" />
            <input type="hidden" name="profile" id="profile" />

            <span class="form_error_msg" id="UserProfileError"></span>

            </div>
            <button id="changePassBtn" class="btn btn-grey inner_page_btn">Update Profile</button>

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
function profile_image(){

	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.msg2').html('Loading...');
	var ext = $('#UserProfile').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){

		$('#UserProfileError').html('Only jpg, png files are allowed.');
		manish = 0;
		return false;
	}
	if(manish == 1){
		var CampaignAttachment = $('#UserProfile').val();
		var formData = new FormData();
		formData.append('UserProfile', $('#UserProfile')[0].files[0]);
		formData.append('model', 'Users');
		formData.append('oldImage', $('#old-image').val());

		$.ajax({

			url: '<?php echo $this->Url->build('/crop-image'); ?>',
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType: 'JSON',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
			},
			success:function(response){
				if(response.data.msg == 'Error'){
					$('#Error500').modal('show');
					return false;
				}else{
					setTimeout(function(){
						$('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="100"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
					}, 1000);
					$('#profile').val(response.data.name);
				}
			}
		});
	}
}
</script>
<script>

$(document).ready(function(e) {

    $('#changePassBtn').click(function(e) {

		var nitam = 1;

		var city = $('#city').val();

		var name = $('#name').val();



		if($.trim(name) == ''){

			$('#nameError').html('Please enter your name');

			$('#name').focus(); return false;

		}

		if($.trim(city) == ''){

			$('#cityError').html('Please enter your location/city');

			$('#city').focus(); return false;

		}

		if(nitam == 1){

			$('#changePassBtn').html('Processing...');

			$('#changePassword').submit();

		}

    });

});

</script>


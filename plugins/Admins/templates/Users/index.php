<style>

input[type="file"]{

    display: none;

}

</style>

<div id="page-wrapper" >

   <?= $this->Flash->render() ?>

   <div id="page-inner">

      <div class="row">

         <div class="col-md-12">

            <h2>Profile Page</h2>

            <h5>Welcome <?php echo ucwords($user['name']); ?> , Love to see you back. </h5>

         </div>

      </div>

      <!-- /. ROW  -->

      <hr />

      <div class="row">

         <div class="col-md-12">

            <!-- Form Elements -->

            <div class="panel panel-default">

               <div class="panel-heading">

                  User Details

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($user,array('csrfToken' => $this->request->getAttribute('csrfToken'),'id' => 'myProfileForm')); ?>

                        <?php echo $this->Form->control('old_image',array(

								   'required'=>false,

								   'type'=>'hidden',

								   'value' => $user['profile']

							   )

                           ); 								

                           ?>

                        <?php echo $this->Form->control('profile',array(

								   'placeholder'=>'Profile',

								   'required'=>false,

								   'type'=>'hidden'

							   )

                           ); 

                           ?>

                        <div class="form-group">

                           <?php echo $this->Form->control('name',array(

									  'placeholder'=>'Name',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('username',array(

									  'placeholder'=>'User Name',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('email',array(

									  'placeholder'=>'Email',

									  'type'=>'text',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('contact',array(

									  'placeholder'=>'Contact',

									  'type'=>'text',

									  'required'=>false,

									  'class'=>'form-control number'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <div class="panel-body excerpt_img" style="display:none;">

                              <div class="progress progress-striped active" role="progressbar">

                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>

                              </div>

                           </div>

                           <div class="msg2">                            

                              <?php

                                 if(!empty($user['profile'])){

                                 	if(file_exists(WWW_ROOT.'img/user/'.$user['profile'])){

                                 		echo $this->Html->image('user/'.$user['profile'], [

                                 			'alt'=>$user['profile'],

                                 			'title' => $user['profile'],

                                 			'width'=>'100']

                                 		);

                                 	}

                                 }

                                 ?>

                           </div>

                        </div>                                               

                        <div class="form-group">

                           	<?php echo $this->Form->control('new_profile',array(

									  'type'=>'file',

									  'label'=>'Profile',

									  'id' => 'UserProfile',

									  'required'=>false,

									  'class'=>'form-control',

									  'onchange' => 'profile_image()',

									  'accept'=>'.png,.jpg,.jpeg'

								  )								  

                              ); 

                            ?>

                            <div class="input-group">                         

                              	<input type="text" class="form-control" id="uploadFile" placeholder="Choose File" readonly="readonly"/>

                                <span class="form-group input-group-btn">

                                <label for="UserProfile" class="btn btn-default">                        	

                                    <i class="fa fa-cloud-upload"></i> Browse

                                </label>

                              </span>

                            </div>

                        </div>  

                        <hr />                      

                        

                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh "></i> Update</button>

                        <?php echo $this->Form->end(); ?>

                     </div>

                  </div>

               </div>

            </div>

            <!-- End Form Elements -->

         </div>

      </div>

      <!-- /. ROW  -->       

      <!-- /. ROW  -->

   </div>

   <!-- /. PAGE INNER  -->

</div>

<!-- /. PAGE WRAPPER  -->





<script type = "text/javascript">

  

$(document).on('click', '#submitForm',function(){

	

$("#myProfileForm").validate({

	errorElement: "div",

	rules: {

		'name': {

			required: true,

		},

		'username': {

			required: true,

		},

		'email': {

			required: true,

			email: '#new-password'

		},

		'contact': {

			required: true,

		}

	},

	messages: {

		'name': {

			required: "Please enter fullname.",

		},

		'username': {

			required: "Please enter username.",

		},

		'email': {

			required: "Please enter email.",

			email: "Please enter valid email.",

		},

		'contact': {

			required: "Please enter contact.",

		}     

	},

	submitHandler: function(form){

		$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');	

		$('#myProfileForm').submit();

	}

}); 

});





function showConfirmPassword() {

	if (jQuery('#passEye2').hasClass('fa-eye')) {

		jQuery('#password').attr('type', 'text');

		jQuery('#passEye2').removeClass('fa-eye').addClass('fa-eye-slash');

	} else {

		jQuery('#password').attr('type', 'password');

		jQuery('#passEye2').removeClass('fa-eye-slash').addClass('fa-eye');

	}

}



function profile_image(){

	var manish = 1;

	$('#errorMsgPopUp').html('Something went wrong. Please try again.');

	$('.myprogress2').css('width', '0');

	$('.msg2').html('');	

	var ext = $('#UserProfile').val().split('.').pop().toLowerCase();



	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){

		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');

		$('#Error500').modal('show');

		manish = 0;

		return false;

	}



	if(manish == 1){

		$('.excerpt_img').show();

		var CampaignAttachment = $('#UserProfile').val();

		$('#uploadFile').val(CampaignAttachment);

		

		var formData = new FormData();

		formData.append('UserProfile', $('#UserProfile')[0].files[0]);

		formData.append('model', 'Admins');

		formData.append('oldImage', $('#old-image').val());

		$.ajax({

			url: '<?php echo $this->Url->build('/admins/images/saveImages'); ?>',

			data: formData,

			processData: false,

			contentType: false,

			type: 'POST',

			dataType: 'JSON',

			headers: {

				'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')

			},

			xhr:function(){

				var xhr = new window.XMLHttpRequest();

				xhr.upload.addEventListener("progress",function(evt){

					if (evt.lengthComputable){

						var percentComplete = evt.loaded / evt.total;

						percentComplete = parseInt(percentComplete * 100);

						$('.myprogress2').text(percentComplete + '%');

						$('.myprogress2').css('width', percentComplete + '%');

					}

				}, false);

				return xhr;

			},

			success:function(response){

				if(response.data.msg == 'Error'){

					$('.excerpt_img').hide();

					$('#Error500').modal('show');

					return false;

				}else{

					setTimeout(function(){

						$('.excerpt_img').hide();

						$('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="100"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');

					}, 1000);

					$('#profile').val(response.data.name);

				}

			}

		});

	}

}

</script>
<style>

   input[type="file"]{ display: none; }

</style>

<div id="page-wrapper" >

   <?=$this->Flash->render() ?>

   <div id="page-inner">

      <div class="row">

         <div class="col-md-12">

            <?php $type = 'Add'; if (isset($user->id)) { $type = 'Edit'; } ?>

            <h2><?php echo $type; ?> Sub Admin</h2>

         </div>

      </div>

      <!-- /. ROW  -->

      <?php

         echo $this->Html->link('Back', array('plugin' => 'Admins', 'controller' => 'Users', 'action' => 'sub-admins'), array('escape' => false, 'class' => "btn btn-primary", 'type' => "button"));

   		?>

      <hr />

      <div class="row">

         <div class="col-md-12">

            <!-- Form Elements -->

            <div class="panel panel-default">

               <div class="panel-heading">

                  Sub Admin Details
               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($user, array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>

                        <?php echo $this->Form->control('old_image', array('required' => false, 'type' => 'hidden', 'value' => $user['icon'])); ?>

                        <?php echo $this->Form->control('profile', array('required' => false, 'type' => 'hidden', 'id' => 'profile')); ?>

                        <div class="form-group">

                           <?php echo $this->Form->control('name', array('placeholder' => 'User Name', 'required' => false, 'class' => 'form-control')); ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('username', array('placeholder' => 'User Name', 'required' => false, 'class' => 'form-control')); ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('email', array('placeholder' => 'Email', 'required' => false, 'class' => 'form-control')); ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('contact', array('placeholder' => 'Contact', 'required' => false, 'class' => 'form-control number', 'maxlength' => 10)); ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('city', array('placeholder' => 'City/Location', 'required' => false, 'class' => 'form-control')); ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('temp', array('placeholder' => 'Password', 'label' => 'Password', 'type' => 'text', 'required' => false, 'class' => 'form-control', 'value' => $userPassword)); ?>

                        </div>

                        <div class="form-group">

                           <div class="panel-body excerpt_img" style="display:none;">

                              <div class="progress progress-striped active" role="progressbar">

                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>

                              </div>

                           </div>

                           <div class="msg2">

                              <?php

                                 if (!empty($user['profile'])) {

                                 	if (file_exists(WWW_ROOT . 'img/user/' . $user['profile'])) {

                                 		echo $this->Html->image('user/' . $user['profile'], ['alt' => $user['profile'], 'title' => $user['profile'], 'width' => '100']);

                                 	}

                                 }

                           	?>

                           </div>

                        </div>

                        <div class="form-group">



                           	<?php echo $this->Form->control('new_profile',array(



									  'type'=>'file',



									  'label'=>'Profile (128 x 128)',



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

                        <label>Status</label>

                        <div class="form-group">

                           <?php echo $this->Form->control('status', array('required' => false, 'label' => 'Active', 'type' => 'checkbox', 'value' => 1,));

                              ?>

                        </div>

                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh "></i> Submit</button>

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

   	$("#addForm").validate({

   		errorElement: "div",

   		rules: {

   			'username': {

   				required: true,

   			},

			'email': {

   				required: true,

   			},

			'contact': {

   				required: true,

   			},

			'password': {

   				required: true,

   			}

   		},

   		messages: {

   			'username': {

   				required: "Please enter username here.",
   			} ,

			'email': {

   				required: "Please enter email here.",
   			} ,

			'contact': {

   				required: "Please enter contact here.",
   			} ,

			'password': {
   				required: "Please enter strong password here.",
   			}
   		},
   		submitHandler: function(form){

   				$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');

   				$('#addForm').submit();

   		}

   	});

   });


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



		formData.append('model', 'Users');



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
$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#page-wrapper').offset().top
    }, 'slow');
});	


</script>


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

            <h2>Site Configuration</h2>

            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>

         </div>

      </div>

      <!-- /. ROW  -->

      <hr />

      <div class="row">

         <div class="col-md-12">

            <!-- Form Elements -->

            <div class="panel panel-default">

               <div class="panel-heading">

                  Site Configuration Details

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($setting,array('csrfToken' => $this->request->getAttribute('csrfToken'),'id' => 'siteConfigForm')); ?>

                        <?php echo $this->Form->control('old_image',array(

								   'required'=>false,

								   'type'=>'hidden',

								   'value' => $setting['logo']

							   )

                           ); 								

                           ?>

                        <?php echo $this->Form->control('logo',array(

								   'required'=>false,

								   'type'=>'hidden'

							   )

                           ); 

                           ?>

                        <div class="form-group">

                           <?php echo $this->Form->control('admin_email',array(

						   			  'label'=>'Admin Email Address',

									  'placeholder'=>'Admin Email Address',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('company_name',array(

									  'placeholder'=>'Company Name',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('business_address',array(

									  'placeholder'=>'Business Address',

									  'type'=>'textarea',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('mobile',array(

									  'placeholder'=>'Contact',

									  'label'=>'Company Contact',

									  'type'=>'text',

									  'maxlength'=>10,

									  'required'=>false,

									  'class'=>'form-control number'

								  )

                              ); 

                              ?>

                        </div>

                        <div class="form-group">

                           <?php echo $this->Form->control('footer_content',array(

									  'placeholder'=>'Footer Content',

									  'type'=>'text',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              ); 

                              ?>

                        </div>
                        
                        <div class="form-group">

                           <?php echo $this->Form->control('footer_heading',array('placeholder'=>'Footer Heading','type'=>'text','required'=>false,'class'=>'form-control')); ?>

                        </div>
                        
                        <div class="form-group">

                           <?php echo $this->Form->control('footer_subheading',array('placeholder'=>'Footer Sub Heading','type'=>'textarea','required'=>false,'class'=>'form-control')); ?>

                        </div>

                        <div class="form-group">

                           <div class="panel-body excerpt_img" style="display:none;">

                              <div class="progress progress-striped active" role="progressbar">

                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>

                              </div>

                           </div>

                           <div class="msg2">                            

                              <?php

                                 if(!empty($setting['logo'])){

                                 	if(file_exists(WWW_ROOT.'img/logo/'.$setting['logo'])){

                                 		echo $this->Html->image('logo/'.$setting['logo'], [

                                 			'alt'=>$setting['logo'],

                                 			'title' => $setting['logo'],

                                 			'width'=>'100']

                                 		);

                                 	}

                                 }

                                 ?>

                           </div>

                        </div>                                               

                        <div class="form-group">

                           	<?php echo $this->Form->control('new_logo',array(

									  'type'=>'file',

									  'label'=>'Site Logo (128 x 128)',

									  'id' => 'SiteSetting',

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

                                <label for="SiteSetting" class="btn btn-default">                        	

                                    <i class="fa fa-cloud-upload"></i> Browse

                                </label>

                              </span>

                            </div>

                        </div>               

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

	$("#siteConfigForm").validate({

		errorElement: "div",

		rules: {

			'admin_email': {

				required: true,

				email: true

			},

			'company_name': {

				required: true,

			},

			'business_address': {

				required: true,

			},

			'mobile': {

				required: true,

			},

			'footer_content': {

				required: true,

			}

		},

		messages: {

			'admin_email': {

				required: "Please enter email address.",

				email: "Please enter valid email.",

			},

			'company_name': {

				required: "Please enter company name.",

			},

			'business_address': {

				required: "Please enter business address.",

			},

			'mobile': {

				required: "Please enter contact.",

			} ,

			'footer_content': {

				required: "Please enter footer content.",

			}    

		},

		submitHandler: function(form){

			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');	

			$('#siteConfigForm').submit();

		}

	});

});





function profile_image(){

	var manish = 1;

	$('#errorMsgPopUp').html('Something went wrong. Please try again.');

	$('.myprogress2').css('width', '0');	

	var ext = $('#SiteSetting').val().split('.').pop().toLowerCase();



	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){

		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');

		$('#Error500').modal('show');

		manish = 0;

		return false;

	}



	if(manish == 1){

		$('.msg2').html('');

		$('.excerpt_img').show();

		var CampaignAttachment = $('#SiteSetting').val();

		$('#uploadFile').val(CampaignAttachment);

		

		var formData = new FormData();

		formData.append('SiteSetting', $('#SiteSetting')[0].files[0]);

		formData.append('model', 'Settings');

		formData.append('oldImage', $('#logo').val());

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

					$('#logo').val(response.data.name);

				}

			}

		});

	}

}

</script>
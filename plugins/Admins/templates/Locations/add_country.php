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
         	<?php $type = 'Add'; if(isset($countries->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Country</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
         </div>
      </div>
      <!-- /. ROW  -->      
      <?php
			echo $this->Html->link('Back',
				array('plugin' => 'Admins', 'controller' => 'Locations', 'action' => 'countries'),
				array('escape' => false,
					'class' => "btn btn-primary",'type'=>"button")
			);
		?>
      <hr />	        
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-heading">
                  Country Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($countries,array('csrfToken' => $this->request->getAttribute('csrfToken'), 'id' => 'countryForm')); ?>
                        <?php echo $this->Form->control('old_image',array(
								   'required'=>false,
								   'type'=>'hidden',
								   'value' => $countries['flag_image']
							   )
                           ); 								
                        ?>
                        <div class="form-group">
                           <?php echo $this->Form->control('country_name',array(
									  'placeholder'=>'Country Name',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              );
                            ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('country_code',array(
									  'placeholder'=>'Country Code',
									  'required'=>false,
									  'class'=>'form-control string',
									  'maxlength' => 3
								  )
                              ); 
                            ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('phonecode',array(
									  'placeholder'=>'Phone Code',
									  'label'=>'Phone Code',
									  'required'=>false,
									  'class'=>'form-control number',
									  'maxlength' => 4
								  )
                              ); 
                           ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('phone_no_format',array(
									  'placeholder'=>'Phone Number Format',
									  'label'=>'Phone Number Format',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              ); 
                           ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('zipcode_format',array(
									  'placeholder'=>'Zip Code Format',
									  'label'=>'Zip Code Format',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              ); 
                           ?>
                        </div>
                        <div class="form-group">
                        <div class="msg2">
                        	<div class="panel-body excerpt_img" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
							<?php
                            if($countries->flag_image != ""){
                                $imgPath = WWW_ROOT.'/img/countries/'.$countries->flag_image;
                                if(is_file($imgPath)){
                                    echo $this->Html->image('countries/'.$countries->flag_image, array('title'=>$countries->country_name, 'alt'=> $countries->country_name));
                                }
                            } ?>
                        </div>
                        </div>          
                        <div class="form-group">
                           	<?php echo $this->Form->control('flag_image',array(
									  'type'=>'file',
									  'label'=>'Country Flag (50 x 50)',
									  'id' => 'Countries',
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
                                <label for="Countries" class="btn btn-default">                        	
                                    <i class="fa fa-cloud-upload"></i> Browse
                                </label>
                              </span>
                            </div>
                        </div>
                        <label>Status</label>
                        <div class="form-group">
                           <?php echo $this->Form->control('status',array(
									  'required'=>false,
									  'label'=>'Active',
									  'type'=>'checkbox',
									  'value' => 1,
								  )
                              ); 
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
	
	$("#countryForm").validate({
		errorElement: "div",
		rules: {
			'country_name': {
				required: true,
			},
			'country_code': {
				required: true,
				digits:true
			},
			'phonecode': {
				required: true,
				number:true
			},
			'phone_no_format': {
				required: true,
			},
			'zipcode_format': {
				required: true,
			}
		},
		messages: {
			'country_name': {
				required: "Please enter country name.",
			},
			'country_code': {
				required: "Please enter country code.",
				digits:'Please enter alphabets Only.'
			},
			'phonecode': {
				required: "Please enter phone number code.",
				number:'Please enter numbers Only.'
			},
			'phone_no_format': {
				required: "Please enter phone number format.",
			},
			'zipcode_format': {
				required: "Please enter zipcode format.",
			}     
		},
		submitHandler: function(form){
			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
			$('#countryForm').submit();
		}
	}); 

});

function profile_image() {
	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.myprogress2').css('width', '0');
	$('.msg2').html('');	
	var ext = $('#Countries').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');
		$('#Error500').modal('show');
		manish = 0;
		return false;
	}

	if(manish == 1){
		$('.excerpt_img').show();
		var CampaignAttachment = $('#Countries').val();
		$('#uploadFile').val(CampaignAttachment);
		
		var formData = new FormData();
		formData.append('Countries', $('#Countries')[0].files[0]);
		formData.append('model', 'Countries');
		$.ajax({
			url: '<?php echo $this->Url->build('/images/saveImage'); ?>',
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
				if (response.data.msg == 'Error'){
					$('.excerpt_img').hide();
					$('#Error500').modal('show');
					return false;
				}else{
					setTimeout(function(){
						$('.excerpt_img').hide();
						$('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="100"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
					}, 1000);
					$('#flag_image').val(response.data.name);
				}
			}
		});
	}
}
</script>
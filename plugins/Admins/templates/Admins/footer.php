<?php echo $this->element('/jQuery'); ?>
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
            <h2>Footer Content</h2>
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
                  Footer Content Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($footer,array('type' => 'file','csrfToken' => $this->request->getAttribute('csrfToken'),'id' => 'footerContentForm')); ?>
                        <?php echo $this->Form->control('old_image',array(
											   'required'=>false,											   
											   'type'=>'hidden',											   
											   'value' => $footer['footer_logo']											   
											   )                           
                                           ); 							
                           
                     	?>
                        <?php echo $this->Form->control('footer_logo',array(
											   'required'=>false,                          
											   'type'=>'hidden'											   
											   )                           
                                           );                            
                        ?>
                        <div class="form-group">
                           <?php echo $this->Form->control('heading',array(
													  'label'=>'Heading',                              
													  'placeholder'=>'Footer Heading',                              
													  'required'=>false,                              
													  'class'=>'form-control'                              
												  )                              
                                              );                               
                          	?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('sub_heading',array(
													  'placeholder'=>'Footer Sub Heading',													  
													  'required'=>false,
													  'type' => 'textarea',
													  'class'=>'form-control'													  
													  )                              
                                                 );                               
                           ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('coming_soon_text',array(
													  'placeholder'=>'App Coming Soon',
													  'label' => 'Coming Soon Text',
													  'required'=>false,
													  'type' => 'text',
													  'class'=>'form-control'													  
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
                                 if(!empty($footer['footer_logo'])){                                 
                                 	if(file_exists(WWW_ROOT.'img/logo/'.$footer['footer_logo'])){                                 
                                 		echo $this->Html->image('logo/'.$footer['footer_logo'], [                                 
                                 			'alt'=>$footer['footer_logo'],                                 
                                 			'title' => $footer['footer_logo'],                                 
                                 			'width'=>'100%']                                 
                                 		);                                 
                                 	}                                 
                                 }                                 
                              ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('new_image',array(
													  'type'=>'file',													  
													  'label'=>'Footer Ad (1280 x 720)',													  
													  'id' => 'FooterContent',
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
                              <label for="FooterContent" class="btn btn-default">                        	
                              <i class="fa fa-cloud-upload"></i> Browse
                              </label>
                              </span>
                           </div>
                        </div>                        
                        
                        
                        <label>Social Navigation Url's</label> 
                        <br />
                        
                        <label>Facebook</label> 
                        <input type="text" name="facebook" class="form-control" value="<?php echo $footer['facebook']; ?>"/>
                        
                        <label>Instagram</label> 
                        <input type="text" name="instagram" class="form-control" value="<?php echo $footer['instagram']; ?>"/>
                        
                        <label>Twitter</label> 
                        <input type="text" name="twitter" class="form-control" value="<?php echo $footer['twitter']; ?>"/>
                        
                        <label>LinkedIn</label> 
                        <input type="text" name="linkedin" class="form-control" value="<?php echo $footer['linkedin']; ?>"/>
                        
                        <label>Youtube</label> 
                        <input type="text" name="youtube" class="form-control" value="<?php echo $footer['youtube']; ?>"/>
                                                
                        <div class="form-group" style="margin-top:15px;">                   
                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh "></i> Update</button>
                        </div>
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

	function searchData(){
		window.location.href="<?php echo $this->Url->build('/admins/admins/footer/'); ?>";	
	}

   $(document).on('click', '#submitForm',function(){	
   
   	$("#footerContentForm").validate({   
   		errorElement: "div",   
   		rules: {   
   			'heading': {   
   				required: true,
   			},   
   			'sub_heading': {   
   				required: true,   
   			}  			 
   		},   
   		messages: {   
   			'heading': {   
   				required: "Please enter heading.", 
   			},   
   			'sub_heading': {   
   				required: "Please enter sub heading.",   
   			}
   		},  
   		submitHandler: function(form){   
   			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');	   
   			$('#footerContentForm').submit();   
   		}   
   	});
	   
   });
   
     
   function profile_image(){
   
   	var manish = 1;
   
   	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
   
   	$('.myprogress2').css('width', '0');	
   
   	var ext = $('#FooterContent').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   
   		$('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');
   
   		$('#Error500').modal('show');
   
   		manish = 0;
   
   		return false;
   
   	}
   
   
   
   	if(manish == 1){
   
   		$('.msg2').html('');
   
   		$('.excerpt_img').show();
   
   		var CampaignAttachment = $('#FooterContent').val();
   
   		$('#uploadFile').val(CampaignAttachment);
   
   		
   
   		var formData = new FormData();
   
   		formData.append('FooterContent', $('#FooterContent')[0].files[0]);
   
   		formData.append('model', 'Footer');
   
   		formData.append('oldImage', $('#footer-logo').val());
   
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
   
   					$('#footer-logo').val(response.data.name);
   
   				}
   
   			}
   
   		});
   
   	}
   
   }
   
   
   /**************delete record*****************/
   
</script>
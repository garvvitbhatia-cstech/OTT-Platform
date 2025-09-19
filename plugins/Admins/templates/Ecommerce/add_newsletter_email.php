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
            <?php $type = 'Add'; if(isset($news->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Newsletter Email</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
         echo $this->Html->link('Back',         
         	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'newsletterEmail'),         
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
                  Newsletter Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($news,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <input type="hidden" name="top_banner_name" id="top_banner_name" />
                        <input type="hidden" name="middle_banner_name" id="middle_banner_name" />
                        <?php echo $this->Form->control('old_top_banner',array(
								   'required'=>false,
								   'type'=>'hidden',
								   'value' => $news['top_banner']
							   )
                           ); 								
                        ?>
                        <?php echo $this->Form->control('old_middle_banner',array(
								   'required'=>false,
								   'type'=>'hidden',
								   'value' => $news['middle_banner']
							   )
                           ); 								
                        ?>
                        <div class="form-group">
                           <label>Type</label>
                           <select onchange="chooseType(this.value);" name="type" id="type" confirmation="false" class="form-control">
                           		
                              <option <?php if($news['type'] == 'Video'){echo "selected";}?> value="Video">Video - Premier Video</option>
                              <option <?php if($news['type'] == 'Random'){echo "selected";}?> value="Random">Random-Weekly News</option>
                              
                           </select>
                        </div>
                        
                        
                        <div id="bannerTypeDiv"  class="form-group">
                           <label>Top Banner Type</label>
                           <select name="top_banner_type" id="top_banner_type" confirmation="false" class="form-control">
                           		
                              <option <?php if($news['top_banner_type'] == 'LMB'){echo "selected";}?> value="LMB">Premier Video Banner </option>
                              <option <?php if($news['top_banner_type'] == 'UCB'){echo "selected";}?> value="UCB">Use Custom Banner</option>
                              
                           </select>
                        </div>
                        
                      
                        
                        <div id="moviewDiv"  class="form-group">
                           <label>Movies</label>
                           <select name="product_id" id="product_id" confirmation="false" class="form-control">
                           		<?php foreach($movies as $key => $movie){?>
                           		<option <?php if($news['product_id'] == $movie->id){echo "selected";}?> value="<?php echo $movie->id;?>"><?php echo $movie->product_name;?></option>
                                <?php } ?>
                           </select>
                        </div>
                        
                        <label>Display Home Elements</label>
                        <div class="form-group">
                           <?php echo $this->Form->control('home_elements',array(
									  'required'=>false,
									  'label'=>'Active',
									  'type'=>'checkbox',
									  'value' => 1,
								  )
                              ); 
                           ?>
                        </div>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('title',array(
													  'placeholder'=>'Subject',
														'label' => 'Subject',
													  'required'=>false,													  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                        </div>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('youtube_link',array(
													  'placeholder'=>'Youtube Link',													  
													  'required'=>false,
													  'type' => 'text',													  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                        </div>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('description',array(
													  'placeholder'=>'Description',													  
													  'required'=>false,											  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                        </div>
                        
                        <div style="background-color: #F96; padding: 20px;margin-bottom: 20px;">
                        
                        <div class="form-group">
                           <div class="panel-body excerpt_img" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
                           <div class="msg2">                            
                              <?php
                                 if(!empty($news['top_banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$news['top_banner'])){
                                 		 echo $this->Html->image('banners/'.$news['top_banner'], [
                                 			'alt'=>$news['top_banner'],
                                 			'title' => $news['top_banner'],
                                 			'width'=>'400']
                                 		);
                                 	}
                                 }
                              ?>
                           </div>
                        </div>
                        
                        <div class="form-group">
                           	<?php echo $this->Form->control('top_banner',array(
									  'type'=>'file',
									  'label'=>'Top Banner',
									  'id' => 'Banners',
									  'required'=>false,
									  'class'=>'form-control',
									  'onchange' => 'banner_image()'
								  )								  
                              ); 
                            ?>
                            <div class="input-group">                         
                              	<input type="text" class="form-control" id="uploadFile" placeholder="Choose File" readonly="readonly"/>
                                <span class="form-group input-group-btn">
                                <label for="Banners" class="btn btn-default">                        	
                                    <i class="fa fa-cloud-upload"></i> Browse
                                </label>
                              </span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('top_banner_url',array(
													  'placeholder'=>'Top Banner URL',													  
													  'required'=>false,
													  'type' => 'text',													  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                        </div>
                        
                        <label>Top Banner Status</label>
                        <div class="form-group">
                           <?php echo $this->Form->control('top_banner_status',array(
									  'required'=>false,
									  'label'=>'Active',
									  'type'=>'checkbox',
									  'value' => 1,
								  )
                              ); 
                           ?>
                        </div>
                        
                        </div>
                        
                        <div style="background-color:#CC6; padding: 20px;margin-bottom: 20px;">
                        
                        <div class="form-group">
                           <div class="panel-body excerpt_img2" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary myprogress3" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
                           <div class="msg3">                            
                              <?php
                                 if(!empty($news['middle_banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$news['middle_banner'])){
                                 		 echo $this->Html->image('banners/'.$news['middle_banner'], [
                                 			'alt'=>$news['top_banner'],
                                 			'title' => $news['top_banner'],
                                 			'width'=>'400']
                                 		);
                                 	}
                                 }
                              ?>
                           </div>
                        </div>
                        
                        <div class="form-group">
                           	<?php echo $this->Form->control('middle_banner',array(
									  'type'=>'file',
									  'label'=>'Middle Banner',
									  'id' => 'MidBanners',
									  'required'=>false,
									  'class'=>'form-control',
									  'onchange' => 'mid_banner_image()'
								  )								  
                              ); 
                            ?>
                            <div class="input-group">                         
                              	<input type="text" class="form-control" id="uploadFile2" placeholder="Choose File" readonly="readonly"/>
                                <span class="form-group input-group-btn">
                                <label for="MidBanners" class="btn btn-default">                        	
                                    <i class="fa fa-cloud-upload"></i> Browse
                                </label>
                              </span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('middle_banner_url',array(
													  'placeholder'=>'Middle Banner URL',													  
													  'required'=>false,
													  'type' => 'text',													  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                        </div>
                        
                        <label>Middle Banner Status</label>
                        <div class="form-group">
                           <?php echo $this->Form->control('middle_banner_status',array(
									  'required'=>false,
									  'label'=>'Active',
									  'type'=>'checkbox',
									  'value' => 1,
								  )
                              ); 
                           ?>
                        </div>
                        
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
   			'email': {   
   				required: true,   
   			}  
   		},   
   		messages: {   
   			'email': {   
   				required: "Please enter email here.",
   			}        
   		},   
   		submitHandler: function(form){   
			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');   
			$('#addForm').submit();     			   
   		}   
   	});
	
	   
   });
   function chooseType(type){
	   /*$('#moviewDiv').hide();
	   $('#bannerTypeDiv').hide();
	   if(type == 'Video'){
		   $('#moviewDiv').show();
	   }else{
		   $('#bannerTypeDiv').show();
	   }*/
   }
   function banner_image(){
	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.myprogress2').css('width', '0');
	$('.msg2').html('');	
	var ext = $('#Banners').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp', 'gif']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png, webp, gif files are allowed.');
		$('#Error500').modal('show');
		manish = 0;
		return false;
	}
	if(manish == 1){
		$('.excerpt_img').show();
		var CampaignAttachment = $('#Banners').val();
		$('#uploadFile').val(CampaignAttachment);
		var formData = new FormData();
		formData.append('Banners', $('#Banners')[0].files[0]);
		formData.append('model', 'Banners');
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
				if (response.data.msg == 'Error'){
					$('.excerpt_img').hide();
					$('#Error500').modal('show');
					return false;
				}else{
					setTimeout(function(){
						$('.excerpt_img').hide();
						$('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="400"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
					}, 1000);
					$('#top_banner_name').val(response.data.name);
				}
			},
			error:function(err){
				alert(err);
				console.log(err);
			}
		});
	}
}
   function mid_banner_image(){
	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.myprogress3').css('width', '0');
	$('.msg3').html('');	
	var ext = $('#MidBanners').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp', 'gif']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png, webp, gif files are allowed.');
		$('#Error500').modal('show');
		manish = 0;
		return false;
	}
	if(manish == 1){
		$('.excerpt_img2').show();
		var CampaignAttachment = $('#MidBanners').val();
		$('#uploadFile2').val(CampaignAttachment);
		var formData = new FormData();
		formData.append('Banners', $('#MidBanners')[0].files[0]);
		formData.append('model', 'Banners');
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
						$('.myprogress3').text(percentComplete + '%');
						$('.myprogress3').css('width', percentComplete + '%');
					}
				}, false);
				return xhr;
			},
			success:function(response){
				if (response.data.msg == 'Error'){
					$('.excerpt_img2').hide();
					$('#Error500').modal('show');
					return false;
				}else{
					setTimeout(function(){
						$('.excerpt_img2').hide();
						$('.msg3').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="400"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
					}, 1000);
					$('#middle_banner_name').val(response.data.name);
				}
			},
			error:function(err){
				alert(err);
				console.log(err);
			}
		});
	}
}
   </script>
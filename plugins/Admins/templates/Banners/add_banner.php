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
         	<?php $type = 'Add'; if(isset($banners->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Banner</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
         </div>
      </div>
      <!-- /. ROW  -->      
      <?php
			echo $this->Html->link('Back',
				array('plugin' => 'Admins', 'controller' => 'Banners', 'action' => 'banners'),
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
                  Banner Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($banners,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <?php echo $this->Form->control('old_image',array(
								   'required'=>false,
								   'type'=>'hidden',
								   'value' => $banners['banner']
							   )
                           ); 								
                        ?>
                        <?php echo $this->Form->control('banner',array(
								   'required'=>false,
								   'type'=>'hidden',
								   'id'=>'icon'
							   )
                           ); 								
                        ?>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('title',array(
									  'placeholder'=>'Banner Title',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              );
                            ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('url',array(
									  'placeholder'=>'Banner URL',
									  'type'=>'text',
									  'required'=>false,
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
                                 if(!empty($banners['banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$banners['banner'])){
                                 		 echo $this->Html->image('banners/'.$banners['banner'], [
                                 			'alt'=>$banners['banner'],
                                 			'title' => $banners['banner'],
                                 			'width'=>'400']
                                 		);
                                 	}
                                 }
                              ?>
                           </div>
                        </div>                                   
                        <div class="form-group">
                           	<?php echo $this->Form->control('new_icon',array(
									  'type'=>'file',
									  'label'=>'Banner Image (1920 x 840)',
									  'id' => 'Banners',
									  'required'=>false,
									  'class'=>'form-control',
									  'onchange' => 'banner_image()',
									  'accept'=>'.png,.jpg,.jpeg'
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
	
	$("#addForm").validate({
		errorElement: "div",
		rules: {
			'title': {
				required: true,
			}
		},
		messages: {
			'title': {
				required: "Please enter banner title here.",
			}    
		},
		submitHandler: function(form){
			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
			$('#addForm').submit();			
		}
	});
});

function banner_image(){
	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.myprogress2').css('width', '0');
	$('.msg2').html('');	
	var ext = $('#Banners').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');
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
					$('#icon').val(response.data.name);
				}
			},
			error:function(err){
				alert(err);
				console.log(err);
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
<link rel="stylesheet" href="<?php echo $this->Url->build('/css/dropzone.css');?>"/>
<script type="text/javascript" src="<?php echo $this->Url->build('/js/dropzone/dropzone.js');?>"></script>
<link rel="stylesheet" href="<?php echo $this->Url->build('/css/sweet-alert.css');?>"/>
<script type="text/javascript" src="<?php echo $this->Url->build('/js/sweet-alert.min.js');?>"></script>
<?= $this->Html->css(array('jquery-ui')) ?>
<?= $this->Html->script(array('jquery-ui')) ?>
<style>
   input[type="file"]{
   display: none;
   }
</style>
<script>
   $(function() {
   	$( "#language" ).autocomplete({
   	  source: "<?php echo $this->Url->build('/get-language'); ?>",
   	  minLength: 2,
   	  select: function( event, ui ) {
   		  $( "#language" ).val(ui.item.label);
   	  }
   	});
   	
   });
</script>
<div id="page-wrapper" >
   <?= $this->Flash->render() ?>
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <?php $type = 'Add'; if(isset($products->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Video</h2>
         </div>
      </div>
      <!-- /. ROW  -->  
      <?php
         echo $this->Html->link('Back',
         	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'products'),
         	array('escape' => false, 'class' => "btn btn-primary",'type'=>"button")
         );
         ?>
      <hr />
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-heading">
                  Video Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($products,array('id' => 'addForm','csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <?php echo $this->Form->control('old_image',array('required'=>false,'type'=>'hidden','value' => $products['icon'] )); ?>
                        <?php echo $this->Form->control('big_banner',array('type'=>'hidden','id'=>'big_banner')); ?>
                        <?php echo $this->Form->control('vertical_banner',array('type'=>'hidden','id'=>'vertical_banner')); ?>
                        <?php echo $this->Form->control('horizontal_banner',array('type'=>'hidden','id'=>'horizontal_banner')); ?>
                        <div class="form-group">                            	
                           <label>Category</label>
                           <select style="height:325px;" name="category_id[]" id="category_id" multiple="multiple" confirmation="false" class="form-control">
                           <?php echo $this->Ecommerce->getAllCategory($products['category_id'],$products->id); ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Type</label>
                           <select name="type" id="type" confirmation="false" class="form-control">
                              <option <?php if($products['type'] == 'Paid'){echo "selected";}?> value="Paid">Paid</option>
                              <option <?php if($products['type'] == 'Free'){echo "selected";}?> value="Free">Free</option>
                           </select>
                        </div>
                        <div class="form-group">
							<?php echo $this->Form->control('product_name',array('onkeyup' => 'setSeoTitle(this.value);', 'placeholder'=>'Title','label'=>'Title','required'=>false,'class'=>'form-control' ));?>
                        </div>
                        <div class="form-group">
							<?php echo $this->Form->control('price',array('placeholder'=>'Rental Price','label'=>'Rental Price','class'=>'form-control' ));?>
                        </div>
                        <div class="form-group">
							<?php echo $this->Form->control('production_year',array('label'=>'Production / Release Year','required'=>false,'class'=>'form-control' ));?>
                        </div>
                        <div class="form-group">
							<?php echo $this->Form->control('language',array('id' => 'language','label'=>'Language', 'required'=>false,'class'=>'form-control' ));?>
                        </div>
                        <div class="form-group">
                           <label>Genres</label>
                           <select style="height:325px;" name="genres[]" id="genres" multiple="multiple" confirmation="false" class="form-control">
                           <?php echo $this->Ecommerce->getAllGenres($products['genres'],$products->id); ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Censor Categories ( Age Related )</label>
                           <?php echo $this->Form->select('censor_category',$censorCategories,['class'=>'form-control']);?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('hours',array('label'=>'Duration of Video','required'=>false,'class'=>'form-control','placeholder'=>'HH','style' => array('width:14%') ));?><span>HH</span>
                           <?php echo $this->Form->control('minutes',array('required'=>false,'label' =>false,'class'=>'form-control','placeholder'=>'MM','style' => array('width:14%') ));?>
                           <span>MM</span>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('description',array('placeholder'=>'Synopsis','label' => 'Synopsis','required'=>false,'type'=>'textarea','class'=>'form-control'));?>
                        </div>
                        <div class="form-group"><?php echo $this->Form->control('director',array('label'=>'Director','required'=>false,'class'=>'form-control' ));?></div>
                        <div class="form-group"><?php echo $this->Form->control('producer',array('label'=>'Producer','required'=>false,'class'=>'form-control' ));?></div>
                        <div class="form-group">
                           <?php echo $this->Form->control('keywords',array('placeholder'=>'Cast','label' => 'Cast', 'required'=>false,'type'=>'textarea','class'=>'form-control'));?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('seo_title',array('placeholder'=>'Seo Title','required'=>false,'class'=>'form-control'));?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('seo_keywords',array('placeholder'=>'Seo Keywords','required'=>false,'class'=>'form-control'));?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('seo_description',array('placeholder'=>'Seo Descriptions','required'=>false,'type'=>'textarea','class'=>'form-control'));?>
                        </div>
                        <div class="form-group">
                           <label>Seo Robots</label>
                           <?php echo $this->Form->select('robot_tags',$robotTags,['class'=>'form-control']);?>
                        </div>
                        <div style="background-color:#9FC" class="form-group">
                           <div class="panel-body big_banner_process" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary big_banner_process_bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
                           <div class="big_banner_show">                            
                              <?php
                                 if(!empty($products['big_banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$products['big_banner'])){
                                 		 echo $this->Html->image('banners/'.$products['big_banner'], [
                                 			'alt'=>$products['big_banner'],
                                 			'title' => $products['big_banner'],
                                 			'width'=>'400']
                                 		);
                                 	}
                                 }
                                 ?>
                           </div>
                        </div>
                        <div style="background-color:#9FC" class="form-group">
                           <?php echo $this->Form->control('big_banner_file',array('type'=>'file','label'=>false,'id' => 'big_banner_file','class'=>'form-control','accept'=>'.png,.jpg,.jpeg','onchange' => 'big_banner_image()')); ?>
                           <div class="input-group"> 
                              <span class="form-group input-group-btn">
                              <label for="big_banner_file" class="btn btn-default">
                              <i class="fa fa-cloud-upload"></i> Browse Banner (1920 X 840)
                              </label>
                              </span>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('big_banner_status',array('required'=>false,'label'=>'Set as a homepage banner','type'=>'checkbox','value' => 1));?>
                        </div>
                        <div style="background-color:#F93" class="form-group">
                           <div class="panel-body vertical_banner_process" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary vertical_banner_process_bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
                           <div class="vertical_banner_show">                            
                              <?php
                                 if(!empty($products['vertical_banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$products['vertical_banner'])){
                                 		 echo $this->Html->image('banners/'.$products['vertical_banner'], [
                                 			'alt'=>$products['vertical_banner'],
                                 			'title' => $products['vertical_banner'],
                                 			'width'=>'200']
                                 		);
                                 	}
                                 }
                                 ?>
                           </div>
                        </div>
                        <div style="background-color:#F93" class="form-group">
                           <?php echo $this->Form->control('vertical_banner_file',array('type'=>'file','label'=>false,'id' => 'vertical_banner_file','class'=>'form-control','accept'=>'.png,.jpg,.jpeg','onchange' => 'vertical_banner_image()')); ?>
                           <div class="input-group"> 
                              <span class="form-group input-group-btn">
                              <label for="vertical_banner_file" class="btn btn-default">
                              <i class="fa fa-cloud-upload"></i> Browse Banner (320 X 480)
                              </label>
                              </span>
                           </div>
                        </div>
                        <div style="background-color:#FC3" class="form-group">
                           <div class="panel-body horizontal_banner_process" style="display:none;">
                              <div class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-primary horizontal_banner_process_bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>
                              </div>
                           </div>
                           <div class="horizontal_banner_show">                            
                              <?php
                                 if(!empty($products['horizontal_banner'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$products['horizontal_banner'])){
                                 		 echo $this->Html->image('banners/'.$products['horizontal_banner'], [
                                 			'alt'=>$products['horizontal_banner'],
                                 			'title' => $products['horizontal_banner'],
                                 			'width'=>'200']
                                 		);
                                 	}
                                 }
                                 ?>
                           </div>
                        </div>
                        <div style="background-color:#FC3" class="form-group">
                           <?php echo $this->Form->control('horizontal_banner_file',array('type'=>'file','label'=>false,'id' => 'horizontal_banner_file','class'=>'form-control','accept'=>'.png,.jpg,.jpeg','onchange' => 'horizontal_banner_image()')); ?>
                           <div class="input-group"> 
                              <span class="form-group input-group-btn">
                              <label for="horizontal_banner_file" class="btn btn-default">
                              <i class="fa fa-cloud-upload"></i> Browse Banner (444 X 250)
                              </label>
                              </span>
                           </div>
                        </div>
                        <script src="https://player.vimeo.com/api/player.js"></script>   
                        <?php if($products['trailer_video']!=""){?>
                        <div class="form-group">
                           <div class="before_uploading">
                              <div  class="panel-body">
                                 <iframe style="border:1px solid #ccc;" src="https://player.vimeo.com/video/<?php echo $products['trailer_video']; ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="&amp;quot; Kramasha &amp;quot; To be continued..."></iframe>  
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                           <?php echo $this->Form->control('trailer_video',array('label'=>'Vimeo Trailer ID','class'=>'form-control' ));?>
                        </div>
                        <?php if($products['trailer_video_password']!=""){?>
                         <div class="form-group">
                           <b>Trailer Password:</b> <?php echo $products['trailer_video_password']; ?>
                        </div>
                        <?php } ?>
                        <?php if($products['video']!=""){?>
                        <div class="form-group">
                           <div class="before_uploading">
                              <div  class="panel-body">
                                 <iframe style="border:1px solid #ccc;" src="https://player.vimeo.com/video/<?php echo $products['video']; ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="&amp;quot; Kramasha &amp;quot; To be continued..."></iframe>   
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                           <?php echo $this->Form->control('video',array('label'=>'Vimeo Video ID','class'=>'form-control' ));?>
                        </div>
                        <?php if($products['video_password']!=""){?>
                         <div class="form-group">
                           <b>Video Password:</b> <?php echo $products['video_password']; ?>
                        </div>
                        <?php } ?>
                        
                        <label>Status</label>
                        <div class="form-group">
                           <?php echo $this->Form->control('status',array('required'=>false,'label'=>'Active','type'=>'checkbox','value' => 1));?>
                        </div>
                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh"></i> Submit</button>
                        <?php echo $this->Form->end(); ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Form Elements -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).on('click', '#submitForm',function(){
   	$("#addForm").validate({
   		errorElement: "div",
   		rules: {
   			'category_id': {
   				required: true,
   			},
   			'product_name': {
   				required: true,
   			}
   		},
   		messages: {
   			'category_id': {
   				required: "Please select category name.",
   			},
   			'product_name': {
   				required: "Please enter title.",
   			}  
   		},
   
   		submitHandler: function(form){
   			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
   			$('#addForm').submit();
   		}
   	});
   
   });
   
</script>
<script>
   function big_banner_image(){
   	
   	var manish = 1;
   	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
   	$('.big_banner_process_bar').css('width', '0');
   	$('.big_banner_show').html('');	
   	var ext = $('#big_banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		$('.big_banner_process').show();
   		var CampaignAttachment = $('#big_banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#big_banner_file')[0].files[0]);
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
   						$('.big_banner_process_bar').text(percentComplete + '%');
   						$('.big_banner_process_bar').css('width', percentComplete + '%');
   					}
   				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					$('.big_banner_process').hide();
   					$('#Error500').modal('show');
   					return false;
   				}else{
   					setTimeout(function(){
   						$('.big_banner_process').hide();
   						$('.big_banner_show').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="400"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
   					}, 1000);
   					$('#big_banner').val(response.data.name);
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
<script>
   function vertical_banner_image(){
   	
   	var manish = 1;
   	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
   	$('.vertical_banner_process_bar').css('width', '0');
   	$('.vertical_banner_show').html('');	
   	var ext = $('#vertical_banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		$('.vertical_banner_process').show();
   		var CampaignAttachment = $('#vertical_banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#vertical_banner_file')[0].files[0]);
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
   						$('.vertical_banner_process_bar').text(percentComplete + '%');
   						$('.vertical_banner_process_bar').css('width', percentComplete + '%');
   					}
   				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					$('.vertical_banner_process').hide();
   					$('#Error500').modal('show');
   					return false;
   				}else{
   					setTimeout(function(){
   						$('.vertical_banner_process').hide();
   						$('.vertical_banner_show').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="200"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
   					}, 1000);
   					$('#vertical_banner').val(response.data.name);
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
<script>
   function horizontal_banner_image(){
   	
   	var manish = 1;
   	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
   	$('.horizontal_banner_process_bar').css('width', '0');
   	$('.horizontal_banner_show').html('');	
   	var ext = $('#horizontal_banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		$('.horizontal_banner_process').show();
   		var CampaignAttachment = $('#horizontal_banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#horizontal_banner_file')[0].files[0]);
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
   						$('.horizontal_banner_process_bar').text(percentComplete + '%');
   						$('.horizontal_banner_process_bar').css('width', percentComplete + '%');
   					}
   				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					$('.horizontal_banner_process').hide();
   					$('#Error500').modal('show');
   					return false;
   				}else{
   					setTimeout(function(){
   						$('.horizontal_banner_process').hide();
   						$('.horizontal_banner_show').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="200"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');
   					}, 1000);
   					$('#horizontal_banner').val(response.data.name);
   				}
   			},
   			error:function(err){
   				alert(err);
   				console.log(err);
   			}
   		});
   	}
   }
   function setSeoTitle(title){
   	var seoTitle = 'Watch '+title+' Movie Online |  '+title+' Movie Online | '+title+' Movie ';
   	$('#seo-title').val(seoTitle);
   	$('#seo-keywords').val(seoTitle);
   	$('#seo-description').val(seoTitle);
   }
   $(document).ready(function () {
       // Handler for .ready() called.
       $('html, body').animate({
           scrollTop: $('#page-wrapper').offset().top
       }, 'slow');
   });	
</script>
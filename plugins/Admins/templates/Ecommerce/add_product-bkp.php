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

                        <div class="form-group"><?php echo $this->Form->control('product_name',array('onkeyup' => 'setSeoTitle(this.value);', 'placeholder'=>'Title','label'=>'Title','required'=>false,'class'=>'form-control' ));?></div>
                        <div class="form-group"><?php echo $this->Form->control('price',array('placeholder'=>'Rental Price','label'=>'Rental Price','class'=>'form-control' ));?></div>
                          <div class="form-group"><?php echo $this->Form->control('production_year',array('label'=>'Production / Release Year','required'=>false,'class'=>'form-control' ));?></div> 
                          <div class="form-group"><?php echo $this->Form->control('language',array('id' => 'language','label'=>'Language', 'required'=>false,'class'=>'form-control' ));?></div> 
                          
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
                        
                        <div class="form-group">                           

                           <div class="before_uploading">                            

                           <?php if(isset($products['video']) && !empty($products['video'])){ ?>

                              <?php

                                 if(!empty($products['video'])){

                                 	if(file_exists(WWW_ROOT.'img/products/'.$products['video'])){

										$ext = explode('.',$products->video);

                               ?>

                                        <div class="panel-body">

                                            <video width="500" height="300" controls>

                                                <source src="<?php echo SITEURL.'img/products/'.$products->video; ?>" type="video/<?php echo $ext[1]; ?>">

                                            </video>

                                        </div>

                               <?php }}

                              ?>

                              <?php } ?>

                           </div>

                        </div>
                        <?php echo $this->Form->control('video',array('required'=>false,'type'=>'hidden','id'=>'uploadVideoFile')); ?>

                        <div class="form-group cancelVideoFileBtn" style="display:none;">

                            <button type="button" class="btn btn-danger" id="cancelVideo" onclick="window.location.reload();">Cancel Video</button>

                        </div>

                        <div id="uploadlist"></div>

                        <div class="form-group uploadVideoFileBtn">

                           	<?php echo $this->Form->control('new_video',array('type'=>'file','label'=>'Media File','id' => 'ProductVideo','required'=>false,'onchange'=>'uploadVideo()','class'=>'form-control')); ?>

                            <div class="input-group">                         

                              	<input type="text" class="form-control" id="uploadFile" placeholder="Choose File" readonly="readonly"/>

                                <span class="form-group input-group-btn">

                                <label for="ProductVideo" class="btn btn-default">

                                    <i class="fa fa-cloud-upload"></i> Browse

                                </label>

                              </span>

                            </div>                            

                            <span id="ProductVideoError" style="display:block;color:#F00"></span>

                        </div>

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

	var uploadingType = 'New'; 

	function uploadVideo(){

		$('#ProductVideoError').html("");

		var fileType = document.getElementById('ProductVideo').files[0].type;
		
		/*if(fileType != "video/mp4" && fileType != "video/MP4"){			
			$('#ProductVideoError').html('Please choose mp4 video file');
			return false;	

		}*/

		$('#ProductVideo').html('<a style="color:#ffffff; text-decoration:none;" onclick="canVideoUploading();"><strong>Cancel Uploading</strong></a>');
		
		$(".before_uploading").html('<div style="height:30px;width:100%;margin:45px auto;" class="progress progress progress-striped active"><div id="progress-bar" class="progress-bar active progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%; line-height:29px;">Uploading</div></div>').show();

		

		window.onbeforeunload = function() { return ''; }

		 

		var input = document.getElementById("ProductVideo");

		var ul = document.getElementById("uploadlist");

		while (ul.hasChildNodes()) {

			ul.removeChild(ul.firstChild);

		}

		for (var i = 0; i < input.files.length; i++) {

			var li = document.createElement("li");

			thefilesize = input.files[i].fileSize||input.files[i].size;

			if (thefilesize > 1024 * 1024){

				 thefilesize = (Math.round(thefilesize  * 100 / (1024 * 1024)) / 100).toString() + 'MB';

			 }else{

				thefilesize = (Math.round(thefilesize  * 100 / 1024) / 100).toString() + 'KB';

			}			

			var video_details = "<span>File Size: " + thefilesize+"</span>" ;

			$('#uploadlist').html(video_details);            

		}

		if(!ul.hasChildNodes()) {

			var li = document.createElement("li");

			li.innerHTML = 'No Files Selected';

			ul.appendChild(li);

		}

		sendRequest();	

	}



	window.BlobBuilder = window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder;

	function sendRequest(){

		var blob = document.getElementById('ProductVideo').files[0];

		var BYTES_PER_CHUNK = 2097152; // 1MB chunk sizes. 10485760,5242880

		var SIZE = blob.size;

		var start = 0;

		var end = BYTES_PER_CHUNK;

		window.uploadcounter=0;

		window.uploadfilearray = [];

		$('#progress-bar').css("width","0%");

		document.getElementById('progress-bar').innerHTML = "Uploading";

		while( start < SIZE ){

			var chunk = blob.slice(start, end);

			window.uploadfilearray[window.uploadcounter]=chunk;

			window.uploadcounter=window.uploadcounter+1;

			start = end;

			end = start + BYTES_PER_CHUNK;

		}

		window.uploadcounter=0;

		uploadFile(window.uploadfilearray[window.uploadcounter],document.getElementById('ProductVideo').files[0].name);

		uploadingType = 'Old';

	}

	

	function fileSelected(){
		var file = document.getElementById('fileToUpload').files[0];
		if (file){
			var fileSize = 0;
			if (file.size > 1024 * 1024)
				fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
			else
				fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
			document.getElementById('fileName').innerHTML = 'Name: ' + file.name;
			document.getElementById('fileSize').innerHTML = 'Size: ' + fileSize;
			document.getElementById('fileType').innerHTML = 'Type: ' + file.type;
		}
	}



	function uploadFile(blobFile,filename){

		var fd = new FormData();

		fd.append("fileToUpload", blobFile);

		var xhr = new XMLHttpRequest();
		xhr.addEventListener("load", uploadComplete, false);
		xhr.addEventListener("error", uploadFailed, false);
		xhr.addEventListener("abort", uploadCanceled, false);		

		xhr.open("POST", "<?php echo $this->Url->build("/admins/ecommerce/uploadIntroVideoProduct/");?>?filename="+filename+"&dir_name=products_video<?php echo $products->id; ?>&uploadingType="+uploadingType);
		xhr.setRequestHeader('X-CSRF-Token', $('[name="csrfToken"]').attr('content'));
		xhr.onload = function(e){

			$('.uploadVideoFileBtn').hide();
			$('.cancelVideoFileBtn').show();
			$('.submitBtn').hide();
			
			var fileName = $('#ProductVideo').val();
			var extFileName = fileName.substring(fileName.lastIndexOf('.') + 1);

			window.uploadcounter=window.uploadcounter+1;

			if (window.uploadfilearray.length > window.uploadcounter ){

				uploadFile(window.uploadfilearray[window.uploadcounter],document.getElementById('ProductVideo').files[0].name); 

				var percentloaded2 = parseInt((window.uploadcounter/window.uploadfilearray.length)*100);

				$('#progress-bar').css("width",percentloaded2+"%");				

				if(percentloaded2 <= 95){

					document.getElementById('progress-bar').innerHTML = percentloaded2+'%';

				}

			}else{

				$('#progress-bar').css("width","100%");

				document.getElementById('progress-bar').innerHTML = "100%";

				var fileType = document.getElementById('ProductVideo').files[0].type;

				if(fileType == "video/mp4" || fileType == "video/MP4"){

					window.onbeforeunload = null;

					//setTimeout(function(){ window.location.reload();},2000);

				}else{

					$('#choose_video').hide();

				}			

				if(document.getElementById('progress-bar').innerHTML == "100%"){
					window.onbeforeunload = null;
					$('#progress-bar').css('background','#093');
					$('#uploadVideoFile').val('products_video<?php echo $products->id; ?>'+'.'+extFileName);	

				}

			}			

		  };

		xhr.send(fd);
	}
	function uploadComplete(evt){
	   console.log(evt);
		/* This event is raised when the server send back a response */
		if (evt.target.responseText != ""){
			//alert(evt.target.responseText);
		}
	}
	function uploadFailed(evt){
		alert("There was an error attempting to upload the file.");
	}
	function uploadCanceled(evt){
		xhr.abort();
		xhr = null;
	}

</script>
<script>
function big_banner_image(){
	
	var manish = 1;
	$('#errorMsgPopUp').html('Something went wrong. Please try again.');
	$('.big_banner_process_bar').css('width', '0');
	$('.big_banner_show').html('');	
	var ext = $('#big_banner_file').val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');
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

	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');
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

	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){
		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');
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

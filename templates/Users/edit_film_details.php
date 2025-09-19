<?php
if(isset($pageData->seo_title)){
    #set page meta content
    $this->assign('title', 'Submit Your Film');
    $this->assign('meta_keywords', 'Submit Your Film');
    $this->assign('meta_description', 'Submit Your Film');
    $this->assign('meta_robot', '');
}
?>
<?= $this->Html->css(array('my_account')) ?>
<style>
.inner_page_btn {
	border: 1px solid #d99200;
	background: #d99200;
	color: #fff;
}
.success {
	text-align: center;
	padding: 10px;
}
.is_film {
	border: 1px solid #3f3f50;
	padding: 10px;
	padding-bottom: 1px;
	margin-bottom: 12px;
	background: #262630;
	border-radius: 4px;
}
.ott-main-body {
	padding-top: 50px;
}
.select_multiple{    width: 100%;
    padding: 10px;
    background: #262630;
    color: #fff;
    border-radius: 3px;
}
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
                  <div _ngcontent-kgi-c53="" class="setting__details ng-tns-c53-397"> <?php echo($this->Flash->render()); ?>
                    <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen">Edit <?php echo $filmData->product_name;?> Details <a href="<?php echo $this->Url->build('/my-films/'); ?>" style="float:right; margin-top:10px;" class="btn btn-grey inner_page_btn">Back</a></h2>
                    <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">
                      <?= $this->Form->create(NULL,array('enctype'=>'multipart/form-data','id' => 'changePassword', 'action' => SITEURL.'edit-film-details/'.base64_encode($filmData->id), 'csrfToken' => $this->request->getAttribute('csrfToken')));
					  ?>
                      <input type="hidden" value="<?php echo $filmData->id;?>" name="id" id="id" />
                      <?php $categories = explode(",",$filmData->category_id);?>
                      <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" style="float:left; width:100%;" class="ng-tns-c53-397">Category</label>
                          <select class="select_multiple" name="category_id[]" multiple="multiple">
                          <?php foreach($categoryList as $keys => $vals): ?>
                          <option <?php if(in_array($vals->id, $categories)) echo 'selected';?> value="<?php echo $vals->id;?>"><?php echo ucwords($vals->name); ?></option>
                          <?php endforeach; ?>
                          </select>
                          <span class="form_error_msg" id="category_idError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Title*</label>
                          <input id="product_name" onkeyup="$('#product_nameError').html('');" value="<?php echo $filmData->product_name;?>" name="product_name" type="text" />
                          <span class="form_error_msg" id="product_nameError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Production / Release Year*</label>
                          <input id="production_year" onkeyup="$('#production_yearError').html('');" value="<?php echo $filmData->production_year;?>" name="production_year" type="text" />
                          <span class="form_error_msg" id="production_yearError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Language*</label>
                          <input id="language" onkeyup="$('#languageError').html('');" value="<?php echo $filmData->language;?>" name="language" type="text" />
                          <span class="form_error_msg" id="languageError"></span> 
                        </div>
                        <?php $genres = explode(",",$filmData->genres);?>
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" style="float:left; width:100%;" class="ng-tns-c53-397">Genres</label>
                          <select class="select_multiple" name="genres[]" multiple="multiple">
                          <?php foreach($genresTableList as $keys => $vals): ?>
                          <option <?php if(in_array($vals->title, $genres)) echo 'selected';?> value="<?php echo $vals->title;?>"><?php echo ucwords($vals->title); ?></option>
                          <?php endforeach; ?>
                          </select>
                          <span class="form_error_msg" id="genresError"></span> 
                        </div>
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" style="float:left; width:100%;" class="ng-tns-c53-397">Censor Categories ( Age Related )</label>
                          <?php echo $this->Form->select('censor_category',$censorCategories,['class'=>'select_multiple']);?>
                          <span class="form_error_msg" id="censor_categoryError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" style="float:left; width:100%;" class="ng-tns-c53-397">Synopsis*</label>
                          <textarea name="description" id="description" class="select_multiple"><?php echo $filmData->description;?></textarea>
                          <span class="form_error_msg" id="descriptionError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Director*</label>
                          <input id="director" onkeyup="$('#directorError').html('');" value="<?php echo $filmData->director;?>" name="director" type="text" />
                          <span class="form_error_msg" id="directorError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Producer*</label>
                          <input id="producer" onkeyup="$('#producerError').html('');" value="<?php echo $filmData->producer;?>" name="producer" type="text" />
                          <span class="form_error_msg" id="producerError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" style="float:left; width:100%;" class="ng-tns-c53-397">Cast*</label>
                          <textarea name="keywords" id="keywords" class="select_multiple"><?php echo $filmData->keywords;?></textarea>
                          <span class="form_error_msg" id="keywordsError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Trailer Video Link*</label>
                          <input id="trailer_video" onkeyup="$('#trailer_videoError').html('');" value="<?php echo $filmData->trailer_video;?>" name="trailer_video" type="text" />
                          <span class="form_error_msg" id="trailer_videoError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Trailer Video Password (If Any)</label>
                          <input id="trailer_video_password" onkeyup="$('#trailer_video_passwordError').html('');" value="<?php echo $filmData->trailer_video_password;?>" name="trailer_video_password" type="text" />
                          <span class="form_error_msg" id="trailer_video_passwordError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Film Video Link*</label>
                          <input id="video" onkeyup="$('#videoError').html('');" name="video" value="<?php echo $filmData->video;?>" type="text" />
                          <span class="form_error_msg" id="videoError"></span> 
                        </div>
                        
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Film Video Password (If Any)</label>
                          <input id="video_password" onkeyup="$('#video_passwordError').html('');" value="<?php echo $filmData->video_password;?>" name="video_password" type="text" />
                          <span class="form_error_msg" id="video_passwordError"></span> 
                        </div>
                        <div _ngcontent-kgi-c53="" id="banner_img_preview" class="form-group ng-tns-c53-397">
                        <?php if($filmData->big_banner != ""){ echo $this->Html->image('banners/'.$filmData->big_banner, ['alt'=>'','title' => '','width'=>'400']); }?>
                        </div>
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Banner (1920 x 840)</label>
                          <input id="banner_file" onchange="banner_image();" name="banner_file" type="file" />
                          <input type="hidden" value="<?php echo $filmData->big_banner;?>" name="banner" id="banner" />
                          <span class="form_error_msg" id="bannerError"></span> 
                        </div>
                        <div _ngcontent-kgi-c53="" id="vertical_img_preview" class="form-group ng-tns-c53-397">
                        <?php if($filmData->vertical_banner != ""){  echo $this->Html->image('banners/'.$filmData->vertical_banner, ['alt'=>'','title' => '','width'=>'200']); }?>
                        </div>
                        <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Banner (320 x 480)</label>
                          <input id="vertical_banner_file" onchange="vertical_banner_image();" name="vertical_banner_file" type="file" />
                          <input type="hidden" value="<?php echo $filmData->vertical_banner;?>" name="vertical_banner" id="vertical_banner" />
                          <span class="form_error_msg" id="vertical_bannerError"></span> 
                        </div>
                        <div _ngcontent-kgi-c53="" id="horizontal_img_preview" class="form-group ng-tns-c53-397">
                        <?php if($filmData->horizontal_banner != ""){  echo $this->Html->image('banners/'.$filmData->horizontal_banner, ['alt'=>'','title' => '','width'=>'200']); }?>
                        </div>
                         <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                          <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Banner (444 x 250)</label>
                          <input id="horizontal_banner_file" onchange="horizontal_banner_image();" name="horizontal_banner_file" type="file" />
                          <input type="hidden" value="<?php echo $filmData->horizontal_banner;?>" name="horizontal_banner" id="horizontal_banner" />
                          <span class="form_error_msg" id="horizontal_bannerError"></span> 
                        </div>
                        
                        <button id="changePassBtn" class="btn btn-grey inner_page_btn">Update</button>
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
<?= $this->Html->css(array('jquery-ui')) ?>
<?= $this->Html->script(array('jquery-ui')) ?>
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
<script>
   function banner_image(){
   	
   	var manish = 1;	
   	var ext = $('#banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#bannerError').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		var CampaignAttachment = $('#banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#banner_file')[0].files[0]);
   		formData.append('model', 'Banners');
   		formData.append('oldImage', '');
   		$.ajax({
   			url: '<?php echo $this->Url->build('/images/saveImages'); ?>',
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
					
				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					return false;
   				}else{
   					$('#banner_img_preview').html('<img src="'+response.data.path + '"width="444"/>');
   					$('#banner').val(response.data.name);
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
   	var ext = $('#horizontal_banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#horizontal_bannerError').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		var CampaignAttachment = $('#horizontal_banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#horizontal_banner_file')[0].files[0]);
   		formData.append('model', 'Banners');
   		formData.append('oldImage', '');
   		$.ajax({
   			url: '<?php echo $this->Url->build('/images/saveImages'); ?>',
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
					
				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					return false;
   				}else{
   					$('#horizontal_img_preview').html('<img src="'+response.data.path + '"width="444"/>');
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
</script>
<script>
   function vertical_banner_image(){
   	
   	var manish = 1;	
   	var ext = $('#vertical_banner_file').val().split('.').pop().toLowerCase();
   
   	if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){
   		$('#vertical_bannerError').html('Only jpg, png, webp files are allowed.');
   		$('#Error500').modal('show');
   		manish = 0;
   		return false;
   	}
   	if(manish == 1){
   		var CampaignAttachment = $('#vertical_banner_file').val();
   		var formData = new FormData();
   		formData.append('Banners', $('#vertical_banner_file')[0].files[0]);
   		formData.append('model', 'Banners');
   		formData.append('oldImage', '');
   		$.ajax({
   			url: '<?php echo $this->Url->build('/images/saveImages'); ?>',
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
					
				}, false);
   				return xhr;
   			},
   			success:function(response){
   				if (response.data.msg == 'Error'){
   					return false;
   				}else{
   					$('#vertical_img_preview').html('<img src="'+response.data.path + '"width="320"/>');
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

$(document).ready(function(e) {

    $('#changePassBtn').click(function(e) {

		var nitam = 1;

		if($.trim($('#product_name').val()) == ''){
			$('#product_nameError').html('Please enter film title');
			$('#product_name').focus(); return false;
		}
		if($.trim($('#production_year').val()) == ''){
			$('#production_yearError').html('Please enter year');
			$('#production_year').focus(); return false;
		}
		if($.trim($('#language').val()) == ''){
			$('#languageError').html('Please enter language');
			$('#language').focus(); return false;
		}
		if($.trim($('#description').val()) == ''){
			$('#descriptionError').html('Please enter synopsis');
			$('#description').focus(); return false;
		}
		if($.trim($('#director').val()) == ''){
			$('#directorError').html('Please enter director');
			$('#director').focus(); return false;
		}
		if($.trim($('#producer').val()) == ''){
			$('#producerError').html('Please enter producer');
			$('#producer').focus(); return false;
		}
		if($.trim($('#keywords').val()) == ''){
			$('#keywordsError').html('Please enter cast');
			$('#keywords').focus(); return false;
		}
		if($.trim($('#trailer_video').val()) == ''){
			$('#trailer_videoError').html('Please enter trailer video link');
			$('#trailer_video').focus(); return false;
		}
		if($.trim($('#video').val()) == ''){
			$('#videoError').html('Please enter video link');
			$('#video').focus(); return false;
		}
		if(nitam == 1){
			$('#changePassBtn').html('Processing...');
			$('#changePassword').submit();
		}

    });

});

</script> 

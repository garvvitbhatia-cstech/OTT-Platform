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

         	<?php $type = 'Add'; if(isset($categories->id)){$type = 'Edit';} ?>

            <h2><?php echo $type; ?> Category</h2>

         </div>

      </div>

      <!-- /. ROW  -->      

      <?php

			echo $this->Html->link('Back',

				array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'categories'),

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

                  Category Details

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($categories,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        
                        <?php echo $this->Form->control('old_image',array(

								   'required'=>false,

								   'type'=>'hidden',

								   'value' => $categories['icon']

							   )

                           ); 								

                        ?>

                        <?php echo $this->Form->control('icon',array(

								   'required'=>false,

								   'type'=>'hidden',

								   'id'=>'icon'

							   )

                           ); 								

                        ?>

                        

                        <div class="form-group">

                           <?php echo $this->Form->control('name',array(

									  'placeholder'=>'Category Name',

									  'required'=>false,

									  'class'=>'form-control'

								  )

                              );

                            ?>

                        </div>
                        
                        <label>Poster Type</label>                        
                        <div class="form-group">
                        	<?php
								$posterTypes = array(
									'Vertical' => 'Vertical',
									'Horizontal' => 'Horizontal'
								);
							?>
                        	<?php echo $this->Form->select('poster_type',
									$posterTypes,
									['class'=>'form-control']
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

                                 if(!empty($categories['icon'])){

                                 	if(file_exists(WWW_ROOT.'img/categories/'.$categories['icon'])){

                                 		 echo $this->Html->image('categories/'.$categories['icon'], [

                                 			'alt'=>$categories['icon'],

                                 			'title' => $categories['icon'],

                                 			'width'=>'100']

                                 		);

                                 	}

                                 }

                              ?>

                           </div>

                        </div>                                   

                        <div class="form-group">

                           	<?php echo $this->Form->control('new_icon',array(

									  'type'=>'file',

									  'label'=>'Category Image (300 x 300)',

									  'id' => 'Categories',

									  'required'=>false,

									  'class'=>'form-control',

									  'onchange' => 'category_image()',

									  'accept'=>'.png,.jpg,.jpeg'

								  )								  

                              ); 

                            ?>

                            <div class="input-group">                         

                              	<input type="text" class="form-control" id="uploadFile" placeholder="Choose File" readonly="readonly"/>

                                <span class="form-group input-group-btn">

                                <label for="Categories" class="btn btn-default">                        	

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
                        
                        <div class="form-group">
                        
                                <label>Rent Label</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="rent_label" name="rent_label" <?php if($categories->rent_label == 1){ echo('checked'); } ?> value="1">Active
                                    </label>
                                </div>

                        </div>
                        
                        <div class="form-group">

                           <label>Live Label</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="live_label" name="live_label" <?php if($categories->live_label == 1){ echo('checked'); } ?> value="1">Active
                                    </label>
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

			'name': {

				required: true,

			}

		},

		messages: {

			'name': {

				required: "Please enter category name here.",

			}     

		},

		submitHandler: function(form){

				$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');

				$('#addForm').submit();

			

		}

	});

});



function category_image(){

	var manish = 1;

	$('#errorMsgPopUp').html('Something went wrong. Please try again.');

	$('.myprogress2').css('width', '0');

	$('.msg2').html('');	

	var ext = $('#Categories').val().split('.').pop().toLowerCase();



	if($.inArray(ext, ['jpeg', 'jpg', 'png']) == -1){

		$('#errorMsgPopUp').html('Only jpg, png files are allowed.');

		$('#Error500').modal('show');

		manish = 0;

		return false;

	}



	if(manish == 1){

		$('.excerpt_img').show();

		var CampaignAttachment = $('#Categories').val();

		$('#uploadFile').val(CampaignAttachment);

		var formData = new FormData();

		formData.append('Categories', $('#Categories')[0].files[0]);

		formData.append('model', 'Categories');

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

						$('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="100"/><div class="slider_action" style="width:200px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');

					}, 1000);

					$('#icon').val(response.data.name);

				}

			}

		});

	}

}

</script>



<!-- <script type="text/javascript">



	var uploadingType = 'New'; 

	function uploadVideo(){

		$('#CategoryVideoError').html("");

		var fileType = document.getElementById('CategoryVideo').files[0].type;	

		

		if(fileType != "video/mp4" && fileType != "video/MP4"){			

			$('#CategoryVideoError').html('Please choose mp4 video file');

			return false;	

		}

		$('#CategoryVideo').html('<a style="color:#ffffff; text-decoration:none;" onclick="canVideoUploading();"><strong>Cancel Uploading</strong></a>');

		

		$(".before_uploading").html('<div style="height:30px;width:100%;margin:45px auto;" class="progress progress progress-striped active"><div id="progress-bar" class="progress-bar active progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:0%; line-height:29px;">Uploading</div></div>').show();

		

			window.onbeforeunload = function() { return ''; }

		 

			var input = document.getElementById("CategoryVideo");

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



	function sendRequest() {

		var blob = document.getElementById('CategoryVideo').files[0];

		var BYTES_PER_CHUNK = 2097152; // 1MB chunk sizes. 10485760,5242880

		var SIZE = blob.size;

		var start = 0;

		var end = BYTES_PER_CHUNK;

		window.uploadcounter=0;

		window.uploadfilearray = [];

		$('#progress-bar').css("width","0%");

		document.getElementById('progress-bar').innerHTML = "Uploading";

		while( start < SIZE ) {



			var chunk = blob.slice(start, end);

			window.uploadfilearray[window.uploadcounter]=chunk;

			window.uploadcounter=window.uploadcounter+1;

			start = end;

			end = start + BYTES_PER_CHUNK;

		}

		window.uploadcounter=0;

		uploadFile(window.uploadfilearray[window.uploadcounter],document.getElementById('CategoryVideo').files[0].name);

		uploadingType = 'Old';

	}

	

	function fileSelected() {

		var file = document.getElementById('fileToUpload').files[0];

		if (file) {

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



	function uploadFile(blobFile,filename) {

		var fd = new FormData();

		fd.append("fileToUpload", blobFile);



		var xhr = new XMLHttpRequest();



		xhr.addEventListener("load", uploadComplete, false);

		xhr.addEventListener("error", uploadFailed, false);

		xhr.addEventListener("abort", uploadCanceled, false);		



		xhr.open("POST", "<?php echo $this->Url->build("/admins/ecommerce/uploadIntroVideo/");?>?filename="+filename+"&dir_name=category_video<?php echo $categories->id; ?>&uploadingType="+uploadingType);

		

		xhr.setRequestHeader('X-CSRF-Token', $('[name="csrfToken"]').attr('content'));

		

		xhr.onload = function(e){

			$('.uploadVideoFileBtn').hide();

			$('.cancelVideoFileBtn').show();

			$('.submitBtn').hide();

			var fileName = $('#CategoryVideo').val();

			var extFileName = fileName.substring(fileName.lastIndexOf('.') + 1);

			window.uploadcounter=window.uploadcounter+1;

			if (window.uploadfilearray.length > window.uploadcounter ){

				uploadFile(window.uploadfilearray[window.uploadcounter],document.getElementById('CategoryVideo').files[0].name); 

				var percentloaded2 = parseInt((window.uploadcounter/window.uploadfilearray.length)*100);

				$('#progress-bar').css("width",percentloaded2+"%");				

				if(percentloaded2 <= 95){

					document.getElementById('progress-bar').innerHTML = percentloaded2+'%';

				}

			}else{

				$('#progress-bar').css("width","100%");

				document.getElementById('progress-bar').innerHTML = "100%";

				var fileType = document.getElementById('CategoryVideo').files[0].type;

				if(fileType == "video/mp4" || fileType == "video/MP4"){

					window.onbeforeunload = null;

					//setTimeout(function(){ window.location.reload();},2000);

				}else{

					$('#choose_video').hide();

				}			

				if(document.getElementById('progress-bar').innerHTML == "100%"){

					setTimeout(function(){

						$('#uploadVideoFile').val('category_video<?php echo $categories->id; ?>'+'.'+extFileName);

						$('#addForm').submit();

					},5000);		

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



	function uploadFailed(evt) {

		alert("There was an error attempting to upload the file.");

	}



	function uploadCanceled(evt) {

		xhr.abort();

		xhr = null;

		//alert("The upload has been canceled by the user or the browser dropped the connection.");

	}

</script> -->
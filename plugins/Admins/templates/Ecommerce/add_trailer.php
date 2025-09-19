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

            <h2>Upload Trailer Video</h2>

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

                  Upload Video Trailer

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($products,array('id' => 'addForm','csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        
                        <div class="form-group">                           

                           <div class="before_uploading">                            

                           <?php if(isset($products['trailer_video']) && !empty($products['trailer_video'])){ ?>

                              <?php

                                 if(!empty($products['trailer_video'])){

                                 	if(file_exists(WWW_ROOT.'img/products/'.$products['trailer_video'])){

										$ext = explode('.',$products->trailer_video);

                               ?>

                                        <div class="panel-body">

                                            <video width="500" height="300" controls>

                                                <source src="<?php echo SITEURL.'img/products/'.$products->trailer_video; ?>" type="video/<?php echo $ext[1]; ?>">

                                            </video>

                                        </div>

                               <?php }}

                              ?>

                              <?php } ?>

                           </div>

                        </div>

                        <?php echo $this->Form->control('id',array('type'=>'hidden')); ?>

                        <?php echo $this->Form->control('trailer_video',array('required'=>false,'type'=>'hidden','id'=>'uploadVideoFile')); ?>

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
		$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
		$('#addForm').submit();
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

		xhr.open("POST", "<?php echo $this->Url->build("/admins/ecommerce/uploadIntroVideoProduct/");?>?filename="+filename+"&dir_name=products_trailer_video<?php echo $products->id; ?>&uploadingType="+uploadingType);
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

				}else{

					$('#choose_video').hide();

				}			

				if(document.getElementById('progress-bar').innerHTML == "100%"){

					$('#uploadVideoFile').val('products_trailer_video<?php echo $products->id; ?>'+'.'+extFileName);
					$('#progress-bar').css('background','#093');
					window.onbeforeunload = null;		

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


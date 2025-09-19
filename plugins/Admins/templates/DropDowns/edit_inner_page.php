<link rel="stylesheet" href="<?php echo $this->Url->build('/css/dropzone.css');?>"/>

<script type="text/javascript" src="<?php echo $this->Url->build('/js/dropzone/dropzone.js');?>"></script>

<link rel="stylesheet" href="<?php echo $this->Url->build('/css/sweet-alert.css');?>"/>

<script type="text/javascript" src="<?php echo $this->Url->build('/js/sweet-alert.min.js');?>"></script>

<style>

input[type="file"]{

    display: none;

}

</style>
<script src="https://www.cinemasthan.com/demo/ckeditor/ckeditor.js"></script>
<script src="https://www.cinemasthan.com/demo/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	//$('#description').ckeditor();
});
</script>
<div id="page-wrapper" >

  

   <div  id="page-inner">
   
    <?= $this->Flash->render() ?>

      <div class="row">

         <div class="col-md-12">

         	<?php $type = 'Add'; if(isset($page->id)){$type = 'Edit';} ?>

            <h2><?php echo $type; ?> Inner Page</h2>

         </div>

      </div>

      <!-- /. ROW  -->      

      <?php

			echo $this->Html->link('Back',

				array('plugin' => 'Admins', 'controller' => 'drop-downs', 'action' => 'inner-pages'),

				array('escape' => false, 'class' => "btn btn-primary",'type'=>"button")

			);

		?>

      <hr />	        

      <div class="row">

         <div class="col-md-12">

            <!-- Form Elements -->

            <div class="panel panel-default">

               <div class="panel-heading">

                  Inner Page Details

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-12">

                        <?php echo $this->Form->create($page,array('id' => 'addForm','csrfToken' => $this->request->getAttribute('csrfToken'))); ?>

                        <?php echo $this->Form->control('old_image',array( 'required'=>false,'type'=>'hidden','value' => $page['banner']));?>
                        <?php echo $this->Form->control('type',array( 'required'=>false,'type'=>'hidden','value' => $page['type']));?>
                        <?php echo $this->Form->control('banner',array('required'=>false,'type'=>'hidden')); ?>
                        <div class="form-group">
                           	<?php echo $this->Form->control('title',array('onkeyup' =>'setSeoTitle(this.value);', 'placeholder'=>'Enter Title','required'=>false,'class'=>'form-control'));?>
                        </div>
                        <?php if($page['type'] == 'Media'){?>
                        <div class="form-group">                            	
                            <label>Category</label>
                            <select style="height:325px;" name="category_id[]" id="category_id" multiple="multiple" confirmation="false" class="form-control">
                            	<?php echo $this->Ecommerce->getAllCategory($page['category_id'],$page->id); ?>
                            </select>
                        </div>
                        <?php } ?>

                        <div class="form-group">

                           	<?php echo $this->Form->control('description',array('placeholder'=>'Enter Description','required'=>false,'type'=>'textarea','rows' => 20,'class'=>'form-control'));?>

                        </div>

                        <div class="form-group">

                            <?php echo $this->Form->control('heading',array('placeholder'=>'Enter Heading','required'=>false,'class'=>'form-control'));?>

                        </div>

                        <div class="form-group">

                            <?php echo $this->Form->control('sub_heading',array('placeholder'=>'Enter Sub Heading','required'=>false,'class'=>'form-control'));?>

                        </div>

                        <div class="form-group">

                           <div class="panel-body excerpt_img" style="display:none;">

                              <div class="progress progress-striped active" role="progressbar">

                                 <div class="progress-bar progress-bar-primary myprogress2" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</span></div>

                              </div>

                           </div>

                           <div class="msg2">                            

                              <?php

                                 if(!empty($page['banner'])){

                                  if(file_exists(WWW_ROOT.'img/banners/'.$page['banner'])){

                                    echo $this->Html->image('banners/'.$page['banner'], [

                                      'alt'=>$page['banner'],

                                      'title' => $page['banner'],

                                      'width'=>'300']

                                    );

                                  }

                                 }

                                 ?>

                           </div>

                        </div>                                               

                        <div class="form-group">

                            <?php echo $this->Form->control('new_profile',array(

									'type'=>'file',

									'label'=>'Banner (1920 x 840)',

									'id' => 'PageBanner',

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

                                <label for="PageBanner" class="btn btn-default">                         

                                    <i class="fa fa-cloud-upload"></i> Browse

                                </label>

                              </span>

                            </div>

                        </div>  

                       

                        <label>Banner Status</label>

                        <div class="form-group">

                           <?php echo $this->Form->control('banner_status',array(

									  'required'=>false,

									  'label'=>'Active',

									  'type'=>'checkbox',

									  'value' => 1,

								  )

                              ); 

                           ?>

                        </div>

                        <div class="form-group">

                            <?php echo $this->Form->control('seo_title',array(

									'placeholder'=>'Enter SEO Title',

									'required'=>false,

									'class'=>'form-control'

								  )

                              );

                            ?>

                        </div>

                        <div class="form-group">

                            <?php echo $this->Form->control('seo_description',array(

									'placeholder'=>'Enter SEO Description',

									'required'=>false,

									'type'=>'textarea',

									'class'=>'form-control'

								  )

                              );

                            ?>

                        </div>

                        <div class="form-group">

                            <?php echo $this->Form->control('seo_keyword',array(

									'placeholder'=>'Enter SEO Keywords',

									'required'=>false,

									'type'=>'textarea',

									'class'=>'form-control'

								  )

                              );

                            ?>

                        </div>

                        <div class="form-group">

                          <?php

                            $options = [

                                'index, follow' => 'index, follow',

                                'index, nofollow' => 'index, nofollow',

                                'noindex, follow' => 'noindex, follow',

                                'noindex, nofollow' => 'noindex, nofollow'

                              ];

                          ?>

                           <?php echo $this->Form->control('robot_tags',array(

									'required'=>false,

									'options' => $options,

									'label' => 'Seo Robots',

									'class'=>'form-control'

								  )

                              );

                            ?>

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

                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh"></i> Submit</button>

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



<script type="text/javascript">



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

					required: "Please enter title.",

				}

				

			},

			submitHandler: function(form){

				$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');

				$('#addForm').submit();

			}

		});

	});



  function profile_image(){

  var manish = 1;

  $('#errorMsgPopUp').html('Something went wrong. Please try again.');

  $('.myprogress2').css('width', '0');

  $('.msg2').html('');  

  var ext = $('#PageBanner').val().split('.').pop().toLowerCase();


  if($.inArray(ext, ['jpeg', 'jpg', 'png', 'webp']) == -1){

    $('#errorMsgPopUp').html('Only jpg, png, webp files are allowed.');

    $('#Error500').modal('show');

    manish = 0;

    return false;

  }



  if(manish == 1){

    $('.excerpt_img').show();

    var CampaignAttachment = $('#PageBanner').val();

    $('#uploadFile').val(CampaignAttachment);

    

    var formData = new FormData();

    formData.append('PageBanner', $('#PageBanner')[0].files[0]);

    formData.append('model', 'InnerPages');

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

        if(response.data.msg == 'Error'){

          $('.excerpt_img').hide();

          $('#Error500').modal('show');

          return false;

        }else{

          setTimeout(function(){

            $('.excerpt_img').hide();

            $('.msg2').html('<div style="margin-bottom:10px;"><img src="'+response.data.path + '"width="300"/><div class="slider_action" style="width:300px;padding-top:10px; display:block;"><div class="clear"></div></div></div>');

          }, 1000);

          $('#banner').val(response.data.name);

        }

      }

    });

  }

}
function setSeoTitle(title){
	<?php if($page['type'] == 'Media'){?>
	var seoTitle = 'Watch '+title+' Movie Online |  '+title+' Movie Online | '+title+' Movie ';
	$('#seo-title').val(seoTitle);
	$('#seo-keywords').val(seoTitle);
	$('#seo-description').val(seoTitle);
	<?php } ?>
}
</script>



	


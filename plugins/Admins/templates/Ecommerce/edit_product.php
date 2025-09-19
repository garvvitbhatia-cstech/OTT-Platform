<?php

#set page meta content

$this->assign('title', SITE_TITLE.' :: Edit Media');

$this->assign('meta_robot', 'noindex, nofollow');

?>

<link rel="stylesheet" href="<?php e($this->Url->build('/admin/css/sweet-alert.css'));?>"/>

<script type="text/javascript" src="<?php e($this->Url->build('/admin/js/sweet-alert.min.js'));?>"></script>

<link rel="stylesheet" href="<?php e($this->Url->build('/admin/css/dropzone.css'));?>"/>

<script type="text/javascript" src="<?php e($this->Url->build('/admin/js/dropzone.js'));?>"></script>

<!--  page-wrapper -->

<div id="page-wrapper">

    <div class="row">

        <!-- page header -->

        <div class="col-lg-12">

            <h1 class="page-header">Edit Media Details</h1>

        </div>

        <!--end page header -->

    </div>

    <div class="row">

        <div class="col-lg-12">

            <a href="<?php e($this->Url->build(ADMIN_FOLDER.'product-management'.'/'));?>" class="btn btn-info">Back To Listing</a><br />&nbsp;

        </div>

        <div class="col-lg-12">

            <!-- Form Elements -->

            <?php e($this->Flash->render()); ?>

            <div class="panel panel-default">

                <div class="panel-heading">

                    Edit product information

                </div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-lg-6">

                            <?= $this->Form->create(NULL,array('id' => 'editForm', 'type' => 'file', 'inputDefaults' => array('label' => false,'div' => false), 'name' => 'editForm', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>

                            <input type="hidden" name="edit_token" id="edit_token" value="<?php e($this->encryptData($editData->id))?>">

                            <div class="form-group">                            	

                                <label>Category Name</label>

                                <select name="category_id" id="category_id" onchange="checkError(this.id);" confirmation="false" class="form-control">

                                	<?php e($this->Ecommerce->getAllCategory($editData->category_id)); ?>

                                </select>

                                <span id="category_idError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Product Name:</label>

                                <input type="text" id="product_name" name="product_name" value="<?php e($editData->product_name); ?>" onkeyup="checkError(this.id);" confirmation="false" class="form-control">

                                <span id="product_nameError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Product Price:</label>

                                <input type="text" id="price" maxlength="8" name="price" onkeyup="checkError(this.id);" value="<?php e($editData->price); ?>" confirmation="false" class="form-control">

                                <span id="priceError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Quantity</label>

                                <input type="text" name="quantity" id="quantity" value="<?php e($editData->quantity); ?>" onkeyup="checkError(this.id);" confirmation="false"  class="form-control"> 

                                <span id="quantityError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Product Description</label>

                                <textarea name="description" id="description" onkeyup="checkError(this.id);" rows="10" class="form-control" ><?php e($editData->description); ?></textarea>

                                <span id="descriptionError" class="admin_login_error"></span>

                            </div> 

                            <div class="form-group">

                                <label>Seo Title</label>

                                <input type="text" name="seo_title" id="seo_title" value="<?php e($editData->seo_title); ?>" onkeyup="checkError(this.id);" class="form-control" /> 

                                <span id="seo_titleError" class="admin_login_error"></span>

                            </div> 

                            <div class="form-group">

                                <label>Seo Keywords</label>

                                <input type="text" name="seo_keywords" id="seo_keywords" value="<?php e($editData->seo_keywords); ?>" onkeyup="checkError(this.id);" class="form-control" /> 

                                <span id="seo_keywordsError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Seo Description</label>

                                <textarea name="seo_description" id="seo_description" onkeyup="checkError(this.id);" rows="5" class="form-control" ><?php e(nl2br($editData->seo_description)); ?></textarea>

                                <span id="seo_descriptionError" class="admin_login_error"></span>

                            </div>

                            <div class="form-group">

                                <label>Seo Robot Tags</label> 

                                <select name="robot_tags" id="robot_tags" onkeyup="checkError(this.id);" class="form-control">

                                    <option <?php if($editData->robot_tags == 'index,follow'){e('selected');} ?> value="index,follow">index,follow</option>

                                    <option <?php if($editData->robot_tags == 'noindex,follow'){e('selected');} ?> value="noindex,follow">noindex,follow</option>

                                    <option <?php if($editData->robot_tags == 'noindex,nofollow'){e('selected');} ?> value="noindex,nofollow">noindex,nofollow</option>

                         		</select>

                            </div>

                            <div class="form-group">

                            	<label>Product Images</label>

                                <div id="my-awesome-dropzone" class="dropzone"></div>

                            </div>

                            <div class="form-group">

                            <hr>

                                <?php if(isset($productImages) && !empty($productImages)){ ?>

                                    <?php foreach($productImages as $key => $val): ?>

                                        <?php

                                            if(!empty($val->image_name)){

                                            $imgPath = WWW_ROOT.'img/products/'.$val->image_name;

                                            if(is_file($imgPath) && file_exists(WWW_ROOT.'img/products/'.$val->image_name)){

											e($this->Html->image('products/'.$val->image_name, array('class' => 'img-rounded', 'title'=>$val->image_title, 'alt'=> $val->image_alt, 'width' => '100','style' => 'margin: 3px 3px 40px 7px;max-width: 100%;height: auto;')));										

                                            ?>                                            

                                            <a class="btn btn-danger" title="Remove Product Image" href="javascript:void(0);" style="margin: -8px 8px 119px -42px" aria-label="Delete" onClick="removeProductImage('<?php e($this->encryptData($val->id)); ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                            <input type="text" name="ordering[]" id="" placeholder="ordering" class="ordering" value="<?php e($val->ordering); ?>" style="width: 90px;max-width: 100%;height: auto;margin: 105px 0px 0px -107px;position: absolute;"/>

                                            <input type="hidden" name="orderingEditId[]" value="<?php e($val->id); ?>"/>

                                    <?php } ?>

                                    <?php } endforeach; ?>

                                <?php } ?>

                            </div>

                            <div class="form-group">

                                <label>Status</label>

                                <div class="checkbox">

                                    <label>

                                        <input type="checkbox" checked="checked" value="1" name="status">Active

                                    </label>

                                </div>

                            </div>

                            <button type="button" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>

                            <?= $this->Form->end(); ?>

                        </div>

                    </div>

                </div>

            </div>

            <!-- End Form Elements -->

            <a href="<?php e($this->Url->build(ADMIN_FOLDER.'product-management'.'/'));?>" class="btn btn-info">Back To Listing</a>

        </div>

    </div>

</div>





<script type="text/javascript">

    var frmSubmitted = 0;

	$('#price').filter_input({regex:'[0-9.]'});

	$('#discount').filter_input({regex:'[0-9.]'});

	$('.ordering').filter_input({regex:'[0-9]'});

	

    $('.submitBtn').click(function(){

        var flag = 0;

        if(frmSubmitted == 0){

			if($.trim($('#product_name').val()) == ""){

                $('#product_nameError').show().html('Please enter product name.').slideDown();

                $('#product_name').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#price').val()) == ""){

                $('#priceError').show().html('Please enter product price.').slideDown();

                $('#price').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#description').val()) == ""){

                $('#long_descriptionError').show().html('Please enter long description.').slideDown();

                $('#long_description').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#description').val()) == ""){

                $('#long_descriptionError').show().html('Please enter long description.').slideDown();

                $('#long_description').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#seo_title').val()) == ""){

                $('#seo_titleError').show().html('Please enter seo title.').slideDown();

                $('#seo_title').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#seo_keywords').val()) == ""){

                $('#seo_keywordsError').show().html('Please enter seo keywords.').slideDown();

                $('#seo_keywords').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

			if($.trim($('#seo_description').val()) == ""){

                $('#seo_descriptionError').show().html('Please enter seo description.').slideDown();

                $('#seo_description').focus();

                frmSubmitted = 0;

                flag = 1; return false;

            }

            if(flag == 0){

                $('.submitBtn').html('Processing...');

                $('#editForm').submit();

                frmSubmitted = 1;

                return true;

            }

        }else{

            return false;

        }

    });

</script>



<script type = "text/javascript" >

    /**************delete banner image*****************/

    function removeProductImage(rowId){

        if (rowId != '') {

            swal({

				title: "Do you want to delete this product image?",

				text: "",

				type: "warning",

				showCancelButton: true,

				confirmButtonColor: '#DD6B55',

				cancelButtonText: "No",

				confirmButtonText: 'Yes',

				closeOnConfirm: false,

				closeOnCancel: false

			},

			function(isConfirm) {

				if (isConfirm) {

					swal("Deleted!", "", "success");

					$.ajax({

						type: 'POST',

						url: '<?php e($this->Url->build('/ecommerce/deleteProductImage'));?>',

						data: {rowId: rowId},

						success: function(msg) {

							window.location.reload(true);

						},

						error: function(ts) {

							$('#error500').modal('show');

						}

					})

				} else {

					swal("Cancelled", "", "error");

				}

			});

        }

    }





    $('#my-awesome-dropzone').attr('class', 'dropzone');

    var myDropzone = new Dropzone('#my-awesome-dropzone', {

        url: '<?php e($this->Url->build('/ecommerce/uploadProductImages'));?>',

        clickable: true,

        method: 'POST',

        maxFiles: 50,

        parallelUploads: 50,

        maxFilesize: 20,

        addRemoveLinks: false,

        dictRemoveFile: 'Remove',

        dictCancelUpload: 'Cancel',

        dictCancelUploadConfirmation: 'Confirm cancel?',

        dictDefaultMessage: 'Drop files here to upload',

        dictFallbackMessage: 'Your browser does not support drag n drop file uploads',

        dictFallbackText: 'Please use the fallback form below to upload your files like in the olden days',

        paramName: 'file',

        params: {'pid':'<?php e($editData->id); ?>'},

        forceFallback: false,

        createImageThumbnails: true,

        maxThumbnailFilesize: 5,

        acceptedFiles: ".jpeg,.jpg",

        //acceptedFiles: "image/*",

        autoProcessQueue: true,

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')

        },

        init: function() {

            this.on('thumbnail', function(file) {

                if (file.width < 500 || file.height < 500) {

                    file.rejectDimensions();

                } else {

                    file.acceptDimensions();

                }

            });

        },

        accept: function(file, done) {

            file.acceptDimensions = done;

            file.rejectDimensions = function() {

                done('The image must be at least 500 x 500px')

            };

        }

    });

    

    myDropzone.on("complete", function(file) {

        var status = file.status;

        if (status == 'success') {

    

        }

        console.log(file);

    });

    

    var count = 1;

    myDropzone.on("success", function(file, responseText) {

        var fnamenew = file.name;

        count++;

    });

    

    myDropzone.on("removedfile", function(file) {

        var fname = file.name;

        fname2 = fname.trim().replace(/["~!@#$%^&*\(\)_+=`{}\[\]\|\\:;'<>,.\/?"\- \t\r\n]+/g, '_');    

    });

    

    myDropzone.on("addedfile", function(file) {

    

    }); 

</script>
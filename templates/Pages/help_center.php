<?php
$session = $this->request->getSession();
if(isset($pageData->seo_title)){

    #set page meta content
    $this->assign('title', $pageData->seo_title);
    $this->assign('meta_keywords', $pageData->seo_keyword);
    $this->assign('meta_description', $pageData->seo_description);
    $this->assign('meta_robot', $pageData->robot_tags);
}
?>

<style>

.help_input{background: #0F0F1C;

    border: 1px solid #bbb;

    padding: 10px;

    color: #fff;

    width: 100%;

    border-radius: 4px;}

	.help_input_div{ margin-bottom:22px;}



.form_error_msg{font-size: 13px;

    margin-top: 8px;}

.message.error{border: 1px solid #f00;

    margin-bottom: 25px;

    color: #f00;}

.message.success{border: 1px solid #FFF;

    margin-bottom: 25px;

    color: #FFF;}	

</style>

<div _ngcontent-ytn-c55="" class="ott-main-body has-header">



<router-outlet _ngcontent-ytn-c55=""></router-outlet>



<app-packages _nghost-ytn-c61="" class="ng-star-inserted">



  <div _ngcontent-ytn-c61="">



    <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">



      



      <?php if(isset($pageData->heading) && $pageData->status == 1){?><h2 _ngcontent-ytn-c61="" class="ng-star-inserted"><?php echo $pageData->heading;?></h2><?php } ?>



      <div _ngcontent-ytn-c61="" class="package_inner">

      

      <?php echo($this->Flash->render()); ?>

      

		<?= $this->Form->create(NULL,array('id' => 'helpCenterForm', 'action' => SITEURL.'save-help-center', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>

        <div style="text-align:justify; padding:25px; border:1px solid #bbb;">

		

        <div class="help_input_div">

        <label>Your Name</label>
		<?php if($session->check('LoginUser.id') && $session->read('LoginUser.name') != ""){?>
        <input type="text" id="name" name="name" readonly="readonly" value="<?php echo $session->read('LoginUser.name'); ?>" onkeyup="$('#nameError').html('');" class="help_input" />
        <?php }else{ ?>
        <input type="text" id="name" name="name" onkeyup="$('#nameError').html('');" class="help_input" />
        <?php } ?>

        <span class="form_error_msg" id="nameError"></span>

        </div>

        <div class="help_input_div">

        <label>Email Address</label>
		<?php if($session->check('LoginUser.id') && $session->read('LoginUser.email') != ""){?>
        <input type="text" id="email" name="email" readonly="readonly" value="<?php echo $session->read('LoginUser.email'); ?>" onkeyup="$('#emailError').html('');" class="help_input" />
        <?php }else{ ?>
        <input type="text" id="email" name="email" onkeyup="$('#emailError').html('');" class="help_input" />
        <?php } ?>

        <span class="form_error_msg" id="emailError"></span>

        </div>

        

        <div class="help_input_div">

        <label>Mobile Number</label>
		<?php if($session->check('LoginUser.id') && $session->read('LoginUser.contact') != ""){?>
        <input type="tel" id="mobile" name="mobile" readonly="readonly" value="<?php echo $session->read('LoginUser.contact'); ?>" maxlength="10" onkeyup="$('#mobileError').html('');" class="help_input" />
        <?php }else{ ?>
        <input type="tel" id="mobile" name="mobile" maxlength="10" onkeyup="$('#mobileError').html('');" class="help_input" />
        <?php } ?>
        

        <span class="form_error_msg" id="mobileError"></span>

        </div>

        

        <div class="help_input_div">

        <label>What Can We Help You With</label>

        <input type="text" id="what_can_help" name="what_can_help" onkeyup="$('#what_can_helpError').html('');" class="help_input" />

        <span class="form_error_msg" id="what_can_helpError"></span>

        </div>

        

        <div class="help_input_div">

        <label>Description</label>

        <textarea class="help_input" id="description" name="description" onkeyup="$('#descriptionError').html('');" rows="6"></textarea>

        <span class="form_error_msg" id="descriptionError"></span>

        </div>

        

        <div class="help_input_div">

        <a style="margin-left:0px; cursor:pointer" class="sign_up" id="helpCenterSubmitBtn"> Submit </a>

        </div>

        

        <div class="help_input_div">

        <?php if(isset($pageData->description) && $pageData->status == 1){?><p><?php echo nl2br($pageData->description);?></p><?php } ?>

        </div>

        

        



        </div>

        <?= $this->Form->end(); ?>



      </div>



    </div>



   </div>



  </app-packages>



</div>

<script>

$(document).ready(function(e) {

	$('#helpCenterSubmitBtn').click(function(e){

		var nitam = 1;

		 if($.trim($('#name').val()) == ''){

			$('#nameError').html('Please enter your name');

			$('#name').focus(); nitam = 0; return false;

		}

		if($.trim($('#email').val()) == ''){

			$('#emailError').html('Please enter email address');

			$('#email').focus(); nitam = 0; return false;

		}else{

			var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if(!filter.test($('#email').val())){

				$('#emailError').html('Please enter valid email address');

				$('#email').focus(); nitam = 0; return false;   

			}  

		}

		if($.trim($('#mobile').val()) == ''){

			$('#mobileError').html('Please enter your mobile number');

			$('#mobile').focus(); nitam = 0; return false;

		}else{

			var mobile = $('#mobile').val();

			if(mobile.length < 10){

				$('#mobileError').html('Please enter valid mobile number');

				$('#mobile').focus(); nitam = 0; return false;   

			}  

		}

		if($.trim($('#what_can_help').val()) == ''){

			$('#what_can_helpError').html('Please enter subject');

			$('#what_can_help').focus(); nitam = 0; return false;

		}

		if($.trim($('#description').val()) == ''){

			$('#descriptionError').html('Please enter description');

			$('#description').focus(); nitam = 0; return false;

		}

		if(nitam == 1){

			$('#helpCenterSubmitBtn').html('Processing...');

			$('#helpCenterForm').submit();

		}

	});

});

</script>
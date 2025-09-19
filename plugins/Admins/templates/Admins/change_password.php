<div id="page-wrapper" >
   <?= $this->Flash->render() ?>
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Change Password</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
         </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-heading">
                  Password Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($user,array('csrfToken' => $this->request->getAttribute('csrfToken'),'id' => 'changePasswordForm')); ?>
                        <input type="hidden" id="passToken" value="1">
                        <div class="form-group">
                           <?php echo $this->Form->control('password',array(
									  'placeholder'=>'Old Password',
									  'type'=>'text',
									  'label'=>'Old Password',
									  'required'=>false,
									  'class'=>'form-control',
									  'onblur'=>'checkPassword(this.value)'
								  )
                              );
                            ?>                        	
                        	<div id="myProgress" style="display:block;">
                                <div id="myBar"></div>
                            </div>
                            <div class="error-message" id="passwordError"><?php if(isset($errors['password']['_empty'])){echo $errors['password']['_empty']; } ?></div>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('new_password',array(
									  'placeholder'=>'New Password',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              ); 
                            ?>
                            <div class="error-message">
								<?php if(isset($errors['new_password']['_empty'])){echo $errors['new_password']['_empty']; } ?>
                                <?php if(isset($errors['new_password']['length'])){echo $errors['new_password']['length']; } ?>
                                <?php if(isset($errors['new_password']['strongPassword'])){echo $errors['new_password']['strongPassword']; } ?>
                            </div>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('confirm_password',array(
									  'placeholder'=>'Confirm New Password',
									  'type'=>'text',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              ); 
                           ?>
                           <div class="error-message">
						   		<?php if(isset($errors['confirm_password']['_empty'])){echo $errors['confirm_password']['_empty']; } ?>
                                <?php if(isset($errors['confirm_password']['comparison'])){echo $errors['confirm_password']['comparison']; } ?>
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
	
	$("#changePasswordForm").validate({
		errorElement: "div",
		rules: {
			'password': {
				required: true,
			},
			'new_password': {
				required: true,
			},
			'confirm_password': {
				required: true,
				equalTo: '#new-password'
			}
		},
		messages: {
			'password': {
				required: "Please enter old password.",
			},
			'new_password': {
				required: "Please enter new password.",
			},
			'confirm_password': {
				required: "Please enter confirm password.",
				equalTo: "Confirm password must be equal to new password.",
			}     
		},
		submitHandler: function(form){
			if($('#passToken').val() == 1){
				$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
				$('#changePasswordForm').submit();
			}else{
				return false;
			}
		}
	}); 

});
 

function checkPassword(password){
	$('#passwordError').html('');
	if(password != ''){
		$('#myProgress').show();
		$('#myBar').css("background-color","#F0AD4E").animate({"width":"100%"}, 500, function(){
			$.ajax({
				url: '<?php echo $this->Url->build('/admins/admins/checkPassword'); ?>',
				data: {password:password},
				type: 'POST',
				dataType: 'JSON',
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
				},
				success:function(response){
					if(response.msg == 'NotMatch'){
						$('#passwordError').html('Current password is wrong.');
						$('#passToken').val(0);
						$('#password').focus();
						return false;	
					}else{
						$('#passToken').val(1);	
					}
				}				
			});
			$('#myBar').animate({width: '0'});
			$('#myProgress').hide();
		});
	}else{
		return true;	
	}
}
</script>
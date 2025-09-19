<div id="page-wrapper" >
   <?= $this->Flash->render() ?>
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <?php $type = 'Add'; if(isset($coupon->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Coupon Code</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
        	echo $this->Html->link('Back',         
         		array('plugin' => 'Admins', 'controller' => 'CouponCodes', 'action' => 'index'),
         		array('escape' => false, 'class' => "btn btn-primary",'type'=>"button")
         );         
  		?>
      <hr />
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-heading">
                  Coupon Code Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($coupon,array('id' => 'addForm','csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <div class="form-group">
                           	<?php echo $this->Form->control('package', array(
																'empty'=>'Select Package',
																'label'=>'Package',
																'options'=>$packages,
															  	'placeholder'=>'Choose Package',
															  	'required'=>false,															  
															  	'class'=>'form-control',
														  	)
                                                 		);
                            ?>
                        </div>
                        <div class="form-group">                        
                           	<?php echo $this->Form->control('title',array(
													  'placeholder'=>'Enter Coupon Title',
													  'required'=>false,
													  'class'=>'form-control',
													  'maxlength'=>8,
													  'style'=>'text-transform: uppercase;'
													  )             
                                                 	);
                     		?>
                        </div>
                        <div class="form-group">
                        	<?php $couponType = ['Amount'=>'Amount','Percent'=>'Percent']; ?>
                           	<?php echo $this->Form->control('type', array(
																'label'=>'Coupon Type',
																'options'=>$couponType,
															  	'placeholder'=>'Choose Coupon Type',
															  	'required'=>false,															  
															  	'class'=>'form-control',
														  	)
                                                 		);
                            ?>
                        </div>
                        <div class="form-group">
                           	<?php echo $this->Form->control('value',array(
												  'placeholder'=>'Enter Coupon Value',
												  'required'=>false,
												  'class'=>'form-control number',
												  'maxlength'=>6
											  	)
                                        	);                              
                            ?>
                        </div>
                        <div class="form-group">
                           	<?php echo $this->Form->control('expiry_date',array(
												  'placeholder'=>'Enter Coupon Expiry Date',
												  'required'=>false,
												  'class'=>'form-control',
												  'value'=>($coupon['expiry_date']?date('d/m/Y',$coupon['expiry_date']):'')
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

<?= $this->Html->css(array('jquery-ui')) ?>
<?= $this->Html->script(array('jquery-ui')) ?>

<script>
	var dateToday = new Date(); 

  $( function() {
    $( "#expiry-date" ).datepicker({
        minDate: dateToday
    });
  } );
  </script>

<script type="text/javascript">
	$(document).on('click', '#submitForm',function(){
		$("#addForm").validate({
			errorElement: "div",
			rules: {
				'package': {
					required: true,
				},
				'title': {
					required: true,
				},
				'param': {
					required: true,
				},
				'link': {
					required: true,
				}
			},
			messages: {
				'package': {
					required: "Please select package.",
				},
				'title': {
					required: "Please enter title here.",
				},
				'param': {
					required: "Please enter param name here.",
				},
				'link': {
					required: "Please enter link here.",
				}  
			},

			submitHandler: function(form){
				$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');
				$('#addForm').submit();
			}
		});

	});
</script>
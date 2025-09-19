<div id="page-wrapper" >
   <?= $this->Flash->render() ?>
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <?php $type = 'Add'; if(isset($navigation->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Header Navigation</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
        	echo $this->Html->link('Back',         
         		array('plugin' => 'Admins', 'controller' => 'drop-downs', 'action' => 'headerNavigations'),
         		array('escape' => false, 'class' => "btn btn-primary",'type'=>"button")
         );         
  		?>
      <hr />
      <div class="row">
         <div class="col-md-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
               <div class="panel-heading">
                  Header Navigation Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($navigation,array('id' => 'addForm','csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <div class="form-group">
                           	<?php echo $this->Form->control('title',array(
													  'placeholder'=>'Enter Title',
													  'required'=>false,
													  'class'=>'form-control'												  
													  )             
                                                 	);
                     		?>
                        </div>
                        <div class="form-group">
                           	<?php echo $this->Form->control('param',array(
													  'placeholder'=>'Enter Param',
													  'required'=>false,
													  'class'=>'form-control'
													  )
                                                 );
                            ?>
                        </div>
                        <div class="form-group">
                           	<?php echo $this->Form->control('link',array(
												  'placeholder'=>'Enter Link',
												  'required'=>false,
												  'class'=>'form-control',
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
				},
				'param': {
					required: true,
				},
				'link': {
					required: true,
				}
			},
			messages: {
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
<div id="page-wrapper" >
   <?= $this->Flash->render() ?>
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
         	<?php $type = 'Add'; if(isset($cities->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> City</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
         </div>
      </div>
      <!-- /. ROW  -->      
      <?php
			echo $this->Html->link('Back',
				array('plugin' => 'Admins', 'controller' => 'Locations', 'action' => 'cities'),
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
                  City Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($cities,array('csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        <div class="form-group">
                           <?php echo $this->Form->control('country_id',array(
									  'required'=>false,
									  'options' => $countryList,
									  'label' => 'Country',
									  'class'=>'form-control'
								  )
                              );
                            ?>
                        </div>
                        <div class="form-group">
                        	<?php 
								$state = array('Select State');
								if(isset($cities->country_id)){
									$stateData = new BasicFunctions();
									$state = $stateData->getStateByCountryId($cities->country_id);
								}
							?>
                           <?php echo $this->Form->control('state_id',array(
									  'required'=>false,
									  'options' => $state,
									  'label' => 'State',
									  'class'=>'form-control'
								  )
                              );
                            ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('city',array(
									  'placeholder'=>'City',
									  'label'=>'City',
									  'required'=>false,
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
	$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');	
});
</script>
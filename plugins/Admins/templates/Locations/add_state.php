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
         	<?php $type = 'Add'; if(isset($states->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> State</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
         </div>
      </div>
      <!-- /. ROW  -->      
      <?php
			echo $this->Html->link('Back',
				array('plugin' => 'Admins', 'controller' => 'Locations', 'action' => 'states'),
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
                  State Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($states,array('csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
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
                           <?php echo $this->Form->control('state',array(
									  'placeholder'=>'State',
									  'required'=>false,
									  'class'=>'form-control'
								  )
                              ); 
                            ?>
                        </div>
                        <div class="form-group">
                           <?php echo $this->Form->control('abbreviation',array(
									  'placeholder'=>'Abbreviation',
									  'label'=>'Abbreviation',
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
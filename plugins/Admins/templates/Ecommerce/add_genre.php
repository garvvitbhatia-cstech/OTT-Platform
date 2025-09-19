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
            <?php $type = 'Add'; if(isset($genre->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Genre</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
         echo $this->Html->link('Back',         
         	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'generes'),         
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
                  Generes Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($genre,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('title',array(
													  'placeholder'=>'Genere Title',													  
													  'required'=>false,													  
													  'class'=>'form-control title'													  
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
      	  
   	$("#addForm").validate({   
   		errorElement: "div",   
   		rules: {   
   			'title': {   
   				required: true,   
   			}  
   		},   
   		messages: {   
   			'title': {   
   				required: "Please enter genere name here.",
   			}        
   		},   
   		submitHandler: function(form){   
			$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');   
			$('#addForm').submit();     			   
   		}   
   	});
	
	   
   });
   </script>
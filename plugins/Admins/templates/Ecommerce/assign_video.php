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
            <h2> Assign Video</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
         echo $this->Html->link('Back',         
         	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'products'),         
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
                  Assign Video Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create(NULL,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        
                            <div class="form-group">
                            <div class="input text">
                            <label for="title">Video Name</label>
                            <input type="text" value="<?php echo $videoDetails->product_name;?>" class="form-control title">
                            </div>                        
                            </div>
                            
                            <div class="form-group">
                            <label for="title">Assigned To</label>
                            <div class="input text">
                            <?php 
							  if($videoDetails->added_by > 0){
								  $userData = $this->User->getSingleRecord($videoDetails->added_by);
								  echo '<b>Name: </b>'.$userData->name;
								  echo '<br>';
								  echo '<b>Email: </b>'.$userData->email;
							  }else{
								 echo 'Admin'; 
							  }
							  ?>
                            </div>                        
                            </div>
                            
                            <div class="form-group">
                            <div class="input text">
                            <label for="title">User Email Address</label>
                            <input type="text" name="email" class="form-control title" id="email">
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
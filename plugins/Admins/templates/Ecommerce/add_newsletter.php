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
            <?php $type = 'Add'; if(isset($news->id)){$type = 'Edit';} ?>
            <h2><?php echo $type; ?> Newsletter User</h2>
         </div>
      </div>
      <!-- /. ROW  -->      
      	<?php
         echo $this->Html->link('Back',         
         	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'newsletters'),         
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
                  Newsletter Details
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-6">
                        <?php echo $this->Form->create($news,array('id' => 'addForm', 'csrfToken' => $this->request->getAttribute('csrfToken'))); ?>
                        
                        <div class="form-group">
                           <?php echo $this->Form->control('email',array(
													  'placeholder'=>'Email Address',
													  'type' =>'textarea',
													  'onkeyup' => "$('#emailError').hide();",
													  'label' => 'Email (You can put multiple email addresses with comma(,) separated)',													
													  'required'=>false,													  
													  'class'=>'form-control title'													  
													  )                              
                                                 );                              
                                               ?>
                                               <span id="emailError" style="display:none; color:#F00">Please enter email address</span>
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

function remove_linebreaks_ss( str ) {
        var newstr = "";
          
        for( var i = 0; i < str.length; i++ ) 
            if( !(str[i] == '\n' || str[i] == '\r') )
                    newstr += str[i];
                      
        return newstr;
    } 
      
    // Method 2
      
    // Regular Expression
    function remove_linebreaks( str ) {
        return str.replace( /[\r\n]+/gm, "" );
        $('#addForm').submit();
    }
      
    function removeNewLines() {
        var sample_str =
            document.getElementById('email').value;
          
      
        // For printing time taken on console.
        
      
         document.getElementById('email').value
                = remove_linebreaks( sample_str);

    }

   $(document).on('click', '#submitForm',function(){
      	  if($.trim($('#email').val()) == ''){
			  $('#emailError').show();
			  return false;
		  }else{
   	$('#submitForm').html('<i class="fa fa-refresh fa-spin" style="font-size:15px"></i> Processing...');   
            removeNewLines();
		  }
	
	   
   });
   </script>
   
   <script>
   $( document ).ready(function() {
    // var t = document.email;
  //alert(t.maxLength); // 5
  $("#email").removeAttr( "maxLength" )
  //t.removeAttribute('maxLength');
});
   </script>
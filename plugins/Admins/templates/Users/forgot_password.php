<div class="container">
   <div class="row text-center">
   		<div class="col-md-12">      	
         <br><br>
         <h2> Binary Admin : Forgot Password</h2>
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
         <br />
         <?= $this->Flash->render() ?>
         <br />
      </div>
   </div>
   <div class="row">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <strong> Forgot Password </strong>  
            </div>
            <div class="panel-body">
               <?php echo $this->Form->create(); ?>
                  <br/>
                  <div class="form-group input-group">
                     <span class="input-group-addon">@</span>
                     <?php echo $this->Form->control('email',array(
								'type'=>'text',
								'placeholder'=>'Your Email',
								'label'=>false,								
								'required'=>false,
								'class'=>'form-control'
							)
						); 
					 ?>                     
                  </div>   
                  <div class="form-group input-group">       
                  <?php echo $this->Form->button('Forgot Password',['class'=>'btn btn-success']); ?>
                  </div>
                  <hr />
                  Already Registered ? <?= $this->Html->link('Login here', ['action' => 'login']) ?>
               <?php echo $this->Form->end(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
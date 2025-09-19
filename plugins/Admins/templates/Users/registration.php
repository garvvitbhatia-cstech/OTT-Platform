<div class="container">
   <div class="row text-center  ">
      <div class="col-md-12">
         <br /><br />
         <h2> Binary Admin : Register</h2>
         <h5>( Register yourself to get access )</h5>
         <br />
         <?= $this->Flash->render() ?>
      </div>
   </div>
   <div class="row">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <strong>  New User ? Register Yourself </strong>  
            </div>
            <div class="panel-body">
               <?php echo $this->Form->create($user); ?>
                  <br/>
                  <div class="form-group input-group">
                     <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                     <?php echo $this->Form->control('name',array(
								'placeholder'=>'Name',
								'label'=>false,
								'required'=>false,
								'class'=>'form-control'
							)
						); 
					 ?>
                  </div>
                  <div class="form-group input-group">
                     <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                     <?php echo $this->Form->control('username',array(
								'placeholder'=>'Desired Username',
								'label'=>false,
								'required'=>false,
								'class'=>'form-control'
							)
						); 
					 ?>
                  </div>
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
                     <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                     <?php echo $this->Form->control('password',array(
								'placeholder'=>'Enter Password',
								'type' => 'password',
								'label'=>false,
								'required'=>false,
								'class'=>'form-control'
							)
						); 
					 ?>
                  </div>                 
                  <?php echo $this->Form->button('Register Me',['class'=>'btn btn-success']); ?>
                  <hr />
                  Already Registered ? <?= $this->Html->link('Login here', ['action' => 'login']) ?>
               <?php echo $this->Form->end(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container">

   <div class="row text-center ">

      <div class="col-md-12">      	

         <br /><br />

         <img style="width:230px;" src="<?php echo $this->Url->build('/img/logo.png'); ?>">

         <h5>( Login yourself to get access )</h5>

         <br />

      </div>

   </div>

   <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

      	<?= $this->Flash->render() ?>
        
        <br />

         <div class="panel panel-default">

            <div class="panel-heading">

               <strong>Enter Details To Login</strong>  

            </div>

            <div class="panel-body">

               <?php echo $this->Form->create(); ?>

                  <br />

                  <div class="form-group input-group">

                     <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>

                     <?php echo $this->Form->control('email',array(

								'type'=>'text',

								'placeholder'=>'Your Email',

								'label'=>false,	
								'value' => $cookieUserName,							

								'required'=>false,

								'class'=>'form-control'

							)

						); 

					 ?>

                  </div>

                  <div class="form-group input-group">

                     <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                     <?php echo $this->Form->control('password',array(

								'placeholder'=>'Enter Password',

								'type' => 'password',

								'label'=>false,
								'value' => $cookiePassword,	

								'required'=>false,

								'class'=>'form-control'

							)

						); 

					 ?>

                  </div>

                  <div class="form-group">

                     <label class="checkbox-inline">

                     <input name="rememberme" <?php if($cookieRemember != ""){?> checked="checked" <?php } ?> type="checkbox" />Remember me

                     </label>

                     <span class="pull-right">

                     <!-- <?= $this->Html->link('Forgot password ?', ['action' => 'forgotPassword']) ?> -->

                     </span>

                  </div>

                  <?php echo $this->Form->button('Login Now',['class'=>'btn btn-primary','id'=>'loginUser']); ?>

                 <!--  <hr />

                  Not register ? <?= $this->Html->link('Click here', ['action' => 'registration']) ?> -->

               <?php echo $this->Form->end(); ?>

            </div>

         </div>

      </div>

   </div>

</div>



<script type = "text/javascript">

$(document).on('click', '#loginUser', function () {

	$('#loginUser').html('Processing...');

});

</script>
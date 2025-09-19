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

            <h2>Newsletter Footer</h2>

            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>

         </div>

      </div>

      <!-- /. ROW  -->

      <hr />

      <div class="row">

         <div class="col-md-12">

            <!-- Form Elements -->

            <div class="panel panel-default">

               <div class="panel-heading">

                  Newsletter  Details

               </div>

               <div class="panel-body">

                  <div class="row">

                     <div class="col-md-6">

                        <?php echo $this->Form->create($setting,array('csrfToken' => $this->request->getAttribute('csrfToken'),'id' => 'siteConfigForm')); ?>

                        
                        
                        <div class="form-group">

                           <?php echo $this->Form->control('newsletter_footer',array('rows' => 15, 'placeholder'=>'Footer Content','type'=>'textarea','required'=>false,'class'=>'form-control')); ?>

                        </div>

                                                                       

                                       

                        <button id="submitForm" class="btn btn-primary"><i class=" fa fa-refresh "></i> Update</button>

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






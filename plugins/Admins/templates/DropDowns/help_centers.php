<?php echo $this->element('/jQuery'); ?>

<div id="page-wrapper" >

   <div id="page-inner">

      <div class="row">

         <div class="col-md-12">

            <h2>Help Centers</h2>

            <h4>Total Help Center: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>

         </div>

      </div>

      <!-- /. ROW  -->

      <hr />

      <div class="row">

         <div class="col-md-12">

            <!-- Advanced Tables -->

            <div id="myProgress" style="display:block;">

               <div id="myBar"></div>

            </div>

            <div class="panel panel-primary">

               <div class="panel-heading" style="padding: 10px 15px 10px;">

                  <div class="row">

                     <div id="searchDivOptions" style="display:block;">

                        <?php echo $this->Form->create(NULL, array('csrfToken' => $this->request->getAttribute('csrfToken'), 'type' => 'get')); ?>

                        <div class="col-md-2">

                           <?php $name = $this->request->getQuery('name'); ?>

                           <?php echo $this->Form->control('name',

						   			array(

										'placeholder' => 'Search Name',

										'type' => 'text',

										'label' => false,

										'required' => false,

										'class' => 'form-control',

										'value' => isset($name) ? $this->request->getQuery('name') : ''));

							?>

                        </div>

                        <div class="col-md-2">

                           <?php $email = $this->request->getQuery('email'); ?>

                           <?php echo $this->Form->control('email',

						   			array(

										'placeholder' => 'Search Email',

										'type' => 'text',

										'label' => false,

										'required' => false,

										'class' => 'form-control',

										'value' => isset($email) ? $this->request->getQuery('email') : ''));

							?>

                        </div>

                        <div class="col-md-2">

                           <?php $mobile = $this->request->getQuery('mobile'); ?>

                           <?php echo $this->Form->control('mobile',

						   			array(

										'placeholder' => 'Search Mobile Number',

										'type' => 'text',

										'label' => false,

										'required' => false,

										'class' => 'form-control number',

										'value' => isset($mobile) ? $this->request->getQuery('mobile') : ''));

							?>

                        </div>

                        <div class="col-md-2">

                           <?php $status = $this->request->getQuery('status'); ?>

                           <?php echo $this->Form->control('status',

						   			array(

										'required' => false,

										'options' => $setStatus,

										'label' => false,

										'empty' => 'Select Status',

										'class' => 'form-control',

										'value' => isset($status) ? $this->request->getQuery('status') : ''));

							?>

                        </div>

                        <button id="submitForm" class="btn btn-info">Search</button>

                        <?php

						echo $this->Html->link('Reset', array('plugin' => 'Admins', 'controller' => 'DropDowns', 'action' => 'helpCenters'), array('escape' => false, 'title' => 'Click here to reset record', 'class' => "btn btn-warning", 'type' => "button"));

						?>

                        <?php echo $this->Form->end(); ?>

                     </div>

                  </div>

               </div>

               <div class="panel-body">

                  <?php echo $this->element('paginator'); ?><br />

                  <div class="table-responsive">

                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>

                           <tr>

                              <th>S. No.</th>

                              <th><?=$this->Paginator->sort('name', 'Name') ?></th>

                              <th><?=$this->Paginator->sort('email', 'Email') ?></th>

                              <th><?=$this->Paginator->sort('mobile', 'Mobile') ?></th>

                              <th>Created</th>

                              <th width="20%">Action</th>

                           </tr>

                        </thead>

                        <tbody>

                           <?php if (isset($pages) && $pages->count() > 0){

								$num = 0;

							?>

                           <?php $num = $this->Paginator->counter('{{start}}'); ?>

                           <?php foreach ($pages as $key => $val): ?>
						   <?php $userData = $this->User->getSingleRecordByEmail($val->email);?>
                           <tr class="odd gradeX">

                              <td <?php if(isset($userData->id)){?> style="background-color:#093; color:#FFF" <?php } ?>><?php echo $num; ?></td>

                              <td <?php if(isset($userData->id)){?> style="background-color:#093; color:#FFF" <?php } ?>><?php echo ucwords(isCheckVal($val->name)); ?></td>

                              <td <?php if(isset($userData->id)){?> style="background-color:#093; color:#FFF" <?php } ?>><a target="_blank" style="color:#000" href="mailto:<?php echo strtolower(isCheckVal($val->email)); ?>"><?php echo strtolower(isCheckVal($val->email)); ?></a></td>

                              <td <?php if(isset($userData->id)){?> style="background-color:#093; color:#FFF" <?php } ?>><?php echo isCheckVal($val->mobile); ?></td>

                              <td <?php if(isset($userData->id)){?> style="background-color:#093; color:#FFF" <?php } ?>><?php echo date("F jS, Y h:i A",$val->created); ?></td>

                              <td>

                                <button class="btn btn-info" onclick="viewData('<?= $val->id; ?>')" id="view_btn_<?= $val->id; ?>" id="view_btn_<?= $val->id; ?>"><i class="fa fa-eye "></i> View</button>

                                <button class="btn btn-danger" onclick="deleteRecord('HelpCenters',<?php echo $val->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>

                              </td>

                           </tr>

                           <tr style="display:none;" id="profiledtl_<?= $val->id; ?>"></tr>

                           <?php $num++; endforeach; ?>

                           <?php }else { ?>

                           <tr class="odd gradeX">

                              <td colspan="8" class="text-center">No Record Found</td>

                           </tr>

                           <?php } ?>

                        </tbody>

                     </table>

                  </div>

                  <?php echo $this->element('paginator'); ?>

               </div>

            </div>

            <!--End Advanced Tables -->

         </div>

      </div>

   </div>

</div>



<script type="text/javascript">



   function searchData(){



      window.location.href="<?php echo $this->Url->build('/admins/drop-downs/help-centers/'); ?>";



   }



   function viewData(uid){

		var divCondition = $('#profiledtl_'+uid).is(":visible");

		if(divCondition == false){

			$('#view_btn_'+uid).html('...');

			$('#profiledtl_'+uid).fadeIn();

			$.ajax({

				type: 'POST',

				url:'<?php echo $this->Url->build('/admins/dropDowns/viewHelpCenterDetails'); ?>',

				data: {rowId:uid},

				headers:{

					'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')

				},

				success: function(msg){

					if(msg != 'Error'){

						$('#profiledtl_'+uid).html(msg);

						$('#view_btn_'+uid).html('<i class="fa fa-eye "></i> View');

					}else{

						$('#view_btn_'+uid).html('<i class="fa fa-eye "></i> View');

						$('#error500').modal('show');

					}

				},error: function(ts){

					$('#view_btn_'+uid).html('<i class="fa fa-eye "></i> View');

					$('#error500').modal('show');

					console.log(ts);

				}

			})

		}else{

			$('#profiledtl_'+uid).html('');

			$('#profiledtl_'+uid).hide();

		}

	}



</script>


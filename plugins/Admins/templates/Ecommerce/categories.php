<?php echo $this->element('/jQuery'); ?>

<div id="page-wrapper" >

   <div id="page-inner">

      <div class="row">

         <div class="col-md-12">

            <h2>Categories</h2>

            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>

            <h4>Total Category: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>

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

                        <?php echo $this->Form->create(NULL,array('csrfToken' => $this->request->getAttribute('csrfToken'),'type'=>'get')); ?>

                        <div class="col-md-2">

                        	<?php $categoryName = $this->request->getQuery('name'); ?>

                           	<?php echo $this->Form->control('name',array(

                              'placeholder'=>'Category Name',

                              'type'=>'text',

                              'label'=>false,

                              'required'=>false,

                              'class'=>'form-control',

                              'value' => isset($categoryName)?$this->request->getQuery('name'):''

                              )

							 );

						   	?>

                        </div>

                        <div class="col-md-2">

                        	<?php $status = $this->request->getQuery('status'); ?>

                           	<?php echo $this->Form->control('status',array(

									  'required'=>false,

									  'options' => $setStatus,

									  'label' => false,

									  'empty' => '(Select Status)',

									  'class'=>'form-control',

									  'value' => isset($status)?$this->request->getQuery('status'):''

								  )

                              );

                            ?>

                        </div>

                        <button id="submitForm" class="btn btn-info">Search</button>

                        <?php

                           	echo $this->Html->link('Reset',

                           	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'categories'),

                           	array('escape' => false,

                           		'title'=>'Click here to reset record','class' => "btn btn-warning",'type'=>"button")

                           );

                        ?>

                        <?php

                           	echo $this->Html->link('Add Category',

                           	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addCategory'),

                           	array('escape' => false,

                           		'title'=>'Click here to add category','class' => "btn btn-default",'type'=>"button", "style"=>'float:right;margin:0px 15px 0px 0px;')

                           );

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

                              <th><?= $this->Paginator->sort('name', 'Name') ?></th>

                              <th><?= $this->Paginator->sort('icon', 'Icon') ?></th>
                              
                              <th><?= $this->Paginator->sort('ordering', 'Ordering') ?></th>

                              <th style="text-align:center">Status</th>

                              <th width="20%">Action</th>

                           </tr>

                        </thead>

                        <tbody>

                           <?php if(isset($categories) && !empty($categories) && $categories->count()>0){ 

						   	$num = 0;

						   ?>

                           <?php $num = $this->Paginator->counter('{{start}}'); ?>

                           <?php foreach($categories as $key=>$val): ?>
                           
                           <?php $categoryExist = $this->Media->getItems($val->id);?>

                           <tr class="odd gradeX">

                              <td><?php echo $num; ?></td>

                              <td><?php echo ucwords(isCheckVal($val->name)); ?></td>

                              <td>

                              	<?php

                                 if(!empty($val['icon'])){

                                 	if(file_exists(WWW_ROOT.'img/categories/'.$val['icon'])){

                                 		echo $this->Html->image('categories/'.$val['icon'], [

                                 			'alt'=>$val['icon'],

                                 			'title' => $val['icon'],

                                 			'width'=>'50']

                                 		);

                                 	}else{

										echo isCheckVal();

									}

                                 }else{

									echo isCheckVal();

								}

                                ?>

							  </td>
                              
                              <td width="5%">

                                 <input type="text" style="text-align:center;" class="form-control number" onchange="saveOrder(<?php echo $val->id ?>,<?php echo $val->ordering ?>,'Categories',this.value);" id="ordering" value="<?php echo $val->ordering ?>"/>

                              </td>
                              

                              <td align="center">

                                 <?php if($val->status == 1){ ?>                                  

                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Categories',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>

                                 <?php } else { ?>

                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Categories',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>

                                 <?php } ?>

                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />

                              </td>

                              <td width="25%">

                              <button class="btn btn-info" onclick="viewData('<?= $val->id; ?>')" id="view_btn_<?= $val->id; ?>"><i class="fa fa-eye "></i> View</button>

                                 <?php

                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',

                                    	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addCategory',$val->id),

                                    	array('escape' => false,

                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")

                                    );

                                 ?>
									<?php if($categoryExist->count() == 0){?>
                                 <button class="btn btn-danger" onclick="deleteRecord('Categories',<?php echo $val->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>
                                 <?php } ?>

                              </td>

                           </tr>

                           <tr style="display:none;" id="profiledtl_<?= $val->id; ?>"></tr>

                           <?php $num++; endforeach; ?>

                           <?php }else{ ?>

                           <tr class="odd gradeX">

                              <td align="center" colspan="7">No Record Found</td>

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

		window.location.href="<?php echo $this->Url->build('/admins/ecommerce/categories/'); ?>";	

	}

	$('#submitForm').on('click',function(){

		$('#submitForm').html('Searching...');

	});

	function viewData(uid){

		var divCondition = $('#profiledtl_'+uid).is(":visible"); 

		if(divCondition == false){

			$('#view_btn_'+uid).html('...');

			$('#profiledtl_'+uid).fadeIn();

			$.ajax({

				type: 'POST',

				url:'<?php echo $this->Url->build('/admins/ecommerce/viewCategoryDetails'); ?>', 

				data: {categoryId:uid},

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
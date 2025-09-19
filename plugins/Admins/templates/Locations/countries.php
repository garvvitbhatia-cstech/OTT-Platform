<?php echo $this->element('/jQuery'); ?>
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Countries</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
            <h4>Total Country: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>
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
                        	<?php $countryName = $this->request->getQuery('country_name'); ?>
                           	<?php echo $this->Form->control('country_name',array(
                              'placeholder'=>'Country Name',
                              'type'=>'text',
                              'label'=>false,
                              'required'=>false,
                              'class'=>'form-control',
                              'value' => isset($countryName)?$this->request->getQuery('country_name'):''
                              )
							 );
						   	?>
                        </div>
                        <div class="col-md-2">
                        	<?php $countryCode = $this->request->getQuery('country_code'); ?>
                           	<?php echo $this->Form->control('country_code',array(
                              'placeholder'=>'Country Code',
                              'required'=>false,
                              'label'=>false,
                              'maxlength'=>4,
                              'class'=>'form-control string',
                              'value' => isset($countryCode)?$this->request->getQuery('country_code'):''
                              )
							 ); 
						   	?>
                        </div>
                        <div class="col-md-2">
                        	<?php $phoneCode = $this->request->getQuery('phonecode'); ?>
                           	<?php echo $this->Form->control('phonecode',array(
                              'placeholder'=>'Phone Code',
                              'type'=>'text',
                              'required'=>false,
                              'label'=>false,
                              'class'=>'form-control number',
                              'value' => isset($phoneCode)?$this->request->getQuery('phonecode'):''
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
                           	array('plugin' => 'Admins', 'controller' => 'Locations', 'action' => 'countries'),
                           	array('escape' => false,
                           		'title'=>'Click here to reset record','class' => "btn btn-warning",'type'=>"button")
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
                              <th><?= $this->Paginator->sort('id', 'Name') ?></th>
                              <th><?= $this->Paginator->sort('country_code', 'Country Code') ?></th>
                              <th><?= $this->Paginator->sort('phonecode', 'Phone Code') ?></th>
                              <th><?= $this->Paginator->sort('ordering', 'Ordering') ?></th>
                              <th style="text-align:center">Status</th>
                              <th width="20%" style="text-align:center">Created</th>
                              <th width="20%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($countries) && $countries->count() > 0){
						   	$num = 0;
						   ?>
                           <?php $num = $this->Paginator->counter('{{start}}'); ?>
                           <?php foreach($countries as $key=>$val): ?>
                           <tr class="odd gradeX">
                              <td><?php echo $num; ?></td>
                              <td><?php echo ucwords(isCheckVal($val->country_name)); ?></td>
                              <td><?php echo ucwords(isCheckVal($val->country_code)); ?></td>
                              <td><?php echo ucwords(isCheckVal($val->phonecode)); ?></td>
                              <td width="5%">
                                 <input type="text" style="text-align:center;" class="form-control number" onchange="saveOrder(<?php echo $val->id ?>,<?php echo $val->ordering ?>,'Countries',this.value);" id="ordering" value="<?php echo $val->ordering ?>"/>
                              </td>
                              <td align="center">
                                 <?php if($val->status == 1){ ?>                                  
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Countries',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                 <?php } else { ?>
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Countries',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
                                 <?php } ?>       
                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              </td>
                              <td><?php echo date("F jS, Y h:i A",$val->created); ?></td>
                              <td>
                              <button class="btn btn-info" onclick="viewData('<?= $val->id; ?>')" id="view_btn_<?= $val->id; ?>" id="view_btn_<?= $val->id; ?>"><i class="fa fa-eye "></i> View</button>
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',
                                    	array('plugin' => 'Admins', 'controller' => 'Locations', 'action' => 'addCountry',$val->id),
                                    	array('escape' => false,
                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")
                                    );
                                 ?>
                                 <button class="btn btn-danger" onclick="deleteRecord('Countries',<?php echo $val->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>
                              </td>
                           </tr>
                           <tr style="display:none;" id="profiledtl_<?= $val->id; ?>"></tr>
                           <?php $num++; endforeach; ?>
                           <?php }else{ ?>
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
		window.location.href="<?php echo $this->Url->build('/admins/locations/countries/'); ?>";	
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
				url:'<?php echo $this->Url->build('/admins/Locations/viewCountryDetails'); ?>', 
				data: {countryId:uid},
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
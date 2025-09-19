<?php echo $this->element('/jQuery'); ?>
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Footer Apps</h2>
            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>
            <h4>Total Apps: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>
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
                        	<?php $type = $this->request->getQuery('type'); ?>
                           	<?php echo $this->Form->control('type',array(
									  'required'=>false,
									  'options' => ['TV'=>'TV', 'Mobile'=>'Mobile'],
									  'label' => false,
									  'empty' => '(Select App Type)',
									  'class'=>'form-control',
									  'value' => isset($type)?$this->request->getQuery('type'):''
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
                           	array('plugin' => 'Admins', 'controller' => 'Banners', 'action' => 'footerApps'),
                           	array('escape' => false,
                           		'title'=>'Click here to reset record','class' => "btn btn-warning",'type'=>"button")
                           );
                        ?>
                        <?php
                           	echo $this->Html->link('Add Banner',
                           	array('plugin' => 'Admins', 'controller' => 'Banners', 'action' => 'addFooterApp'),
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
                              <th><?= $this->Paginator->sort('type', 'Type') ?></th>
                              <th><?= $this->Paginator->sort('icon', 'Icon') ?></th>
                              <th><?= $this->Paginator->sort('ordering', 'Ordering') ?></th>
                              <th style="text-align:center">Status</th>
                              <th width="20%" style="text-align:center">Created</th>
                              <th width="20%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($footerApps) && !empty($footerApps) && $footerApps->count()>0){ 
						   	$num = 0;
						   ?>
                           <?php $num = $this->Paginator->counter('{{start}}'); ?>
                           <?php foreach($footerApps as $key=>$val): ?>
                           <tr class="odd gradeX">
                              <td><?php echo $num; ?></td>
                              <td><?php echo ucwords(isCheckVal($val->type)); ?></td>
                              <td>
                              	<?php
                                 if(!empty($val['icon'])){
                                 	if(file_exists(WWW_ROOT.'img/banners/'.$val['icon'])){
                                 		echo $this->Html->image('banners/'.$val['icon'], [
                                 			'alt'=>$val['icon'],
                                 			'title' => $val['icon'],
                                 			'width'=>'100']
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
                                 <input type="text" style="text-align:center;" class="form-control number" onchange="saveOrder(<?php echo $val->id ?>,<?php echo $val->ordering ?>,'FooterApps',this.value);" id="ordering" value="<?php echo $val->ordering ?>"/>
                              </td>
                              <td align="center">
                                 <?php if($val->status == 1){ ?>                                  
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('FooterApps',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                 <?php } else { ?>
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('FooterApps',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
                                 <?php } ?>
                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              </td>
                              <td><?php echo date("F jS, Y h:i A",$val->created); ?></td>
                              <td width="25%">                              
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',
                                    	array('plugin' => 'Admins', 'controller' => 'Banners', 'action' => 'addFooterApp',$val->id),
                                    	array('escape' => false,
                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")
                                    );
                                 ?>
                                 <button class="btn btn-danger" onclick="deleteRecord('FooterApps',<?php echo $val->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>
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
		window.location.href="<?php echo $this->Url->build('/admins/banners/footerApps/'); ?>";	
	}
	$('#submitForm').on('click',function(){
		$('#submitForm').html('Searching...');
	});

</script>
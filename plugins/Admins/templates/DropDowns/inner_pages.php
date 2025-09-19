<?php echo $this->element('/jQuery'); ?>
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Inner Pages Management</h2>
            <h4>Total Pages: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>
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
                           <?php $title = $this->request->getQuery('title'); ?>
                           <?php echo $this->Form->control('title',array(
                              'placeholder'=>'Enter Title',
                              'type'=>'text',
                              'label'=>false,
                              'required'=>false,
                              'class'=>'form-control',
                              'value' => isset($title)?$this->request->getQuery('title'):''
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
                           	array('plugin' => 'Admins', 'controller' => 'DropDowns', 'action' => 'inner-pages'),
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
                              <th><?= $this->Paginator->sort('id', 'Title') ?></th>
                              
                              <th style="text-align:center">Status</th>
                             
                              <th width="20%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($pages) && $pages->count() > 0){
						   	$num = 0; 
						   ?>
                           <?php $num = $this->Paginator->counter('{{start}}'); ?>
                           <?php foreach($pages as $key=>$val): ?>
                           <tr class="odd gradeX">
                              <td><?php echo $num; ?></td>
                              <td><?php echo ucwords(isCheckVal($val->title)); ?></td>
                              
                              <!-- <td align="center">
                                 <?php 
                                 if($val['profile'] != ''){
                                    if(file_exists(WWW_ROOT.'img/members/'.$val['profile'])){
                                       echo $this->Html->image('members/'.$val['profile'], [
                                          'alt'=>$val['profile'],
                                          'title' => $val['name'],
                                          'class'=>'img-rounded',
                                          'width'=> '80px'
                                       ]
                                       );
                                    }else{
                                       echo isCheckVal();
                                    }                                 
                                 }else{
                                    echo isCheckVal();
                                 }
                                 ?>
                              </td> -->
                              <td align="center">
                                 <?php if($val->status == 1){ ?>                                  
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('InnerPages',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                 <?php } else { ?>
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('InnerPages',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
                                 <?php } ?>       
                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              </td>
                              
                              <td>
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',
                                    	array('plugin' => 'Admins', 'controller' => 'DropDowns', 'action' => 'editInnerPage', base64_encode($val->id)),
                                    	array('escape' => false,
                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")
                                    );
                                 ?>
                                 
                              </td>
                           </tr>
                           <?php $num++; endforeach;  ?>
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
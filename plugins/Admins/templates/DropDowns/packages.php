<?php echo $this->element('/jQuery'); ?>
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Packages Management</h2>
            <h4>Total Package: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>
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
                        <div class="col-md-12" style="float:right;">
                        
                        Package Details
                        
                        </div>
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
                              <th><?= $this->Paginator->sort('title', 'Title') ?></th>
                              <th><?= $this->Paginator->sort('discounted_price', 'Discounted Price') ?></th>
                              <th><?= $this->Paginator->sort('price', 'Price') ?></th>
                              <th style="text-align:center">Status</th>                             
                              <th width="20%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($packages) && $packages->count() > 0){
						   	$num = 0; 
						   ?>
                           <?php $num = $this->Paginator->counter('{{start}}'); ?>
                           <?php foreach($packages as $key=>$val): ?>
                           <tr class="odd gradeX">
                              <td><?php echo $num; ?></td>
                              <td><?php echo ucwords(isCheckVal($val->title)); ?></td>
                              <td><?php echo isCheckVal($val->discounted_price); ?> INR</td>
                              <td><?php echo isCheckVal($val->price); ?> INR</td>
                              
                              <td align="center">
                                 <?php if($val->status == 1){ ?>                                  
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Packages',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                 <?php } else { ?>
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Packages',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
                                 <?php } ?>       
                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              </td>                              
                              <td>
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',
                                    	array('plugin' => 'Admins', 'controller' => 'DropDowns', 'action' => 'editPackage', base64_encode($val->id)),
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
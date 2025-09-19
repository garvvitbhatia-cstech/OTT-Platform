<?php
   #set page meta content   
   $this->assign('title', SITE_TITLE.' :: Order Management');   
   $this->assign('meta_robot', 'noindex, nofollow');   
   //echo($this->Element('/admin/jQuery'));   
?>
<?php echo $this->element('/jQuery'); ?>
<!--  page-wrapper -->
<div id="page-wrapper">
   <div class="row">
      <!-- page header -->
      <div class="col-lg-12">
         <h1 class="page-header">Subscriptions</h1>
      </div>
      <!--end page header -->
   </div>
   <div class="panel panel-primary">
      <div class="panel-heading" style="padding: 10px 15px 10px;">
         <div class="row">
            <div id="searchDivOptions" style="display:block;">
               <?php echo $this->Form->create(NULL,array('csrfToken' => $this->request->getAttribute('csrfToken'),'type'=>'get')); ?>                        
               <div class="col-md-2">
                  <?php $customerEmail = $this->request->getQuery('customer_email'); ?>
                  <?php echo $this->Form->control('customer_email',array(
													 'placeholder'=>'Email',													 
													 'type'=>'text',													 
													 'label'=>false,													 
													 'required'=>false,													 
													 'class'=>'form-control',													 
													 'value' => isset($customerEmail)?$this->request->getQuery('customer_email'):'' 
												)                     
                     						);
                     
                     ?>
               </div>
               
               <div class="col-md-2">
                  <?php $customerContact = $this->request->getQuery('customer_contact'); ?>
                  <?php echo $this->Form->control('customer_contact',array(
														 'placeholder'=>'Contact',														 
														 'type'=>'text',														 
														 'label'=>false,														 
														 'required'=>false,														 
														 'class'=>'form-control number',														 
														 'value' => isset($customerContact)?$this->request->getQuery('customer_contact'):''						 
													 )                     
                     							);
                     
                     ?>
               </div>
               
               <div class="col-md-2">
                  <?php $paymentStatus = array('Pending'=>'Pending','Completed'=>'Completed','Failed'=>'Failed'); ?>
                  <?php $customerPayStatus = $this->request->getQuery('payment_status'); ?>
                  <?php echo $this->Form->control('payment_status',array(
											 'required'=>false,											 
											 'options' => $paymentStatus,											 
											 'label' => false,											 
											 'empty' => 'Select Payment Status',											 
											 'class'=>'form-control',											 
											 'value' => isset($customerPayStatus)?$this->request->getQuery('payment_status'):''									 
											 )                     
                                        );
                     
				?>
               </div>
               <button id="submitForm" class="btn btn-info">Search</button>
               <?php
                  echo $this->Html->link('Reset',                  
										  array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'Orders'),                  
										  array('escape' => false,                  
											'title'=>'Click here to reset record','class' => "btn btn-warning",'type'=>"button")                  
										  );                  
          		?>
               <?php echo $this->Form->end(); ?>
            </div>
         </div>
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="col-lg-12">
               <div class="table-responsive">
                  <div id="replaceHtml">
                     <table class="table table-bordered table-hover table-striped">
                        <thead>
                           <tr>
                              <th>S.No.</th>
                              <th>Order Details</th>
                              <th>Item Name</th>
                              <th>Customer Details</th>
                              <th>Payment Details</th>
                              <th>Duration</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              if(count($orders) > 0){
                              $currentDate = time();
                                  foreach($orders as $key => $order){
                              	  $itemDetail = $this->Ecommerce->getItemDetails($order->item_id,$order->type);                            
                              ?>
                           <tr>
                              <td><?php echo($key+1); ?>.</td>
                              <td>
                                 Invoice ID: <?php echo(isCheckVal($order->invoice_id));?><br />
                                 Txn No: <?php echo($order->txn_id);?><br />
                                 Order Date: <?php echo(date("F jS, Y h:i A",$order->created)); ?>
                              </td>
                              <td>
                                 <?php echo($itemDetail);?><br /><br />
                                 <?php if($order->payment_status == 'Completed'){?>
                                 <?php if($order->pack_start_date <= $currentDate && $order->pack_end_date >= $currentDate){?>
                                 <span style="background-color:#093; color:#FFF; padding:3px;">Active</span>
                                 <?php }else{ ?>
                                 <span style="background-color:#f00; color:#FFF; padding:3px;">Expired</span>
                                 <?php } ?>
                                 <?php } ?>
                              </td>
                              <td>
                                 <?php echo($order->customer_email);?><br />
                                 <?php echo($order->customer_contact);?>
                              </td>
                              <td>
                                 Discount: <?php echo($order->discount);?> INR<br />
                                 Paid Amount: <?php echo($order->total);?> INR<br />
                                 Payment Status: <?php echo($order->payment_status);?>
                                 <?php if($order->payment_status == 'Pending' || $order->payment_status == 'Failed'){?>
                                 <button class="btn btn-danger" onclick="deleteRecord('Orders',<?php echo $order->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>
                                 <?php } ?>
                              </td>
                              <td>
                                 Start Date: <?php echo(date("F jS, Y h:i A",$order->pack_start_date)); ?><br />
                                 End Date: <?php echo(date("F jS, Y h:i A",$order->pack_end_date)); ?>
                              </td>
                           </tr>
                           <?php }
                              }else{
                              
                              ?>
                           <tr>
                              <td class="text-center" colspan="7">Records are not found.</td>
                           </tr>
                           <?php } ?>
                        </tbody>
                        <?php if($orders->count() > 0){ ?>
                        <tbody>
                           <tr>
                              <td align="center" colspan="7">
                                 <ul class="pagination">
                                    <?php
                                       $this->Paginator->options(array('update' => '#replaceHtml', 'evalScripts' => true, 'escape' => false, 'url' => array_merge(array('controller' => 'Ecommerce', 'action' => 'ordersFilter'))));?>
                                    <?php echo $this->Paginator->first('First'); ?>
                                    <?php echo $this->Paginator->numbers(); ?>
                                    <?php echo $this->Paginator->last('Last'); ?>
                                 </ul>
                              </td>
                           </tr>
                        </tbody>
                        <?php } ?>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.panel-body -->
   </div>
</div>
<script type="text/javascript">
   function searchData(){   
   		window.location.href="<?php echo $this->Url->build('/admins/ecommerce/orders/'); ?>";   
   }
   
   $('#submitForm').on('click',function(){   
   		$('#submitForm').html('Searching...');   
   });
</script>
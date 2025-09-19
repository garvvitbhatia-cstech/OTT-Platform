<?php echo $this->element('/jQuery'); ?>
<div id="page-wrapper" >
   <div id="page-inner">
      <div class="row">
         <div class="col-md-12">
            <h2>Videos</h2>
            <h4>Total Items: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>
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
									  'placeholder'=>'Title',
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
													  
													  'empty' => 'Select Status',
													  
													  'class'=>'form-control',
													  
													  'value' => isset($status)?$this->request->getQuery('status'):''
													  
													  )
                              
                                                 );
                              
                                               ?>
                        </div>
                        <button id="submitForm" class="btn btn-info">Search</button>
                        <?php
                           echo $this->Html->link('Reset',
                           
							   array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'Products'),
							   
							   array('escape' => false,
							   
								'title'=>'Click here to reset record','class' => "btn btn-warning",'type'=>"button")
							   
							   );
                           
                           ?>
                        <?php
                           echo $this->Html->link('Add Video',
                           
                           array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addProduct'),
                           
                           array('escape' => false,
                           
                           	'title'=>'Click here to add video','class' => "btn btn-default",'type'=>"button", "style"=>'float:right;margin:0px 15px 0px 0px;')
                           
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
                              <th><?= $this->Paginator->sort('product_name', 'Title') ?></th>
                              <th>Uploaded By</th>
                              <th>Category Name</th>
                              <th>Trailer Views</th>
                              <th>Video Views</th>
                              <th>Banner</th>
                              <th style="text-align:center">Status</th>
                              <th >Exist Media</th>
                              <th>Edit</th>
                              <th>Assign</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                           	<?php if(isset($products) && !empty($products) && $products->count()>0){ 
                              $num = 0;                              
                         	?>
                           	<?php $num = $this->Paginator->counter('{{start}}'); ?>
                           	<?php foreach($products as $key=>$val): 
                              $category = $this->Ecommerce->getCategoryNameById($val->category_id);
							  //$mediaExist = $this->Ecommerce->getMediaExist($val->id);
							  $viewsCount = $this->Ecommerce->getViews($val->id);
							  $viewsTrailerCount = $this->Ecommerce->getTrailerViews($val->id);
							  ##################
							  	$video = $trailer_video = 'No';
								if(!empty($val->video)){
									//if(file_exists(WWW_ROOT.'img/products/'.$val->video)){
										$video = 'Yes';	
									//}
								}
								if(!empty($val->trailer_video)){
									//if(file_exists(WWW_ROOT.'img/products/'.$val->trailer_video)){
										$trailer_video = 'Yes';	
									//}
								}
							  ##################
                              $tralerExixts = $trailer_video;
							  $movieExixts = $video;
                           	?>
                           	<tr class="odd gradeX">
                              <td><?php echo $num; ?></td>
                              <td><?php echo ucwords(isCheckVal($val->product_name)); ?>
                              		<br />Created at: <?php echo date("F jS, Y h:i A",$val->created); ?>
                                    <br />Modified at: <?php echo date("F jS, Y h:i A",$val->modified); ?>
                                    <br /><span style="color:#F00">Duration: <?php echo $val->hours;?>H <?php echo $val->minutes;?>M</span>
                                    </td>
                              <td>
                              <?php 
							  if($val->added_by > 0){
								  $userData = $this->User->getSingleRecord($val->added_by);
								  echo '<b>Name: </b>'.$userData->name;
								  echo '<br>';
								  echo '<b>Email: </b>'.$userData->email;
							  }else{
								 echo 'Admin'; 
							  }
							  ?>
                              </td>
                              <td><?php echo ucwords(isCheckVal($category)); ?></td>
                              <td>
                              Duration: <?php echo $viewsTrailerCount['total_duration']; ?><br />
                              View: <?php echo $viewsTrailerCount['total_view']; 
							  
							  echo '<br>';
							  
							  	if($viewsTrailerCount['total_view'] > 0){	
									echo '&nbsp;<button title="View User Detail" class="btn btn-default btn-sm" onclick="viewUserDataTrailer('.$val->id.')" id="view_btns_'.$val->id.'"><i class="fa fa-eye "></i></button>';
								}
							  ?>                              	
                              </td>
                              <td>
							  Duration: <?php echo $viewsCount['total_duration']; ?><br />
							  View: <?php echo $viewsCount['total_view']; 
							  echo '<br>';
							  	if($viewsCount['total_view'] > 0){	
									echo '&nbsp;<button title="View User Detail" class="btn btn-default btn-sm" onclick="viewUserData('.$val->id.')" id="view_btns_'.$val->id.'"><i class="fa fa-eye "></i></button>';
								}
							  ?>                              	
                              </td>
                              <td><?php if($val->horizontal_banner != ""){?> <img title="<?php echo $val->horizontal_banner; ?>" alt="<?php echo $val->horizontal_banner; ?>" src="<?php echo SITEURL.'img/banners/'.$val->horizontal_banner;?>" width="100" /><?php } ?></td>
                              <td align="center">
                                 <?php if($val->status == 1){ ?>                                  
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Products',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                 <?php } else { ?>
                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('Products',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
                                 <?php } ?>       
                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              </td>
                              <td>
							  	Trailer: <?php echo $tralerExixts; ?><br />
                                Video: <?php echo $movieExixts;  ?>
                              </td>
                              <td>
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',
                                    
                                    	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addProduct',$val->id),
                                    
                                    	array('escape' => false,
                                    
                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")
                                    
                                    );
                                    
                                    ?>
                              </td>
                              <td>
                                 <?php
                                    echo $this->Html->link('<i class="fa fa-edit "></i> Assign',
                                    
                                    	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'assignVideo',$val->id),
                                    
                                    	array('escape' => false,
                                    
                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")
                                    
                                    );
                                    
                                    ?>
                              </td>
                              <td>
                                 <button class="btn btn-danger" onclick="deleteRecord('Products',<?php echo $val->id; ?>,0);" ><i class="fa fa-trash"></i> Delete</button>
                              </td>
                           </tr>
                           <tr style="display:none;" id="profiledtl_<?= $val->id; ?>"></tr>
                           <?php $num++; endforeach; ?>
                           <?php }else{ ?>
                           <tr class="odd gradeX">
                              <td align="center" colspan="9">No Record Found</td>
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
   
   	window.location.href="<?php echo $this->Url->build('/admins/ecommerce/products/'); ?>";
   
   }
   
   $('#submitForm').on('click',function(){
   
   	$('#submitForm').html('Searching...');
   
   });
   
   function viewUserDataTrailer(uid){
   
   	var divCondition = $('#profiledtl_'+uid).is(":visible"); 
   
   	if(divCondition == false){
   
   		//$('#view_btns_'+uid).html('...');
   
   		$('#profiledtl_'+uid).fadeIn();
   
   		$.ajax({
   
   			type: 'POST',
   
   			url:'<?php echo $this->Url->build('/admins/ecommerce/viewTrailerUserDetails'); ?>', 
   
   			data: {user_id:uid},
   
   			headers:{
   
   				'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
   
   			},
   
   			success: function(msg){
   
   				if(msg != 'Error'){
   
   					$('#profiledtl_'+uid).html(msg);
   
   					$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>');
   
   				}else{ 
   
   					$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>');
   
   					$('#error500').modal('show');
   
   				}
   
   			},error: function(ts){
   
   				$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>'); 
   
   				$('#error500').modal('show');
   
   				console.log(ts);
   
   			}
   
   		})
   
   	}else{
   
   		$('#profiledtl_'+uid).html('');
   
   		$('#profiledtl_'+uid).hide();
   
   	}
   
   }
   
   function viewUserData(uid){
   
   	var divCondition = $('#profiledtl_'+uid).is(":visible"); 
   
   	if(divCondition == false){
   
   		//$('#view_btns_'+uid).html('...');
   
   		$('#profiledtl_'+uid).fadeIn();
   
   		$.ajax({
   
   			type: 'POST',
   
   			url:'<?php echo $this->Url->build('/admins/ecommerce/viewUserDetails'); ?>', 
   
   			data: {user_id:uid},
   
   			headers:{
   
   				'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
   
   			},
   
   			success: function(msg){
   
   				if(msg != 'Error'){
   
   					$('#profiledtl_'+uid).html(msg);
   
   					$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>');
   
   				}else{ 
   
   					$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>');
   
   					$('#error500').modal('show');
   
   				}
   
   			},error: function(ts){
   
   				$('#view_btns_'+uid).html('<i class="fa fa-eye "></i>'); 
   
   				$('#error500').modal('show');
   
   				console.log(ts);
   
   			}
   
   		})
   
   	}else{
   
   		$('#profiledtl_'+uid).html('');
   
   		$('#profiledtl_'+uid).hide();
   
   	}
   
   }
   
   function viewData(uid){
   
   	var divCondition = $('#profiledtl_'+uid).is(":visible"); 
   
   	if(divCondition == false){
   
   		$('#view_btn_'+uid).html('...');
   
   		$('#profiledtl_'+uid).fadeIn();
   
   		$.ajax({
   
   			type: 'POST',
   
   			url:'<?php echo $this->Url->build('/admins/ecommerce/viewProductDetails'); ?>', 
   
   			data: {productId:uid},
   
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
   
   
   
   $(document).ready(function(){
   
   	$('.video-btn').click(function(){
   
   		var url = $(this).data("src");
   
   		var banner = $(this).data('banner');
   
   		
   
   		/* Assign empty url value to the iframe src attribute when
   
   		modal hide, which stop the video playing */
   
   		$("#myModal").on('hide.bs.modal', function(){		
   
   			$("#videoPoster").attr('src', '');
   
   			$("#videoPoster").attr('poster', '');			
   
   		});
   
   		
   
   		/* Assign the initially stored url back to the iframe src
   
   		attribute when modal is displayed again */
   
   		$("#myModal").on('show.bs.modal', function(){
   
   			$("#videoPoster").attr('src', url);
   
   			$("#videoPoster").attr('poster', banner);
   
   		});
   
   	});
   
   });
   
</script>
<?php echo $this->element('/jQuery'); ?>

<div id="page-wrapper" >

   <div id="page-inner">

      <div class="row">

         <div class="col-md-12">

            <h2>Newsletter Emails</h2>

            <h5>Welcome <?php echo ucwords($session['name']); ?> , Love to see you back. </h5>

            <h4>Total Newsletters: <?php echo $this->Paginator->counter('{{count}}'); ?></h4>

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

                              'placeholder'=>'Subject',

                              'type'=>'text',

                              'label'=>false,

                              'required'=>false,

                              'class'=>'form-control',

                              'value' => isset($title)?$this->request->getQuery('email'):''

                              )

							 );

						   	?>

                        </div>

                        <div class="col-md-2">

                        	<?php $status = $this->request->getQuery('status'); ?>

                           	<?php echo $this->Form->control('type',array(

									  'required'=>false,

									  'options' => $setStatus,

									  'label' => false,

									  'empty' => 'Type',

									  'class'=>'form-control',

									  'value' => isset($status)?$this->request->getQuery('status'):''

								  )

                              );

                            ?>

                        </div>
                        
                        <div class="col-md-2">

                        	<?php $status = $this->request->getQuery('status'); ?>

                           	<?php echo $this->Form->control('top_banner_type',array(

									  'required'=>false,

									  'options' => $bannerType,

									  'label' => false,

									  'empty' => 'Top Banner Type',

									  'class'=>'form-control',

									  'value' => isset($status)?$this->request->getQuery('status'):''

								  )

                              );

                            ?>

                        </div>
                        
                        <div class="col-md-2">

                        	<?php $status = $this->request->getQuery('status'); ?>

                           	<?php echo $this->Form->control('current_status',array(

									  'required'=>false,

									  'options' => $emailStatus,

									  'label' => false,

									  'empty' => 'Cron Job Status',

									  'class'=>'form-control',

									  'value' => isset($status)?$this->request->getQuery('status'):''

								  )

                              );

                            ?>

                        </div>

                        <button id="submitForm" class="btn btn-info">Search</button>

                        <?php

                           	echo $this->Html->link('Reset',

                           	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'newsletterEmail'),

                           	array('escape' => false,

                           		'title'=>'','class' => "btn btn-warning",'type'=>"button")

                           );

                        ?>

                        <?php

                           	echo $this->Html->link('Add New',

                           	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addNewsletterEmail'),

                           	array('escape' => false,

                           		'title'=>'','class' => "btn btn-default",'type'=>"button", "style"=>'float:right;margin:0px 15px 0px 0px;')

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
                              <th>Details</th>
                              <th>Title</th>
                              <th>Banner</th>
                              <th>Subject</th>
							  <th style="text-align:center">Status</th>
                              <th style="text-align:center">Send</th>
                              <th width="20%">Action</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php if(isset($newsletters) && !empty($newsletters) && $newsletters->count()>0){ 

						   	$num = 0;

						   ?>

                           <?php $num = $this->Paginator->counter('{{start}}'); ?>

                           <?php foreach($newsletters as $key=>$val): ?>
                           
                           <?php 
						   $moviewTitle = 'Use Custom Banner';
						   $movieBanner = '<img  src="'.SITEURL.'img/banners/'.$val->top_banner.'" width="100" />';
						   if($val->top_banner_type == 'LMB'){
							   $moviewDetails = $this->Media->getItem($val->product_id);
							   $moviewTitle = $moviewDetails->product_name;
							   $movieBanner = '<img  src="'.SITEURL.'img/banners/'.$moviewDetails->horizontal_banner.'" width="100" />';
						   }
						   $typeText = $val->type == 'Video' ? 'Premier Video' : 'Random-Weekly News';
						   $tobBannerType = $val->top_banner_type == 'LMB' ? '<span style="color:#093">Premier Video Banner</span>' : '<span style="color:#093">Use Custom Banner</span>';
						   ?>

                           <tr class="odd gradeX">

                              <td><?php echo $num; ?></td>

                              <td>
                              <?php echo $typeText; ?><br />
                              <?php echo $tobBannerType; ?><br />
                              Date: <?php echo date('d F Y',$val->created);?>
                              </td>
                              
                               <td><?php echo $moviewTitle; ?></td>
                               <td><?php echo $movieBanner; ?></td>
                              
                              <td><?php echo $val->title; ?></td>
                              <td><span id="current_status_<?php echo $val->id; ?>"><?php echo $val->current_status; ?></span></td>

                              <td align="center">
								
                                 <?php if($val->status == 1){ ?>                                  

                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('NewsletterEmails',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Deactive" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>

                                 <?php } else { ?>

                                 <button id="buttonId_<?php echo $val->id; ?>" onclick="changeStatus('NewsletterEmails',<?php echo $val->id; ?>,<?php echo $val->status; ?>)" title= "Click here to Active" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>

                                 <?php } ?>

                                 <input type="hidden" id="current_status<?php echo $val->id;?>" value="<?php echo $val->status;?>" />
                              

                              </td>

                              <td width="25%">
                                 <?php

                                    echo $this->Html->link('<i class="fa fa-edit "></i> Edit',

                                    	array('plugin' => 'Admins', 'controller' => 'Ecommerce', 'action' => 'addNewsletterEmail',$val->id),

                                    	array('escape' => false,

                                    		'title'=>'Click here to edit record','class' => "btn btn-primary",'data-placement'=>"top",'data-toggle'=>"tooltip",'type'=>"button",'data-original-title'=>"Click here to edit record")

                                    );

                                 ?>
                                 
                                 <a target="_blank" href="<?php echo $this->Url->build('/admins/ecommerce/view-email-template/'.$val->type.'/'.$val->product_id.'/'.$val->id); ?>" class="btn btn-success"><i class="fa fa-eye"></i> View</a>

                                 <button class="btn btn-danger" onclick="deleteRecord('NewsletterEmails',<?php echo $val->id; ?>,0);" ><i class="fa fa-pencil"></i> Delete</button>
                                 <a onclick="$('#profiledtl_<?php echo $val->id; ?>').toggle();"class="btn btn-primary"><i class="fa fa-edit "></i> Test</a>

                              </td>

                           </tr>

                           <tr style="display:none;" id="profiledtl_<?= $val->id; ?>">
                           <td colspan="8" align="center">
                           <input id="test_email_<?php echo $val->id;?>" style="float:left; margin-right:10px; width:15%;" placeholder="Enter email address" class="form-control" type="text" /><button class="btn btn-danger" id="testEmailSendBtn_<?php echo $val->id;?>" style="float:left;" onclick="testEmail('<?php echo $val->type;?>','<?php echo $val->product_id;?>','<?php echo $val->id;?>');" >Send</button>
                           </td>
                           </tr>

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
		window.location.href="<?php echo $this->Url->build('/admins/ecommerce/newsletter-email/'); ?>";	

	}
	$('#submitForm').on('click',function(){

		$('#submitForm').html('Searching...');

	});
	function testEmail(type,videoID,rowID){
		
		if($.trim($('#test_email_'+rowID).val()) == ''){
			alert('Please enter email address');
			$('#test_email_'+rowID).focus(); return false;
		}else{
			$('#testEmailSendBtn_'+rowID).html('Sending...');
			var email = $('#test_email_'+rowID).val();
			$.ajax({
					type: 'POST',
					url: '<?= $this->Url->build('/test-newsletter-email');?>',
					data: {type:type,videoID:videoID,rowID:rowID,email:email},
					success: function(msg){
						$('#test_email_'+rowID).val('');
						$('#testEmailSendBtn_'+rowID).html('Send');
						alert(msg);
					}
				});
			
		}
		
	}
	function sendEmails(){
		$.ajax({
					type: 'POST',
					url: '<?= $this->Url->build('/send-newsletters');?>',
					success: function(msg){
						if(msg == 'Completed'){
							window.location.reload();
						}else if(msg == 'Success'){
							return false;
						}else{
							$('#current_status_'+msg).html('InProcess');
						}
					}
				});
	}

	setInterval(function(){ sendEmails(); }, 10000);
</script>
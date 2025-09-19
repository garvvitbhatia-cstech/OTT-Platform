<?php
if(isset($pageData->seo_title)){
    #set page meta content
    $this->assign('title', 'My Submitted Films');
    $this->assign('meta_keywords', 'My Submitted Films');
    $this->assign('meta_description', 'My Submitted Films');
    $this->assign('meta_robot', '');
}
?>
<?= $this->Html->css(array('my_account')) ?>
<?php echo $this->element('/jQuery'); ?>
<style>
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #3f3f50;
	color:#fff
}
.ott-main-body {
	padding-top: 50px;
}
.inner_page_btn {
	border: 1px solid #d99200;
	background: #d99200;
	color: #fff;
}
.success {
	text-align: center;
	padding: 10px;
}
.is_film {
	border: 1px solid #3f3f50;
	padding: 10px;
	padding-bottom: 1px;
	margin-bottom: 12px;
	background: #262630;
	border-radius: 4px;
}
.ott-main-body {
	padding-top: 50px;
}
</style>

<div _ngcontent-ytn-c55="" class="ott-main-body has-header">
  <router-outlet _ngcontent-ytn-c55=""></router-outlet>
  <app-packages _nghost-ytn-c61="" class="ng-star-inserted">
    <div _ngcontent-ytn-c61="">
      <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">
        <div _ngcontent-kgi-c59="" class="ott-main-body has-header">
          <router-outlet _ngcontent-kgi-c59=""></router-outlet>
          <app-settings _nghost-kgi-c53="" class="ng-tns-c53-397 ng-star-inserted">
            <div _ngcontent-kgi-c53="" class="settings ng-tns-c53-397 ng-trigger ng-trigger-fadeInAnimation">
              <div _ngcontent-kgi-c53="" class="container-fluid ng-tns-c53-397">
                <div _ngcontent-kgi-c53="" class="inner-container ng-tns-c53-397">
                  <div _ngcontent-kgi-c53="" class="setting__details ng-tns-c53-397"> <?php echo($this->Flash->render()); ?>
                    <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen">My Submitted Films</h2>
                    <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">
                      <?= $this->Form->create(NULL,array('enctype'=>'multipart/form-data','id' => 'changePassword', 'action' => SITEURL.'submit-your-film', 'csrfToken' => $this->request->getAttribute('csrfToken')));
					  ?>
                      <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">
                       <table width="100%" class="table table-bordered" border="0">
                        <tr>
                        <td><b>Film Details</b></td>
                        <td><b>Banner</b></td>
                        <td><b>Status</b></td>
                        <td><b>Action</b></td>
                        </tr>
                        <?php foreach($films as $key => $film){?>
                        <?php 
						if($showForm == 'Yes'){
						$data = $this->User->getTotalView($film->id,1);
						}?>
                        <tr>
                        <td>
                        <b>Film Title:</b> <?php echo $film->product_name;?><br />
                        <b>Director:</b> <?php echo $film->director;?><br />
                        <?php if($showForm == 'Yes'){ ?>
                        <b>Duration:</b> <?php echo $data['video_duration'];?> | <?php echo $data['video_views'];?> Views<br />
                        <?php } ?>
                        
                        </td>
                        <td>
                        <?php if($film->horizontal_banner != ""){?>
                        <?php echo $this->Html->image('banners/'.$film->horizontal_banner, ['alt'=>'','title' => '','width'=>'200']);?>
                        <?php } ?>
                        </td>
                        <td>
                        <?php if($film->status == 1){echo 'Published';}else{echo 'In Process';}?>
                        </td>
                        <td>
                        
                        <?php if($film->status != 1){?>
                        <a onclick="deleteRecord('Products',<?php echo $film->id; ?>,0);" style="background:#f00;padding: 0px 8px; cursor:pointer">Remove</a>
                        <a href="<?php echo $this->Url->build('/edit-film-details/'.base64_encode($film->id)); ?>" style="background:#FC3;padding: 0px 8px; cursor:pointer; color:#000; text-decoration:none">Edit</a>
                        <?php } ?>
                        
                        <a href="<?php echo $this->Url->build('/view-film-details/'.base64_encode($film->id)); ?>" style="background:#093;padding: 0px 8px; cursor:pointer; color:#FFF; text-decoration:none">View</a>
                        
                        </td>
                        </tr>
                        <?php } ?>
                        <?php if($films->count() == 0){?>
                        <tr>
                        <td colspan="3" align="center">No Record</td>
                        </tr>
                        <?php } ?>
                        </table>
                      </div>
                      <?= $this->Form->end(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div _ngcontent-kgi-c53="" class="ng-tns-c53-397"></div>
          </app-settings>
        </div>
      </div>
    </div>
  </app-packages>
</div>

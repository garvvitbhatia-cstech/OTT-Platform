<?php

if(isset($pageData->seo_title)){

    #set page meta content
    $this->assign('title', $pageData->seo_title);
    $this->assign('meta_keywords', $pageData->seo_keyword);
    $this->assign('meta_description', $pageData->seo_description);
    $this->assign('meta_robot', $pageData->robot_tags);

}
$isSubscribed = '';
$session = $this->request->getSession();
if($session->check('LoginUser.id')){
	$isSubscribed = $this->Setting->checkSubbscription($session->read('LoginUser.id'));
}
$rentalData = $this->Setting->getRental($session->read('LoginUser.id'));
$expireRentalData = $this->Setting->getExpireRental($session->read('LoginUser.id'));
?>
<style>
.ott-main-body{ padding-top:50px;}
</style>
<?= $this->Html->css(array('my_account')) ?>

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
        <?php echo($this->Flash->render()); ?>
        <!---->
        <div _ngcontent-kgi-c53="" class="setting__details ng-tns-c53-397">
          <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen">My Account</h2>
          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">
            <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">
            
			<?php

				 if (!empty($userData->profile)) {
					if (file_exists(WWW_ROOT . 'img/user/' . $userData->profile)) { ?>
              <div _ngcontent-kgi-c53="" style="text-align:center" class="form-group ng-tns-c53-397">
                
					
						<?php echo $this->Html->image('user/' . $userData->profile, ['alt' => $userData->profile, 'title' => $userData->profile, 'width' => '100']); ?>
						
					

              </div>
			  <?php }
				 }
			?>
              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Name:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397"><?php echo($userData->name);?></span>
                <a _ngcontent-kgi-c53="" class="link ng-tns-c53-397 ng-star-inserted" href="<?php echo $this->Url->build('/edit-profile/'); ?>">Edit Profile</a>
              </div>
              
              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Email:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397"><?php echo($userData->email);?></span>
              </div>

              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Password:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397">******</span>
                <a _ngcontent-kgi-c53="" class="link ng-tns-c53-397 ng-star-inserted" href="<?php echo $this->Url->build('/change-password/'); ?>">Change</a><!----></div>

              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Mobile Number:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397"><?php if($userData->contact != ""){?>+91-<?php echo($userData->contact);?><?php } ?></span>
                <p _ngcontent-kgi-c53="" class="text-danger ng-tns-c53-397"></p>
              </div>
              
              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">City:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397"><?php echo($userData->city);?></span>
              </div>
              
              <div _ngcontent-kgi-c53="" class="form-group ng-tns-c53-397">
                <label _ngcontent-kgi-c53="" class="ng-tns-c53-397">Film Maker:</label>
                <span _ngcontent-kgi-c53="" class="info ng-tns-c53-397"><?php if($userData->is_film_maker == 1){ echo('Yes'); }else{ echo 'No';}?></span>
              </div>
              
              <!----></div>
          </div>
        </div>
        <div _ngcontent-kgi-c53="" class="setting__details user_pack_details ng-tns-c53-397 ng-star-inserted">
          <h2 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Active Subscription Plans</h2>
          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397">
            <div _ngcontent-kgi-c53="" class="plans_list ng-tns-c53-397 ng-star-inserted">
              <div _ngcontent-kgi-c53="" class="pl_row show_details_inner ng-tns-c53-397">
              	<?php if($isSubscribed == 'No'){?>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">You have not yet subscribed to a plan</h6>
                <?php }else{ ?>
                <?php $currentPlanDetails = $this->Setting->getCurrentPlanDetails($session->read('LoginUser.id'));?>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your current plan is <?php echo $currentPlanDetails['plan_title'];?>.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">You have paid <?php echo $currentPlanDetails['price'];?> INR for this plan.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your plan duration is <?php echo date('d F Y',$currentPlanDetails['start_date']);?> to <?php echo date('d F Y',$currentPlanDetails['end_date']);?>.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your plan will be expire on <?php echo date('d F Y',$currentPlanDetails['end_date']);?>.</h6>
                <?php } ?>
              </div>
              <!--<div _ngcontent-kgi-c53="" class="show-details__content-bottom clearfix ng-tns-c53-397"><a _ngcontent-kgi-c53="" class="link ng-tns-c53-397">Transaction History</a></div>-->
            </div>
            </div>
        </div>
        <!---->
        <?php if($rentalData->count() > 0){?>
        <div _ngcontent-kgi-c53="" class="setting__details user_pack_details ng-tns-c53-397 ng-star-inserted">
          <h2 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Active Rental Movies</h2>
          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397">
            <div _ngcontent-kgi-c53="" class="plans_list ng-tns-c53-397 ng-star-inserted">
              <div _ngcontent-kgi-c53="" class="pl_row show_details_inner ng-tns-c53-397">
              	
                <?php foreach($rentalData as $key => $rentalMovie){?>
					<?php $moviewData = $this->Media->getItem($rentalMovie->item_id);?>
                    <h6 style="font-size:18px; color:#6FF" _ngcontent-kgi-c53="" class="ng-tns-c53-397"><?php echo $moviewData->product_name;?>.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">You have paid <?php echo $rentalMovie->total;?> INR.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your rent duration is <?php echo date('d F Y h:i A',$rentalMovie->pack_start_date);?> to <?php echo date('d F Y h:i A',$rentalMovie->pack_end_date);?>.</h6>
                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your rent will be expire on <?php echo date('d F Y h:i A',$rentalMovie->pack_end_date);?>.</h6>
                    
				<?php }?>
                
              </div>
            </div>
            </div>
        </div>
        <?php } ?>
        
        <?php if($expireRentalData->count() > 0){?>
        <div _ngcontent-kgi-c53="" class="setting__details user_pack_details ng-tns-c53-397 ng-star-inserted">
          <h2 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Expired Rental Movies</h2>
          <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397">
            <div _ngcontent-kgi-c53="" class="plans_list ng-tns-c53-397 ng-star-inserted">
              <div _ngcontent-kgi-c53="" class="pl_row show_details_inner ng-tns-c53-397">
              	
                <?php foreach($expireRentalData as $key => $rentalMovie){?>
					<?php $moviewData = $this->Media->getItem($rentalMovie->item_id);
					$moviewName = isset($moviewData->product_name) ? $moviewData->product_name : 'Video is deleted';
					?>
                    <h6 style="font-size:18px; color:#FCC" _ngcontent-kgi-c53="" class="ng-tns-c53-397"><?php echo $moviewName;?>.</h6>

                <h6 _ngcontent-kgi-c53="" class="ng-tns-c53-397">Your rent duration expired on <?php echo date('d F Y h:i A',$rentalMovie->pack_end_date);?>.</h6>
                    
				<?php }?>
                
              </div>
            </div>
            </div>
        </div>
        <?php } ?>
        
        
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

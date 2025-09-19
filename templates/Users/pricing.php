<?php

if(isset($pageData->seo_title)){

    #set page meta content

    $this->assign('title', $pageData->seo_title);

    $this->assign('meta_keywords', $pageData->seo_keyword);

    $this->assign('meta_description', $pageData->seo_description);

    $this->assign('meta_robot', $pageData->robot_tags);

}

?>
<style>
.couponcode_box{    color: #fff;
    background: #17172B;
    border: 1px dotted #3D3D74;
    padding: 7px;}
	.apply_couponcode_btn{background: #3D3D74;
    padding: 8px 13px;
    margin-left: 12px; cursor:pointer;}
</style>
<?= $this->Html->css(array('pricing')) ?>
<div _ngcontent-ytn-c55="" class="ott-main-body has-header">

        <router-outlet _ngcontent-ytn-c55=""></router-outlet>

        <app-packages _nghost-ytn-c61="" class="ng-star-inserted">

          <div _ngcontent-ytn-c61="">

            <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">

              <!--<div _ngcontent-ytn-c61="" class="mobile_nav_header ng-star-inserted"><img _ngcontent-ytn-c61="" src="./pricing - FirstShows_files/back-arrow.svg"> Pricing</div>-->

              <!---->

              <?php if(isset($pageData->heading) && $pageData->status == 1){?><h2 _ngcontent-ytn-c61="" class="ng-star-inserted"><?php echo $pageData->heading;?></h2><?php } ?>

              <!---->

              <div _ngcontent-ytn-c61="" class="package_inner">

                <div _ngcontent-ytn-c61="" class="pack_left ng-star-inserted mCustomScrollbar _mCS_1 mCS_no_scrollbar">

                  <div id="mCSB_1" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">

                    <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">

                    

						<?php $packages = $this->Setting->getPackages();?>

                        <?php foreach($packages as $key => $package){?>

                        <div _ngcontent-ytn-c61="" id="pack_div_<?php echo $package->id; ?>" style="cursor:pointer" onclick="choosePlan('<?php echo $package->id; ?>');" class="pack_block ng-star-inserted">

                        <div _ngcontent-ytn-c61="" class="pack_info">

                        <label _ngcontent-ytn-c61="" id="pack_label_<?php echo $package->id; ?>" class="radio">

                        <input _ngcontent-ytn-c61="" id="pack_radio_<?php echo $package->id; ?>" type="radio" onchange="choosePlan('<?php echo $package->id; ?>');" name="pack_radio" class="hidden">

                        <span _ngcontent-ytn-c61="" class="label"></span></label>

                        <span _ngcontent-ytn-c61="" class="plan_name"><?php echo $package->title; ?></span>

                        <span _ngcontent-ytn-c61="" class="terms">

                        <a _ngcontent-ytn-c61="" target="_blank" href="<?php echo $this->Url->build('/terms-and-conditions/'); ?>">Terms and Conditions</a> apply

                        </span>

                        </div>

                        <div _ngcontent-ytn-c61="" class="pack_price">

                        <span _ngcontent-ytn-c61="" class="old_price">INR <?php echo $package->discounted_price; ?></span>

                        <span _ngcontent-ytn-c61="" class="new_price">INR <?php echo $package->price; ?></span>

                        <span _ngcontent-ytn-c61="" class="tax">Inclusive of all Taxes</span>

                        </div>

                        </div>

                        <?php } ?>

                      

                      </div>

                  </div>

                </div>

                

                <div _ngcontent-ytn-c61="" id="pack_details" class="pack_right ng-star-inserted"></div>

                

                </div>

            </div>

            </div>

          </app-packages>

        </div>
        
        <?php $firstPackId = $this->Setting->firstPack(); ?>

        <script>
		<?php if($firstPackId > 0){?>
		$(document).ready(function(e) {
            choosePlan('<?php echo $firstPackId; ?>');
        });
		<?php } ?>
        function choosePlan(id){

			if(id != ""){

				$('#pack_details').html('Loading...');

				$('.pack_block').removeClass('selected');

				$('#pack_div_'+id).addClass('selected');

				$('#pack_radio_'+id).prop('checked',true);

				$.ajax({
					type: 'POST',
					url: '<?= $this->Url->build('/get-pack-data');?>',
					data: {id:id},
					success: function(msg){
						$('#pack_details').html(msg);
					}
				});

			}

		}
		function proceedToPay(id){
			if(id != ""){
				$('#proceedPayBtn').html('Processing...');
				$.ajax({
					type: 'POST',
					url: '<?= $this->Url->build('/check-package');?>',
					data: {id:id},
					success: function(msg){
						if(msg == 'Success'){
							window.location.href = '<?= $this->Url->build('/create-order/');?>'+id;
						}else if(msg == 'GoToSignIn'){
							window.location.href = '<?= $this->Url->build('/sign-in/');?>';
						}else{
							alert('Internal error!'); return false;
						}
					}
				});
			}
		}
		function showcodebox(){
			$('#applyCouponCodeLink').hide();
			$('#applyCouponCodeInputDiv').show();
			$('#applyCouponCodeInputDivError').hide();
			$('#coupon_code').focus();
		}
		function applyCouponCode(){
			if($.trim($('#coupon_code').val()) == ""){
				$('#coupon_code').focus();
			}else{
				$('#couponApplyBtn').html('....');
				var couponCode = $('#coupon_code').val();
				var pck = $('#coupon_code').attr('pck');
				$.ajax({
					type: 'POST',
					url: '<?= $this->Url->build('/check-coupon-code');?>',
					data: {couponCode:couponCode,pck:pck},
					success: function(msg){
						const obj = JSON.parse(msg);
						if(obj['status'] == 'Success'){
							$('#discount_amt').html(obj['discount_amt']);
							$('#final_amt').html(obj['final_amt']);
							$('#discount_div').show();
							$('#applyCouponCodeInputDivError').html(obj['msg']).show();
						}else{
							$('#discount_amt').html(obj['discount_amt']);
							$('#final_amt').html(obj['final_amt']);
							$('#discount_div').hide();
							$('#coupon_code').val('');
							$('#applyCouponCodeInputDivError').html(obj['msg']).show();
						}
						$('#couponApplyBtn').html('Apply');
					}
				});
			}
		}
        </script>
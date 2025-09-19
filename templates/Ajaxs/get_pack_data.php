<div _ngcontent-ytn-c61="" class="pack_right_inner">

<div _ngcontent-ytn-c61="" class="summary_header"><span _ngcontent-ytn-c61="" class="summary_heading">Order Summary</span><span _ngcontent-ytn-c61="" class="price_label">Price</span></div>

<div _ngcontent-ytn-c61="" class="summary_body"><span _ngcontent-ytn-c61="" class="yp_label">Your Plan</span>

<div _ngcontent-ytn-c61="" class="package_row">

<div _ngcontent-ytn-c61="" class="pack_col_1"><?php echo $record->title;?></div>

<div _ngcontent-ytn-c61="" class="pack_col_2">INR <?php echo $record->price; ?></div>

</div>

<div _ngcontent-ytn-c61="" id="applyCouponCodeLink" class="package_row">
<a onclick="showcodebox();" style="cursor:pointer; color:#007bff; text-decoration:underline">Apply coupon code</a>
</div>
<div _ngcontent-ytn-c61="" id="applyCouponCodeInputDiv" style="display:none;" class="package_row">
<input placeholder="Enter coupon code" id="coupon_code" pck="<?php echo base64_encode($record->id); ?>" class="couponcode_box" type="text" />
<a onclick="applyCouponCode();" id="couponApplyBtn" class="apply_couponcode_btn">Apply</a>
</div>
<div _ngcontent-ytn-c61="" id="applyCouponCodeInputDivError" style="display:none;" class="package_row"></div>


<hr _ngcontent-ytn-c61="">

<div _ngcontent-ytn-c61="" id="discount_div" style="display:none" class="package_row total_amount">

<div _ngcontent-ytn-c61="" class="pack_col_1">Discount Amount</div>

<div _ngcontent-ytn-c61="" id="discount_amt" class="pack_col_2"></div>

</div>

<div _ngcontent-ytn-c61="" class="package_row total_amount">

<div _ngcontent-ytn-c61="" class="pack_col_1">Total Amount</div>

<div _ngcontent-ytn-c61="" id="final_amt" class="pack_col_2">INR <?php echo $record->price; ?></div>

</div>

<button _ngcontent-ytn-c61="" id="proceedPayBtn" onclick="proceedToPay('<?php echo base64_encode($record->id); ?>');" class="proceed ng-star-inserted">Proceed To Pay</button>
</div>
</div>
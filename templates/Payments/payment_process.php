<?php $this->assign('title','Secure Payment Processing'); ?>
<?php $this->disableAutoLayout(); ?>
<script src="https://www.mrcoconut.in/js/front/vendor/jquery-3.4.1.min.js"></script>
<div style="text-align:center; margin-top:235px;">

<h3>We are processing your payment.</h3>
<p>This process may take a few seconds, so please be patient.</p>

</div>

<form method="post" id="paytmForm" action="<?php echo PAYTM_TXN_URL ?>" name="f1">

<?php
foreach($paramList as $name => $value) {
	echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
}
?>
            
<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
                        
</form>

<script type="text/javascript">

setTimeout(function(){ $('#paytmForm').submit();},2000);

</script>


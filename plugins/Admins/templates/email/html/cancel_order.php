<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?php e(SITE_TITLE);?></title>
  </head>
<body style="-webkit-text-size-adjust: 100%; -moz-text-size-adjust: none;-ms-text-size-adjust: 100%;">
<table style="margin:0 auto; width:800px; border:1px solid #d3d3d3; padding:10px 15px 10px; box-sizing:border-box; border-collapse: separate; border-spacing:0;" aria-describedby="mydesc">
<tr style="display:none; height:0px; width:0px;">
<th scope="col" colspan="2"></th>
</tr>
  <?php e($this->Element('email_data/email_header'));
    $booking = $sendEmailData['userData']; 
  ?>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:14px;font-weight:500;">Your order is cancelled now..! <br>You'll find a summary of your recent cancel order below.</td>
  </tr>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Dear <?php e(ucwords($booking['customer_name'])); ?>,</td>
  </tr>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Invoice ID: <?php e(strtolower($booking['invoice_id'])); ?></td>
  </tr>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Price: <span>&#8377;</span><?php e(number_format($booking['total'],2)); ?> </td>
  </tr> 
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Payment Method: <?php e($booking['payment_method']); ?></td>
  </tr>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Order Place : <?php e(date("F jS, Y h:i A",$booking['created'])); ?></td>
  </tr>  
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Order Cancel : <?php e(date("F jS, Y h:i A",$booking['cancel_date'])); ?></td>
  </tr>
  <?php if(isset($booking['notes']) && !empty($booking['notes'])){?>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Reason: <?php e(nl2br($booking['notes'])); ?></td>
  </tr>
  <?php } ?>
   <?php e($this->Element('email_data/email_footer_text'));?>
 </table>
</body>
</html> 
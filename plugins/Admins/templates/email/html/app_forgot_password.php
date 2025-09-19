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
  $userDetails = $sendEmailData['userData'];
  ?>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Dear <?php e(ucwords($userDetails['name'])); ?>,</td>
  </tr>
   <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Email: <?php e($userDetails['email']); ?>,</td>
  </tr>
  <?php if(isset($userDetails['temp_password'])){ ?>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">Temporary Password: <?php e($userDetails['temp_password']); ?></td>
  </tr>
<?php } ?>
 <?php if(isset($userDetails['new_password'])){ ?>
  <tr>
    <td colspan="2" style="padding:20px 15px 10px;font-family:Verdana, Geneva, sans-serif; color:#424242; font-size:13px;font-weight:400;">New Password: <?php e($userDetails['new_password']); ?></td>
  </tr>
<?php } ?>
  <?php e($this->Element('email_data/email_footer_text'));?>
 </table>
</body>
</html>
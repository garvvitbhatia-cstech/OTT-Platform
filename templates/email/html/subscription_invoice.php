<?php ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cinemasthan</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Sans" />
</head>

<body bgcolor="#f7f8fa">
    <div style="width:100%;" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="center" valign="top">
<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="background-color:#ffffff; padding:15px">
    <tbody>
        <tr>
            <td align="center" valign="top" style="color:#000000; font-family: tahoma; border: 1px solid #484848; font-size:16px;padding: 28px 18px 0;-webkit-font-smoothing: antialiased;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom: solid 6px #ffda65;padding-bottom: 25px; background:#000;">
                    <tbody>
                        <tr>
                            <td style="padding:15px;" align="center" valign="middle">
                                <a title="Cinemasthan" href="" style="text-decoration:none;color:#000000; "><img src="<?php echo SITEURL;?>img/logo.png" alt="Cinemasthan" title="Cinemasthan" width="200" /></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 20px;">
                    <tbody>
                        <tr>
                            <td align="left" valign="middle" style="color: #000;font-size: 13px;font-weight: 550; padding-top: 10px;font-family:tahoma;-webkit-font-smoothing: antialiased;">
                                Hello <?php echo ucfirst($username);?>,
                                
                            <td>
							<td align="right" valign="middle" style="color: #000;font-size: 13px;font-weight: 550; padding-top: 10px;font-family:tahoma;-webkit-font-smoothing: antialiased;">
                                Date: <?php echo date('d F Y');?>
                                
                            <td>
                        </tr>
						</tbody>
						</table>
                        
                        
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 20px; padding-bottom: 15px;">
                    <tbody>
                        <tr>
                        <td style="font-size: 13px;font-weight: 300; color: #000000;font-family: tahoma;-webkit-font-smoothing: antialiased;">
                        <br />	
                        Thank you very much for joining Cinemasthan, If you have any questions, please visit our help center page! We will be reaching out once you have completed your application.
                        <br /><br /><br />
                       
                            <table style="width: 100%;border: 1px solid #484848;font-family: tahoma;border-collapse: collapse;;border-style: hidden;box-shadow: 0 0 0 1px #484848;-webkit-font-smoothing: antialiased;">
                                <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Invoice ID:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $orderData->invoice_id;?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Txn No:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $orderData->txn_id;?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Order Date:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo date('d F Y',$orderData->created);?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Plan Name:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $planName;?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Amount:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $orderData->price;?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Discount:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $orderData->discount;?></td>
                                    <td></td>
                                 </tr>
                                 <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Final Amount:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo $orderData->total;?></td>
                                    <td></td>
                                 </tr>
                                <tr style="border-bottom: 1px solid #484848;">
                                    <td style="padding: 10px; color: #484848; font-size: 13px; padding-left: 40px;">Validity:</td>
                                    <td style="padding: 10px; color: #484848; font-size: 13px;"><?php echo date('d F Y',$orderData->pack_start_date);?> to <?php echo date('d F Y',$orderData->pack_end_date);?></td>
                                    <td></td>
                                 </tr>
                            </table>
                            <br /><br />
						Please feel free to get in touch with our support team at <a href="#" style="text-decoration: none; color: #9b790f;"> info@cinemasthan.com</a>
						<br /><br />
						Thank you, 
						<br /><br />
 						<a href="#" style="text-decoration: none; color: #9b790f; font-weight: bold;">Cinemasthan</a>
 						</br><br />
 						<a href="#" style="text-decoration: none; color: #000000;">www.cinemasthan.com</a>
                		<br /><br /><br />
                        </td>
                        </tr>
                        
                    </tbody>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <td align="center" valign="middle" bgcolor="#484848" style="background: #484848; color: #ffffff;font-size: 13px;font-weight: 300;font-family: tahoma;line-height: 26px;padding: 3px 0 3px 0; ">
                             Copyright © 2021 Cinemasthan - All Rights Reserved.
                        </td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</td>
</tr>
</tbody>
</table>

</div>
</body>
</html>
<td colspan="8">

    <div class="row">

        <div class="col-md-12 col-lg-12 col-xs-12" style="padding-left: 30px;">

            <h4 class="heading-top"><?php echo ucwords($detail->name); ?> Details:</h4>         

            <p>	
            	<div class="heading_text_style"><strong>Email:</strong></div>

            	<div class="name_style"> <?php echo strtolower(isCheckVal($detail->email)); ?></div>
           

            	<div class="heading_text_style"><strong>Mobile:</strong></div>

                <div class="name_style"> <?php echo isCheckVal($detail->mobile); ?></div>
                

                <div class="heading_text_style"><strong>Subject:</strong></div>

                <div class="name_style"> <?php echo isCheckVal($detail->subject); ?></div>
                
                
                <div class="heading_text_style"><strong>Description:</strong></div>

                <div class="name_style"> <?php echo nl2br(isCheckVal($detail->description)); ?></div>

           	</p>            

        </div>    

    </div>    

</td>

   

<style>

	.heading-top {
		text-decoration: none;
		font-size: 18px;
		background-color: #00b0e4;
		padding: 8px 0 8px 8px;
		color: #fff;
		margin-top: 8px;
	}

	.heading_text_style {
		display: inline-block;
		font-size: 16px;
		width: 20%;
		padding: 0 0 0 10px;
	}

	.name_style {
		width: 60%;
		display: inline-block;
		padding-left: 15px;
		font-size: 14px;
	}
</style>

<?php die; ?>
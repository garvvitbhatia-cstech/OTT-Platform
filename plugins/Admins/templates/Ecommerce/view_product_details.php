<td colspan="7">

    <div class="row">
    
        <div class="col-md-12 col-lg-12 col-xs-12" style="padding-left:30px;">
            
            <h4 class="heading-top"><?php echo ucwords($productDetail->product_name); ?> Details:</h4>
         
            <p>
            	<?php if($productDetail->category_id > 0){ ?>
                    <div class="heading_text_style"><strong>Category:</strong></div>
                    <?php $category = $this->Ecommerce->getCategoryNameById($productDetail->category_id); ?>
                    <div class="name_style"> <?php echo ucwords(isCheckVal($category)); ?></div>
                <?php } ?>
                                
                <div class="heading_text_style"><strong>Product Name:</strong></div>
            	<div class="name_style"> <?php echo ucwords(isCheckVal($productDetail->product_name)); ?></div>
                
                <div class="heading_text_style"><strong>Product Price:</strong></div>
            	<div class="name_style"> <?php echo ucwords(isCheckVal($productDetail->price)); ?></div>
                
                <div class="heading_text_style"><strong>Product Quantity:</strong></div>
            	<div class="name_style"> <?php echo ucwords(isCheckVal($productDetail->quantity)); ?></div>
                
                <div class="heading_text_style"><strong>Product Description:</strong></div>
            	<div class="name_style"> <?php echo nl2br(isCheckVal($productDetail->description)); ?></div>
               
                <br /><br />
                <?php if($productImages->count() > 0){ 
				foreach($productImages as $key => $val):
					if(!empty($val->image_name)){
					$imgPath = WWW_ROOT.'img/products/'.$val->image_name;
					if(is_file($imgPath) && file_exists(WWW_ROOT.'img/products/'.$val->image_name)){
						echo $this->Html->image('products/'.$val->image_name, array('class' => 'img-rounded', 'title'=>$val->image_title, 'alt'=> $val->image_alt, 'width' => '80','style' => 'margin: 3px 3px 40px 7px;max-width: 100%;height: auto;'));
					?>
				<?php } } endforeach; } ?>
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
<?php
if(isset($categoryData->name)){
    #set page meta content
    $this->assign('title', $categoryData->name);
   $this->assign('meta_keywords', $categoryData->name);
    $this->assign('meta_description', $categoryData->name);
    $this->assign('meta_robot', 'index, follow');
}
?>
<main class="content-section">

    <div class="product-box-section live_tv">
    
            <div class="top-content container-fluid">						
                <section class="sec_header ng-star-inserted">
                    <h3 class="ott_tray_title has_view_more"><?php echo $categoryData->name;?></h3>
                </section> 
                <?php $items = $this->Media->getItems($categoryData->id);?>
                
                <div class="carousel-slider-items">
                    <div class="without-slider">
                    	<?php if($items->count() > 0){?>
                        <?php 
						foreach($items as $key => $item){
							$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $categoryData->slug);
							if($categoryData->poster_type == 'Vertical'){
								echo $this->Media->getVerticalItem($categoryData->rent_label,$categoryData->live_label,$itemData);
							}else{
								echo $this->Media->getHorizontalItem($categoryData->rent_label,$categoryData->live_label,$itemData);
							}
						}
						?>
                        <?php }else{?>
                        <div class="no_records">There are no records</div>
                        <?php } ?>
                      
                    </div>
                </div>
                
            </div>  

    </div>
    </div>
</main>

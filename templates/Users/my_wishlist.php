<?php
if(isset($pageData->seo_title)){
    #set page meta content
    $this->assign('title', $pageData->seo_title);
    $this->assign('meta_keywords', $pageData->seo_keyword);
    $this->assign('meta_description', $pageData->seo_description);
    $this->assign('meta_robot', $pageData->robot_tags);
}
?>

<main class="content-section">
<!--Rent Movies section start here-->
<div  class="product-box-section live_tv">

        <div class="top-content container-fluid">						

            <section class="sec_header ng-star-inserted">

                <h3 class="ott_tray_title has_view_more">My Wishlist</h3>

            </section> 
			
            <div class="carousel-slider-items">

                    <div class="without-slider">

                    	<?php 
						$fillArray = array();
						if($records->count() > 0){?>

                        <?php 
						
						foreach($records as $key => $record){
							$item = $this->Media->getItem($record->product_id);
							if(isset($item->category_id)){
							$categoryData = $this->Media->getCategory($item->category_id);
							$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $categoryData->slug);
							echo $this->Media->getVerticalItem(0,0,$itemData);
							$fillArray[] = $record->product_id;
							}
						}

						?>

                        <?php }?>
                        
                        <?php if(count($fillArray) == 0){?>

                        <div style="text-align:center; margin-bottom:50px;">
                        <img src="<?php echo SITEURL?>/img/no_fav.svg" /><br /><br /><br />
                        <span style="color:#FFF; font-size:20px;">Looks like you don’t have any Wishlist yet...!</span>
                        </div>

                        <?php } ?>

                      

                    </div>

                </div>
            
            
            
        </div>
        </div>
        
<div class="product-box-section">

    

            <div class="top-content container-fluid">						

                <section class="sec_header ng-star-inserted">

                    <h3 class="ott_tray_title has_view_more">You May Also Like</h3>

                </section> 

                <div class="carousel-slider-items">

                    <div class="owl-carousel">

                    	
                        <?php if($remainingMovies->count() > 0){
							foreach($remainingMovies as $key => $remainingMovie){

									$categoryData = $this->Media->getCategory($remainingMovie->category_id);
									$itemData = array('title' => $remainingMovie->product_name, 'img_v' => $remainingMovie->vertical_banner, 'img_h' => $remainingMovie->horizontal_banner, 'slug' => $remainingMovie->slug,'free_paid' => $remainingMovie->type,'cat_slug' => $categoryData->slug);
									echo $this->Media->getVerticalItem($categoryData->rent_label,0,$itemData);
								
							}
						} ?>

                      

                    </div>

                </div>

                

            </div>  



    </div>        

</div>
<!--Rent Movies section end here-->
</main>


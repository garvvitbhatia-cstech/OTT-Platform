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



			<?= $this->element('slider') ?>



			<!--Rent Movies section start here-->



			<div class="product-box-section">

					<?php 

					if(count($categories) > 0){

					foreach($categories as $key => $category){?>

                    <?php $items = $this->Media->getItems($category['id']);?>

                    <?php if($items->count() > 0){?>

					<div class="top-content container-fluid">						



				    	<section class="sec_header ng-star-inserted">



				    		<h3 class="ott_tray_title has_view_more"><?php echo $category['name'];?></h3>

							<?php if($items->count() > 8){?>

				    		<a href="<?php echo $this->Url->build('/view-all/'.$category['slug'].'/'); ?>" class="view-more">View All</a>
                            
                            <?php } ?>



				    	</section> 



						<div class="carousel-slider-items">



							<div class="<?php if($category['poster_type'] == 'Vertical'){ ?>owl-carousel<?php }else{ ?> owl-carousel-tv<?php } ?> owl-theme">



								<?php 

								foreach($items as $key => $item){

									$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $category['slug']);

									if($category['poster_type'] == 'Vertical'){

										echo $this->Media->getVerticalItem($category['rent_label'],$category['live_label'],$itemData);

									}else{

										echo $this->Media->getHorizontalItem($category['rent_label'],$category['live_label'],$itemData);

									}

								}

								?>

							</div>

						</div>

					</div>

					<?php } } }else{?>

                    

                    <div style="text-align:center; margin-bottom:50px;">

                        <img src="<?php echo SITEURL?>/img/no_fav.svg" /><br /><br /><br />

                        <span style="color:#FFF; font-size:20px;">There are no records!</span>

                        </div>

                    

                    <?php } ?> 

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
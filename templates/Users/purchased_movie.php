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

                <h3 class="ott_tray_title has_view_more">Purchased Movies</h3>

            </section> 

            <div class="carousel-slider-items">

                <div class="owl-carousel owl-theme">

                    <?php 
                    for($i =0; $i<= 15; $i++){echo $this->Media->getVerticalItem(2,2);}
                    ?>
                </div>
            </div>
        </div>
        </div>

</div>
<!--Rent Movies section end here-->
</main>


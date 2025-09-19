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

            <div style="text-align:center; margin-bottom:200px;">

            <img width="100" src="<?php echo SITEURL?>/img/6-2-success-png-image.png" /><br /><br /><br />

            <span style="color:#FFF; font-size:20px;">You are already subscribed on Cinemasthan...!</span>

            </div>

        </div>

        </div>



</div>

<!--Rent Movies section end here-->

</main>




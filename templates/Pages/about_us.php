<?php

if(isset($pageData->seo_title)){

    #set page meta content

    $this->assign('title', $pageData->seo_title);

    $this->assign('meta_keywords', $pageData->seo_keyword);

    $this->assign('meta_description', $pageData->seo_description);

    $this->assign('meta_robot', $pageData->robot_tags);

}

?>

<div _ngcontent-ytn-c55="" class="ott-main-body has-header">

<router-outlet _ngcontent-ytn-c55=""></router-outlet>

<app-packages _nghost-ytn-c61="" class="ng-star-inserted">

<?php if($pageData->banner != "" && $pageData->banner_status == 1){?>
        <div class="header-slider">

            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">

              <span class="banner_bottom_gradient"></span>

              <div class="carousel-inner">

                <div class="carousel-item active">

                  <a href="#"><img class="d-block w-100" src="<?php echo SITEURL; ?>img/banners/<?php echo $pageData->banner;?>" alt="Third slide"></a>

                </div>

              </div>

            </div>

        </div>
		<?php } ?>

  <div _ngcontent-ytn-c61="">

    <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">
   
      <?php if(isset($pageData->heading) && $pageData->status == 1){?><h2 _ngcontent-ytn-c61="" class="ng-star-inserted"><?php echo $pageData->heading;?></h2><?php } ?>

      <div _ngcontent-ytn-c61="" class="package_inner">
		
        <div style="text-align:justify; padding:25px;">
<img style="width: 140px !important;float: right;border: 1px solid #e1e1e1;margin-left: 22px; background:#fff;" src="<?php echo SITEURL; ?>img/riff_logo.png" alt="">
        <?php if(isset($pageData->description) && $pageData->status == 1){?><p><?php echo nl2br($pageData->description);?></p><?php } ?>

        </div>

      </div>

    </div>

   </div>

  </app-packages>

</div>
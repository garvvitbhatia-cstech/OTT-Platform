<?php $sliders = $this->Setting->slider();?>
<div class="header-slider">
	<?php if($sliders->count() > 0){?>
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">

      <ol class="carousel-indicators">
		
        <?php foreach($sliders as $key => $slider){?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>" <?php if($key == 0){?>class="active"<?php } ?>></li>
        <?php } ?>

      </ol>

      <span class="banner_bottom_gradient"></span>

      <div class="carousel-inner">
		
        <?php foreach($sliders as $key => $slider){?>
        
        <div class="carousel-item <?php if($key == 0){?>active<?php } ?>">

          <?php if($slider->url != ""){?><a  href="<?php echo $slider->url;?>"><?php } ?><img class="d-block w-100" src="<?php echo $this->Url->build('/img/banners/'.$slider->banner); ?>" alt="<?php echo $slider->title;?>"><?php if($slider->url != ""){?></a><?php } ?>

        </div>
		
        <?php } ?>

      </div>

    </div>
	<?php } ?>
</div>
<?php
if(isset($movieData->seo_title)){
	$seoTitle = "";
	if($movieData->seo_title != ""){
		$seoTitle = $movieData->seo_title;
	}else{
		$seoTitle = 'Watch '.$movieData->product_name.' Movie Online |  '.$movieData->product_name.' Movie Online | '.$movieData->product_name.' Movie ';
	}
    #set page meta content
    $this->assign('title', $seoTitle);
    $this->assign('meta_keywords', $movieData->seo_keywords);
    $this->assign('meta_description', $movieData->seo_description);
    $this->assign('meta_robot', $movieData->robot_tags);
}

$isSubscribed = $isRantel = 'No';
$session = $this->request->getSession();
if($session->check('LoginUser.id')){
	$isSubscribed = $this->Setting->checkSubbscription($session->read('LoginUser.id'));
	$isRantel = $this->Setting->checkRental($session->read('LoginUser.id'),$movieData->id);
}
?>
<style>
.movie_details {
	z-index: 99;
	color: #fff;
	width: 55%;
	position: absolute;
	top: 28%;
	left: 3%;
	padding: 26px;
}
.moview_title {
	font-size: 30px;
	width: 100%;
	float: left;
	margin-bottom: 10px;
}
.movie_year {
	width: 100%;
	float: left
}
.movie_description {
	margin-top: 20px;
	height: 90px;
	text-align: justify;
	float: left;
	font-size: 14px;
	color: #ccc;
	margin-bottom: 52px;
}
.movie_btns {
	margin-top: 2%;
}
.rent_btn {
	background: #35323F;
	padding: 13px;
	margin-right: 5px;
	cursor: pointer;
	color: #fff;
}
.rent_btn:hover {
	color: #FFF;
}
.play_now_btn:hover {
	color: #FFF;
}
.play_now_btn {
	background: #D99300;
	padding: 13px;
	margin-right: 5px;
	cursor: pointer;
	color: #fff;
}
.rental_text {
	margin-top: 13px;
	float: left;
	font-size: 13px;
	color: #8bc5ff;
	font-style: italic;
}
 @media(max-width: 767px) {
.movie_details {
	z-index: 0 !important;
	color: #fff;
	width: 100%;
	position: relative;
	top: 35%;
	left: 0%;
	padding: 15px;
}
.moview_title {
	font-size: 18px;
	width: 100%;
	float: left
}
.movie_year {
	width: 100%;
	float: left;
	font-size: 11px;
	text-align: justify;
}
.movie_description {
	margin-top: 28px;
	font-size: 11px;
	text-align: justify;
	height: auto;
}
.movie_btns {
	margin-top: 7%;
}
.rental_text {
	font-size: 10px;
	margin-bottom: 20px;
	margin-top: 17px;
	float: left;
}
.mobile_view_btn {
	width: 100%;
	margin-bottom: 10px;
	margin-right: 20px;
	float: left;
	text-align: center;
}
}
 @media(max-width: 992px) {
.movie_details {
	z-index: 0 !important;
	color: #fff;
	width: 100%;
	position: relative;
	top: 35%;
	left: 0%;
	padding: 15px;
}
.moview_title {
	font-size: 18px;
	width: 100%;
	float: left
}
.movie_year {
	width: 100%;
	float: left;
	font-size: 11px;
}
.movie_description {
	margin-top: 28px;
	font-size: 11px;
	text-align: justify;
	height: auto;
}
.movie_btns {
	margin-top: 7%;
}
.rental_text {
	font-size: 10px;
	margin-bottom: 20px;
	margin-top: 17px;
	float: left;
}
.mobile_view_btn {
	width: 100%;
	margin-bottom: 10px;
	margin-right: 20px;
	float: left;
	text-align: center;
}
}
</style>
<main class="content-section">

<div class="header-slider">
  <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel"> <span class="banner_left_gradient"></span> <span class="banner_bottom_gradient"></span>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <?php 

				  	$bannerImg = SITEURL.'img/big-banner-no-img.jpg';

					if(isset($movieData->big_banner) && $movieData->big_banner != ""){

					  $bannerImg = SITEURL.'img/banners/'.$movieData->big_banner;

					   } ?>
        <img class="d-block w-100" src="<?php echo $bannerImg; ?>" alt=""> </div>
    </div>
  </div>
  <div class="movie_details">
    <?php if(isset($movieData->product_name) && $movieData->product_name != ""){?>
    <span class="moview_title"><?php echo $movieData->product_name;?></span>
    <?php } ?>
    <?php 

					$productionYear = $language = $genres = $censor = $hour = $minute = '';

					if($movieData->production_year != ""){

						$productionYear = $movieData->production_year.' | ';

					}

					if($movieData->language != ""){

						$language = $movieData->language.' | ';

					}

					if($movieData->genres != ""){

						$genres = $movieData->genres.' | ';

					}

					if($movieData->censor_category != ""){

						$censor = $movieData->censor_category.' | ';

					}

					if($movieData->hours != ""){

						$hour = $movieData->hours.'h ';

					}

					if($movieData->minutes != ""){

						$minute = $movieData->minutes.'m';

					}

					?>
    <span class="movie_year"><?php echo $productionYear.$language.$genres.$censor.$hour.$minute;?></span>
    <div style="clear:both"></div>
    <?php if(isset($movieData->director) && $movieData->director != ""){?>
    <span style="margin-top:20px;" class="movie_year">Director: <?php echo $movieData->director; ?></span>
    <?php } ?>
    <?php if(isset($movieData->producer) && $movieData->producer != ""){?>
    <span class="movie_year">Producer: <?php echo $movieData->producer; ?></span>
    <?php } ?>
    <?php if(isset($movieData->keywords) && $movieData->keywords != ""){?>
    <span class="movie_year">Cast: <?php echo $movieData->keywords; ?></span>
    <?php } ?>
    <?php if(isset($movieData->description) && $movieData->description != ""){?>
    <p class="movie_description">
      <?php if(strlen($movieData->description) > 600){ echo substr($movieData->description,0,600).'...'; }else{ echo $movieData->description; } ?>
    </p>
    <?php } ?>
    <div style="clear:both"></div>
    <div class="movie_btns">
      <?php if($movieData->trailer_video != ""){?>
      <?php if($session->check('LoginUser.id')){ ?>
      <a href="<?php echo $this->Url->build('/play/trailer/'.$catSlug.'/'.$movieData->slug.'/'); ?>" class="rent_btn mobile_view_btn"> <img _ngcontent-ntu-c40="" src="<?php echo SITEURL; ?>img/trailer-icon-web.svg" class="ng-tns-c40-139"> Trailer</a>
      <?php }else{ ?>
      <a style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" class="rent_btn mobile_view_btn"> <img _ngcontent-ntu-c40="" src="<?php echo SITEURL; ?>img/trailer-icon-web.svg" class="ng-tns-c40-139"> Trailer</a>
      <?php } ?>
      <?php } ?>
      <?php if($session->check('LoginUser.id')){ ?>
      <?php if($isRantel == 'No' && $isRent == 'Yes' && $movieData->price > 0 && $isSubscribed == "No" && $movieData->type == 'Paid'){?>
      <a href="<?php echo $this->Url->build('/create-rental/'.base64_encode($movieData->id)); ?>" class="rent_btn mobile_view_btn">Rent for ₹ <?php echo number_format($movieData->price,2);?></a>
      <?php } ?>
      <?php }else{ ?>
      <?php if($isRent == 'Yes' && $movieData->price > 0 && $isSubscribed == "No" && $movieData->type == 'Paid'){?>
      <a style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" class="rent_btn mobile_view_btn">Rent for ₹ <?php echo number_format($movieData->price,2);?></a>
      <?php } ?>
      <?php } ?>
      <?php if($movieData->video != ""){?>
      <?php if($session->check('LoginUser.id')){ ?>
      <?php if($isSubscribed == "Yes" || $movieData->type == 'Free' || $isRantel == 'Yes'){?>
      <a href="<?php echo $this->Url->build('/play/movie/'.$catSlug.'/'.$movieData->slug.'/'); ?>" class="play_now_btn mobile_view_btn"> <img _ngcontent-ntu-c40="" src="<?php echo SITEURL; ?>img/trailer-icon-web.svg" class="ng-tns-c40-139"> Play Now</a>
      <?php } ?>
      <?php }else{ ?>
      <?php if($movieData->type == 'Free'){?>
      <a href="<?php echo $this->Url->build('/play/movie/'.$catSlug.'/'.$movieData->slug.'/'); ?>" class="play_now_btn mobile_view_btn"> <img _ngcontent-ntu-c40="" src="<?php echo SITEURL; ?>img/trailer-icon-web.svg" class="ng-tns-c40-139"> Play Now</a>
      <?php } ?>
      <?php } ?>
      <?php } ?>
      <?php if($session->check('LoginUser.id')){ ?>
      <?php if($isSubscribed == "No"){?>
      <a href="<?php echo $this->Url->build('/pricing/'); ?>" class="play_now_btn">Subscribe Now</a>
      <?php } ?>
      <?php }else{ ?>
      <a style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" class="play_now_btn">Subscribe Now</a>
      <?php } ?>
      <?php if($session->check('LoginUser.id')){ ?>
      <a style="cursor:pointer" onclick="setAddWishlist('<?php echo($movieData->id);?>');">
      <?php if($currentWishStatus == 1){?>
      <img   id="addToWishIcon" src="<?php echo SITEURL; ?>img/remove-watch-list.svg">
      <?php }else{ ?>
      <img  id="addToWishIcon" src="<?php echo SITEURL; ?>img/add-to-watch-list.svg">
      <?php } ?>
      </a>
      <input type="hidden" id="wishlist_data" value="<?php echo $currentWishStatus; ?>" />
      <?php }else{ ?>
      <a style="cursor:pointer" data-toggle="modal" data-target="#exampleModal"><img id="addToWishIcon" src="<?php echo SITEURL; ?>img/add-to-watch-list.svg"></a>
      <?php } ?>
    </div>
    <?php if($isRent == 'Yes' && $movieData->price > 0 && $isSubscribed == "No" && $movieData->type == 'Paid'){?>
    <div style="clear:both"></div>
    <span class="rental_text"><img _ngcontent-ntu-c40="" src="<?php echo SITEURL;?>img/pack-info-icon.svg" class="ng-tns-c40-139"> Rentals will be active for 24 hours from the time of purchased.</span>
    <?php } ?>
    <div style="clear:both"></div>
  </div>
</div>
<div style="margin-top:70px;" class="product-box-section">
  <div class="top-content container-fluid">
    <section class="sec_header ng-star-inserted">
      <h3 class="ott_tray_title has_view_more">You May Also Like</h3>
    </section>
    <?php $items = $this->Media->getItems($youMayLikeCategoryData->id); ?>
    <div class="carousel-slider-items">
      <div class="owl-carousel">
        <?php if($items->count() > 0){?>
        <?php 
						$movieArray = Array();
						foreach($items as $key => $item){

							if($item->id != $movieData->id){

							$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $youMayLikeCategoryData->slug);

							if($youMayLikeCategoryData->poster_type == 'Vertical'){

								echo $this->Media->getVerticalItem(0,0,$itemData);

							}else{

								echo $this->Media->getHorizontalItem(0,0,$itemData);

							}
							
							}
							$movieArray[] = $item->id;

						}

						?>
        <?php }?>
        <?php if($remainingMovies->count() > 0){
							foreach($remainingMovies as $key => $remainingMovie){
								if(!in_array($remainingMovie->id, $movieArray)){
									if($remainingMovie->id != $movieData->id){
									
									$explodeCategory = explode(',',$movieData->category_id);
									$youMayLikeCateIDOther = $explodeCategory[0];
									if($explodeCategory[0] == 1 && isset($explodeCategory[1])){
										$youMayLikeCateIDOther = $explodeCategory[1];
									}
										
									$categoryData = $this->Media->getCategory($youMayLikeCateIDOther);
									
									$itemData = array('title' => $remainingMovie->product_name, 'img_v' => $remainingMovie->vertical_banner, 'img_h' => $remainingMovie->horizontal_banner, 'slug' => $remainingMovie->slug,'free_paid' => $remainingMovie->type,'cat_slug' => $categoryData->slug);
									echo $this->Media->getVerticalItem($categoryData->rent_label,0,$itemData);
									}
								}
							}
						} ?>
      </div>
    </div>
  </div>
</div>
</div>
</main>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="background-color:#18182f;" class="modal-content">
      <div style="border-bottom:0px;" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <img src="<?php echo SITEURL; ?>img/lan-popup-close.png" /> </button>
      </div>
      <div style="text-align:center; color:#FFF;" class="modal-body"> <span style="font-size:20px;">To get access to watch the content</span><br />
        <br />
        <span style="font-size:14px;">Sign in or Join Cinemasthan to enjoy uninterrupted services</span><br />
        <br />
      </div>
      <div class="modal-footer"> <a href="<?= $this->Url->build('/sign-in/');?>" class="wish_sign_in">Sign In</a> <a href="<?= $this->Url->build('/sign-up/');?>" class="wish_sign_up">Sign Up</a> </div>
    </div>
  </div>
</div>

<script>

function setAddWishlist(productId){

	var wishlistData = $('#wishlist_data').val();

	$.ajax({

		type: 'POST',

		url: '<?= $this->Url->build('/set-wishlist');?>',

		data: {productId:productId,wishlistData:wishlistData},

		success: function(msg){

			if(wishlistData == 1){

				$('#wishlist_data').val(2);

				$('#addToWishIcon').attr('src','<?php echo SITEURL; ?>img/add-to-watch-list.svg');

			}else{

				$('#wishlist_data').val(1);

				$('#addToWishIcon').attr('src','<?php echo SITEURL; ?>img/remove-watch-list.svg');

			}

		}

	});

}

</script>
<style>

.wish_sign_in{    
background: #2c2c70;
padding: 10px 20px; color:#FFF !important;
margin: 20px;
cursor: pointer;
}
.wish_sign_up{    
background: #d99200; color:#FFF !important;
padding: 10px 20px;
margin: 20px;
cursor: pointer;
}

</style>

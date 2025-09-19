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
    $this->assign('meta_keywords', $movieData->seo_keyword);
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
.close_video{    
position: absolute;
    right: 20px;
    top: 10px;
    font-size: 25px; cursor:pointer; display:none;
	}
.subs_now_div{    width: 100%;
    background: #000;
    color: #FFF;
    text-align: center;
    padding: 22%;}
video::-internal-media-controls-download-button { 
    display:none; 
} 
video::-webkit-media-controls-enclosure { 
    overflow:hidden; 

} 
video::-webkit-media-controls-panel { 
    width: calc(100% + 30px); /* Adjust as needed */ 
} 
.player-wrap{
	min-height:350px; 
	background:#000;
}
.moview_title{ font-size:30px !important; width:100%; float:left; margin-bottom:10px;}
.movie_year{ width:100%; float:left; font-size:16px;}
.move_decription{font-size:14px !important; color:#ccc !important;}
.rent_btn{background: #35323F;
padding: 13px;

margin-right: 5px; cursor:pointer; color:#fff;}
.rent_btn:hover{ color:#FFF;}
.play_now_btn{background: #D99300;
padding: 13px;
margin-right: 5px; cursor:pointer; color:#fff;}	

.rental_text{margin-top: 28px;
/* float: left; */
font-size: 13px;
color: #8bc5ff;
font-style: italic;
display: inherit;}	
#movieVideoPlayer{width:100%; height:480px; position:relative; bottom:-5px}
.player .vp-controls{
bottom:0 !important;
}
@media(max-width: 767px){
	.player-wrap{
	min-height:173px; 
	background:#000;
}
.moview_title { font-size:18px !important;}

element.style {
}
.movie_year {
    font-size: 11px !important;
}
.move_decription{font-size:11px !important; color:#ccc;}
.rent_btn {
    background: #35323F;
    padding: 13px;
    cursor: pointer;
    color: #fff;
    width: 100%;
    float: left;
    text-align: center;
    margin-bottom: 5;
    margin-bottom: 8px;
}
#movieVideoPlayer{width:100%; height:200px;}
}
@media(max-width: 992px){
	.player-wrap{
	min-height:173px; 
	background:#000;
}
.moview_title { font-size:18px !important;}
.movie_year {
    font-size: 11px !important;
}
.move_decription{font-size:11px !important; color:#ccc;}
.rent_btn {
    background: #35323F;
    padding: 13px;
    cursor: pointer;
    color: #fff;
    width: 100%;
    float: left;
    text-align: center;
    margin-bottom: 5;
    margin-bottom: 8px;
}
#movieVideoPlayer{width:100%; height:200px;}
}	
</style>

<?= $this->Html->css(array('movie')) ?>

<?php 
$bannerImg = SITEURL.'img/big-banner-no-img.jpg';
if(isset($movieData->big_banner) && $movieData->big_banner != ""){
$bannerImg = SITEURL.'img/banners/'.$movieData->big_banner;
} ?>

<div _ngcontent-xlr-c55="" class="ott-main-body has-header">

        <router-outlet _ngcontent-xlr-c55=""></router-outlet>

        <home-view _nghost-xlr-c42="" class="ng-star-inserted">

          <div _ngcontent-xlr-c42="" infinitescroll=""><!----><!----><!----><!---->

            <component-builder _ngcontent-xlr-c42="" _nghost-xlr-c35="" class="ng-star-inserted">

              <div _ngcontent-xlr-c35=""></div>

              <video-player _nghost-xlr-c33="" class="ng-star-inserted">

                <div _ngcontent-xlr-c33="" class="dmargins_f_player">

                  <div _ngcontent-xlr-c33="" class="player-page">

                    <div _ngcontent-xlr-c33="" class="player-left">

                      <div _ngcontent-xlr-c33="" class="player_inner_z">

                        <div _ngcontent-xlr-c33="" id="player-wrap" class="player-wrap">

                          <?php if($type == 'trailer'){?>

                          <iframe src="https://player.vimeo.com/video/<?php echo $movieData->trailer_video; ?>?amp;autoplay=1&badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" id="movieVideoPlayer" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen  title=""></iframe>

                          <?php }else{ ?>

                          <?php if($movieData->type == 'Free'){?>

                         
                          <iframe src="https://player.vimeo.com/video/<?php echo $movieData->video; ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" id="movieVideoPlayer" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title=""></iframe>

                          <?php }else{?>

                          <?php if($type == 'movie' && ($isSubscribed == 'Yes' || $isRantel == 'Yes')){?>

                          <iframe src="https://player.vimeo.com/video/<?php echo $movieData->video; ?>?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" id="movieVideoPlayer" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title=""></iframe>

                          <?php }else{ ?>

                          <div class="subs_now_div">

                          <a href="<?php echo $this->Url->build('/pricing/'); ?>"><img style="margin-left:20px;" src="<?php echo SITEURL; ?>img/subscribe.jpg"></a>

                          </div>

                          <?php } ?>

                          <?php } ?>

                          <?php } ?>

                          <script src="https://player.vimeo.com/api/player.js"></script>
                          <input type="hidden" id="current_player_time" value="0" />

                        </div>

                      </div>

                      <div _ngcontent-xlr-c33="" class="channel_desc">

                        <div _ngcontent-xlr-c33="" class="player_desc_left_bl">

                          <div _ngcontent-xlr-c33="" class="repeater ng-star-inserted">

                            <div _ngcontent-xlr-c33="" class="det_row_no_0 prog_det_loop ng-star-inserted">

                              <div _ngcontent-xlr-c33="" class="page_type_tvshowepisode pull-left ng-star-inserted"><!---->

                                <div _ngcontent-xlr-c33="" class="ott-year ott-text-font rowNumber_1 tvshowepisode ott-video-title ng-star-inserted">

                                  <h1 _ngcontent-xlr-c33="" class="moview_title"><?php echo $movieData->product_name;?></h1>

                                </div>

                                </div>

                              </div>

                            </div>

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

                          <div _ngcontent-xlr-c33="" class="repeater ng-star-inserted">

                            <div _ngcontent-xlr-c33="" class="det_row_no_1 prog_det_loop ng-star-inserted">

                              <div _ngcontent-xlr-c33="" class="page_type_tvshowepisode pull-left ng-star-inserted"><!----><!---->

                                <p _ngcontent-xlr-c33="" style="margin-bottom:12px;" class="ott-year ott-text-font rowNumber_2 tvshowepisode ott-video-subtitle ng-star-inserted"><span _ngcontent-xlr-c33="" class="movie_year"><?php echo $productionYear.$language.$genres.$censor.$hour.$minute;?></span></p>

                                <?php if(isset($movieData->director) && $movieData->director != ""){?><p style="margin-bottom:0px;" _ngcontent-xlr-c33="" class="movie_year"><span _ngcontent-xlr-c33="" class="subtext1">Director: <?php echo $movieData->director; ?></span></p><?php } ?>

                               <?php if(isset($movieData->producer) && $movieData->producer != ""){?> <p style="margin-bottom:0px;" _ngcontent-xlr-c33="" class="movie_year"><span _ngcontent-xlr-c33="" class="subtext1">Producer: <?php echo $movieData->producer; ?></span></p><?php } ?>

                               <?php if(isset($movieData->keywords) && $movieData->keywords != ""){?> <p style="margin-bottom:0px;" _ngcontent-xlr-c33="" class="movie_year"><span _ngcontent-xlr-c33="" class="subtext1">Cast: <?php echo $movieData->keywords; ?></span></p><?php } ?>

                                </div>

                              </div>

                            </div>

                          <div _ngcontent-xlr-c33="" class="repeater ng-star-inserted">

                            <div _ngcontent-xlr-c33="" class="det_row_no_2 prog_det_loop ng-star-inserted">

                              <div _ngcontent-xlr-c33="" class="page_type_tvshowepisode pull-left ng-star-inserted"><!----><!----><!---->

                                <div _ngcontent-xlr-c33="" class="repeater ng-star-inserted"><!----></div>

                                <span _ngcontent-xlr-c33="" style="text-align:justify" class="move_decription ott-year ott-text-font description tvshowepisode ng-star-inserted"><?php echo nl2br($movieData->description); ?></span></div>

                              </div>

                            </div>
                        

                          <div _ngcontent-xlr-c33="" class="repeater ng-star-inserted"><!----></div>
						  
						  <?php if($movieData->trailer_video != ""){?>

							 <a href="<?php echo $this->Url->build('/play/trailer/'.$catSlug.'/'.$movieData->slug.'/'); ?>" class="rent_btn mobile_view_btn"> <img _ngcontent-ntu-c40="" src="<?php echo SITEURL; ?>img/trailer-icon-web.svg" class="ng-tns-c40-139"> Trailer</a>

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
							
							
                    
                    <?php if($isRent == 'Yes' && $movieData->price > 0 && $isSubscribed == "No" && $movieData->type == 'Paid'){?>
                    <span class="rental_text"><img _ngcontent-ntu-c40="" src="<?php echo SITEURL;?>img/pack-info-icon.svg" class="ng-tns-c40-139"> Rentals will be active for 24 hours from the time of purchased.</span>
                    <?php } ?>

                          </div>

                        <div _ngcontent-xlr-c33="" class="player_desc_right_bl text-right player_rel_shared"><!---->

                          <div _ngcontent-xlr-c33="" class="exp"><!----></div>

                        </div>

                      </div>

                    </div>

                    <div _ngcontent-xlr-c33="" class="player-right ng-star-inserted">

                      <div _ngcontent-xlr-c33="" class="player-bar banner player-bar-slick show_arrows">

                        <div _ngcontent-xlr-c33="" class="filter-days pt-20 tabs slick-initialized slick-slider"><!---->

                          <div aria-live="polite" class="slick-list draggable">

                            <div _ngcontent-xlr-c33="" data-tab="suggested-channels" class="day-name tab-link channels ng-star-inserted"><a _ngcontent-xlr-c33="" href="javascript:;" class="active" tabindex="-1">Recommendations</a></div>

                          </div>

                        </div>

                      </div>

                      <?php $items = $this->Media->getItems($categoryData->id);?>

                      <div _ngcontent-xlr-c33="" id="content2" class="player-related-shows content nested mCustomScrollbar _mCS_2 mCS_no_scrollbar" >

                        <div id="mCSB_2" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">

                          <div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">

                            

                            <?php if($items->count() > 0){?>

                                <article _ngcontent-xlr-c33="">

                                  <ul _ngcontent-xlr-c33="" id="suggested-channels" <?php if($items->count() > 8){?> style="overflow: hidden;overflow-y:scroll;height:700px;" <?php } ?> class="catchup-dates-tab tab-content channels current">
									<?php if($items->count() > 9){
										$counter = 1;
										foreach($items as $key => $item){?>

										<?php if($item->id != $movieData->id){?>
    
                                        <?php 
    
                                        $img = SITEURL.'img/horizontal-no-img.jpg';
                                        
                                        if($item->horizontal_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $item->horizontal_banner)){
                                            $img = SITEURL.'img/banners/'.$item->horizontal_banner;
                                        }else if($item->big_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $item->big_banner)){
                                            $img = SITEURL.'img/banners/'.$item->big_banner;
                                        }
                                        $categoryData = $this->Media->getCategory($item->category_id);
    
                                        ?>
    
                                        <a href="<?php echo SITEURL.'movie/'.$categoryData->slug.'/'.$item->slug; ?>">
    
                                        <li _ngcontent-xlr-c33="" class="player-related-items display-table dummy-cards ng-star-inserted">
    
                                            <div _ngcontent-xlr-c30="" class="overlay_poster_mobile_grid ng-tns-c30-650 ng-star-inserted">
    
                                              <div _ngcontent-xlr-c30="" class="pl_su_left ng-tns-c30-650">
    
                                              
    
                                              <img _ngcontent-xlr-c30="" width="444" class="img-responsive main ng-tns-c30-650 mCS_img_loaded" src="<?php echo $img; ?>">
    
                                                <div _ngcontent-xlr-c30="" class="favourite_icon ng-tns-c30-650"></div>
    
                                              </div>
    
                                              <div _ngcontent-xlr-c30="" class="ng-tns-c30-650 overlay">
    
                                                <div _ngcontent-xlr-c30="" class="ng-tns-c30-650">
    
                                                  <div _ngcontent-xlr-c30="" class="card_in_cont ng-tns-c30-650">
    
                                                    <div _ngcontent-xlr-c30="" class="card_info ng-tns-c30-650">
    
                                                      <div _ngcontent-xlr-c30="" class="item_mid_txt ng-tns-c30-650"><span _ngcontent-xlr-c30="" class="main_title ng-tns-c30-650"><?php if(strlen($item->product_name) > 30){ echo substr($item->product_name,0,30).'...';}else{ echo $item->product_name;} ?></span><span _ngcontent-xlr-c30="" class="sm_title ng-tns-c30-650"></span></div>
    
                                                    </div>
    
                                                  </div>
    
                                                </div>
    
                                              </div>
    
                                              </div>
    
                                           
    
                                        </li>
    
                                        </a>
    
                                        <?php 
										if($counter > 9){
											break;
										}
										$counter++;
                                        } 
                                        }
								     }else{ ?>
                                  	<?php 
									$movieArray = $approveData = Array();
									foreach($items as $key => $item){?>

                                    <?php if($item->id != $movieData->id){?>

                                    <?php 

									$img = SITEURL.'img/horizontal-no-img.jpg';
									
									if($item->horizontal_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $item->horizontal_banner)){
										$img = SITEURL.'img/banners/'.$item->horizontal_banner;
									}else if($item->big_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $item->big_banner)){
										$img = SITEURL.'img/banners/'.$item->big_banner;
									}
									$categoryData = $this->Media->getCategory($item->category_id);

									?>

                                    <a href="<?php echo SITEURL.'movie/'.$categoryData->slug.'/'.$item->slug; ?>">

                                    <li _ngcontent-xlr-c33="" class="player-related-items display-table dummy-cards ng-star-inserted">

                                        <div _ngcontent-xlr-c30="" class="overlay_poster_mobile_grid ng-tns-c30-650 ng-star-inserted">

                                          <div _ngcontent-xlr-c30="" class="pl_su_left ng-tns-c30-650">

                                          

                                          <img _ngcontent-xlr-c30="" width="444" class="img-responsive main ng-tns-c30-650 mCS_img_loaded" src="<?php echo $img; ?>">

                                            <div _ngcontent-xlr-c30="" class="favourite_icon ng-tns-c30-650"></div>

                                          </div>

                                          <div _ngcontent-xlr-c30="" class="ng-tns-c30-650 overlay">

                                            <div _ngcontent-xlr-c30="" class="ng-tns-c30-650">

                                              <div _ngcontent-xlr-c30="" class="card_in_cont ng-tns-c30-650">

                                                <div _ngcontent-xlr-c30="" class="card_info ng-tns-c30-650">

                                                  <div _ngcontent-xlr-c30="" class="item_mid_txt ng-tns-c30-650"><span _ngcontent-xlr-c30="" class="main_title ng-tns-c30-650"><?php if(strlen($item->product_name) > 30){ echo substr($item->product_name,0,30).'...';}else{ echo $item->product_name;} ?></span><span _ngcontent-xlr-c30="" class="sm_title ng-tns-c30-650"></span></div>

                                                </div>

                                              </div>

                                            </div>

                                          </div>

                                          </div>

                                       

                                    </li>

                                    </a>

                                    <?php 
									$approveData[] = $item->id;
									} 
									$movieArray[] = $item->id;
									}
									$countApproveMoview = count($approveData);
									?>
                                    <?php if($countApproveMoview < 6 && $remainingMovies->count() > 0){?>
                                    <?php $remainingApproveMoview = 6-$countApproveMoview;?>
                                    <?php foreach($remainingMovies as $key => $remainingMovie){ ?>
                                    <?php if(!in_array($remainingMovie->id, $movieArray)){ ?>
                                    
                                    <?php 
									
									if(($key+1) > $remainingApproveMoview){
										break;
									}

									$img = SITEURL.'img/horizontal-no-img.jpg';
									
									if($remainingMovie->horizontal_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $remainingMovie->horizontal_banner)){
										$img = SITEURL.'img/banners/'.$remainingMovie->horizontal_banner;
									}else if($remainingMovie->big_banner != "" && file_exists(WWW_ROOT . 'img/banners/' . $remainingMovie->big_banner)){
										$img = SITEURL.'img/banners/'.$remainingMovie->big_banner;
									}
									$categoryData = $this->Media->getCategory($remainingMovie->category_id);

									?>
                                    <a href="<?php echo SITEURL.'movie/'.$categoryData->slug.'/'.$remainingMovie->slug; ?>">

                                    <li _ngcontent-xlr-c33="" class="player-related-items display-table dummy-cards ng-star-inserted">

                                        <div _ngcontent-xlr-c30="" class="overlay_poster_mobile_grid ng-tns-c30-650 ng-star-inserted">

                                          <div _ngcontent-xlr-c30="" class="pl_su_left ng-tns-c30-650">

                                          

                                          <img _ngcontent-xlr-c30="" width="444" class="img-responsive main ng-tns-c30-650 mCS_img_loaded" src="<?php echo $img; ?>">

                                            <div _ngcontent-xlr-c30="" class="favourite_icon ng-tns-c30-650"></div>

                                          </div>

                                          <div _ngcontent-xlr-c30="" class="ng-tns-c30-650 overlay">

                                            <div _ngcontent-xlr-c30="" class="ng-tns-c30-650">

                                              <div _ngcontent-xlr-c30="" class="card_in_cont ng-tns-c30-650">

                                                <div _ngcontent-xlr-c30="" class="card_info ng-tns-c30-650">

                                                  <div _ngcontent-xlr-c30="" class="item_mid_txt ng-tns-c30-650"><span _ngcontent-xlr-c30="" class="main_title ng-tns-c30-650"><?php if(strlen($remainingMovie->product_name) > 30){ echo substr($remainingMovie->product_name,0,30).'...';}else{ echo $remainingMovie->product_name;} ?></span><span _ngcontent-xlr-c30="" class="sm_title ng-tns-c30-650"></span></div>

                                                </div>

                                              </div>

                                            </div>

                                          </div>

                                          </div>

                                       

                                    </li>

                                    </a>
                                    
                                    <?php 
									
									} ?>
                                    <?php } ?>
                                    <?php } ?>
                                     <?php } ?>
                                    
                                    

                                  </ul>

                                </article>

                                <?php } ?>

                            

                            </div>

                          <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-dark-2 mCSB_scrollTools_vertical" style="display: none;">

                            <div class="mCSB_draggerContainer">

                              <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 0px; top: 0px;">

                                <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>

                                <div class="mCSB_draggerRail"></div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                    </div>

                </div>

                </video-player>

              </component-builder>

            </div>

        </home-view>
        
        <div class="product-box-section">

    

            <div class="top-content container-fluid">						

                <section class="sec_header ng-star-inserted">

                    <h3 class="ott_tray_title has_view_more">You May Also Like</h3>

                </section> 

                <?php $items = $this->Media->getItems($youMayLikeCategoryData->id);?>

                <div class="carousel-slider-items">

                    <div class="owl-carousel">

                    	<?php if($items->count() > 0){?>

                        <?php 
						$movieArray = Array();
						foreach($items as $key => $item){

							if($item->id != $movieData->id){

							$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $youMayLikeCategoryData->slug);

							if($categoryData->poster_type == 'Vertical'){

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
        <style>
        .carousel-slider-items {
			
			z-index: 0 !important;
		}
        </style>
        
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">

            <div style="background-color:#18182f;" class="modal-content">

              <div style="border-bottom:0px;" class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <img src="<?php echo SITEURL; ?>img/lan-popup-close.png" />

                </button>

              </div>

              <div style="text-align:center; color:#FFF;" class="modal-body">

                <span style="font-size:20px;">To get access to watch the content</span><br /><br />

                <span style="font-size:14px;">Sign in or Join Cinemasthan to enjoy uninterrupted services</span><br /><br />

              </div>

              <div class="modal-footer">

        		<a href="<?= $this->Url->build('/sign-in/');?>" class="wish_sign_in">Sign In</a>

                <a href="<?= $this->Url->build('/sign-up/');?>" class="wish_sign_up">Sign Up</a>

      </div>

            </div>

          </div>

        </div>
  

<script>

$(document).ready(function(e) {

	if (screen.width > 768) {

		$( window ).scroll(function(){

			if (window.scrollY > 500) {

				$('#movieVideoPlayer').css({'height':'37%','width':'28%', 'position':'fixed','right':'0px','bottom':'0px'});
				//$('#close_video').show();

			}
			if(window.scrollY == 0){

				$('#movieVideoPlayer').css({'width':'100%', 'position':'relative','right':'0px','bottom':'0px','height':'480px'});
				//$('#close_video').hide();
			}

			

		});

	}

});
</script>
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
video::-internal-media-controls-download-button {
	display:none;
}

video::-webkit-media-controls-enclosure {
	overflow:hidden;
}

video::-webkit-media-controls-panel {
	width: calc(100% + 30px); / Adjust as needed /
}
</style>
<script>
$(document).ready(function(){
   $('#movieVideoPlayer').bind('contextmenu',function() { return false; });
   $("#movieVideoPlayer").contents().find(".vp-controls").css('bottom', '0 !important');
});
</script>
<script type="text/javascript">
var iframe = document.querySelector('iframe');
var player = new Vimeo.Player(iframe);
var intervalID;
player.on('play', function() {
	console.log('played the video!');
	intervalID = setInterval(function () {savePlayingTime()}, 5000);
});
player.on('pause', function() {
	clearInterval(intervalID);
  	console.log('pause the video!');
});
player.on('timeupdate', function (getAll)
{
	currentPos = getAll.seconds; //get currentime
	vdoEndTym = getAll.duration; //get video duration
	percentage = (getAll.percent * 100)+"%";
	
	$('#current_player_time').val(currentPos);
});
function savePlayingTime(){
	var moview_id = '<?php echo($movieData->id);?>';
	var currentTime = $('#current_player_time').val();
	var type = '<?php echo($type);?>';
	$.ajax({
		type: 'POST',
		url: '<?= $this->Url->build('/save-player-time');?>',
		data: {currentTime:currentTime,moview_id:moview_id,type:type},
		success: function(msg){
			
		}
	});
}
function clearDtata(){
	
}
</script>

        

        
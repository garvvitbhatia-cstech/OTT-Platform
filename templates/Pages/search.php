<?php

if(isset($pageData->seo_title)){

    #set page meta content

    $this->assign('title', $pageData->seo_title);

    $this->assign('meta_keywords', $pageData->seo_keyword);

    $this->assign('meta_description', $pageData->seo_description);

    $this->assign('meta_robot', $pageData->robot_tags);

}

?>

<?= $this->Html->css(array('jquery-ui')) ?>

<?= $this->Html->script(array('jquery-ui')) ?>

<style>

input:focus, input:focus-visible, input:focus-within, input:visited {

    outline: none;

    border: 0;

}

.help_input{background: #0F0F1C;

    padding: 10px;

    color: #fff;

    width: 93%;

    height: 63px;

    font-size:18px;

    border: 0px;

}

.cross{    color: #fff;

    font-size: 26px;

    cursor: pointer; display:none;}

@media(max-width: 767px){

	.black_theme_img{ display:none;}

}	

</style>

<script>

$(function() {

 

	$( "#search_box" ).autocomplete({

	  source: "<?php echo $this->Url->build('/search-data'); ?>",

	  minLength: 2,

	  select: function( event, ui ) {
		if(ui.item.type == 'Movie'){
			window.location.href = '<?php echo $this->Url->build('/movie/'); ?>'+ui.item.cat_slug+'/'+ui.item.slug+'/';
		}
		if(ui.item.type == 'Director'){
			window.location.href = '<?php echo $this->Url->build('/search/?director='); ?>'+ui.item.value;
		}
		if(ui.item.type == 'Producer'){
			window.location.href = '<?php echo $this->Url->build('/search/?producer='); ?>'+ui.item.value;
		}

	  }

	});

	

});

</script>

<main class="content-section">

<!--Rent Movies section start here-->

<div  class="product-box-section live_tv">



        <div class="top-content container-fluid">						


			<?= $this->Form->create(NULL,array('id' => 'searchForm', 'action' => SITEURL.'search', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>
            <div style="text-align:center; margin-bottom:50px; <?php if(count($items) == 0){?> min-height:400px; <?php } ?>">

            <div style="border-bottom:1px solid #bbb; margin:0 auto; width:82%; ">

            <img class="black_theme_img" style="width:26px;"src="<?php echo $this->Url->build('/img/search-icon.svg'); ?>" />

            <input class="help_input" id="search_box" value="<?php echo $searchKey;?>" name="search_key" onkeyup="$('#cross_btn').show();" placeholder="Search...!" type="text" />

            <span id="cross_btn" onclick="$('#search_box').val('');$('#cross_btn').hide();" class="cross">X</span>

            </div>

            </div>
			<?= $this->Form->end(); ?>

        </div>

        </div>
        
        <?php if(count($items) > 0){?>
        
        <div  class="product-box-section live_tv">

        <div class="top-content container-fluid">						

            <section class="sec_header ng-star-inserted">

                <h3 class="ott_tray_title has_view_more">Search Results</h3>

            </section> 
			
            <div class="carousel-slider-items">

                    <div class="without-slider">

                        <?php 

						foreach($items as $key => $record){
							$item = $this->Media->getItem($record->id);
							$categoryData = $this->Media->getCategory($item->category_id);
							$itemData = array('title' => $item->product_name, 'img_v' => $item->vertical_banner, 'img_h' => $item->horizontal_banner, 'slug' => $item->slug,'free_paid' => $item->type,'cat_slug' => $categoryData->slug);
							echo $this->Media->getVerticalItem($categoryData->rent_label,0,$itemData);
						}

						?>

                      

                    </div>

                </div>
            
            
            
        </div>
        </div>
        
        <?php } ?>



</div>

<!--Rent Movies section end here-->

</main>




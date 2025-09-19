<?php
if(isset($pageData->seo_title)){
    #set page meta content
    $this->assign('title', 'My Submitted Films');
    $this->assign('meta_keywords', 'My Submitted Films');
    $this->assign('meta_description', 'My Submitted Films');
    $this->assign('meta_robot', '');
}
?>
<?= $this->Html->css(array('my_account')) ?>
<?php echo $this->element('/jQuery'); ?>
<style>
   
	
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #3f3f50;
	color:#fff
}
.ott-main-body {
	padding-top: 50px;
}
.inner_page_btn {
	border: 1px solid #d99200;
	background: #d99200;
	color: #fff;
}
.success {
	text-align: center;
	padding: 10px;
}
.is_film {
	border: 1px solid #3f3f50;
	padding: 10px;
	padding-bottom: 1px;
	margin-bottom: 12px;
	background: #262630;
	border-radius: 4px;
}
.ott-main-body {
	padding-top: 50px;
}
</style>

<div _ngcontent-ytn-c55="" class="ott-main-body has-header">
  <router-outlet _ngcontent-ytn-c55=""></router-outlet>
  <app-packages _nghost-ytn-c61="" class="ng-star-inserted">
    <div _ngcontent-ytn-c61="">
      <div _ngcontent-ytn-c61="" class="package_page ng-star-inserted">
        <div _ngcontent-kgi-c59="" class="ott-main-body has-header">
          <router-outlet _ngcontent-kgi-c59=""></router-outlet>
          <app-settings _nghost-kgi-c53="" class="ng-tns-c53-397 ng-star-inserted">
            <div _ngcontent-kgi-c53="" class="settings ng-tns-c53-397 ng-trigger ng-trigger-fadeInAnimation">
              <div _ngcontent-kgi-c53="" class="container-fluid ng-tns-c53-397">
                <div _ngcontent-kgi-c53="" class="inner-container ng-tns-c53-397">
                
                  <div _ngcontent-kgi-c53="" class="setting__details ng-tns-c53-397"> <?php echo($this->Flash->render()); ?>
                  
                    <h2 _ngcontent-kgi-c53="" class="account-info ng-tns-c53-397 accordion-item--isOpen"><?php echo $filmData->product_name;?> Details <a href="<?php echo $this->Url->build('/my-films/'); ?>" style="float:right; margin-top:10px;" class="btn btn-grey inner_page_btn">Back</a></h2>
                    
                    
                    
                    <div _ngcontent-kgi-c53="" class="user__details clearfix ng-tns-c53-397 ng-trigger ng-trigger-accordionItemContentAnimation" style="">
                      <?= $this->Form->create(NULL,array('enctype'=>'multipart/form-data','id' => 'changePassword', 'action' => SITEURL.'submit-your-film', 'csrfToken' => $this->request->getAttribute('csrfToken')));
					  ?>
                      <div _ngcontent-kgi-c53="" class="user__details__inner ng-tns-c53-397">
                       <?php if($showForm == 'Yes'){?>
                       <table width="100%" class="table table-bordered" border="0">
                       
                        <tr>
                        <td><b>Film Title</b></td>
                        <td><?php echo $filmData->product_name;?></td>
                        </tr>
                        <tr>
                        <td><b>Categories</b></td>
                        <td><?php echo $cateName;?></td>
                        </tr>
                        <tr>
                        <td><b>Director</b></td>
                        <td><?php echo $filmData->director;?></td>
                        </tr>
                        <tr>
                        <td><b>Producer</b></td>
                        <td><?php echo $filmData->producer;?></td>
                        </tr>
                        <tr>
                        <td><b>Production Year</b></td>
                        <td><?php echo $filmData->production_year;?></td>
                        </tr>
                        <tr>
                        <td><b>Language</b></td>
                        <td><?php echo $filmData->language;?></td>
                        </tr>
                        <tr>
                        <td><b>Duration</b></td>
                        <td><?php echo $filmData->hours;?>H : <?php echo $filmData->minutes;?>M</td>
                        </tr>
                        <tr>
                        <td><b>Trailer Views</b></td>
                        <td>Duration: <?php echo $trailer_duration;?> | Views: <?php echo $trailer_views;?></td>
                        </tr>
                        <tr>
                        <td><b>Video Views</b></td>
                        <td>Duration: <?php echo $video_duration;?> | Views: <?php echo $video_views;?></td>
                        </tr>
                        <tr>
                        <td><b>Censor Category</b></td>
                        <td><?php echo $filmData->censor_category;?></td>
                        </tr>
                        <tr>
                        <td><b>Genres</b></td>
                        <td><?php echo $filmData->genres;?></td>
                        </tr>
                        <tr>
                        <td><b>Synopsis</b></td>
                        <td><?php echo $filmData->description;?></td>
                        </tr>
                        <tr>
                        <td><b>Cast</b></td>
                        <td><?php echo $filmData->keywords;?></td>
                        </tr>
                        <?php if($filmData->big_banner != ""){?>
                        <tr>
                        <td><b>Big Banner</b></td>
                        <td><?php echo $this->Html->image('banners/'.$filmData->big_banner, ['alt'=>'','title' => '','width'=>'400']);?></td>
                        </tr>
                        <?php } ?>
                        <?php if($filmData->vertical_banner != ""){?>
                        <tr>
                        <td><b>Vertical Banner</b></td>
                        <td><?php echo $this->Html->image('banners/'.$filmData->vertical_banner, ['alt'=>'','title' => '','width'=>'200']);?></td>
                        </tr>
                        <?php } ?>
                        <?php if($filmData->horizontal_banner != ""){?>
                        <tr>
                        <td><b>Horizontal Banner</b></td>
                        <td><?php echo $this->Html->image('banners/'.$filmData->horizontal_banner, ['alt'=>'','title' => '','width'=>'200']);?></td>
                        </tr>
                        <?php } ?>
                        
                        </table>
                       <?php }else{?>
                       <div _ngcontent-kgi-c53="" style="text-align:center" class="user__details__inner ng-tns-c53-397">
                      
                      To get access to film submit form. Subscribe Now!<br /><br />
                      
                      <a href="<?php echo $this->Url->build('/pricing/'); ?>" class="btn btn-grey inner_page_btn">Subscribe</a>
                      </div>
                       <?php } ?>
                      </div>
                      <?= $this->Form->end(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div _ngcontent-kgi-c53="" class="ng-tns-c53-397"></div>
          </app-settings>
        </div>
      </div>
    </div>
  </app-packages>
</div>

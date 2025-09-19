<?php $this->disableAutoLayout(); ?>
<table width="100%" align="center" valign="top" bgcolor="#252E39" border="0" cellpadding="0" cellspacing="0" style="background-color:#252e39" dir="ltr">
    <tbody>
      <tr>
        <td><div style="max-width:700px;margin:0 auto;background-color:#0f171e">
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:100%;height:auto;border-bottom:4px solid #00a8e1">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="11" style="height:11px;line-height:11px;font-size:11px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><a style="text-decoration:none" href="https://www.cinemasthan.com"><img src="https://www.cinemasthan.com/img/logo.png" alt="Cinemasthan Video" width="110" height="47" style="display:block;outline:none;border:none;text-decoration:none;width:200px;height:85px;margin:0 auto" class="CToWUd"></a></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">

                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="11" style="height:11px;line-height:11px;font-size:11px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:100%;height:auto">
                            <tbody>
                              <?php if($newsletterData->top_banner_type == 'LMB'){ ?>
                              <tr>
                              <td align="center" valign="top" height="auto">
                              <div><a style="text-decoration:none" href="<?php echo SITEURL.'movie/'.$categoryDetails->slug.'/'.$movieDetails->slug;?>"><img src="<?php echo SITEURL .'img/banners/'.$movieDetails->big_banner ?>" width="100%" class="CToWUd"></a></div>
                              
                              </td>
                                
                              </tr>
                              <?php } ?>
                              <?php if($newsletterData->top_banner_type == 'UCB'){ ?>
                              <?php if($newsletterData->top_banner != '' && $newsletterData->top_banner_status == 1){ ?>
                              <tr>
                              <td align="center" valign="top" height="auto">
                              <div><a style="text-decoration:none" href="<?php echo $newsletterData->top_banner_url;?>"><img src="<?php echo SITEURL .'img/banners/'.$newsletterData->top_banner ?>" width="100%" class="CToWUd"></a></div>
                              
                              </td>
                                
                              </tr>
                              <?php } ?>
                              <?php } ?>
                              <tr>
                                <td align="center" valign="top" height="auto">
                                
                                  <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="10" style="height:10px;line-height:10px;font-size:10px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><div>
                                    <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="28" style="height:28px;line-height:28px;font-size:28px;width:100%"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <?php if($newsletterData->top_banner_type == 'UCB'){ ?>
                                  <div>
                                    <div style="margin:0 28px;font-size:16px;line-height:22px;font-family:EmberLight,Helvetica,Arial,sans-serif;color:#8197a4">Dear SOMENDRA HARSH,</div>
                                  </div>
                                  <?php } ?>
                                  <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  
                                  <?php if($newsletterData->top_banner_type == 'UCB'){ ?>
                                  
                                  <div>
                                    <div style="margin:0 28px;font-size:16px;line-height:22px;font-family:EmberLight,Helvetica,Arial,sans-serif;color:#8197a4;word-wrap:break-word;word-break:break-word">
                                    
                                    <p style="text-align: justify;font-family: Tahoma, Geneva, sans-serif;font-size: 16px;line-height:22px;">
                                        <?php if(strlen($newsletterData->description) > 600){ echo substr($newsletterData->description,0,600).'...'; }else{ echo $newsletterData->description; } ?>
                                         <?php if($newsletterData->youtube_link != ''){?>
										 <br><br>
										 <a style="text-decoration:none" href="<?php echo $newsletterData->youtube_link;?>"><?php echo $newsletterData->youtube_link;?></a><?php } ?>
                                      </p></div>
                                  </div>
                                  
                                  <?php } ?>
                                  
                                  </td>
                              </tr>
                              <?php if($newsletterData->top_banner_type == 'UCB'){ ?>
                              <tr>
                                <td align="center" valign="top" height="auto">
                                <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              
                              <?php } ?>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php if($newsletterData->top_banner_type == 'LMB'){ ?>
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:100%;height:auto">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="auto"><div>
                                    <div style="margin:0 28px;font-size:16px;line-height:22px;font-family:EmberLight,Helvetica,Arial,sans-serif;color:#8197a4;word-wrap:break-word;word-break:break-word;text-align:left">
										<div style="margin-bottom:20px;">
										<div style="margin-bottom: 10px;font-size:16px;line-height:22px;font-family:EmberLight,Helvetica,Arial,sans-serif;color:#8197a4">Dear SOMENDRA HARSH,</div>
										
										 Watch Now! <?php echo $movieDetails->product_name;?> on Cinemasthan - Rajasthan's Own OTT<br />
                                        <?php if($newsletterData->youtube_link != ''){?><a style="text-decoration:none" href="<?php echo $newsletterData->youtube_link;?>"><?php echo $newsletterData->youtube_link;?></a><?php } ?><br />
                                        Visit www.cinemasthan.com & Subscribe @₹1 per day to get unlimited access ad-free !!
										
										</div>
                                    	<span style="font-size:24px; color:#FF0; margin-bottom:10px;"><?php echo $movieDetails->product_name;?></span>
                                        
                                        <?php 

										$productionYear = $language = $genres = $censor = $hour = $minute = '';
					
										if($movieDetails->production_year != ""){
					
											$productionYear = $movieDetails->production_year.' | ';
					
										}
					
										if($movieDetails->language != ""){
					
											$language = $movieDetails->language.' | ';
					
										}
					
										if($movieDetails->genres != ""){
					
											$genres = $movieDetails->genres.' | ';
					
										}
					
										if($movieDetails->censor_category != ""){
					
											$censor = $movieDetails->censor_category.' | ';
					
										}
					
										if($movieDetails->hours != ""){
					
											$hour = $movieDetails->hours.'h ';
					
										}
					
										if($movieDetails->minutes != ""){
					
											$minute = $movieDetails->minutes.'m';
					
										}
					
										?>
                                        <br /><br />
                                        <span><?php echo $productionYear.$language.$genres.$censor.$hour.$minute;?></span><br /><br />
                                        
                                        <?php if(isset($movieDetails->director) && $movieDetails->director != ""){?><span>Director: <?php echo $movieDetails->director; ?></span><br /><?php } ?>

                    <?php if(isset($movieDetails->producer) && $movieDetails->producer != ""){?><span>Producer: <?php echo $movieDetails->producer; ?></span><br /><?php } ?>

                    <?php if(isset($movieDetails->keywords) && $movieDetails->keywords != ""){?><span>Cast: <?php echo $movieDetails->keywords; ?></span><br /><?php } ?>
                                        
                                      <p style="text-align: justify;font-family: Tahoma, Geneva, sans-serif;font-size: 16px;line-height:24px;">
                                        <?php if(strlen($movieDetails->description) > 600){ echo substr($movieDetails->description,0,600).'...'; }else{ echo $movieDetails->description; } ?>
                                       

                                        
                                      </p>
                                      <br>
                                    </div>
                                  </div></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="10" style="height:10px;line-height:10px;font-size:10px;width:100%"></td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:100%;height:auto">
                            <tbody>
                              <tr>
                                <td align="right" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="<?php echo SITEURL.'movie/'.$categoryDetails->slug.'/'.$movieDetails->slug;?>">
                                  <table width="100%" height="auto" align="right" valign="top" bgcolor="#00A8E1" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#00a8e1;width:208px;height:24px;border-radius:3px;text-align:center">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="auto" bgcolor="#00A8E1" style="border-radius:3px;padding:8px 10px 8px 10px"><span style="font-size:16px;line-height:20px;vertical-align:middle;display:table-cell;font-family:EmberBold,Helvetica,Arial,sans-serif;color:#ffffff">Watch now</span></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  </a><u></u></td>
                                <td align="center" valign="top" height="auto" width="8"></td>
                                <td align="left" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="<?php echo SITEURL.'movie/'.$categoryDetails->slug.'/'.$movieDetails->slug;?>">
                                  <table width="100%" height="auto" align="left" valign="top" bgcolor="#425265" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#425265;width:208px;height:24px;border-radius:3px;text-align:center">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="auto" bgcolor="#425265" style="border-radius:3px;padding:8px 10px 8px 10px"><span style="font-size:16px;line-height:20px;vertical-align:middle;display:table-cell;font-family:EmberRegular,Helvetica,Arial,sans-serif;color:#ffffff">Add to watchlist</span></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  </a><u></u></td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="10" style="height:10px;line-height:10px;font-size:10px;width:100%"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php } ?>
            
            <?php if($newsletterData->middle_banner != '' && $newsletterData->middle_banner_status == 1){ ?>
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="700" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:700px;height:auto">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><div><a style="text-decoration:none" href="<?php echo $newsletterData->middle_banner_url; ?>"><img src="<?php echo SITEURL .'img/banners/'.$newsletterData->middle_banner ?>" alt="Prime Video" width="700" height="auto" style="display:block;outline:none;border:none;text-decoration:none;width:700px;height:auto;max-width:700px" class="CToWUd"></a></div></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php } ?>
            
            <?php 
			if($newsletterData->home_elements == 1){
			$ordering = 1;
			foreach($categories as $key => $category){?>
             <?php if(in_array($category->id,$cateArray)){?>
             
             <?php $items = $this->Media->getItemsForEmail($category->id);?>
             
             <?php 
			 $countItems = $items->count();
			 if($countItems > 0){?>
             
             <?php 
			 $show = 'Yes';
			 $sliderData = $this->Setting->getSingleSlider($ordering);?>
            
            <?php if(isset($sliderData->id) && $show == 'No'){?>
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <table width="700" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:700px;height:auto">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><div><a style="text-decoration:none" target="_blank" href="<?php echo $sliderData->url;?>"><img src="https://www.cinemasthan.com/img/banners/<?php echo $sliderData->banner; ?>" alt="Prime Video" width="700" height="auto" style="display:block;outline:none;border:none;text-decoration:none;width:700px;height:auto;max-width:700px" class="CToWUd"></a></div></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                    <tbody>
                                      <tr>
                                        <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <?php } ?>
            
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <div style="width:700px;height:auto;background-color:#0f171e">
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;height:auto;margin:0 auto;">
                              <tbody>
                                <tr>
                                  <td align="left" valign="top" height="auto"><div style="text-align:left">
                                      <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                        <tbody>
                                          <tr>
                                            <td align="center" valign="top" height="6" style="height:6px;line-height:6px;font-size:6px;width:100%"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <div style="font-size:13px;line-height:16px;text-align:left; margin-left:6px;"><span style="font-family:EmberBold,Helvetica,Arial,sans-serif;color:#FF0"><?php echo $category->name;?></span></div>
                                    </div></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="14" style="height:14px;line-height:14px;font-size:14px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;height:auto;margin:0 auto;">
                              <tbody>
                              
                                <tr>
                                <?php foreach($items as $key => $item){?>
             
                                  <td align="left" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="<?php echo SITEURL.'movie/'.$category->slug.'/'.$item->slug;?>"><img src="<?php echo SITEURL.'img/banners/'.$item->vertical_banner;?>" alt="" height="auto" style="display:block;outline:none;border:none;text-decoration:none;width:110px;height:auto;color:#8197a4; margin-left:5px;" class="CToWUd">
                                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                              <tbody>
                                                <tr>
                                                  <td align="center" valign="top" height="8" style="height:8px;line-height:8px;font-size:8px;width:100%"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div style="font-family:EmberLight,Helvetica,Arial,sans-serif;font-size:12px;line-height:15px;text-align:center;padding:0 16px;color:#ffffff"><?php echo $item->product_name;?></div>
                                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                              <tbody>
                                                <tr>
                                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            </a></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                    
                                <?php } ?>
                                
                                <?php if($countItems < 6){?>
                                <?php $difference = 6-$countItems;?>
                                <?php for($i = 1; $i <= $difference; $i++){?>
                                <td align="left" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="auto"><img src="https://www.cinemasthan.com/img/blank-img.jpg" alt="" height="auto" style="display:block;outline:none;border:none;text-decoration:none;width:110px;height:auto;color:#8197a4; margin-left:5px;" class="CToWUd">
                                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                              <tbody>
                                                <tr>
                                                  <td align="center" valign="top" height="8" style="height:8px;line-height:8px;font-size:8px;width:100%"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            
                                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                              <tbody>
                                                <tr>
                                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            </td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                <?php } ?> 
                                <?php } ?>  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
           
            
            <?php 
			$ordering ++;
			} ?>
            
            <?php } ?>
            <?php } } ?>
            
            <div style="max-width:700px;margin:0 auto">
              <div style="min-width:320px;margin:0 auto">
                <div style="margin:0 auto;min-width:320px;max-width:700px;width:700px;word-wrap:break-word;word-break:break-word;background-color:#0f171e">
                  <div style="border-collapse:collapse;display:table;width:100%">
                    <div style="min-width:320px;max-width:700px;width:700px;background-color:#0f171e">
                      <div style="width:100%;background-color:#0f171e">
                        <div style="text-align:center;border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">
                          <div style="width:700px;height:auto;background-color:#0f171e">
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="40" style="height:40px;line-height:40px;font-size:40px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="1" width="424" bgcolor="#252E39" style="width:424px;line-height:1px;background-color:#252e39"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="auto" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:auto;height:auto;margin:0 auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="auto"><a target="_blank" style="color:#FFF;text-decoration:none;font-family:EmberLight,Helvetica,Arial,sans-serif;"  href="<?php echo SITEURL.'movies';?>">Movies</a></td>
                                  <td align="center" valign="top" height="auto" width="30"></td>
                                  <td align="center" valign="top" height="auto"><a target="_blank" style="color:#FFF;text-decoration:none;font-family:EmberLight,Helvetica,Arial,sans-serif;"  href="<?php echo SITEURL.'music-videos';?>">Music Videos</a></td>
                                  <td align="center" valign="top" height="auto" width="30"></td>
                                  <td align="center" valign="top" height="auto"><a target="_blank" style="color:#FFF;text-decoration:none;font-family:EmberLight,Helvetica,Arial,sans-serif;"  href="<?php echo SITEURL.'pricing';?>">Pricing</a></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="1" width="424" bgcolor="#252E39" style="width:424px;line-height:1px;background-color:#252e39"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <div style="color:#8197a4;background-color:#0f171e;text-align:center;text-transform:uppercase;font-family:EmberRegular,Helvetica,Arial,sans-serif;font-size:11px;line-height:12px">FOLLOW US</div>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="12" style="height:12px;line-height:12px;font-size:12px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table  height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;height:auto;margin:0 auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="https://www.instagram.com/cinema.sthan/?hl=en"><img src="https://www.cinemasthan.com/img/instagram.png" alt="youtube" width="40" height="40" style="display:block;outline:none;border:none;text-decoration:none;width:40px;height:40px" class="CToWUd"></a></td>
                                  <td align="center" valign="top" height="auto" width="24"></td>
                                  <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="https://www.facebook.com/cinemasthan"><img src="https://www.cinemasthan.com/img/facebook-new.png" alt="facebook" width="40" height="40" style="display:block;outline:none;border:none;text-decoration:none;width:40px;height:40px" class="CToWUd"></a></td>
                                  <td align="center" valign="top" height="auto" width="24"></td>
                                  <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="https://twitter.com/cinemasthan"><img src="https://www.cinemasthan.com/img/twitter.png" alt="twitter" width="40" height="40" style="display:block;outline:none;border:none;text-decoration:none;width:40px;height:40px" class="CToWUd"></a></td>
                                  <td align="center" valign="top" height="auto" width="24"></td>
                                  <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="https://www.linkedin.com/company/cinemasthan/"><img src="https://www.cinemasthan.com/img/linkedin.png" alt="twitter" width="40" height="40" style="display:block;outline:none;border:none;text-decoration:none;width:40px;height:40px" class="CToWUd"></a></td>

                                  <td align="center" valign="top" height="auto" width="24"></td>
                                  <td align="center" valign="top" height="auto"><a style="text-decoration:none" target="_blank" href="https://www.youtube.com/channel/UCvKlfB3JVdxrUzKurp4wYSQ"><img src="https://www.cinemasthan.com/img/youtube.png" alt="twitter" width="40" height="40" style="display:block;outline:none;border:none;text-decoration:none;width:40px;height:40px" class="CToWUd"></a></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="24" style="height:24px;line-height:24px;font-size:24px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="1" width="424" bgcolor="#252E39" style="width:424px;line-height:1px;background-color:#252e39"></td>
                                </tr>
                              </tbody>
                            </table>
                            
                            <table height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;height:auto;color:#8197a4">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top" height="auto">
                                  <div style="margin:0;font-family:Helvetica,Arial,sans-serif;font-size:9px;font-weight:300;line-height:11px;text-align:left">
                                      	<div style="padding:0px 28px;text-align:justify;"><?php echo nl2br($setting->newsletter_footer);?></div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="24" style="height:24px;line-height:24px;font-size:24px;width:100%"></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                              </tbody>
                            </table>
                            
                            
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="1" width="424" bgcolor="#252E39" style="width:424px;line-height:1px;background-color:#252e39"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="auto" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:transparent;width:auto;height:auto;margin:0 auto">
                              <tbody>
                                <tr>
                                <td align="center" valign="top" height="auto"><a target="_blank" style="color:#FFF; text-decoration:none"  href="<?php echo SITEURL.'help-center';?>">Help Center</a></td>
                                  
                                  <td align="center" valign="top" height="auto" width="30"></td>
                                  
                                  <td align="center" valign="top" height="auto"><a target="_blank" style="color:#FFF; text-decoration:none"  href="<?php echo SITEURL.'unsubscribe-now';?>">Unsubscribe Now</a></td>
                                  
                                
                                </tr>
                              </tbody>
                            </table>
                            <table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                </tr>
                              </tbody>
                            </table>
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="1" width="424" bgcolor="#252E39" style="width:424px;line-height:1px;background-color:#252e39"></td>
                                </tr>
                              </tbody>
                            </table>
                            
                            <table width="424" height="auto" align="center" valign="top" bgcolor="#0F171E" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#0f171e;width:424px;height:auto;color:#8197a4">
                              <tbody>
                                <tr>
                                  <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="16" style="height:16px;line-height:16px;font-size:16px;width:100%"></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top" height="auto">

                                        <div style="color:#FF0; font-size:12px;font-family:EmberLight,Helvetica,Arial,sans-serif;">© Copyright CINEMASTHAN 2021 - All Rights Reserved.</div>
                           
                                    </td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top" height="auto"><table width="100%" height="auto" align="center" valign="top" bgcolor="transparent" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:inherit;width:100%;height:auto">
                                      <tbody>
                                        <tr>
                                          <td align="center" valign="top" height="24" style="height:24px;line-height:24px;font-size:24px;width:100%"></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                              </tbody>
                            </table>
                            
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></td>
      </tr>
      <tr>
        <td height="120" width="100%">&nbsp;</td>
      </tr>
    </tbody>
  </table>
                 
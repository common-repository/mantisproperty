<style>
    #error-page{
        max-width: 100%;
    }

.entry .entry-content > *, .entry .entry-summary > *, .entry .entry-summary > .wp-block-group > .wp-block-group__inner-container > *, .entry .entry-content > .wp-block-group > .wp-block-group__inner-container > *{
    width: 100%;
    max-width: 100% !important;
    }
    .entry-content{
        padding: 0px !important;
    }
    
    <?php $mantis_settings = get_option('mantis_settings'); ?>
    
    <?php if (!empty($mantis_settings['listing_default_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item {
        color: <?php echo esc_html( $mantis_settings['listing_default_font_color'] ); ?> !important;
    }
    <?php endif; ?>
    
    <?php if (!empty($mantis_settings['listing_heading_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-info .item-title a {
        color: <?php echo esc_html( $mantis_settings['listing_heading_font_color'] ); ?> !important;
    }
    <?php endif; ?>    
    
    <?php if (!empty($mantis_settings['listing_address_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-info .item-location {
        color: <?php echo esc_html( $mantis_settings['listing_address_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['listing_icons_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-info .item-details-i {
        color: <?php echo esc_html( $mantis_settings['listing_icons_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['listing_text_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-info .item-details p {
        color: <?php echo esc_html( $mantis_settings['listing_text_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['listing_link_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-info .item-details a {
        color: <?php echo esc_html( $mantis_settings['listing_link_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['listing_price_font_color'])) : ?>
    .mpa_property_section .mpa_property_listing .item-listing .item-image .item-price {
        color: <?php echo esc_html( $mantis_settings['listing_price_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

</style>


<div class="mpa_property_section">
  <div class="mpa_property_section_inner">
    <div class="mpa_property_listing">
        <div class="item-listing">

              <?php 
            
                if(isset($params['type']) && !empty($params['type'])){
                     $listingType = $params['type'];
                }elseif(isset($listingType) && !empty($listingType)){
                     $listingType = $listingType;
                }else{
                    $listingType = "residential";
                }

               if(isset($xml2)){
               foreach($xml2->children() as $list) {
               if(isset($list->uniqueID)){ 
                    
               $property_id = $list->attributes(); 
               ?>

                <div class="item clearfix">
                    <div class="item-image">
                          <?php 

                            $attr = $list->photos->photo[0]->attributes();

                            $attributes = current($attr);            

                            if(isset($attributes) &&!empty($attributes))                     
                                $midPhoto = $attributes['midSize']; 
                            else
                                $midPhoto ='';


                            ?>
                         <a href="?details=<?php echo esc_html( $listingType.'-'.$list->suburb.'-'.$list->state.'-'.$property_id ); ?>">
                            <img class="img-fluid" src="<?php echo esc_html( $midPhoto ); ?>"> 
                            <div class="item-badges"></div>
                            <div class="item-meta">
                               <div class="item-price">
                                  <small><?php echo esc_html( $list->displayPrice ); ?></small>
                               </div>
                            </div>
                         </a>
                      </div>

                    <div class="item-info">
                             <h3 class="item-title"><a href="?details=<?php echo esc_html( $listingType.'-'.$list->suburb.'-'.$list->state.'-'.$property_id ); ?>"><?php echo esc_html( $list->heading ); ?></a></h3>
                             <div class="item-location">
                                 <i class="fa fa-map-marker "></i> <?php echo esc_html( $list->streetAddress.' '.$list->suburb.' '.$list->state ); ?>
                             </div>
                             <div class="item-details-i"> 
                                 <?php if($list->bedrooms): ?>
                                 <span class="bedrooms"  title="Bedrooms"><i class="fa fa-bed"></i> <?php echo esc_html( $list->bedrooms ); ?></span>
                                 <?php endif; ?>
                                 <?php if($list->bathrooms): ?>
                                 &nbsp;&nbsp;&nbsp;
                                 <span class="bathrooms" title="Bathrooms"><i class="fa fa-bath"></i> <?php echo esc_html( $list->bathrooms ); ?></span>
                                 <?php endif; ?>
                                 <?php if($list->carSpaces): ?>
                                 &nbsp;&nbsp;&nbsp;
                                 <span class="bathrooms" title="Car Space"><i class="fa fa-car"></i> <?php echo esc_html( $list->carSpaces ); ?></span>
                                 <?php endif; ?>
                         
                         
                         <?php if($list->buildingArea): ?>
                                 &nbsp;&nbsp;&nbsp;
                                 <span class="building" title="Building Area"><i class="fa fa-building"></i> <?php echo esc_html( $list->buildingArea ); ?> </span>
                                 <?php endif; ?>
                         
                          <?php if($list->category1): ?>
                                 &nbsp;&nbsp;&nbsp;
                                 <span class="building" title="Building Area"><?php echo esc_html( $list->category1 ); ?> </span>
                                 <?php endif; ?>
                         
                         
                         
                         
                              </div>
                             <div class="item-details">
                                 <?php 

                                    $string = strip_tags($list->description);
                                    if (strlen($string) > 300) {

                                        $stringCut = substr($string, 0, 350);
                                        $endPoint = strrpos($stringCut, ' ');


                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= '... <a href="?details='. $listingType.'-'.$list->suburb.'-'.$list->state.'-'.$property_id.'">Read More</a>';
                                    }

                                 ?>

                                <p><?php echo esc_html( $string ); ?></p>
                             </div>
                          </div>
                 </div>

               <?php  
                } //break;
                }
              }else{?>
                    <p>No Listing Found</p> 
              <?php } ?>

          </div>
    </div>
   
   <div id="mpa_sidebar" class="mpa_sidebar_left">
         <div class="sidebar_inner">
            <form action="" method="GET">
                    <input type="hidden" name="action" value="filter_query">

                    <div class="card">
                      <div class="card-header">
                         <h4 class="panel-title">Order By</h4>
                      </div>

                      <div class="card-body">
                        <select name="orderby" id="orderby" class="form-control">
                           <option value=""  selected="selected"> Order by</option>
                           <option value="3"<?php if(sanitize_text_field($_GET['orderby']) == 3)echo ' selected'; ?>>Latest Listing</option>
                           <option value="2"<?php if(sanitize_text_field($_GET['orderby']) == 2)echo ' selected'; ?>>Order By Price Ascending</option>
                           <option value="1"<?php if(sanitize_text_field($_GET['orderby']) == 1)echo ' selected'; ?>>Order By Price Descending</option>
                           <option value="0"<?php if(sanitize_text_field($_GET['orderby']) == '0')echo ' selected';?>>Order By Suburb</option>
                        </select>
                      </div>

                    </div>

                    <div class="card" style="visibilty:none;display:none;">
                      <div class="card-header">
                         <h4 class="panel-title">  Property Type  </h4>
                      </div>
                         <div class="card-body">
                            <select name="listingType" id="listingType" class="form-control">
                               <option selected="selected" value="">All</option>
                               <option value="residential"<?php if($listingType=='residential')echo ' selected'; ?>>Residential</option>
                               <option value="land"<?php if($listingType=='land')echo ' selected'; ?>>Land</option>
                               <option value="rent"<?php if($listingType=='rent')echo ' selected'; ?>>Rent</option>
                               <option value="holiday"<?php if($listingType=='holiday')echo ' selected'; ?>>Holiday</option>
                               <option value="commercial"<?php if($listingType=='commercial')echo ' selected'; ?>>Commercial</option>
                               <option value="commercialLand"<?php if($listingType=='commercialLand')echo ' selected'; ?>>Commercial Land</option>
                               <option value="business"<?php if($listingType=='business')echo ' selected'; ?>>Business</option>
                               <option value="rural"<?php if($listingType=='rural')echo ' selected'; ?>>Rural</option>
                        
                        
                        
                        
                            </select>
                         </div>
                   </div>

            
               <?php if($listingType=='residential' or $listingType=='rent' or $listingType=='rural') { ?>
            
                    <div class="card">
                      <div class="card-header"><h4 class="panel-title">Bedrooms Minimum</h4></div>

                        <div class="card-body">
                        <select name="beds" id="beds" class="form-control">
                            <option value="">Any</option>
                            <?php for($i=1; $i < 10; $i++): ?>
                                <option value="<?php echo esc_html( $i ); ?>" <?php if(sanitize_text_field($_GET['beds']) == $i)echo ' selected'; ?>><?php echo esc_html( $i ); ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>

                    </div>

                    <div class="card">
                      <div class="card-header">
                          <h4 class="panel-title">Bathrooms Minimum</h4>
                      </div>

                        <div class="card-body">
                        <select name="baths" id="baths" class="form-control">
                            <option value="">Any</option>
                            <?php for($i=1; $i < 10; $i++): ?>
                                <option value="<?php echo esc_html( $i ); ?>" <?php if(sanitize_text_field($_GET['baths']) == $i)echo ' selected'; ?>><?php echo esc_html( $i ); ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>

                    </div>
            
            
            <?php } ?>
            

                    <div class="card">
                      <div class="card-header"><h4 class="panel-title">Car Spaces Minimum</h4></div>

                        <div class="card-body">
                        <select name="cars" id="cars" class="form-control">
                            <option value="">Any</option>
                            <?php for($i=1; $i < 10; $i++): ?>
                                <option value="<?php echo esc_html( $i ); ?>" <?php if(sanitize_text_field($_GET['cars']) == $i)echo ' selected'; ?>><?php echo esc_html( $i ); ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>

                    </div>

                    <div class="card">
                      <div class="card-header"><h4 class="panel-title">Budget</h4></div>

                            <div class="card-body">
                                 <div class="form-group">
                                      <select name="priceFrom" id="priceFrom" class="form-control">
                                        <option value="0">All</option>
                                        <?php for($i=200000; $i <= 9000000; $i+=100000): ?>
                                            <option value="<?php echo esc_html( $i ); ?>"<?php if(sanitize_text_field($_GET['priceFrom']) == $i)echo ' selected'; ?>>$<?php echo esc_html( number_format($i) ); ?></option>
                                        <?php endfor; ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                     <select name="priceTo" id="priceTo" class="form-control">
                                        <option value="0">All</option>
                                        <?php for($i=200000; $i <= 9000000; $i+=100000): ?>
                                            <option value="<?php echo esc_html( $i ); ?>"<?php if(sanitize_text_field($_GET['priceTo']) == $i)echo ' selected'; ?>>$<?php echo esc_html( number_format($i) ); ?></option>
                                        <?php endfor; ?>
                                <option value="<?php echo esc_html( $i ); ?>"<?php if(sanitize_text_field($_GET['priceTo']) == 10000000)echo ' selected'; ?>>$over 9,000,000</option>
                                    </select>
                                  </div>
                            </div>

                       </div>

                    <br>
                    <input type="submit" name="" value="Search" id="" class="btn btn-primary">
                </form>
         </div>
    </div>
  </div>
</div>



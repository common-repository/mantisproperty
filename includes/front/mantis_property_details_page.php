<style>
    #error-page{
        max-width: 100%;
    }
    
    .container{
        max-width: 1200px !important;
    }
     .entry-content{
        padding: 0px !important;
    }
    
    <?php $mantis_settings = get_option('mantis_settings'); ?>
    
    <?php if (!empty($mantis_settings['detail_default_font_color'])) : ?>
    .mpa_property_details {
        color: <?php echo esc_html( $mantis_settings['detail_default_font_color'] ); ?> !important;
    }
    <?php endif; ?>
    
    <?php if (!empty($mantis_settings['detail_heading_font_color'])) : ?>
    .mpa_property_details .section_1 .left_area h1 {
        color: <?php echo esc_html( $mantis_settings['detail_heading_font_color'] ); ?> !important;
    }
    <?php endif; ?>    
    
    <?php if (!empty($mantis_settings['detail_address_font_color'])) : ?>
    .mpa_property_details .section_1 .left_area small {
        color: <?php echo esc_html( $mantis_settings['detail_address_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['detail_icons_font_color'])) : ?>
    .mpa_property_details .section_3 .right_area .right_area_sidebar .card .card-body .inner_td .span_2 {
        color: <?php echo esc_html( $mantis_settings['detail_icons_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['detail_text_font_color'])) : ?>
    .mpa_property_details .section_3 .left_area .desc_area p {
        color: <?php echo esc_html( $mantis_settings['detail_text_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['detail_link_font_color'])) : ?>
    .mpa_property_details a {
        color: <?php echo esc_html( $mantis_settings['detail_link_font_color'] ); ?> !important;
    }
    <?php endif; ?>    

    <?php if (!empty($mantis_settings['detail_price_font_color'])) : ?>
    .mpa_property_details .section_1 .right_area h2 {
        color: <?php echo esc_html( $mantis_settings['detail_price_font_color'] ); ?> !important;
    }
    <?php endif; ?>      

</style>

<?php foreach($xml_details->children() as $list) { ?> 
<?php if(isset($list->uniqueID)){  //echo '<pre>';print_r($list);exit; ?>
    
    <?php  $listingType = explode("-", sanitize_text_field($_GET['details']) );
            $listingType = $listingType[0]; 
    ?>
    <input type="hidden" id="property_listing_id" value="<?php echo esc_html( $list->attributes() ); ?>">
    <input type="hidden" id="property_listing_type" value="<?php echo esc_html( $listingType ); ?>">

<div class="mpa_property_details">
    <div class="section_1">
        <div class="left_area">
            <h1><?php echo esc_html( $list->heading ); ?></h1>
            <small><i class="fa fa-map-marker"></i> <?php echo esc_html( $list->streetAddress.' '.$list->suburb.' '.$list->state ); ?> </small>
         
         
         <?php 
   $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
   
   
   ?><div>
   <button onclick="window.location.href='<?php echo esc_html( $previous ); ?>';" style="font-size:12px; font-weight:normal;line-height:12px;padding:5px;">< back to search</a>
      </div>
   <?php 
}
   ?>
   
         
         
        </div>
        <div class="right_area">
            <h2><?php echo esc_html( $list->displayPrice ); ?></h2>
            <small><span class="label label-bordered"><?php if(!$list->sold)echo ' For Sale'; ?></span></small>
         
            
        </div>    
    </div>
   
   
   
    
    <div class="section_2">
        <div class="item-gallery">
            <div class="swiper-container gallery-top" data-pswp-uid="1">
               <div class="swiper-wrapper lazyload">
                   
                   <?php
                                 
                     $photoAttributes = $list->photos[0];
                                 
                     ?>
                  <?php foreach($photoAttributes as $photos): ?>
                  <div class="swiper-slide" style="">
                     <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="<?php echo esc_url( $photos['midSize'] ); ?>" itemprop="contentUrl" data-size="0x0">
                           <center>
                              <div style="max-height:530px;overflow:hidden;">
                                  <img src="<?php echo esc_url( $photos['midSize'] ); ?>"  class="img-fluid swiper-lazy" style="max-height:530px;" >
                               </div>
                           </center>
                        </a>
                     </figure>
                  </div>
                   <?php endforeach; ?>
               </div>
               <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div>
            </div>
            <div id="ctl00_ctHomeslider_divthumbs">
               <div class="swiper-container gallery-thumbs">
                  <div class="swiper-wrapper">
                      <?php foreach($photoAttributes as $photos): ?>
                      <div class="swiper-slide">
                        <div style="max-height: 117px; overflow: hidden;">
                           <img src="<?php echo esc_url( $photos['thumbnail'] ); ?>" class="img-fluid" style="max-height: 117px;" alt="">
                        </div>
                     </div>
                      <?php endforeach; ?>
                      
                  </div>
               </div>
            </div>
         </div>
    </div>
    
    <div class="section_3">
        
        <div class="left_area">
            <div class="desc_area">
                <h3 class="headline">Description</h3>
                <p><?php echo esc_html( $list->description ); ?></p>                
            </div>
            <div class="inspection_time">
              
                <?php if(isset($list->inspections)){ ?>
                <?php foreach($list->inspections->inspection as $inspect){ ?>
                    <p>Inspection : <?php echo esc_html( $inspect->displayTime ); ?></p>
                <?php }} ?>
            </div>
            
            <div class="map_area">
               <?php if(!empty($mantis_settings['google_map_api_key']) && isset($list->showAddress) && $list->showAddress == 'yes') { ?>
                   <script>
         var geocoder;
           var map;
           function initMap() {
             geocoder = new google.maps.Geocoder();
             var latlng = new google.maps.LatLng(-34.397, 150.644);
             var mapOptions = {
               zoom: 11,
               center: latlng
             }
             map = new google.maps.Map(document.getElementById('map'), mapOptions);

             var address = '<?php echo esc_html( $list->streetAddress.', '.$list->suburb.', '.$list->state ); ?>';
             geocoder.geocode( { 'address': address}, function(results, status) {
               if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
               } else {
            console.log('Geocode was not successful for the following reason: ' + status);
               }
             });
           }         
                   </script>
                   
                   <div id="map" style="width: 100%; height: 400px;"></div>
                   
                   
                   <script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_html( $mantis_settings['google_map_api_key'] ); ?>&callback=initMap"></script>


               <?php } ?>
            </div>
        </div>
        <div class="right_area">
            <div class="right_area_sidebar">
                
               <div class="card specifications">
                  <div class="card-header" role="tab" id="headingOne">
                     <h4 class="panel-title">Specifications</h4>
                  </div>
                  <div class="card-body">
                      <?php if(isset($list->category1)): ?>
                      <div class="inner_td">
                          <span class="span_1">Category</span>
                          <span class="span_2"><?php echo esc_html( $list->category1 ); ?></span>
                      </div>
                      <?php endif; ?>
                 
                    <?php if(isset($list->buildingArea)): ?>
                      <div class="inner_td">
                          <span class="span_1">Building</span>
                          <span class="span_2"><?php echo esc_html( $list->buildingArea ); ?></span>
                      </div>
                      <?php endif; ?>
                 
                      <?php if(isset($list->landDetails->landArea)): ?>
                      <div class="inner_td">
                          <span class="span_1">Land Area</span>
                          <span class="span_2"><?php echo esc_html( $list->landDetails->landArea ); ?></span>
                      </div>
                      <?php endif; ?>
                      <?php if(isset($list->bedrooms)): ?>
                      <div class="inner_td">
                          <span class="span_1">Beds</span>
                          <span class="span_2"><?php echo esc_html( $list->bedrooms ); ?></span>
                      </div>
                      <?php endif; ?>
                      <?php if(isset($list->bathrooms)): ?>
                      <div class="inner_td">
                          <span class="span_1">Baths</span>
                          <span class="span_2"><?php echo esc_html( $list->bathrooms ); ?></span>
                      </div>
                      <?php endif; ?>
                      <?php if(isset($list->carSpaces)): ?>
                      <div class="inner_td">
                          <span class="span_1">Cars</span>
                          <span class="span_2"><?php echo esc_html( $list->carSpaces ); ?></span>
                      </div>
                      <?php endif; ?>
                      
                  </div>
               </div>
                
                
               <div class="card agency_stuff">
                  <div class="card-header" role="tab" id="headingOne">
                     <h4 class="panel-title">Agent</h4>
                  </div>
                  <div class="card-body ">
                      
                      <?php foreach($list->salesPeople->salesPerson as $salesPers){ ?>
                                 
                      <?php if(isset($salesPers->photo)){ ?>
                      <div class="text-center">
                          <img src="<?php echo esc_url( $salesPers->photo ); ?>" border='0' style="width:100%; max-width: 250px;" > 
                       </div>  
                      <?php } ?>

                      <h4 class="media-heading"><?php echo esc_html( $salesPers->firstName.' '.$salesPers->lastName ); ?></h4>
                      
                      
                      <div class="inner_td">
                          <span class="span_1"><i class="fa fa-phone"></i> Call: <?php echo esc_html( $salesPers->phone ); ?></span>
                      </div>
                      
                      <div class="inner_td">
                          <span class="span_1"><i class="fa fa-mobile"></i> Mobile: <?php echo esc_html( $salesPers->mobile ); ?></span>
                          <input type="hidden" name="sales_email" id="sales_email" value="<?php echo esc_html( $salesPers->email ); ?>" />
                          <input type="hidden" name="sales_firstname" id="sales_firstname" value="<?php echo esc_html( $salesPers->firstName ); ?>" />
                          <input type="hidden" name="sales_lastname" id="sales_lastname" value="<?php echo esc_html( $salesPers->lastName ); ?>" />
                      </div>      
                      
                      <?php } ?>
                      <button type="button" id="myBtn" class="" >Enquire Now</button>

                  </div>
               </div>
            
                
            </div>
        </div>
    
    </div>
</div>
<div id="myModal" class="modal enquire_model">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <div class="media">
               <h4 class="media-heading">Enquire about this listing now</h4>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label>First Name <span style="color:Red;">*</span></label>
               <input name="first_name" type="text" id="first_name" class="form-control" />
            </div>
            <div class="form-group">
               <label>Last Name <span style="color:Red;">*</span></label>
               <input name="last_name" type="text" id="last_name" class="form-control" />
            </div>
            <div class="form-group">
               <label>Your Email <span style="color:Red;">*</span></label>
               <input name="your_email" type="text" id="your_email" class="form-control" />
            </div>
            <div class="form-group">
               <label>Your Telephone<span style="color:Red;">*</span></label>
               <input name="your_phone" type="text" id="your_phone" class="form-control" />
            </div>
            <div class="form-group">
               <label>Message</label>
               <textarea name="your_message" rows="4" cols="20" id="your_message" class="form-control" placeholder="Please include any useful details, i.e. current status, availability for viewings, etc."></textarea>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-link btn-cancel" data-dismiss="modal">Cancel</button>
            <input type="submit" name="send_msg_agent" value="Send Message" id="send_msg_agent" class="btn btn-primary" />
            </div>
         </div>
      </div>
   </div>
  

<?php }} ?>






<script type="text/javascript">

        var initPhotoSwipeFromDOM = function (gallerySelector) {
            var parseThumbnailElements = function (el) {
                console.log(el);
                var thumbElements = $(el).closest(main_gallery).find('figure'),
                    numNodes = thumbElements.length,
                    items = [],
                    figureEl,
                    linkEl,
                    size,
                    item;

                for (var i = 0; i < numNodes; i++) {

                    figureEl = thumbElements[i]; // <figure> element

                    // include only element nodes 
                    if (figureEl.nodeType !== 1) {
                        continue;
                    }

                    linkEl = figureEl.children[0]; // <a> element

                    size = linkEl.getAttribute('data-size').split('x');

                    // create slide object
                    item = {
                        src: linkEl.getAttribute('href'),
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10)
                    };



                    if (figureEl.children.length > 1) {
                        // <figcaption> content
                        item.title = figureEl.children[1].innerHTML;
                    }

                    if (linkEl.children.length > 0) {
                        // <img> thumbnail element, retrieving thumbnail url
                        item.msrc = linkEl.children[0].getAttribute('src');
                    }

                    item.el = figureEl; // save link to element for getThumbBoundsFn
                    items.push(item);
                }

                return items;
            };

            // find nearest parent element
            var closest = function closest(el, fn) {
                return el && (fn(el) ? el : closest(el.parentNode, fn));
            };

            // triggers when user clicks on thumbnail
            var onThumbnailsClick = function (e) {
                e = e || window.event;
                e.preventDefault ? e.preventDefault() : e.returnValue = false;

                var eTarget = e.target || e.srcElement;

                // find root element of slide
                var clickedListItem = closest(eTarget, function (el) {
                    return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                });

                if (!clickedListItem) {
                    return;
                }
                var clickedGallery = clickedListItem.parentNode,
                    childNodes = $(clickedListItem).closest(main_gallery).find('figure'),
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

                for (var i = 0; i < numChildNodes; i++) {
                    if (childNodes[i].nodeType !== 1) {
                        continue;
                    }

                    if (childNodes[i] === clickedListItem) {
                        index = nodeIndex;
                        break;
                    }
                    nodeIndex++;
                }
                if (index >= 0) {
                    // open PhotoSwipe if valid index found
                    openPhotoSwipe(index, clickedGallery);
                }
                return false;
            };

            var openPhotoSwipe = function (index, galleryElement, disableAnimation) {
                var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

                items = parseThumbnailElements(galleryElement);

                // define options (if needed)
                options = {
                    history: false,
                    bgOpacity: 0.8,
                    loop: false,
                    barsSize: {
                        top: 0,
                        bottom: 'auto'
                    },

                    // define gallery index (for URL)
                    galleryUID: $(galleryElement).closest(main_gallery).attr('data-pswp-uid'),

                    getThumbBoundsFn: function (index) {
                        // See Options -> getThumbBoundsFn section of documentation for more info
                        var thumbnail = document.querySelectorAll(main_gallery + ' img')[index],
                            //var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                        return {
                            x: rect.left,
                            y: rect.top + pageYScroll,
                            w: rect.width
                        };
                    }

                };

                options.index = parseInt(index, 10);

                // exit if index not found
                if (isNaN(options.index)) {
                    return;
                }

                if (disableAnimation) {
                    options.showAnimationDuration = 0;
                }

                // Pass data to PhotoSwipe and initialize it
                gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

                gallery.listen('gettingData', (index, item) => {
                    if (!item.w || !item.h) {
                        const innerImgEl = item.el.getElementsByTagName('img')[0]
                        if (innerImgEl) {
                            item.w = innerImgEl.width;
                            item.h = innerImgEl.height;
                        }

                        const img = new Image()
                        img.onload = function () {
                            //item.w = this.width;
                            //item.h = this.height;

                            var viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
                            var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

                            var aspectRatio = this.width / this.height;
                            var viewportRatio = viewportWidth / viewportHeight;
                            var adaptedHeight = this.height;
                            var adaptedWidth = this.width;


                            if (viewportRatio > aspectRatio) // scale by width or height?
                            {
                                adaptedHeight *= viewportWidth / this.width;
                                adaptedWidth *= viewportWidth / this.width;
                            }
                            else {
                                adaptedHeight *= viewportHeight / this.height;
                                adaptedWidth *= viewportHeight / this.height;
                            }

                            item.w = adaptedWidth;
                            item.h = adaptedHeight;

                            gallery.updateSize(true)
                        }
                        img.src = item.src
                    }
                });

                gallery.init();
                //gallery.shout('helloWorld', 'John' /* you may pass more arguments */);



                var totalItems = gallery.options.getNumItemsFn();

                function syncPhotoSwipeWithOwl() {
                    var currentIndex = gallery.getCurrentIndex();
                    galleryTop.slideTo(currentIndex);
                    if (currentIndex == (totalItems - 1)) {
                        $('.pswp__button--arrow--right').attr('disabled', 'disabled').addClass('disabled');
                    } else {
                        $('.pswp__button--arrow--right').removeAttr('disabled');
                    }
                    if (currentIndex == 0) {
                        $('.pswp__button--arrow--left').attr('disabled', 'disabled').addClass('disabled');
                    } else {
                        $('.pswp__button--arrow--left').removeAttr('disabled');
                    }
                };
                gallery.listen('afterChange', function () {
                    syncPhotoSwipeWithOwl();
                });
                syncPhotoSwipeWithOwl();
            };

            // loop through all gallery elements and bind events
            var galleryElements = document.querySelectorAll(gallerySelector);

            for (var i = 0, l = galleryElements.length; i < l; i++) {
                galleryElements[i].setAttribute('data-pswp-uid', i + 1);
                galleryElements[i].onclick = onThumbnailsClick;
            }
        };
        var main_gallery = '.gallery-top';
        var galleryTop = new Swiper(main_gallery, {
            autoHeight: true,
            spaceBetween: 10,
            lazy: {
                loadPrevNext: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
            , on: {
                init: function () {
                    initPhotoSwipeFromDOM(main_gallery);
                },
            }
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            autoHeight: true,
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 5,
            touchRatio: 0.2,
            slideToClickedSlide: true,
        });
        galleryTop.controller.control = galleryThumbs;
        galleryThumbs.controller.control = galleryTop;

        function SlideToFloorplans(index) {
            galleryTop.slideTo(index);
            scrollToAnchor('photos');
        }

        function scrollToAnchor(aid) {
            var aTag = $("a[name='" + aid + "']");
            $('html,body').animate({ scrollTop: aTag.offset().top - $("nav").height() }, 'slow');
        }
    

    </script>

<script>

jQuery(function($) {
   
   $("#myBtn").click(function() {
      $("#myModal").fadeIn();
   });
   
   $("button.close, button.btn-cancel").click(function() {
      $("#myModal").fadeOut();
   });
   
   $(document).on('click', '#myModal', function(e) {
      if ($(e.target).is('#myModal') || $(e.target).is('.modal-dialog')) {
         $("#myModal").fadeOut();
      }
   });
   
});

</script>


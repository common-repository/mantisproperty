<?php

global $default_mantis_settings;

$default_mantis_settings = array(
     'google_map_api_key' => '',
     'listing_default_font_color' => '#000000',
     'listing_heading_font_color' => '#6fbb27',            
     'listing_address_font_color' => '#999',
     'listing_icons_font_color' => '#666',
     'listing_text_font_color' => '#626262',
     'listing_link_font_color' => '#6fbb27',
     'listing_price_font_color' => '#fff',


     'detail_default_font_color' => '#000000',
     'detail_heading_font_color' => '#2c2c2c',
     'detail_address_font_color' => '#999',
     'detail_icons_font_color' => '#666',
     'detail_text_font_color' => '#626262',
     'detail_link_font_color' => '#6fbb27',
     'detail_price_font_color' => '#6fba28',
  );


function mpa_activate_options() {
    
    global $table_prefix, $wpdb, $default_mantis_settings;

    $tblname = 'mantis_api';
    $wp_track_table = $table_prefix . "$tblname";

    #Check to see if the table exists already, if not, then create it
    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table)  {
        
        $sql = "CREATE TABLE " . $wp_track_table . " (
      `id` mediumint(9) NOT NULL AUTO_INCREMENT,
      `api_key` mediumtext NOT NULL,
      `agency_id` mediumtext NOT NULL,
      UNIQUE KEY id (id),
        PRIMARY KEY (id)
      );";
        
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);                                                                               
    }
    
    if (get_option('mantis_settings') === false) {
      update_option('mantis_settings', $default_mantis_settings);       
    }
    
}

function mpa_deactivate_options() {
    
    global $table_prefix, $wpdb;

    $tblname = 'mantis_api';
    $wp_track_table = $table_prefix . "$tblname";
    
    $sql = $wpdb->query("Drop table $wp_track_table");
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    
    delete_option('mantis_settings');
    
}

 register_deactivation_hook( __FILE__, 'mpa_deactivate_options');


//top level menu link


function mpa_api_credentials() {
    
  add_menu_page(
        'Mantis Api Credentials', 
        'Mantis Property',
        'manage_options', 
        'credential_page',
        'mpa_api_credential_page'
    );    
   
}

function mpa_get_api_credentials(){
    
    global $table_prefix;
    global $wpdb;
    
    $tblname = 'mantis_api';
    $wp_track_table = $table_prefix . "$tblname";
    
    $result = $wpdb->get_results("SELECT * FROM $wp_track_table LIMIT 1");
    
    return $query_list = "apikey=".urlencode($result[0]->api_key)."&agencyID=".urlencode($result[0]->agency_id);
    
}

add_action( 'init', 'mpa_get_api_credentials',10);



function mpa_api_credential_page(){
    mpa_activate_options();
    
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );    
    
    require_once plugin_dir_path(__FILE__) . 'credential_page.php';
}


add_action( 'admin_menu', 'mpa_api_credentials' );


function mpa_create_pages(){
    
    $title1 = "Residential for Sale";
    $content1 = '[mantis_listings type="residential"]';
    $page1_data = array(
        'post_title' => $title1,
        'post_content' => $content1,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title1, 'OBJECT', 'page'))
        wp_insert_post($page1_data);
    
     $title2 = "Residential for Sale - Sold";
    $content2 = '[mantis_listings type="residential" search="sold"]';
    $page2_data = array(
        'post_title' => $title2,
        'post_content' => $content2,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title2, 'OBJECT', 'page'))
        wp_insert_post($page2_data);
   
     $title3 = "Land for Sale";
    $content3 = '[mantis_listings type="land"]';
    $page3_data = array(
        'post_title' => $title3,
        'post_content' => $content3,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title3, 'OBJECT', 'page'))
        wp_insert_post($page3_data);
   
   $title4 = "Land for Sale - Sold";
    $content4 = '[mantis_listings type="land" search="sold"]';
    $page4_data = array(
        'post_title' => $title4,
        'post_content' => $content4,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title4, 'OBJECT', 'page'))
        wp_insert_post($page4_data);
   
   
    $title5 = "Rural for Sale";
    $content5 = '[mantis_listings type="rural"]';
    $page5_data = array(
        'post_title' => $title5,
        'post_content' => $content5,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title5, 'OBJECT', 'page'))
        wp_insert_post($page5_data);
   
   
   $title6 = "Rural for Sale - Sold";
    $content6 = '[mantis_listings type="rural" search="sold"]';
    $page6_data = array(
        'post_title' => $title6,
        'post_content' => $content6,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title6, 'OBJECT', 'page'))
        wp_insert_post($page6_data);
   
    
    $title7 = "Residential For Rent";
    $content7 = '[mantis_listings type="rent"]';
    $page7_data = array(
        'post_title' => $title7,
        'post_content' => $content7,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title7, 'OBJECT', 'page'))
        wp_insert_post($page7_data);
    
    
    $title8 = "Holiday Rentals";
    $content8 = '[mantis_listings type="holiday"]';
    $page8_data = array(
        'post_title' => $title8,
        'post_content' => $content8,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title8, 'OBJECT', 'page'))
        wp_insert_post($page8_data);
    
    
    
    $title9 = "Commercial Land";
    $content9 = '[mantis_listings type="commercialLand"]';
    $page9_data = array(
        'post_title' => $title9,
        'post_content' => $content9,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title9, 'OBJECT', 'page'))
        wp_insert_post($page9_data);
    
        
    $title10 = "Commercial for Lease";
    $content10 = '[mantis_listings type="commercial" sale="lease"]';
    $page10_data = array(
        'post_title' => $title10,
        'post_content' => $content10,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title10, 'OBJECT', 'page'))
        wp_insert_post($page10_data);
    
    $title11 = "Commercial for Sale";
    $content11 = '[mantis_listings type="commercial" sale="sale"]';
    $page11_data = array(
        'post_title' => $title11,
        'post_content' => $content11,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title11, 'OBJECT', 'page'))
        wp_insert_post($page11_data);
    
    
    $title12 = "Commercial - For Sale - Recently Sold";
    $content12 = '[mantis_listings type="commercial" sale="sale" search="sold"]';
    $page12_data = array(
        'post_title' => $title12,
        'post_content' => $content12,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title12, 'OBJECT', 'page'))
        wp_insert_post($page12_data);
   
   
     $title13 = "Business For Sale";
    $content13 = '[mantis_listings type="business"]';
    $page13_data = array(
        'post_title' => $title13,
        'post_content' => $content13,
        'post_type' => 'page',
        'post_status'   => 'publish',
    );
    if (!get_page_by_title($title13, 'OBJECT', 'page'))
        wp_insert_post($page13_data);
    
    
    
}


function mpa_save_credentials() {

    global $table_prefix;
    global $wpdb;
    
    $tblname = 'mantis_api';
    $wp_track_table = $table_prefix . "$tblname";
    
    if(isset($_POST['submit']) && !empty($_POST['submit'])){ 
        
        $mpa_api_key = sanitize_text_field( $_POST['api_key'] );
        $mpa_agency_id = sanitize_text_field( $_POST['agency_id'] );
        
        $data = array('api_key' => "$mpa_api_key", 'agency_id' => "$mpa_agency_id");
        $format = NULL;
        
        $totalRows = $wpdb->get_row("select * from $wp_track_table");
        //echo '<pre>';print_r($totalRows);exit;
        if($totalRows->id)
           $update = $wpdb->update($wp_track_table,$data,array('id'=>$totalRows->id));
        else
           $update =  $wpdb->insert($wp_track_table,$data,$format);
           
           
	update_option( 'mantis_settings', $_POST['mantis_settings'] );
        

        //if($update){ 
            mpa_create_pages();
            $location = $_SERVER['HTTP_REFERER'].'&saved=1';
            wp_safe_redirect($location);
        //}
    }
    
}

add_action( 'admin_post_custom_credentials_save', 'mpa_save_credentials' );



function mpa_send_message_to_agent() {  
    
    if(isset($_POST['action']) && sanitize_text_field($_POST['action']) == 'agent_info'){
        
        $listing_id = sanitize_text_field($_POST['listing_id']);
        
        $sales_listType = sanitize_text_field( $_POST['sales_listType'] );
        
        $first_name      = sanitize_text_field( $_POST['first_name'] );
        $last_name      = sanitize_text_field( $_POST['last_name'] );
        $email     = sanitize_email( $_POST['email'] );
        $phone     = sanitize_text_field( $_POST['phone'] );
        $message   = sanitize_textarea_field( $_POST['message'] );
                
        //$body = "Name:$name,email:$email,phone:$phone,message:$message";
        
        //echo '<pre>';print_r($body);exit;
        $query_list = mpa_get_api_credentials();
        
        $leads = 'https://api.mantisproperty.com.au/leads?'.$query_list;
    
        $input_xml = '<?xml version="1.0" encoding="UTF-8"?>
                <lead>
                    <contact>
                        <firstName>'.$first_name.'</firstName>
                        <lastName>'.$last_name.'</lastName>
                        <primaryEmail>
                            <emailAddress>'.$email.'</emailAddress> 
                        </primaryEmail>
                        <mobile>
                            <phone>'.$phone.'</phone>
                        </mobile>
                        <groups>
                            <group>Leads</group>
                        </groups>
                    </contact>
                    <listingID>'.$listing_id.'</listingID>
                    <listingType>'.$sales_listType.'</listingType>
                    <notes>'.$message.'</notes>
                    <notifyAgent>false</notifyAgent>
                </lead>';

        //echo $input_xml;exit;
        
        $Getxml = mpa_send_api_post_request($leads, $input_xml);
        

        $xml2 = simplexml_load_string($Getxml) or die("Error: Cannot create object");
        
        //echo '<pre>';print_r($xml2);exit;
    
        if($xml2->status == 'Success'){
            echo 'Your Message has been Sent';
        }else{
            echo 'Message not Sent, Please try again later';
        }
        exit;
        
        
        
        
        $admin_email =  get_bloginfo('admin_email');

        $subject = 'inquiry form for Mantis Property';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $headers .= 'From: MantisProperty <'.$admin_email.'>' . "\r\n";
        
        $body = "<html><body><table>";
        $body .= "<tr><td>Name:</td><td>".$name."</td></tr>";
        $body .= "<tr><td>Email</td><td>".$email."</td></tr>";
        $body .= "<tr><td>Phone</td><td>".$phone."</td></tr>";
        $body .= "<tr><td>Message</td><td>".$message."</td></tr>";
        $body .= "</table></body></html>";
        
        $send = wp_mail($sales_email, $subject, $body, $headers);
        if($send){
            echo 'Your Message has been Sent';
        }else{
            echo 'Message not Sent, Please try again later';
        }
        exit;
        
    }else{
        echo 'invalid details';
        exit;    
    }   
}

add_action("wp_ajax_agent_info", "mpa_send_message_to_agent"); 
add_action("wp_ajax_nopriv_agent_info", "mpa_send_message_to_agent");




function mpa_list_properties( $params = array() ) {
    
    //echo '<pre>';print_r($params['type']);exit;

    $query_list = mpa_get_api_credentials();
                   
    if(isset($_GET['action']) && sanitize_text_field( $_GET['action'] ) == 'filter_query') { 
        
        if(isset($params['type']) && !empty($params['type']))
            $query_list .= "&listingType=".$params['type']; 
        else if(isset($_GET['listingType']) && !empty($_GET['listingType']))
            $query_list .= "&listingType=" . sanitize_text_field( $_GET['listingType'] );
        else
            $query_list .= "&listingType=residential"; 
        
        if(isset($params['search']) && $params['search'] == 'sold'){
            $searchType = $params['search'];
            $query_list .= '&searchType='.$searchType;
        }

        if(isset($_GET['beds']))
            $query_list .= "&beds=". sanitize_text_field($_GET['beds']); 

        if(isset($_GET['baths']))
            $query_list .= "&baths=" . sanitize_text_field( $_GET['baths'] );

        if(isset($_GET['cars']))
            $query_list .= "&cars=" . sanitize_text_field( $_GET['cars'] );
        
        if(isset($_GET['priceFrom']))
            $query_list .= "&priceFrom=" . sanitize_text_field( $_GET['priceFrom'] );
        
        if(isset($_GET['priceTo']))
            $query_list .= "&priceTo=" . sanitize_text_field( $_GET['priceTo'] );
        
        if(isset($_GET['orderby']))
            $query_list .= "&order=" . sanitize_text_field( $_GET['orderby'] );
        
        
        $url2 = 'https://api.mantisproperty.com.au/listings?'.$query_list;
        

        $Getxml = mpa_send_api_request($url2);

        $xml2 = simplexml_load_string($Getxml) or die("Error: Cannot create object");

            //echo '<pre>';print_r($xml2);exit;

        ob_start();
    
        include 'front/mantis_listing_page.php';
        //include 'front/mantis_property_details_page.php';

        $output = ob_get_contents();
        
        ob_end_clean();

        return  $output;
        
        
    }
 
    else if(!isset($_GET['details']) && sanitize_text_field( $_GET['action'] ) != 'filter_query') { 
        
        if(isset($params['type']) && !empty($params['type'])){
            $listingType = $params['type'];
            $query_list .= '&listingType='.$listingType;
        }else{
            $listingType = 'residential';
            $query_list .= '&listingType='.$listingType;
        }
        
        if(isset($params['sale']) && !empty($params['sale'])){
            $saleType = $params['sale'];
            $query_list .= '&saleType='.$saleType;
        }else{
            //$saleType = '';
            //$query_list .= '&saleType='.$saleType;
        }
        
        if(isset($params['search']) && !empty($params['search'])){
            $searchType = $params['search'];
            $query_list .= '&searchType='.$searchType.'&order=5';
        }else{
            //$searchType = '';
            //$query_list .= '&searchType='.$searchType;
        }
        
        
        //echo '<pre>';print_r($params);exit;
        
        //$query_list .= '&listingType='.$listingType.'&saleType='.$saleType;
        
        $query_list .= '&beds=1';
        
        $url2 = 'https://api.mantisproperty.com.au/listings?'.$query_list;
        
        //echo $url2;exit;

        $Getxml = mpa_send_api_request($url2);

        $xml2 = simplexml_load_string($Getxml) or die("Error: Cannot create object");

        //echo '<pre>';print_r($xml2);exit;
        ob_start();

        include 'front/mantis_listing_page.php';

        $output = ob_get_contents();
        ob_end_clean();
        return $output;
        
    }
    
    else {
        
        //echo $query_list;exit;
        if(isset($_GET['details'])){ 
        
            $explode = explode("-", sanitize_text_field( $_GET['details'] ) );

            $listingType = $explode[0];
            $propertyId = $explode[3];

            
            $query_list .= "&includeSold=true"; 

            $query_list .= "&listingType=".$listingType; 
            $query_list .= "&propertyID=".$propertyId; 


            $url2 = 'https://api.mantisproperty.com.au/listings?'.$query_list;

            //echo $url2;exit;

            $Getxml = mpa_send_api_request($url2);

            $xml_details = simplexml_load_string($Getxml) or die("Error: Cannot create object");

           //echo '<pre>';print_r($xml_details);exit;
           
            ob_start();

            include 'front/mantis_property_details_page.php';

            $output = ob_get_contents();
            ob_end_clean();

            return  $output;  
        }

    }
}  

add_shortcode('mantis_listings', 'mpa_list_properties',10);





function mpa_send_api_request($url){

    $response = wp_remote_get($url, array('user-agent' => 'MantisProperty Plugin ' . MPA_PLUGIN_VERSION, 'httpversion' => '1.1', 'sslverify' => false));
    
    return $response['body'];
    
}

function mpa_send_api_post_request($url, $fields) {

   $response = wp_remote_post($url, 
      [        
         'user-agent' => 'MantisProperty Plugin ' . MPA_PLUGIN_VERSION,
         'httpversion' => '1.1',
         'sslverify' => false,
         'headers' => [
             "Content-type: text/xml",
             "Content-length: " . strlen($fields),
             "Connection: close",
         ],       
      ]
   );
    
   return $response['body'];
    
}



function mpa_scripts() {
   global $post;
   if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'mantis_listings') ) {
   
      wp_enqueue_style('opensans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');
      wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
   
      if (isset($_GET['details'])) {

         wp_enqueue_style('photoswipe', plugins_url('front/assets/css/photoswipe.css', __FILE__));
         wp_enqueue_style('swiper', plugins_url('front/assets/css/swiper.min.css', __FILE__));
         wp_enqueue_style('animate', plugins_url('front/assets/css/animate.css', __FILE__));


         wp_enqueue_script('swiper', plugins_url('front/assets/js/swiper.min.js', __FILE__), array('jquery'), '', false);
         wp_enqueue_script('photoswipe', plugins_url('front/assets/js/photoswipe.min.js', __FILE__) , array('jquery'), '', true);
         wp_enqueue_script('photoswipe-ui', plugins_url('front/assets/js/photoswipe-ui-default.min.js', __FILE__) , array('jquery'), '', true);
         wp_enqueue_script('mpa-custom', plugins_url('front/assets/js/custom.js', __FILE__) , array('jquery'), '', true);
         wp_enqueue_script('popper', plugins_url('front/assets/js/popper.min.js', __FILE__) , array('jquery'), '', true);
      }
      
      wp_enqueue_style('mpa-custom', plugins_url('front/assets/css/custom.css', __FILE__));

   }   
}
add_action( 'wp_enqueue_scripts', 'mpa_scripts' );

?>
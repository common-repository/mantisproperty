<?php 

global $table_prefix, $wpdb;
$tblname = 'mantis_api';
$wp_track_table = $table_prefix . "$tblname ";

$result = $wpdb->get_results("SELECT * FROM $wp_track_table LIMIT 1");

$settings_result = get_option('mantis_settings');

global $default_mantis_settings;


 if(isset($_GET['saved']) && $_GET['saved']==1){ 
 ?>
    <div class="notice notice-success is-dismissible"> 
        <p><strong>Credentials saved.</strong></p>
    </div>
 <?php } ?>


<div class="wrap">
    <h1>Add MantisProperty credentials</h1>
    <form action="<?php echo esc_html( get_admin_url() ."admin-post.php"); ?>" method="POST">
        <input type="hidden" name="action" value="custom_credentials_save">

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="api_key">ApiKey:</label></th>
                    <td><input type="text" class="regular-text" id="api_key" placeholder="Enter Api Key" value="<?php if(isset($result))echo $result[0]->api_key; ?>" name="api_key" required>
                </tr>
                <tr>
                    <th scope="row"><label for="agency_id">Agent ID:</label></th>
                    <td><input type="text" class="regular-text" id="agency_id" placeholder="Enter Agency Id" value="<?php if(isset($result))echo $result[0]->agency_id; ?>" name="agency_id" required></td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="GoogleMapApiKey">Google Map API Key:</label></th>
                    <td><input type="text" class="regular-text" id="GoogleMapApiKey" placeholder="Enter Google Map Api Key" value="<?php echo isset($settings_result['google_map_api_key']) ? $settings_result['google_map_api_key'] : ''; ?>" name="mantis_settings[google_map_api_key]">
                </tr>
				<tr>
					<td><B>A Google Map API key is required for maps to show on your listings (when you have set the address to show for that listing)</B><br>
					  <p>
            To retrieve an API key, <a href="https://cloud.google.com/maps-platform/#get-started" target="_blank">click here</a> and follow the prompts to set up a Google Maps account or contact your web developer and ask for a Google Maps API key to be created for the Geocoding API. Further information is available via the links below.
        </p>
          <p>
              <a href="https://developers.google.com/maps/documentation/geocoding/get-api-key#detailed-guide" target="_blank">Get an API Key</a>
              <br />
              <a href="https://developers.google.com/maps/documentation/geocoding/usage-and-billing#pricing-for-the-geocoding-api" target="_blank">Geocoding Billing</a>
          </p>
					</td>
				</tr>
                
                <tr>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="ListingDefaultFontColor">Listing Default Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingDefaultFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_default_font_color']) ? $default_mantis_settings['listing_default_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_default_font_color']) ? $settings_result['listing_default_font_color'] : ''; ?>" name="mantis_settings[listing_default_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingHeadingFontColor">Listing Heading Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingHeadingFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_heading_font_color']) ? $default_mantis_settings['listing_heading_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_heading_font_color']) ? $settings_result['listing_heading_font_color'] : ''; ?>" name="mantis_settings[listing_heading_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingAddressFontColor">Listing Address Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingAddressFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_address_font_color']) ? $default_mantis_settings['listing_address_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_address_font_color']) ? $settings_result['listing_address_font_color'] : ''; ?>" name="mantis_settings[listing_address_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingIconsFontColor">Listing Icons Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingIconsFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_icons_font_color']) ? $default_mantis_settings['listing_icons_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_icons_font_color']) ? $settings_result['listing_icons_font_color'] : ''; ?>" name="mantis_settings[listing_icons_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingTextFontColor">Listing Text Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingTextFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_text_font_color']) ? $default_mantis_settings['listing_text_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_text_font_color']) ? $settings_result['listing_text_font_color'] : ''; ?>" name="mantis_settings[listing_text_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingLinkFontColor">Listing Link Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingLinkFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_link_font_color']) ? $default_mantis_settings['listing_link_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_link_font_color']) ? $settings_result['listing_link_font_color'] : ''; ?>" name="mantis_settings[listing_link_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingPriceFontColor">Listing Price Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingPriceFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_price_font_color']) ? $default_mantis_settings['listing_price_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['listing_price_font_color']) ? $settings_result['listing_price_font_color'] : ''; ?>" name="mantis_settings[listing_price_font_color]"></td>
                </tr>
                
                <tr>
                    <td colspan="2"></td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="DetailDefaultFontColor">Detail Default Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailDefaultFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_default_font_color']) ? $default_mantis_settings['detail_default_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_default_font_color']) ? $settings_result['detail_default_font_color'] : ''; ?>" name="mantis_settings[detail_default_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailHeadingFontColor">Detail Heading Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailHeadingFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_heading_font_color']) ? $default_mantis_settings['detail_heading_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_heading_font_color']) ? $settings_result['detail_heading_font_color'] : ''; ?>" name="mantis_settings[detail_heading_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailAddressFontColor">Detail Address Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailAddressFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_address_font_color']) ? $default_mantis_settings['detail_address_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_address_font_color']) ? $settings_result['detail_address_font_color'] : ''; ?>" name="mantis_settings[detail_address_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailIconsFontColor">Detail Icons Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailIconsFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_icons_font_color']) ? $default_mantis_settings['detail_icons_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_icons_font_color']) ? $settings_result['detail_icons_font_color'] : ''; ?>" name="mantis_settings[detail_icons_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailTextFontColor">Detail Text Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailTextFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_text_font_color']) ? $default_mantis_settings['detail_text_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_text_font_color']) ? $settings_result['detail_text_font_color'] : ''; ?>" name="mantis_settings[detail_text_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailLinkFontColor">Detail Link Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailLinkFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_link_font_color']) ? $default_mantis_settings['detail_link_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_link_font_color']) ? $settings_result['detail_link_font_color'] : ''; ?>" name="mantis_settings[detail_link_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailPriceFontColor">Detail Price Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailPriceFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_price_font_color']) ? $default_mantis_settings['detail_price_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($settings_result['detail_price_font_color']) ? $settings_result['detail_price_font_color'] : ''; ?>" name="mantis_settings[detail_price_font_color]"></td>
                </tr>                  
            </tbody>
        </table>


        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>

<script>
jQuery(document).ready(function() {
   jQuery(".color-picker").wpColorPicker();
});
</script>





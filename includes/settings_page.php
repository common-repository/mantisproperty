<?php 

$result = get_option('mantis_settings');

global $default_mantis_settings;

 if(isset($_GET['saved']) && sanitize_text_field( $_GET['saved']) == 1){ 
 ?>
    <div class="notice notice-success is-dismissible"> 
        <p><strong>Credentials saved.</strong></p>
    </div>
 <?php } ?>


<div class="wrap">
    <h1>Add MantisProperty credentials</h1>
    <form action="<?php echo esc_html( get_admin_url()."admin-post.php" ); ?>" method="POST">
        <input type="hidden" name="action" value="custom_settings_save">

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="GoogleMapApiKey">Google Map API Key:</label></th>
                    <td><input type="text" class="regular-text" id="GoogleMapApiKey" placeholder="Enter Google Map Api Key" value="<?php echo isset($result['google_map_api_key']) ? $result['google_map_api_key'] : ''; ?>" name="mantis_settings[google_map_api_key]">
                </tr>
                
                <tr>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="ListingDefaultFontColor">Listing Default Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingDefaultFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_default_font_color']) ? $default_mantis_settings['listing_default_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_default_font_color']) ? $result['listing_default_font_color'] : ''; ?>" name="mantis_settings[listing_default_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingHeadingFontColor">Listing Heading Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingHeadingFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_heading_font_color']) ? $default_mantis_settings['listing_heading_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_heading_font_color']) ? $result['listing_heading_font_color'] : ''; ?>" name="mantis_settings[listing_heading_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingAddressFontColor">Listing Address Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingAddressFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_address_font_color']) ? $default_mantis_settings['listing_address_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_address_font_color']) ? $result['listing_address_font_color'] : ''; ?>" name="mantis_settings[listing_address_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingIconsFontColor">Listing Icons Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingIconsFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_icons_font_color']) ? $default_mantis_settings['listing_icons_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_icons_font_color']) ? $result['listing_icons_font_color'] : ''; ?>" name="mantis_settings[listing_icons_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingTextFontColor">Listing Text Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingTextFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_text_font_color']) ? $default_mantis_settings['listing_text_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_text_font_color']) ? $result['listing_text_font_color'] : ''; ?>" name="mantis_settings[listing_text_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingLinkFontColor">Listing Link Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingLinkFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_link_font_color']) ? $default_mantis_settings['listing_link_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_link_font_color']) ? $result['listing_link_font_color'] : ''; ?>" name="mantis_settings[listing_link_font_color]"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ListingPriceFontColor">Listing Price Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="ListingPriceFontColor" data-default-color="<?php echo isset($default_mantis_settings['listing_price_font_color']) ? $default_mantis_settings['listing_price_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['listing_price_font_color']) ? $result['listing_price_font_color'] : ''; ?>" name="mantis_settings[listing_price_font_color]"></td>
                </tr>
                
                <tr>
                    <td colspan="2"></td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="DetailDefaultFontColor">Detail Default Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailDefaultFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_default_font_color']) ? $default_mantis_settings['detail_default_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_default_font_color']) ? $result['detail_default_font_color'] : ''; ?>" name="mantis_settings[detail_default_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailHeadingFontColor">Detail Heading Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailHeadingFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_heading_font_color']) ? $default_mantis_settings['detail_heading_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_heading_font_color']) ? $result['detail_heading_font_color'] : ''; ?>" name="mantis_settings[detail_heading_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailAddressFontColor">Detail Address Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailAddressFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_address_font_color']) ? $default_mantis_settings['detail_address_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_address_font_color']) ? $result['detail_address_font_color'] : ''; ?>" name="mantis_settings[detail_address_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailIconsFontColor">Detail Icons Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailIconsFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_icons_font_color']) ? $default_mantis_settings['detail_icons_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_icons_font_color']) ? $result['detail_icons_font_color'] : ''; ?>" name="mantis_settings[detail_icons_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailTextFontColor">Detail Text Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailTextFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_text_font_color']) ? $default_mantis_settings['detail_text_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_text_font_color']) ? $result['detail_text_font_color'] : ''; ?>" name="mantis_settings[detail_text_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailLinkFontColor">Detail Link Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailLinkFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_link_font_color']) ? $default_mantis_settings['detail_link_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_link_font_color']) ? $result['detail_link_font_color'] : ''; ?>" name="mantis_settings[detail_link_font_color]"></td>
                </tr>                
                <tr>
                    <th scope="row"><label for="DetailPriceFontColor">Detail Price Font Color:</label></th>
                    <td><input type="text" class="color-picker" id="DetailPriceFontColor" data-default-color="<?php echo isset($default_mantis_settings['detail_price_font_color']) ? $default_mantis_settings['detail_price_font_color'] : ''; ?>" placeholder="Pick a color" value="<?php echo isset($result['detail_price_font_color']) ? $result['detail_price_font_color'] : ''; ?>" name="mantis_settings[detail_price_font_color]"></td>
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

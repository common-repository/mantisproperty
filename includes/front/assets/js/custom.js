
jQuery(document).ready(function(){
    
    jQuery("#send_msg_agent").bind("click", function() {
        var first_name = jQuery("#first_name").val();
        var last_name = jQuery("#last_name").val();
        var email = jQuery("#your_email").val();
        var phone = jQuery("#your_phone").val();
        var message = jQuery("#your_message").val();
        
        var listing_id = jQuery("#property_listing_id").val();
        var sales_listType = jQuery("#property_listing_type").val();
        
        
        //alert(sales_email);return false;
        
        if(first_name == '' || first_name == null){
           alert('Please input First Name');
            return false;
        }
        if(last_name == '' || last_name == null){
           alert('Please input Last Name');
            return false;
        }
        if(email == '' || email == null){
           alert('Please input Email');
            return false;
        }
        if(phone == '' || phone == null){
           alert('Please input Phone');
            return false;
        }
        if(message == '' || message == null){
           alert('Please input Message');
            return false;
        }
        
        jQuery.ajax({
          type:'POST',
          data:{action:'agent_info',first_name:first_name,last_name:last_name,email:email,phone:phone,message:message,listing_id:listing_id,sales_listType:sales_listType},
          url: site_url+"/wp-admin/admin-ajax.php",
          success: function(value) {
           alert(value);
           jQuery(".enquire_model").css("display","none");
          }
        });
    });
    
});

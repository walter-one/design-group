jQuery(function(){

    jQuery('#title_show').change(function(){
        if( this.value == '1' ){
            jQuery('#title_options').slideDown();
        }
        else{
            jQuery('#title_options').slideUp();
        }
    });
    jQuery('#title_show').change();
	

    if( jQuery('#page_template').val() == 'page-one-page.php' ){
        jQuery('#pmeta_onepage').slideDown();
        jQuery('#postdivrich').hide();
        jQuery('#blox_contentbuilder').hide();
    }
    else if( jQuery('#page_template').val() == 'page-blank.php' ){
        jQuery('#pmeta_page').hide();
    }

    jQuery('#pmeta_less_option').addClass('closed');

    jQuery('#page_template').change(function(){
        if( this.value == 'one-page.php' ){
            jQuery('#pmeta_one_page').slideDown();
        }
        else{
            jQuery('#pmeta_one_page').slideUp();
        }

    });


    jQuery('#button_op_custom_link').click(function(){
        jQuery('#one_page_custom_link').toggle('fast');
    });

    jQuery('#onpage_allpages').change(function(){
        if( jQuery(this).val()!='0' ){
            jQuery('#button_onepage_add').trigger('click');
            jQuery(this).val('0').change();
        }
    });
	
    jQuery('#onepage_container').sortable({
        update: function( event, ui ){

        }
    });




    jQuery('#up_layout').change(function(){
        if( this.value == 'boxed' ){
            jQuery('#option_wrapper_up_margin_top,#option_wrapper_up_margin_bottom,#option_wrapper_up_background_img').slideDown();
        }
        else{
            jQuery('#option_wrapper_up_margin_top,#option_wrapper_up_margin_bottom,#option_wrapper_up_background_img').slideUp();
        }
    });
    jQuery('#up_layout').change();


    jQuery('#up_header_height').change(function(){
        jQuery('#less_header-height').val( this.value+'px' );
    });


    jQuery('#up_menu_font,#up_heading_font,#up_body_font').change(function(){
        var $this = jQuery(this);
        if( $this.parent().find('.google_fonts_preview').length<1 ){
            $this.parent().append('<span class="google_fonts_preview">Preview Text</span>');
        }
        jQuery('.gf_'+$this.attr('id')).remove();
        if( this.value!='default' ){
            jQuery('head').append('<link href="http://fonts.googleapis.com/css?family='+ this.value +'" rel="stylesheet" type="text/css" class="gf_'+ $this.attr('id') +'">');
            $this.parent().find('.google_fonts_preview').css('font-family', this.value);
        }
        else{
            $this.parent().find('.google_fonts_preview').attr('style');
        }
    });

    /* Font actions */
    jQuery('#up_body_font').change(function(){
        jQuery('#less_base-font-body').val( this.value=='default' ? 'arial' : this.value );
    });
    jQuery('#up_heading_font').change(function(){
        jQuery('#less_base-font-heading').val( this.value=='default' ? 'arial' : this.value );
    });
    jQuery('#up_menu_font').change(function(){
        jQuery('#less_base-font-menu').val( this.value=='default' ? 'arial' : this.value );
    });

    jQuery('#up_menu_font').change();
    jQuery('#up_body_font').change();
    jQuery('#up_heading_font').change();
    jQuery('#less_grid-columns').attr('readonly', 'readonly');

    jQuery('#pmeta_less_option').find('.inside').prepend('<div class="page_option_fieldset"><a href="javascript:;" id="button_reset_less" class="button-primary">Reset LESS Variables</a></div>');
    jQuery('#button_reset_less').click(function(){
        jQuery(this).parent().append('<span class="spinner" style="display: inline; float:left;"></span>');
        jQuery.post( ajaxurl, { action: 'up_reset_less_options', post_id: jQuery('#post_ID').val() },
        function(data){
            window.location.reload();
        });
    });



    jQuery('#up_header').change(function(){
        if( this.value == '1' ){ jQuery('#up_header_group').slideDown(); }
        else{ jQuery('#up_header_group').slideUp(); }
    });
    jQuery('#up_header').change();
    
	
});

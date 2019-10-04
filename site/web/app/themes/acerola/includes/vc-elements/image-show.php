<?php

class WPBakeryShortCode_Image_Show extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "title" => "",
            "description" => "Image description",
            "image" => "",
            "extra_class" => ""
        ), $atts ) );

        $image_s = wp_get_attachment_image($image, 'large');
        $imagesrc = wp_get_attachment_image_src($image, 'full');
        $image_src = $imagesrc[0];

        $result = "<div class='popup-gallery det-img'>
                        <a href='$image_src'>
                            $image_s
                             <div class='layer-style-2'>
                                <div class='vertical-align'>
                                    <h4>$title</h4>
                                    <span>$description</span>
                                </div>   
                             </div>
                        </a>
                     </div>";

        return $result;
    }
}

vc_map( array(
            "name" => esc_html__("Image Showcase", 'acerola'),
            "description" => esc_html__("", 'acerola'),
            "base" => "image_show",
            "class" => "",
            "icon" => "icon-wpb-quickload",
            "category" => esc_html__('Themeton', 'acerola'),
            "show_settings_on_create" => true,
            "params" => array(       
                array(
                    'type' => 'textfield',
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'acerola'),
                    "value" => 'Project Title',
                    "holder" => "div"
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "description",
                    "heading" => esc_html__("Description", 'acerola'),
                    "value" => 'aspernatur sit ratione'
                ),         
                array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image Image", 'acerola'),
                    "value" => ''
                ),
                array(
                    "type" => "textfield",
                    "param_name" => "extra_class",
                    "heading" => esc_html__("Extra Class", 'acerola'),
                    "value" => "",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'acerola'),
                )
            )
        ) );
<?php

class WPBakeryShortCode_Service_Box extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "icon_type" => "",
            "image" => "",
            "icon" => "",
            "title" => 'Title',
            "description" => 'description',
            "extra_class" => ""
        ), $atts ) );

        $image_src = $icon_type == 'icon_font' ? "<i class='$icon'></i>" : wp_get_attachment_image($image);

        $result = "<div class='servis-block'>
                        $image_src
                          <h4>$title</h4>
                            <p>$description</p>
                    </div>";

        return $result;
    }
}

vc_map( array(
            "name" => esc_html__("Service Box", 'acerola'),
            "description" => esc_html__("", 'acerola'),
            "base" => "service_box",
            "class" => "",
            "icon" => "icon-wpb-quickload",
            "category" => esc_html__('Themeton', 'acerola'),
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    'type' => 'textfield',
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'acerola'),
                    "value" => 'WEB DESIGN',
                    "holder" => "div"
                ),
                array(
                    'type' => 'dropdown',
                    "param_name" => "icon_type",
                    "heading" => esc_html__("Icon Type", 'acerola'),
                    "value" => array(
                        "Icon font" => "icon_font",
                        "Icon image" => "icon_image"
                    ),
                    "std" => "icon_font",
                ),
                array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image Image", 'acerola'),
                    "value" => '',
                    "dependency" => Array("element" => "icon_type", "value" => array("icon_image"))
                ),
                array(
                    'type' => 'iconpicker',
                    "param_name" => "icon",
                    "heading" => esc_html__("Icon", 'acerola'),
                    "description" => "",
                    'value' => 'fa fa-adjust', // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    "std" => "mdi-action-account-box",
                    "dependency" => Array("element" => "icon_type", "value" => array("icon_font"))
                ),
                array(
                    'type' => 'textarea',
                    "param_name" => "description",
                    "heading" => esc_html__("Description", 'acerola'),
                    "value" => 'Expedita nam natus non dolorem repellendus accusantium similique fugiat earum'
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
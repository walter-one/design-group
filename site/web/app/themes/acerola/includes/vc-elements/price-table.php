<?php

class WPBakeryShortCode_Price_Table extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "title" => 'Title',
            "price"     => "15",
            "per"     => "/mo",
            "symbol" => "$",
            "button_text"     => "Button",
            "button_link"     => "",
            "extra_class" => ""
        ), $atts ) );

        $content = wpb_js_remove_wpautop( $content, true );

        $result = '<div class="price-block">
                         <div class="price-price">
                            <h4>'.$title.'</h4>
                         </div>
                         <div class="price-title">
                           <sup>'.$symbol.'</sup>
                              <span>'.$price.'</span>
                                <sub>'.$per.'</sub>
                         </div>
                         '.$content.'
                         <div class="button-style-2">
                           <a href="'.$button_link.'" class="b-md butt-style">'.$button_text.'</a>
                         </div>
                    </div>';

        return $result;
    }
}

vc_map( array(
            "name" => esc_html__("Price Table", 'acerola'),
            "description" => esc_html__("Prices", 'acerola'),
            "base" => "price_table",
            "class" => "",
            "icon" => "icon-wpb-quickload",
            "category" => esc_html__('Themeton', 'acerola'),
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    'type' => 'textfield',
                    "param_name" => "title",
                    "heading" => esc_html__("Title", 'acerola'),
                    "value" => 'STARTER',
                    "holder" => "div"
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "price",
                    "heading" => esc_html__("Price", 'acerola'),
                    "value" => '15'
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "symbol",
                    "heading" => esc_html__("Currency", 'acerola'),
                    "value" => '$'
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "per",
                    "heading" => esc_html__("Per?", 'acerola'),
                    "value" => '/mo'
                ),
                array(
                    'type' => 'textarea_html',
                    "param_name" => "content",
                    "heading" => esc_html__("Content", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "button_text",
                    "heading" => esc_html__("Button text", 'acerola'),
                    "value" => 'SIGN IN'
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "button_link",
                    "heading" => esc_html__("Button Link", 'acerola'),
                    "value" => '#!'
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
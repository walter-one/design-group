<?php

class WPBakeryShortCode_Progress_Bar extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'description' => '',
            'percentage' => '',
            'extra_class' => ''
        ), $atts));
            
            $result = "<div class='skill-block $extra_class'>
                          <span>$description</span>
                            <div class='skill-line'>
                                <div data-width-pb='$percentage%'><h5 class='timer' data-to='$percentage' data-speed='2000'>0</h5></div>
                            </div>
                      </div>";
        
        return $result;
    }
}

vc_map( array(
    "name" => esc_html__( 'Progress Bar', 'acerola' ),
    "description" => esc_html__("", 'acerola'),
    "base" => 'progress_bar',
    "icon" => "icon-wpb-themeton",
    "category" => esc_html__('Themeton', 'acerola'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "description",
            "heading" => esc_html__("Description", 'acerola'),
            "value" => 'CREATIVITY',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "percentage",
            "heading" => esc_html__("Percentage", 'acerola'),
            "value" => '80'
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'acerola'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'acerola'),
        )
    )
));
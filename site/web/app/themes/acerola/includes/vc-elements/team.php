<?php

class WPBakeryShortCode_Team extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "name" => 'Name',
            "about" => 'About',
            "position" => 'description',
            "image" => '',
            "number"     => "",
            "social_facebook" => "",
            "social_twitter" => "",
            "social_linkedin" => "",
            "social_instagram" => "",
            "social_link" => "",
            "extra_class" => ""
        ), $atts ) );

        $image = wp_get_attachment_image($image, 'team-member');

        $socials = '';
        $socials .= $social_facebook == '' ? '' : '<a href="'.$social_facebook.'"><i class="fa fa-facebook"></i></a>';
        $socials .= $social_twitter == '' ? '' : '<a href="'.$social_facebook.'"><i class="fa fa-twitter"></i></a>';
        $socials .= $social_linkedin == '' ? '' : '<a href="'.$social_linkedin.'"><i class="fa fa-linkedin"></i></a>';
        $socials .= $social_instagram == '' ? '' : '<a href="'.$social_instagram.'"><i class="fa fa-instagram"></i></a>';
$socials .= $social_link == '' ? '' : '<a href="'.$social_link.'"><i class="fa fa-link"></i></a>';

        $result = '<div class="team-block">
                        '.$image.'
                          <div class="later-team" style="left: 100%;">
                             <h4>'.$name.'</h4>
                               <h6>'.$position.'</h6>
                                 <div class="hiden-text">
                                   <p>'.$about.'</p>   
                                     <div class="team-share">
                                        '.$socials.'
                                     </div>
                                  </div>
                          </div>
                    </div>';

        return $result;
    }
}

vc_map( array(
            "name" => esc_html__("Team member", 'acerola'),
            "description" => esc_html__("", 'acerola'),
            "base" => "team",
            "class" => "",
            "icon" => "icon-wpb-quickload",
            "category" => esc_html__('Themeton', 'acerola'),
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    'type' => 'textfield',
                    "param_name" => "name",
                    "heading" => esc_html__("Name", 'acerola'),
                    "value" => 'Tom Smith',
                    "holder" => 'div'
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "position",
                    "heading" => esc_html__("Position", 'acerola'),
                    "value" => 'CEO - Webdesign'
                ),
                array(
                    'type' => 'textarea',
                    "param_name" => "about",
                    "heading" => esc_html__("About", 'acerola'),
                    "value" => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus accusantium, temporibus distinctio commodi harum'
                ),
                array(
                    'type' => 'attach_image',
                    "param_name" => "image",
                    "heading" => esc_html__("Image Image", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "social_facebook",
                    "heading" => esc_html__("Facebook", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "social_twitter",
                    "heading" => esc_html__("Twitter", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "social_linkedin",
                    "heading" => esc_html__("Linkedin", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "social_instagram",
                    "heading" => esc_html__("Instagram", 'acerola'),
                    "value" => ''
                ),
                array(
                    'type' => 'textfield',
                    "param_name" => "social_link",
                    "heading" => esc_html__("Your custom link", 'acerola'),
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

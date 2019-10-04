<?php

class WPBakeryShortCode_Tt_Blog_Posts extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'count' => '',
            'categories' => '',
            'extra_class' => '',
            'orderby' => 'date',
            'order' => 'DESC'
        ), $atts));

        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }

        $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $count,
                        'ignore_sticky_posts' => true,
                        'orderby' => $orderby,
                        'order' => $order
                    );
        if(!empty($cats)){
            $args['category__in'] = $cats;
        }

        $items = '';
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $excerpt = wp_trim_words( wp_strip_all_tags(strip_shortcodes(get_the_content())), 30 );
            $img = '';
            if( has_post_thumbnail() ){
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog-thumb' );
                $img = !empty($img) ? $img[0] : '';
            }

            $postclass = implode(' ',get_post_class());
            $items .= "<div class='blog-item item'>
                    <a href='".get_permalink()."'>".get_the_post_thumbnail( get_the_ID(), 'blog-thumb' )."</a> 
                      <h4><a href='".get_permalink()."'>".get_the_title()."</a></h4>
                      <p>$excerpt</p>
                        <div class='button-style-2'>
                             <a href='".get_permalink()."' class='b-sm butt-style'>".__('Read More','acerola')."</a>
                        </div>
                </div>
";
}

        // reset query
        wp_reset_postdata();
        
        return "<div class='izotope-container gutt-col3'>
                    <div class='grid-sizer'></div>
                    $items
                </div>";
    }
}

vc_map( array(
    "name" => esc_html__( 'Blog Posts', 'acerola' ),
    "description" => esc_html__("Only post type: post", 'acerola'),
    "base" => 'tt_blog_posts',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('Themeton', 'acerola'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts Count", 'acerola'),
            "value" => '3'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'acerola'),
            "description" => esc_html__("Specify category Id or leave blank to display items from all categories.", 'acerola'),
            "value" => ''
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'acerola'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'acerola'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Order by', 'acerola' ),
            'param_name' => 'orderby',
            'value' => array(
                esc_html__( 'Date', 'acerola' ) => 'date',
                esc_html__( 'ID', 'acerola' ) => 'ID',
                esc_html__( 'Author', 'acerola' ) => 'author',
                esc_html__( 'Title', 'acerola' ) => 'title',
                esc_html__( 'Modified', 'acerola' ) => 'modified',
                esc_html__( 'Random', 'acerola' ) => 'rand',
                esc_html__( 'Comment count', 'acerola' ) => 'comment_count',
                esc_html__( 'Menu order', 'acerola' ) => 'menu_order',
            ),
            'description' => sprintf( esc_html__( 'Select how to sort retrieved posts. More at %s.', 'acerola' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Sort order', 'acerola' ),
            'param_name' => 'order',
            'value' => array(
                esc_html__( 'Descending', 'acerola' ) => 'DESC',
                esc_html__( 'Ascending', 'acerola' ) => 'ASC',
            ),
            'description' => sprintf( esc_html__( 'Select ascending or descending order. More at %s.', 'acerola' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
        ),

    )
));
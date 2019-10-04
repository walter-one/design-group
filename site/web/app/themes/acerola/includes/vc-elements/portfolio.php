<?php

class WPBakeryShortCode_Tt_Portfolio extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'count' => '12',
            'filter' => '1',
            'columns' => '3',
            'gutter' => 'yes',
            'masonry' => 'no',
            'pager' => 'no',
            'categories' => ''
        ), $atts));

        global $paged;
        if( is_front_page() ){
            $paged = get_query_var('page') ? get_query_var('page') : 1;
        }


        // build category ids
        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }


        // build query
        $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => $count,
                        'ignore_sticky_posts' => true,
                        'paged' => $paged
                    );
        
     
       
        if( !empty($categories) ){
            $categories = str_replace(' ', '', $categories);
            $cats = explode( ',', $categories );
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'portfolio_entries',
                    'field' => 'slug',
                    'terms' => $cats
                )
            );
        }
        

        
        $filter_html = '';
        $cat_array = $cat_array_order = array();
        $items = '';
        $encoded_args = base64_encode( serialize($args) );

        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            $img = '';
            $img_full = '';
            if( has_post_thumbnail() ){
                $img_size = $masonry=='yes' ? 'folio-item' : 'folio-grid';

                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $img_size );
                $img = !empty($img) ? $img[0] : '';
            }


            $cats = '';
            $last_cat = '';
            $cat_titles = array();
            $terms = wp_get_post_terms(get_the_ID(), 'portfolio_entries');
            foreach ($terms as $term){
                $cat_title = $term->name;
                $cat_slug = $term->slug;

                $cat_titles []= $cat_title;
                if( $filter=='1' && !in_array($term->term_id, $cat_array) ){
                    //$filter_html .= '<button class="but" data-filter=".ftr-'.$cat_slug.'">'.$cat_title.'</button>';
                    $cat_array[] = $term->term_id;
                    $cat_array_order[$cat_slug] = $cat_title;
                }

                $cats .= "ftr-$cat_slug ";
                $last_cat = $cat_title;
            }

            $items .= '<div class="item '.$cats.'">
                           <a href="'.get_permalink().'"></a>
                             <div class="det-img ellem" data-caption="<a href=\''.get_permalink().'\' class=\'sleep-title\'><span class=\'vertical-align\'><h4>'.esc_attr(get_the_title()).'</h4><span class=\'pr-sutitle\'>'.esc_attr($last_cat).'</span></span></a>">
                                   <img src="'.$img.'" alt="'.esc_attr__('Image','acerola').'">
                             </div>
                         </div>';
        }

        ksort($cat_array_order);

        foreach($cat_array_order as $cat_slug => $cat_title) {
            $filter_html .= '<button class="but" data-filter=".ftr-'.$cat_slug.'">'.$cat_title.'</button>';
        }

        if( $filter=='1' ){
            $filter_html = '<div class="row">
                                <div id="filters" class="fillter-wrap">
                                    <button class="but activbut" data-filter="*">'.__('All', 'acerola').'</button>   
                                    '.$filter_html.'
                                </div>
                             </div>';
        } else $filter_html = '';

        // Gutter
        $gutt = '';
        if( $gutter=='yes' ){
            $gutt = 'gutt-col' . abs($columns);
        }
        else {
            $gutt = 'nogutt-col' . abs($columns);
        }

        // Pager
        $pagination = '';
        if( $pager=='pagination' ){
            
            $pager_result = '';
            ob_start();
            TPL::pagination($posts_query);
            $pager_result .= ob_get_contents();
            ob_end_clean();

            $pagination = '<div class="row text-center portfolio-pager">
                                <div class="col-sm-12">'.$pager_result.'</div>
                          </div>';
        }
        else if( $pager=='infinite' ){
            $pagination = '<div class="row text-center portfolio-pager">
                                <div class="col-sm-12">
                                    <a href="javascript:;" class="portfolio-pagination btn"><i class="fa fa-spinner"></i>'.__('Load more...', 'acerola').'</a>
                                </div>
                          </div>';
        }


        // reset query
        wp_reset_postdata();

        return '<div class="portfolio-element" data-page="2">
                    '. $filter_html .'
                    <div class="row">
                        <div class="izotope-container '.$gutt.' sliphover"> 
                            <div class="grid-sizer"></div>
                            '. $items .'
                        </div>
                    </div>
                    <div class="encrypted_args">'.$encoded_args.'</div>
                    '.$pagination.'
                </div>';

    }
}

vc_map( array(
    "name" => esc_html__( 'Portfolio', 'acerola' ),
    "description" => esc_html__("post type: portfolio", 'acerola'),
    "base" => 'tt_portfolio',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => esc_html__('Themeton', 'acerola'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts per page", 'acerola'),
            "value" => '9'
        ),
        array(
            "type" => "dropdown",
            "param_name" => "filter",
            "heading" => esc_html__("Show Filter", 'acerola'),
            "value" => array(
                "No" => "0",
                "Yes" => "1"
            ),
            "std" => "1"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "columns",
            "heading" => esc_html__("Columns", 'acerola'),
            "value" => array(
                "2 Columns" => "2",
                "3 Columns" => "3",
                "4 Columns" => "4"
            ),
            "std" => "3"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "gutter",
            "heading" => esc_html__("Gutter", 'acerola'),
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "std" => "no"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "masonry",
            "heading" => esc_html__("Masonry", 'acerola'),
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "std" => "no",
            "description" => esc_html__("This options works when portfolio item image size larger than width:640px.", 'acerola')
        ),
        array(
            "type" => "dropdown",
            "param_name" => "pager",
            "heading" => esc_html__("Pager", 'acerola'),
            "value" => array(
                "No" => "no",
                "Pager" => "pagination",
                "Infinite" => "infinite"
            ),
            "std" => "no"
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'acerola'),
            "description" => esc_html__("Specify category Id or leave blank to display items from all categories.", 'acerola'),
            "value" => ''
        )
    )
));







// folio_infinite

add_action('wp_ajax_folio_infinite', 'folio_infinite_hook');
add_action('wp_ajax_nopriv_folio_infinite', 'folio_infinite_hook');

function folio_infinite_hook(){
    $encoded_args = $_POST['folio_args'];
    $pager = $_POST['page'];
    $args = unserialize( base64_decode($encoded_args) );

    $args['paged'] = $pager;

    $posts_query = new WP_Query($args);
    if( $posts_query->have_posts() ){
        
        $items = '';
        $filter_html = '';
        $cat_array = array();

        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

            $img = '';
            $img_full = '';
            if( has_post_thumbnail() ){
                $img_size = 'folio-grid';

                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $img_size );
                $img = !empty($img) ? $img[0] : '';
            }


            $cats = '';
            $last_cat = '';
            $cat_titles = array();
            $terms = wp_get_post_terms(get_the_ID(), 'portfolio_entries');
            foreach ($terms as $term){
                $cat_title = $term->name;
                $cat_slug = $term->slug;

                $cat_titles []= $cat_title;
                if( !in_array($term->term_id, $cat_array) ){
                    $cat_array[] = $term->term_id;
                }

                $cats .= "ftr-$cat_slug ";
                $last_cat = $cat_title;
            }

            $items .= '<div class="item '.$cats.'">
                           <a href="'.get_permalink().'"></a>
                             <div class="det-img ellem" data-caption="<a href=\''.get_permalink().'\' class=\'sleep-title\'><span class=\'vertical-align\'><h4>'.esc_attr(get_the_title()).'</h4><span class=\'pr-sutitle\'>'.esc_attr($last_cat).'</span></span></a>">
                                   <img src="'.$img.'" alt="'.esc_attr__('Image','acerola').'">   
                             </div>
                         </div>';
        }

        echo "<div class='result'>$items</div>";
    }
    else{
        echo '0';
        exit;
    }
    
    
    exit;
}

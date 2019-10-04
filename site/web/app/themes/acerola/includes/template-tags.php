<?php

class TPL{

    public static function post_thumbnail(){
        global $post;
        if ( post_password_required() ){
            return;
        }

        $media = TPL::get_post_media();
        if( !empty($media) )
            echo "<div class='card-image'>$media</div>";
    }


    public static function get_post_thumb(){
        global $post;

        $result = '';
        if( has_post_thumbnail() ){
            $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
            $result = '<div class="post_thumbnail_row">
                            <a href="'.esc_url(get_permalink()).'">
                                <img src="'.esc_attr($img).'" alt="'.esc_attr__('Image','acerola').'" class="img-responsive">
                            </a>
                        </div>';
        }

        return $result;
    }

    public static function get_post_media(){
        global $post;
        $media = '';
        if( has_post_thumbnail() ){
            $media = '<a class="post-thumbnail img-responsive" href="'.get_permalink().'">'. get_the_post_thumbnail(get_the_ID(), 'post-thumb') .'</a>';
        }

        if( is_single() ){
            return $media;
        }

        $format = get_post_format();
        if ( current_theme_supports( 'post-formats', $format ) ) {
            if( $format=='quote' ){
                preg_match("/<blockquote>(.)*<\/blockquote>/msi", get_the_content(), $matches);
                if( isset($matches[0]) && !empty($matches[0]) ){
                    $media = $matches[0];
                    $media = str_replace('<blockquote', '<blockquote class="quote-post"', $media);
                    if( has_post_thumbnail() ){
                        $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'featured-img' );
                        $media = str_replace("<blockquote", "<blockquote style='background-image:url($img);'", $media);
                    }
                }
            }
            else if( $format=='gallery' && has_shortcode($post->post_content, 'gallery') ){
                $gallery = get_post_gallery( get_the_ID(), false );
                $ids = explode(",", isset($gallery['ids']) ? $gallery['ids'] : "");

                $gallery_id = uniqid();
                $gallery = '';
                $indicators = '';
                $indx = 0;
                foreach ($ids as $gid) {
                    $img = wp_get_attachment_image( $gid, 'post-thumb', false, array('class'=>'img-responsive') );
                    $gallery .= "<li>$img</li>";
                    $indx++;
                }

                $media = !empty($gallery) ? "<div class='slider flex-banner'>
                                                <ul class='slides'>$gallery</ul>
                                            </div>" : $media;

                $media = $media;
            }
            else if( $format=='audio' ){
                $pattern = get_shortcode_regex();
                preg_match('/'.$pattern.'/s', $post->post_content, $matches);
                if (is_array($matches) && isset($matches[2]) && $matches[2] == 'audio') {
                    $shortcode = $matches[0];
                    $media = '<div class="mejs-wrapper audio">'. do_shortcode($shortcode) . '</div>';
                }
                else{
                    preg_match("/<iframe(.)*<\/iframe>/msi", get_the_content(), $matches);
                    if( isset($matches[0]) && !empty($matches[0]) )
                        $media = $matches[0];
                }
                $media = $media;
            }
            else if( $format=='video' ){
                $pattern = get_shortcode_regex();
                preg_match('/'.$pattern.'/s', $post->post_content, $matches);
                if (is_array($matches) && isset($matches[2]) && $matches[2] == 'video') {
                    $shortcode = $matches[0];
                    $media = '<div class="mejs-wrapper video">'. do_shortcode($shortcode) . '</div>';
                    $media = "<div class='entry-media'>$media</div>";
                }
                else{
                    preg_match("/<iframe(.)*<\/iframe>/msi", get_the_content(), $matches);
                    if( isset($matches[0]) && !empty($matches[0]) ){
                        $media = $matches[0];
                        $media = "<div class='video-container'>$media</div>";
                    }
                }
            }
        }

        return $media;
    }


    public static function get_author(){
        return '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a>';
    }

     
    public static function pagination( $query=null ) {
         
        global $wp_query;
        $query = $query ? $query : $wp_query;
        $big = 999999999;

        $paginate = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type' => 'array',
            'total' => $query->max_num_pages,
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
            )
        );

        if ($query->max_num_pages > 1) :
        echo '<ul class="post-pager">';
        foreach ( $paginate as $page ) {
            echo '<li>' . $page . '</li>';
        }
        echo '</ul>';
        endif;
        
    }



    public static function get_next_post(){
        $next_post = get_next_post();
        if ( is_a( $next_post , 'WP_Post' ) ) {
            return '<li class="next"><a href="'.esc_url(get_permalink( $next_post->ID )).'">Next <img src="'.get_template_directory_uri().'/images/icons/blog/arrow-next.png" alt="'.esc_attr__('Image','acerola').'"></a></li>';
        }
        return '';
    }
    public static function get_prev_post(){
        $prev_post = get_previous_post();
        if ( is_a( $prev_post , 'WP_Post' ) ) {
            return '<li class="previous"><a href="'.esc_url(get_permalink( $prev_post->ID )).'"><img src="'.get_template_directory_uri().'/images/icons/blog/arrow-prev.png" alt="'.esc_attr__('Image','acerola').'"> previous</a></li>';
        }
        return '';
    }




    public static function get_related_posts( $options=array() ){
        $options = array_merge(array(
                    'per_page'=>'2'
                    ),
                    $options);

        global $post;

        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => $options['per_page']
        );
        $post_type_class = 'blog';

        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category) {
                $category_ids[] = $individual_category->term_id;
            }
            $args['category__in'] = $category_ids;
        }

        // For portfolio post and another than Post
        if($post->post_type == 'portfolio') {
            $tax_name = 'portfolio_entries'; //should change it to dynamic and for any custom post types
            $args['post_type'] =  get_post_type(get_the_ID());
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax_name,
                    'field' => 'id',
                    'terms' => wp_get_post_terms($post->ID, $tax_name, array('fields'=>'ids'))
                )
            );
            $post_type_class = 'portfolio';
        }

        if(isset($args)) {
            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {

                $html = '';
                while ($my_query->have_posts()) {
                    $my_query->the_post();

                    $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'small-thumb' );
                    if( !empty($img) ){
                        $img = '<div class="pop-img">
                                    <img src="'.esc_attr($img).'" alt="'.esc_attr__('Image','acerola').'">
                                </div>';
                    }

                    $html .= '<div class="col-md-6">
                                    <div class="popular-block padd-80">
                                        '.$img.'
                                        <div class="pop-text">
                                            <a href="'.get_permalink().'"><h5>'.get_the_title().'</h5></a>
                                            <p>'.wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), 13 ).'</p>
                                            <span>'.get_the_time('F d, Y').'</span>
                                        </div>
                                    </div>
                                </div>';
                }


                if($post->post_type == 'portfolio'){
                    echo '<div class="row m0 youMightLike '.$post_type_class.'">
                            <div class="row sectionTitle">
                                <h4>' . esc_html__('Related Projects', 'acerola') . '</h4>
                            </div>
                            <div class="row">
                                '. $html .'
                            </div>
                          </div>';
                }
                else{
                    printf('%s', $html);
                }
                
            }
        }
        wp_reset_postdata();
    }



    public static function get_post_icon(){
        global $post;
        $class = '';
        $format = get_post_format();
        if( $format===false ){
            $class = 'fa fa-file-text';
        }
        else if( $format=='aside' ){
            $class = 'fa fa-file-text';
        }
        else if( $format=='image' ){
            $class = 'fa fa-file-image-o';
        }
        else if( $format=='gallery' ){
            $class = 'fa fa-file-image-o';
        }
        else if( $format=='video' ){
            $class = 'fa fa-file-video-o';
        }
        else if( $format=='audio' ){
            $class = 'fa fa-file-audio-o';
        }
        else if( $format=='quote' ){
            $class = 'fa fa-comment';
        }
        else if( $format=='link' ){
            $class = 'fa fa-link';
        }
        else if( $format=='status' ){
            $class = 'fa fa-link';
        }
        else if( $format=='chat' ){
            $class = 'fa fa-comments';
        }
        return "<i class='$class'></i>";
    }


    public static function getCategories($post_id, $post_type){
        $cats = array();
        $taxonomies = get_object_taxonomies($post_type);
        if( !empty($taxonomies) ){
            $tax = $taxonomies[0];
            if( $post_type=='product' )
                $tax = 'product_cat';
            $terms = wp_get_post_terms($post_id, $tax);
            foreach ($terms as $term){
                $cats[] = array(
                                'term_id' => $term->term_id,
                                'name' => $term->name,
                                'slug' => $term->slug,
                                'link' => get_term_link($term)
                                );
            }
        }

        return $cats;
    }

    public static function getPostViews($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count=='' || $count=='0'){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0 View";
        }
        return $count.' Views';
    }
    public static function setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }



    public static function get_social_links(){
        global $post;
        $social = array();

        $social[] = '<a href="http://www.facebook.com/sharer.php?u='.esc_url(get_permalink()).'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>';
        $social[] = '<a href="https://twitter.com/share?url='.esc_url(get_permalink()).'&text='.esc_attr(get_the_title()).'" target="_blank"><i class="fa fa-twitter"></i></a>';
        $social[] = '<a href="https://plus.google.com/share?url='.esc_url(get_permalink()).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
        $social[] = '<a href="https://pinterest.com/pin/create/bookmarklet/?media='.esc_url(isset($thumb[0]) ? $thumb[0] : '').'&url='.esc_url(get_permalink()).'&description='.esc_attr(get_the_title()).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
        $social[] = '<a href="#" onclick="window.print();return false;"><i class="fa fa-print"></i></a>'; 

        return $social;
    }


    public static function get_share_links(){
        $social = array();

        $social['facebook'] = 'http://www.facebook.com/sharer.php?u='.esc_url(get_permalink());
        $social['twitter'] = 'https://twitter.com/share?url='.esc_url(get_permalink()).'&text='.esc_attr(get_the_title());
        $social['googleplus'] = 'https://plus.google.com/share?url='.esc_url(get_permalink());
        $social['pinterest'] = 'https://pinterest.com/pin/create/bookmarklet/?media='.esc_url(isset($thumb[0]) ? $thumb[0] : '').'&url='.esc_url(get_permalink()).'&description='.esc_attr(get_the_title());

        return $social;
    }

}



function getPageSlider($onTop){
    global $post;
    $slider_class = 'fullscreen-section no-padding';

    if (TT::getmeta('slider') != '' && TT::getmeta('slider') != 'none'):
        echo '<div id="tt-slider" class="tt-slider '.$slider_class.'">';
            $slider_name = TT::getmeta("slider");
            $slider = explode("_", $slider_name);
            $shortcode = '';
            if (strpos($slider_name, "layerslider") !== false)
                $shortcode = "[" . $slider[0] . " id='" . $slider[1] . "']";
            elseif (strpos($slider_name, "revslider") !== false)
                $shortcode = "[rev_slider " . $slider[1] . "]";
            elseif (strpos($slider_name, "masterslider") !== false)
                $shortcode = "[master_slider id='" . $slider[1] . "']";
            echo do_shortcode($shortcode);
        echo '</div>';
    endif;
}









// Comment Navigation
if ( ! function_exists( 'tt_theme_comment_nav' ) ) :
    function tt_theme_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'acerola' ); ?></h2>
            <div class="nav-links">
                <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'acerola' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'acerola' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
endif;



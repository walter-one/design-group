<?php
    $title_height = '';
    $title_attr = '';

    // Page title height
    $page_title_height = abs(TT::get_mod('page_title_height'));
    if( $page_title_height!=200 && $page_title_height>0 ){
        $title_height = 'height:' . $page_title_height . 'px;';
    }
    
    // background image
    $img = TT::get_option_bg_value('page_title_image');
    if( !empty($img) ){
        $title_attr = $img;
    }

    // Background Image
    if( is_page() ){
        $meta_title_bg = TT::get_meta_bg_value('title_bg');
        if( !empty($meta_title_bg) ){
            $title_attr = $meta_title_bg;
        }

        $pth = abs(TT::getmeta('page_title_height'));
        if( $page_title_height!=$pth && $pth>0 ){
            $title_height = 'height:' . $pth . 'px;';
        }
    }
    else if( is_single() && has_post_thumbnail() ){
        $meta_title_bg = TT::get_meta_bg_value('title_bg');
        if( !empty($meta_title_bg) ) {
            $title_attr = $meta_title_bg;
        }else {
            $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' );
        $title_attr = "background-image:url($img);";    
        }

        $pth = abs(TT::getmeta('page_title_height'));
        if( $page_title_height!=$pth && $pth>0 ){
            $title_height = 'height:' . $pth . 'px;';
        }
        
    }

?>
<div class="padd-80">
    <div class="row">
        <div class="col-md-12">
            <div class="second-heading" style="<?php echo esc_attr($title_height); ?>">
                <div class="leyer-title"></div>
                <div class="clip">
                    <div class="bg bg-bg-chrome" style="<?php echo esc_attr($title_attr); ?>"></div>
                </div>
                <div class="vertical-align">
                    <div class="second-heading-txt">
                        <h2><?php
            
                        if( function_exists('is_shop') && is_shop() ):
                            printf( "%s", esc_html__('Shop', 'acerola') );
                        elseif( function_exists('is_shop') && is_product() ):
                            printf( "%s", esc_html__('Shop Details', 'acerola') );
                        elseif( is_archive() ):
                            if(function_exists('the_archive_title')) :
                                the_archive_title();
                            else:
                                printf( esc_html__( 'Category: <span>%s</span>', 'acerola' ), single_cat_title( '', false ) );
                            endif;

                        elseif( is_search() ):
                            printf( 'Search Results for: <span>%s</span>', get_search_query() );
                        elseif( is_singular('portfolio') ):
                            printf( '%s', get_the_title() );
                        elseif( is_single() ):
                            printf( '%s', get_the_title() );
                        elseif( is_front_page() || is_home() ):
                            if( is_home() ):
                                printf('%s', esc_html__('Blog', 'acerola'));
                            elseif( get_query_var('post_type')=='portfolio' ):
                                printf('%s', esc_html__('Projects', 'acerola'));
                            else:
                                printf('%s', esc_html__('Home', 'acerola'));
                            endif;
                        elseif( is_404() ):
                            printf( "%s", esc_html__('404 Page', 'acerola') );
                        else:
                            the_title();
                        endif;
                        ?></h2>

                        <div class="separ"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
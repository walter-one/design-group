<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php
        if( TT::getmeta('title_show')!='0' ){
            get_template_part("tpl", "page-title");
        }

        $page_layout = TT::getmeta('page_layout');
        $content_class = 'col-sm-9';
        $page_class = '';

        if( $page_layout=='full' ){
            $content_class = 'col-sm-12';
        }
        else if( $page_layout=='left' ){
            $content_class .= ' pull-right';
        }

        if( TT::getmeta('remove_padding')=='1' ){
            $page_class .= 'no-padding ';
        }
        ?>

        <div class="padd-80">
            <div class="row">
                <div class="<?php echo esc_attr($content_class); ?>">
                    
                    <div class="page-content">
                        <?php
                        while ( have_posts() ) : the_post();
                            the_content();

                            if(TT::get_mod('page_nextprev')=='1') {
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'acerola' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'acerola' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) );
                            }

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                print "<div class='clearfix'></div>";
                                comments_template();
                            endif;
                            
                        endwhile;
                        ?>
                    </div>

                </div>

                <?php
                if( $page_layout!='full' ){
                    get_sidebar();
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
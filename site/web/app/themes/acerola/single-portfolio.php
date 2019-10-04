<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php
            if( TT::getmeta('title_show')!='0' ){
                get_template_part("tpl", "page-title");
            }
        ?>

        <div class="padd-80">

            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="page-content">
                        <?php
                        while ( have_posts() ) : the_post();
                            the_content();
                              if ( TT::get_mod('post_comment')=='1' && (comments_open() || get_comments_number()) ) :
                            comments_template();
                        endif;
                        endwhile;
                        ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="project-nav">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    $prev_post = get_previous_post();
                    if ( is_a( $prev_post , 'WP_Post' ) ) {
                        echo '<div class="left-arrow-nav">
                                <a href="'.esc_url(get_permalink( $prev_post->ID )).'"><span>Previous Project</span></a>
                            </div>';
                    }


                    $next_post = get_next_post();
                    if ( is_a( $next_post , 'WP_Post' ) ) {
                        echo '<div class="right-arrow-nav">
                                <a href="'.esc_url(get_permalink( $next_post->ID )).'"><span>'.__('Next Project', 'acerola').'</span></a>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        

    </div>
</div>

<?php get_footer(); ?>
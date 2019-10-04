<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php get_template_part("tpl", "page-title"); ?>

        <div class="padd-80">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content-single', get_post_format() );

                        
                        if ( TT::get_mod('post_comment')=='1' && (comments_open() || get_comments_number()) ) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
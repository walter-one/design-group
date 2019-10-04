<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php get_template_part("tpl", "page-title"); ?>

        <div class="padd-80">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="blog-loop">

                        <div class="row">
                            <div class="izotope-container gutt-col3">
                                <div class="grid-sizer"></div>

                                <?php if ( have_posts() ) : ?>
                                    <?php
                                    // Start the loop.
                                    while ( have_posts() ) : the_post();
                                        get_template_part( 'content', get_post_format() );
                                    endwhile;

                                // If no content, include the "No posts found" template.
                                else :
                                    echo '<div class="text-center"><p>';
                                    esc_html_e('<h4>Nothing found, please search again with an another query.</h4>', 'acerola');
                                    echo '</p>';
                                    echo '</div>';
                                endif;
                                ?>
                            </div>
                        </div>

                        <?php
                        // Previous/next page navigation.
                        echo '<div class="row pagination m0">';
                            TPL::pagination();
                        echo '</div>';
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
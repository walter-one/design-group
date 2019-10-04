<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php get_template_part("tpl", "page-title"); ?>

        <div class="padd-80">
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="page-content text-center">
                        <h2><?php esc_html_e('Sorry! the page not found' , 'acerola'); ?></h2>
                        <p><?php esc_html_e('The Link You Folowed Probably Broken, or the page has been removed.' , 'acerola'); ?></p>
                        <a href="<?php echo home_url('/'); ?>" class="return_home borderred_link"><span><?php esc_html_e('Return to home' , 'acerola'); ?></span></a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
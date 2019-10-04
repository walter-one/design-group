<?php get_header(); ?>

<div class="main-wrapp">
    <div class="container">
        
        <?php
        if( TT::getmeta('title_show')!='0' ){
            get_template_part("tpl", "page-title");
        }

        $page_layout = TT::getmeta('page_layout');
        $content_class = 'col-sm-9';

        if( is_product() ){
            $content_class = 'col-sm-12';
        }

        ?>

        <div class="padd-80">
            <div class="row">
                
                <?php
                if( !is_product() ):
                    global $sidebar;
                    $sidebar = 'woo';
                    get_sidebar();
                endif;
                ?>

                <div class="<?php echo esc_attr($content_class); ?>">
                    
                    <div class="page-content">
                        <?php woocommerce_content(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
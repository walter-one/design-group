<div class="blog-post">
    <?php the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'acerola' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'acerola' ) . ' </span>%',
            'separator'   => '<span class="screen-reader-text">, </span>',
        ) );
    ?>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="det-tags pad-80">
			<h4><?php esc_html_e('CATEGORIES', 'acerola'); ?></h4>
			<div class="tags-button">
				<?php the_category(' '); ?>
            </div>
            <?php
                $tag_list = get_the_tag_list();
                if( !empty($tag_list) ):
                ?>
                <h4 class="clearfix"><?php esc_html_e('Tags :', 'acerola'); ?></h4>
                <div class="tags-button">
                <?php echo get_the_tag_list('', ' '); ?>
                </div>
            <?php endif; ?>
        </div>
	</div>
</div>


<div class="row">
    <?php echo TPL::get_related_posts(); ?>
</div>
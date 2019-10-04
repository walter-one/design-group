<div <?php post_class('blog-item item'); ?>>
    <?php
    if( has_post_thumbnail() ){
        $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'post-thumb' );
        echo '<a href="'.get_permalink().'">
                <img src="'.$img.'" alt="'.esc_attr__('Image','acerola').'">
            </a>';
    }
    ?>
    
    <h4>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h4>
    
    <p>
        <?php
        if(strpos($post->post_content, '<!--more-->') > 0) :
            echo wp_strip_all_tags(get_the_content(false));
        elseif(has_excerpt()) :
            echo wp_strip_all_tags(get_the_excerpt());
        else :
            printf( '%s', wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), 55 ) );
        endif;
        ?>
    </p>

    <div class="button-style-2">
        <a href="<?php the_permalink(); ?>" class="b-sm butt-style"><?php esc_html_e('read more', 'acerola'); ?></a>
    </div>
</div>
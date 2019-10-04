<?php
class TT_WooCommerce{
    public $size = 'woo-item';

    function __construct(){
        add_theme_support( 'woocommerce' );

        add_filter('woocommerce_show_page_title', array($this, 'woo_page_title'));

        /* WOO PAGINATION HOOK
        =============================================*/
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action( 'woocommerce_after_shop_loop', array($this, 'woo_pagination'), 10);

        add_filter( 'loop_shop_columns', array($this, 'wc_loop_shop_columns'), 1, 10 );

        add_action( 'woocommerce_before_shop_loop_item_title', array($this, 'ttwc_st_before_shop_loop_item_title'), 10);
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        // woocommerce_before_shop_loop_item
        add_action( 'woocommerce_before_shop_loop_item', array($this, 'before_shop_loop_item'), 0, 0 );
        add_action( 'woocommerce_after_shop_loop_item', array($this, 'after_shop_loop_item'), 99, 0 );

        //woocommerce_before_single_product
        add_action( 'woocommerce_before_single_product', array($this, 'woo_before_single_product') );
        
    }

    public function woo_page_title() {
        return false;
    }

    public function woo_pagination() {
        global $wp_query;
        echo '<div class="row pagination m0">';
            TPL::pagination($wp_query);
        echo '</div>';
    }

    public function wc_loop_shop_columns( $number_columns ){
        return 3;
    }


    public function ttwc_st_before_shop_loop_item_title($param){
        global $product;
        
        $id = get_the_ID();
        
        echo "<section>";

            $first_img = $this->gallery_first_thumbnail( $id , 'woo-thumb');
            if( has_post_thumbnail() ){
                $fimage = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'woo-thumb');
                echo "<img class='img-responsive' src='$fimage[0]'>";
            }
            
        echo "</section>";
    }


    public function gallery_first_thumbnail($id, $size){
        $active_hover = true;

        if(!empty($active_hover)){
            $product_gallery = get_post_meta( $id, '_product_image_gallery', true );
            
            if(!empty($product_gallery)){
                $gallery    = explode(',',$product_gallery);
                $image_id   = $gallery[0];
                $image      = wp_get_attachment_image_src( $image_id, $size );
                
                if(!empty($image)) return $image;
            }
        }
        return '';
    }



    public function before_shop_loop_item(){
        global $product, $post;
        $id = $post->ID;

        $price_html = '';
        if ( $product->get_price_html() ){
            $price_html = $product->get_price_html();
        }

        $thumb = '';
        if( has_post_thumbnail() ){
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'woo-thumb');
            $thumb = $img[0];
        }
        else{
            $thumb = $this->gallery_first_thumbnail( $id , 'woo-thumb');
        }

        $_product = wc_get_product( get_the_ID() );

        echo '<div class="shop-item">
                    <div class="layer-shop">
                          <div class="vertical-align">
                                <a href="'.esc_url($_product->add_to_cart_url()).'" rel="nofollow" data-product_id="'.$_product->id.'" data-product_sku="'.esc_attr($_product->get_sku()).'" data-quantity="1" class="button add_to_cart_button product_type_simple card-button"><span class="fa fa-shopping-cart"></span>'.esc_html__('add to cart', 'acerola').'</a>
                          </div>
                    </div>
                    <img src="'. $thumb .'" alt="'. esc_attr(get_the_title()) .'">
              </div>
              <div class="shop-title">
                    <a href="'. get_permalink() .'"><h5>'. get_the_title() .'</h5></a>
                    '. $price_html .'
              </div>';

        // echo '<a href="/dev/shop/?add-to-cart=37" rel="nofollow" data-product_id="37" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple">Add to cart</a>';

        echo '<div class="woo-item-content">';
    }

    public function after_shop_loop_item(){
        echo '</div>';
    }



    public function woo_before_single_product(){
        global $product, $post;
        $product_gallery = get_post_meta( $post->ID, '_product_image_gallery', true );
        $ex_gallery = explode(",", $product_gallery);

        if( !empty($ex_gallery) ){
            $image = '';
            foreach ($ex_gallery as $value) {
                $img = wp_get_attachment_image_src( trim($value), 'full' );
                $image .= '<div class="swiper-slide">
                              <div class="det-slider-shop">
                                <img src="'.$img[0].'">
                              </div> 
                            </div>';
            }

            $swiper = '<div class="col-md-12 shop-gall">
                        <div class="swiper-container slider-7" data-autoplay="3000" data-touch="1" data-mouse="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-loop="0" data-speed="1800" data-mode="horizontal" id="slider-7">                 
                            <div class="swiper-wrapper">
                                '.$image.'
                            </div>
                            <div class="pagination"></div>
                        </div>
                        <div class="slide-prev arrow-style-1"><span class="fa fa-angle-left"></span></div>
                        <div class="slide-next arrow-style-1"><span class="fa fa-angle-right"></span></div>
                    </div>';

            print $swiper;

        }
    }

}


if( class_exists( 'woocommerce' ) ) {
    new TT_WooCommerce();
}


function get_woo_cart_link(){
    if( class_exists( 'woocommerce' ) ){
        global $woocommerce;
        return '<a href="'.wc_get_cart_url().'"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
    }
    return '';
}
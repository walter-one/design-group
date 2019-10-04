<?php if(TT::get_mod('footer') == 1): ?>
<footer>
	<div class="container">
            <div class="row">
                <?php 
                    switch (TT::get_mod('footer_widget_num')) {
                        case 1:
                            $col = 1;
                            $percent = array('col-xs-12 col-sm-12 col-md-12 col-lg-12');
                            break;
                        case 2:
                            $col = 2;
                            $percent = array(
                                'col-xs-12 col-sm-6 col-md-6 col-lg-6',
                                'col-xs-12 col-sm-6 col-md-6 col-lg-6');
                            break;
                        case 3:
                            $col = 3;
                            $percent = array(
                                'col-md-4 col-sm-4',
                                'col-md-4 col-sm-4',
                                'col-md-4 col-sm-4');
                            break;
                        case 4:
                            $col = 4;
                            $percent = array(
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6');
                            break;
                        case 5:
                            $col = 3;
                            $percent = array(
                                'col-xs-12 col-sm-12 col-md-6 col-lg-6',
                                'col-xs-12 col-sm-6 col-md-3 col-lg-3',
                                'col-xs-12 col-sm-6 col-md-3 col-lg-3');
                            break;
                        case 6:
                            $col = 3;
                            $percent = array(
                                'col-xs-12 col-sm-6 col-md-3 col-lg-3',
                                'col-xs-12 col-sm-6 col-md-3 col-lg-3',
                                'col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-right');
                            break;
                        default:
                            $col = 4;
                            $percent = array(
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6',
                                'col-md-3 col-sm-6');
                            break;
                    }
                    for ($i = 1; $i <= $col; $i++) {                                
                        echo "<div class='".esc_attr($percent[$i - 1])." footer-column-$i'>";
                            dynamic_sidebar('footer'.$i);
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    <div class="copyright">
    	<?php echo preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", TT::get_mod('copyright_content')); ?>
    </div>  
</footer>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
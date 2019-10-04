<!-- Sidebar
================================================== -->
<?php 
global $sidebar;
$sidebar_id = 'sidebar';
?>
<div class="col-sm-3 sidebar">

    <?php
    if( isset($sidebar) && !empty($sidebar) )
        $sidebar_id = $sidebar_id ."-". $sidebar;

    if ( is_active_sidebar( $sidebar_id ) ) :
        dynamic_sidebar($sidebar_id);
    else: 
        echo "<div class='widget row'><h5>".__('Please add your widgets.', 'acerola')."</h5></div>";
    endif;
    ?>

</div>
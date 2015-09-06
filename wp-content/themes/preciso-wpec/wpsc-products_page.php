<?php
$slides = ot_get_option("product_slider");
if ( $slides )
{
?>
<div class="flexslider">
    <ul class="slides">
        <?php foreach ( $slides as $slide ) { ?>
            <li><a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>" /></a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>



<?php
$tab1_heading = ot_get_option('product_tab1');
$tab2_heading = ot_get_option('product_tab2');
$tab3_heading = ot_get_option('product_tab3');

$th1 = explode(' ', $tab1_heading, 2);
$th2 = explode(' ', $tab2_heading, 2);
$th3 = explode(' ', $tab3_heading, 2);
$categorie = $_GET['wpsc_product_category'];
$page_id  =     $_GET['page_id'];
$pageName = 'products-page';

   if($categorie || isPageID($pageName)){
	    get_template_part( 'templates/template-product-4col' );
    }else {?>
     <div id="default_products_page_container" class="wrap wpsc_container">
     <div class="products-list products-list-small">
        <div class="container">
            <div class="tabbable">
                <div class="nav nav-tabs">
                    <?php
                    if( $tab1_heading )
                    {
                        echo '<a href="#tab1" data-toggle="tab">'.$th1[0].' <span>'.$th1[1].'</span></a>';
                    }
                    if( $tab2_heading )
                    {
                        echo '<a href="#tab2" data-toggle="tab" class="active">'.$th2[0].' <span>'.$th2[1].'</span></a>';
                    }
                    if( $tab3_heading )
                    {
                        echo '<a href="#tab3" data-toggle="tab">'.$th3[0].' <span>'.$th3[1].'</span></a>';
                    }
                    ?>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <?php get_template_part( 'inc/product_tab1' ); ?>
                    </div>
                    <div class="tab-pane active" id="tab2">
                        <?php get_template_part( 'inc/product_tab2' ); ?>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <?php get_template_part( 'inc/product_tab3' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <?php }?>
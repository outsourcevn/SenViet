<!--Main Content-->
<div class="home-content">
    <div class="container">
        <?php if(count($slideData) > 0 && is_array($slideData)) :?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for($i = 0; $i < count($slideData); $i++) { ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : ''?>"></li>
                <?php } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $i = 0; foreach($slideData as $_slideItem) : ?>
                <div class="item <?php echo ($i === 0) ? 'active' : ''?> ">
                    <a <?php if($_slideItem->link !== '') echo 'href="'.$_slideItem->link.'"'; ?>><img src="<?php echo base_url().$_slideItem->image_link;?>" alt="<?php echo strip_tags($_slideItem->caption);?>" title="<?php echo $_slideItem->title?>"></a>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif;?>
    </div>


    <?php
        if(isset($featured_products) && count($featured_products) > 0):
    ?>
    <div class="product-slider">
        <div class="container">
            <span id="prev"><i class="fa fa-chevron-circle-left"></i></span>
            <span id="next"><i class="fa fa-chevron-circle-right"></i></span>
            <ul id="product-slider">
                <?php foreach($featured_products as $_product) :
                    $thumb = getThumbnailByProductId($_product->id);
                    if(isset($thumb)):
                ?>
                <li class="item imgLiquidFill imgLiquid">
                    <img src="<?php echo urldecode($thumb->image_link);?>" alt="<?php echo $_product->title;?>" />
                    <a class="overlay" href="/san-pham/<?php echo $_product->alias?>.html"></a>
                    <span class="product-name"><a href="/san-pham/<?php echo $_product->alias?>.html"><?php echo $_product->title;?></a></span>
                </li>
                <?php endif; endforeach;?>
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
    <?php endif;?>
</div>
<!--/Main Content-->

<script>
    $(document).ready(function() {
        $(".imgLiquidFill").imgLiquid();
    });
</script>
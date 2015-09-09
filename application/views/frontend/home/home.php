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
                <div class="item <?php echo ($i === 0) ? 'active' : ''?>">
                    <a <?php if($_slideItem->link !== '') echo 'href="'.$_slideItem->link.'"'; ?>><img src="<?php echo base_url().$_slideItem->image_link;?>" alt="<?php echo strip_tags($_slideItem->caption);?>" title="<?php echo $_slideItem->title?>"></a>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif;?>
    </div>

    <div class="product-slider">
        <div class="container">
            <span id="prev"><i class="fa fa-chevron-circle-left"></i></span>
            <span id="next"><i class="fa fa-chevron-circle-right"></i></span>
            <ul id="product-slider">
                <li class="item">
                    <img src="images/product/1.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/2.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/1.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/2.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/1.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/2.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/1.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>

                <li class="item">
                    <img src="images/product/2.jpg" alt="TÊN SẢN PHẨM" />
                    <a class="overlay" href="#PRODUCT_LINK"></a>
                    <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                </li>
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--/Main Content-->
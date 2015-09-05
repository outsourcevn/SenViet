
<!--Start Main Content-->
<div class="main-content">
    <div class="container">
        <?php
            if(isset($featured_product_list) && count($featured_product_list) > 0){
        ?>
        <!--Featured Product-->
        <div class="featured-product">
            <h1 class="featured-product-heading">
                <span>Featured Products</span>
            </h1>
        </div>
        
        <!--Carousel-->
        <div style="height: 385px!important; overflow-y: hidden;">
            <div class="owl-carousel">
                
                <?php
                    foreach($featured_product_list as $key => $val){
                        $image = get_image_list($val->id, true);
                        
                        if(count($image) > 0){
                ?>
                
                <div class="item clearfix">
                    <div class="featured-item">
                        <a href="<?php echo $val->alias?>.html">
                            <img class="featured-product-img" src="<?php echo (isset($image->image_link) ? CMS_DOMAIN.$image->image_link : '');?>" height="380px"/>
                        </a>
                        
                        <div class="col-md-12 featured-product-info">
                            <h3 class="featured-product-title"><a href="<?php echo $val->alias?>.html"><?php echo $val->title?></a></h3>
                            <div class="featured-product-data col-md-12">
                                <div class="col-sm-6">
                                    <h3 class="featured-product-price"><?php echo number_format((($val->price > $val->sale_price && $val->sale_price > 0) ? $val->sale_price : $val->price))?> VNĐ</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="#add-to-cart-<?php echo $val->id;?>" id="product_<?php echo $val->id;?>"  class="featured-product-cart add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                </div>
                            </div>
                        </div>
                        <?php echo ($val->price > $val->sale_price && $val->sale_price > 0) ? '<div class="on-sale-ribbon">Sale</div>' : ''?>
                        
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--END Carousel-->
        <?php
            }
        ?>
        
        <?php
            if(isset($hotest_product_list) && count($hotest_product_list) > 0){
        ?>
        <!--Featured Product-->
        <div class="featured-product">
            <h1 class="featured-product-heading">
                <span>Hotest Products</span>
            </h1>
        </div>
        
        
        <!--Carousel-->
        <div style="height: 385px!important; overflow-y: hidden;">
            <div class="owl-carousel">
                
                <?php
                    foreach($hotest_product_list as $key => $val){
                        $image = get_thumbnail_image($val->id);
                        
                        if(count($image) > 0){
                ?>
                
                <div class="item clearfix">
                    <div class="featured-item">
                        <a href="<?php echo $val->alias?>.html">
                            <img class="featured-product-img" src="<?php echo (isset($image->image_link) ? CMS_DOMAIN.$image->image_link : '');?>" height="380px"/>
                        </a>
                        
                        <div class="col-md-12 featured-product-info">
                            <h3 class="featured-product-title"><a href="<?php echo $val->alias?>.html"><?php echo $val->title?></a></h3>
                            <div class="featured-product-data col-md-12">
                                <div class="col-sm-6">
                                    <h3 class="featured-product-price"><?php echo number_format((($val->price > $val->sale_price && $val->sale_price > 0) ? $val->sale_price : $val->price))?> VNĐ</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="#add-to-cart-<?php echo $val->id;?>" id="product_<?php echo $val->id;?>"  class="featured-product-cart add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                </div>
                            </div>
                        </div>
                        <?php echo ($val->price > $val->sale_price && $val->sale_price > 0) ? '<div class="on-sale-ribbon">Sale</div>' : ''?>
                        
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--END Carousel-->
        <?php
            }
        ?>
        
        <?php
            if(isset($lastest_product_list) && count($lastest_product_list) > 0){
        ?>
        <!--Featured Product-->
        <div class="featured-product">
            <h1 class="featured-product-heading">
                <span>Lastest Products</span>
            </h1>
        </div>
        
        
        <!--Carousel-->
        <div style="height: 385px!important; overflow-y: hidden;">
            <div class="owl-carousel">
                
                <?php
                    foreach($lastest_product_list as $key => $val){
                        $image = get_thumbnail_image($val->id);
                        
                        if(count($image) > 0){
                ?>
                
                <div class="item clearfix">
                    <div class="featured-item">
                        <a href="<?php echo $val->alias?>.html">
                            <img class="featured-product-img" src="<?php echo (isset($image->image_link) ? CMS_DOMAIN.$image->image_link : '');?>" height="380px"/>
                        </a>
                        
                        <div class="col-md-12 featured-product-info">
                            <h3 class="featured-product-title"><a href="<?php echo $val->alias?>.html"><?php echo $val->title?></a></h3>
                            <div class="featured-product-data col-md-12">
                                <div class="col-sm-6">
                                    <h3 class="featured-product-price"><?php echo number_format((($val->price > $val->sale_price && $val->sale_price > 0) ? $val->sale_price : $val->price))?> VNĐ</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="#add-to-cart-<?php echo $val->id;?>" id="product_<?php echo $val->id;?>"  class="featured-product-cart add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                                </div>
                            </div>
                        </div>
                        <?php echo ($val->price > $val->sale_price && $val->sale_price > 0) ? '<div class="on-sale-ribbon">Sale</div>' : ''?>
                        
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--END Carousel-->
        <?php
            }
        ?>
        <br /><br /><br /><br />
    </div>     
</div>
<!--End Main Content-->

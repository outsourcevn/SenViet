<?php
    $image = get_image_list($product->id);
?>
<?php echo form_open('', array('onsubmit' => 'return false;'));?>
<div class="container">

    <div class="col-lg-12" style="background: #fff;">
        
        <div class="col-lg-4 text-justify product-images">
            <div class="col-md-12">
                <h3 class="featured-product-heading">Images</h3>
            </div>
            
            <div class="clearfix"></div>
            
            <section class="slider" style="position: relative; overflow: hidden;">
            	<div id="slider" class="flexslider">
            		<ul class="slides">
                    
                        <?php
                            if(count($image) > 0 && is_array($image)){
                                foreach($image as $tempImg){
                        ?>
            			<li>
            				<img src="<?php echo $tempImg->image_link;?>" title="<?php echo $tempImg->title?>" />
            			</li>
                        <?php
                                }
                            }
                        ?>
            		</ul>
            	</div>
            	<div id="carousel" class="flexslider">
            		<ul class="slides">
            			<?php
                            if(count($image) > 0 && is_array($image)){
                                foreach($image as $tempImg){
                        ?>
            			<li style="height: 100px; overflow-y: hidden;">
            				<img src="<?php echo $tempImg->image_link;?>" height="200px" title="<?php echo $tempImg->title?>" />
            			</li>
                        <?php
                                }
                            }
                        ?>
            		</ul>
            	</div>
                <?php echo ($product->price > $product->sale_price && $product->sale_price > 0) ? '<div class="on-sale-ribbon">Sale</div>' : ''?>
            </section>
            
            <script>
                $(window).load(function(){
                    $('#carousel').flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        itemWidth: 150,
                        itemMargin: 5,
                        asNavFor: '#slider'
                    });
                    
                    $('#slider').flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        sync: "#carousel",
                        start: function(slider){
                          $('body').removeClass('loading');
                        }
                    });
                });
            </script>
        </div>
        <!--Product Detail-->
        <div class="col-lg-8 text-justify">
            <div class="col-md-12">
                <h3><?php echo $product->title?></h3>
                <h4 style="color: #fd614e;">VNĐ <?php echo number_format(($product->sale_price < $product->price && $product->sale_price > 0) ? $product->sale_price : $product->price)?></h4>
                <div class="product-description">
                    <?php echo html_entity_decode($product->description);?>
                </div>
                
                <div class="product-more-info">
                    <h4 class="product-quantity-title">Quantity : </h4> <input type="text" id="quantity" name="quanlity" class="product-quantity" size="1" value="1" />
                    <div class="col-sm-12 text-right">
                        <div id="product_<?php echo $product->id;?>" class="btn add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Cart<div class="added-to-cart">ADDED TO CART</div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
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
                                        <a href="#add-to-cart-<?php echo $val->id;?>" class="featured-product-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>\
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
            ?><br /><br />
        </div>
    </div>

</div>
</form>
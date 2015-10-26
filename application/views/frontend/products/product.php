<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <?php if(isset($category_list) && is_array($category_list) && count($category_list) > 0) :?>
                    <div class="panel-left">
                        <div class="left-panel-heading">Sản phẩm khác</div>
                        <div class="panel-left-body">
                            <ul class="left-panel-contain">
                                <?php foreach($category_list as $_category):?>
                                    <?php if($_category->title == 'HOME'):?>
                                        <li class="<?php echo ($cur_category->id == $_category->id) ? 'active' : ''?>"><a href="/san-pham/">Tất cả sản phẩm</a></li>
                                        <?php else:?>
                                    <li class="<?php echo ($cur_category->id == $_category->id) ? 'active' : ''?>"><a href="/san-pham/<?php echo $_category->alias?>"><?php echo $_category->title?></a></li>
                                        <?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                <?php endif;?>
                <?php if(isset($featuredProducts) && is_array($featuredProducts) && count($featuredProducts) > 0) :?>
                    <div class="panel-left">
                        <div class="left-panel-heading">Sản phẩm nổi bật</div>
                        <div class="panel-left-body">
                            <ul class="left-panel-contain featured-products">
                                <?php foreach($featuredProducts as $_product):
                                    $featuredImage = get_image_list($_product->id, true);
                                    ?>
                                    <li>
                                        <?php if(isset($featuredImage)) : ?>
                                            <a href="<?php echo "/san-pham/".$_product->alias?>.html"><img src="<?php echo urldecode($featuredImage->image_link);?>" alt="<?php echo $featuredImage->title?>"/></a>
                                        <?php endif;?>
                                        <a href="<?php echo "/san-pham/".$_product->alias?>.html"><?php echo $_product->title?></a>
                                        <div style="clear: both"></div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                <?php endif;?>
            </div>

            <div class="col-lg-9 main-content-container">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb as $_item) :?>
                        <?php if($_item->id == 1):?>
                            <li><a href="/san-pham/"><i>Trang chủ</i></a></li>
                        <?php else:?>
                            <li><a href="/san-pham/<?php echo $_item->alias;?>"><i><?php echo $_item->title;?></i></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                    <li class="active"><a href="/san-pham/<?php echo $cur_product->alias;?>.html"><i><?php echo $cur_product->title;?></i></a></li>
                </ol>
<!--                <h3 class="news-container-heading">--><?php //echo $cur_product->title;?><!--</h3>-->
                <div class="main-product-content col-md-12 row">
                    <div class="col-md-6 product-img-slider">
                        <div id="dev7-caroufredsel-wrapper-24" class="dev7-caroufredsel-wrapper">
                            <?php
                            $images = get_image_list($cur_product->id);

                            if(is_array($images) && count($images) > 0):
                            ?>
                            <div id="caroufredsel-24" class="dev7-caroufredsel-carousel">
                                <?php foreach($images as $_image): ?>
                                <div class="dev7-caroufredsel-image" style="text-align: center"><img
                                        src="<?php echo $_image->image_link?>" alt="<?php echo $_image->title?>" style="max-height: 230px; max-width: 100%;"/>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="dev7-clearfix"></div>
                            <div class="dev7-caroufredsel-pag">
                                <?php foreach($images as $_image): ?>
                                <a class="dev7-caroufredsel-thumb" href="#">
                                    <img src="<?php echo $_image->image_link?>"/>
                                </a>
                                <?php endforeach;?>
                            </div>
                            <?php
                                else:
                                    echo "Không có ảnh cho sản phẩm này.";
                                endif;
                            ?>
                        </div>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $("#caroufredsel-24").carouFredSel({
                                responsive	: true,
                                heigh       : '320px',
                                items		: 1,
                                scroll		: {
                                    fx			: "crossfade"
                                },
                                pagination	: {
                                    container		: ".dev7-caroufredsel-pag",
                                    anchorBuilder   : false
                                },
                                auto: {
                                    play:false,
                                },
                            });
                        });
                    </script>
                    <div class="col-md-6 product-detail">
                        <h3 class="news-container-heading"><?php echo $cur_product->title;?></h3>

                        <br/>
                        <div class="col-sm-6"><strong>Người gửi:</strong></div><div class="col-sm-6"><span><?php $user = get_username_by_id($cur_product->userid_created); echo ($user != '') ? $user : '-';?></span></div>
                        <div class="col-sm-6"><strong>Giá bán lẻ:</strong></div><div class="col-sm-6"><span><?php echo ($cur_product->price && $cur_product->show_price == 1) ? number_format($cur_product->price).' VNĐ' : 'Liên hệ';?></span></div>
                        <div class="col-sm-6"><strong>Mã số sản phẩm:</strong></div><div class="col-sm-6"><span>#<?php echo $cur_product->id;?></span></div>

                        <div class="col-sm-12 row product-short-description">
                            <?php echo html_entity_decode($cur_product->description);?>
                        </div>
                        <div class="clearfix"></div>
                        <?php if($cur_product->fb_share_like == 1) :?>
                        <div class="social-links">
                            <div class="fb-like" data-share="true"></div>
                        </div>
                        <?php endif;?>
                    </div>

                    <div class="clearfix"></div>

                    <h3>Chi Tiết Sản Phẩm</h3>

                    <div class="product-content">
                        <?php echo html_entity_decode($cur_product->content);?>
                    </div>
                </div>
                <?php
                    if(isset($featured_products) && count($featured_products) >= 4):
                ?>
                <div class="col-sm-12">
                    <h3 class="news-container-heading product-related">SẢN PHẨM LIÊN QUAN</h3>
                    <div class="product-slider">
                        <div class="container">
                            <span id="prev"><i class="fa fa-chevron-circle-left"></i></span>
                            <span id="next"><i class="fa fa-chevron-circle-right"></i></span>
                            <ul id="product-slider">
                                <?php foreach($featured_products as $_product) :
                                    $thumb = getThumbnailByProductId($_product->id);
                                    if(isset($thumb) && count($thumb) >= 4):
                                        ?>
                                        <li class="item imgLiquidFill imgLiquid">
                                            <img src="<?php echo urldecode($thumb->image_link);?>" alt="<?php echo $_product->title;?>" />
                                            <a class="overlay" href="/san-pham/<?php echo $_product->alias?>.html"></a>
                                            <span class="product-name"><a href="product-name">Tên sản phẩm</a></span>
                                        </li>
                                    <?php endif; endforeach;?>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".imgLiquidFill").imgLiquid();
    });
</script>
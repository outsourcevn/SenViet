<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row"></div>
            <div class="col-lg-9 row">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb as $_item) :?>
                        <?php if($_item->id == 1):?>
                            <li><a href="/san-pham/"><i>Trang chủ</i></a></li>
                        <?php else:?>
                            <li><a href="/san-pham/<?php echo $_item->alias;?>"><i><?php echo $_item->title;?></i></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ol>
            </div>
        </div>
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
                        <div class="left-panel-heading">Sản phẩm bán chạy</div>
                        <div class="panel-left-body">
                            <ul class="left-panel-contain">
                                <?php foreach($featuredProducts as $_product):?>
                                    <li><a href="/san-pham/<?php echo $_product->alias?>.html"><?php echo $_product->title?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                <?php endif;?>
            </div>

            <div class="col-lg-9 main-content-container">
                <h3 class="news-container-heading"><?php echo ($cur_category->title == 'HOME') ? 'Trang chủ' : $cur_category->title;?></h3>
                <div class="main-product-content col-md-12 row">
                    <?php if(isset($product_list) && count($product_list) > 0): ?>
                        <?php foreach($product_list as $_product):
                            $images = getThumbnailByProductId($_product->id);
                            ?>
                    <div class="col-md-4 text-center item">
                        <a href="/san-pham/<?php echo $_product->alias;?>.html"><img src="<?php echo (isset($images->image_link)) ? $images->image_link : 'images/product/no-image.svg';?>" class="product-thumbnail" alt="<?php echo (isset($images->title) ? $images->title : '');?>" /></a>

                        <a href="/san-pham/<?php echo $_product->alias;?>.html" class="product-link"><button class="product-name"><?php echo $_product->title;?></button></a>
                    </div>
                        <?php endforeach;?>
                    <?php else:?>
                    <div class="col-md-12 text-center">
                        Hiện tại không có sản phẩm nào trong mục này.
                    </div>
                    <?php endif;?>
                </div>
                <div class="col-md-12 text-center"><?php echo (isset($pagination))? $pagination : ''?></div>
            </div>
            <script>
                //Fixed Height
                jQuery(document).ready(function(){
                    var productImageList = jQuery('.main-product-content .item img.product-thumbnail');
                    var maxHeight = 0;
                    jQuery(productImageList).each(function(){
                        if(jQuery(this).height() > maxHeight){
                            maxHeight = jQuery(this).height();
                        }
                    });
                    jQuery(productImageList).height(maxHeight);

                });
            </script>
        </div>
    </div>
</div>

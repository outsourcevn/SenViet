
<div class="col-lg-9">
<!--Start Main Content-->
<div class="main-content">
    <div class="col-lg-9">
        <h3 class="featured-product-heading">Shop</h3>
    </div>
    <div class="col-lg-3" style="padding:20px;">
        <form method="GET">
            <select name="order_by" id="order_by" class="form-control" onchange="this.submit">
                <option value="DATE_DESC" <?php echo (isset($_GET['order_by']) && $_GET['order_by'] == 'DATE_DESC') ? 'selected' : ''?>>DATE : DOWN</option>
                <option value="DATE_ASC" <?php echo (isset($_GET['order_by']) && $_GET['order_by'] == 'DATE_ASC') ? 'selected' : ''?>>DATE : Up</option>
                <option value="PRICE_ASC" <?php echo (isset($_GET['order_by']) && $_GET['order_by'] == 'PRICE_ASC') ? 'selected' : ''?>>PRICE : LOWER &gt; HIGHER</option>
                <option value="PRICE_DESC" <?php echo (isset($_GET['order_by']) && $_GET['order_by'] == 'PRICE_DESC') ? 'selected' : ''?>>PRICE : HIGHER &gt; LOWER</option>
            </select>
        </form>
    </div>
    <div class="col-lg-12">
        <?php
            if(isset($products) && count($products) > 0){
        ?>                               
        <div class="products-grid">
            <?php
                foreach($products as $keyPro => $valPro){
                    $image = get_thumbnail_image($valPro->id);
                    
                    if(count($image) > 0){
            ?>
            
            <div class="item">
                <div class="featured-item">
                    <a href="<?php echo $valPro->alias?>.html">
                        <img class="featured-product-img" src="<?php echo (isset($image->image_link) ? ($image->image_link) : '');?>" height="300px"/>
                    </a>
                    
                    <div class="col-lg-12 featured-product-info">
                        <h3 class="featured-product-title"><a href="<?php echo $valPro->alias?>.html"><?php echo $valPro->title?></a></h3>
                        <div class="featured-product-data col-lg-12">
                            <div class="col-sm-6">
                                <h3 class="featured-product-price"><?php echo number_format((($valPro->price > $valPro->sale_price && $valPro->sale_price > 0) ? $valPro->sale_price : $valPro->price))?> VNĐ</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a class="featured-product-cart"><span id="product_<?php echo $valPro->id?>" class="glyphicon glyphicon-shopping-cart add-to-cart"></span></a>
                            </div>
                        </div>
                    </div>
                    <?php echo ($valPro->price > $valPro->sale_price && $valPro->sale_price > 0) ? '<div class="on-sale-ribbon">Sale</div>' : ''?>
                    
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <?php
            } else {
        ?>
            <div class="text-center">Không tìm thấy sản phẩm nào trong CSDL.</div>
        <?php
            }
        ?>
        <div class="clearfix"></div>
        <div class="text-center col-lg-12">
            <div class="pagination"><?php echo (isset($pagination)) ? $pagination : ''?></div>
        </div>
    </div>
</div>
<!--End Main Content-->

</div>
</div>
</div>
</form>
<div class="clearfix"></div>
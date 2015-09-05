<!DOCTYPE HTML>
<html>
<head>
	<meta name="author" content="minhducck" />
    <meta charset="utf-8" />
    <meta name="author" content="Ta Minh Duc" />
    <meta name="description" content="<?php echo (isset($seo['meta_description']) ? $seo['meta_description'] : '')?>" />
    <meta name="keywords" content="<?php echo (isset($seo['meta_keywords']) ? $seo['meta_keywords'] : '')?>" />
    
    <base href="http://senviet.vn" />
	<title><?php echo (isset($seo['title']) ? $seo['title'] : '') ?></title>
    
    <!--Jquery-->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <!--Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
    <script src="js/bootstrap.js"></script>
    <!--NoUISlider-->
    <link rel="stylesheet" href="library/NoUISlider/jquery.nouislider.css"/>
    <script src="library/NoUISlider/jquery.nouislider.all.js"></script>
    <!--Owl.Carousel-->
    <script src="js/owl/owl.carousel.js"></script>
    <link rel="stylesheet" href="js/owl/assets/owl.carousel.css"/>
    <!--FLEXSlider-->
    <script src="library/Flexslider/jquery.flexslider.js"></script>
    <link rel="stylesheet" type="text/css" href="library/Flexslider/flexslider.css" />
    <script>
        
    var products = [];
    
    $(document).ready(function() {
        
        //GETTING INFO OF CART
        $.ajax({
            method: "GET",
            url: "shop/ajax_get_cart",
        }).done(function( data ) {
            $('.cart-items table').remove();
            $('.cart-items').append(data);
        });
        //Delete Item on cart
        $('.delete_cart_item').live('click', function(){
            conf = confirm('Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng không ?');
            
            if(conf){
                id = $(this).attr('rel');
                id = id.substr(5);

                $.ajax({
                    method: "GET",
                    url: "shop/ajax_del_item/"+id,
                }).done(function( data ) {
                    if(data)
                    {
                        $('.cart-items table').remove()
                        $('.cart-items').append(data);
                    }
                });
            }
        });
        
        //Slider
        $(".owl-carousel").owlCarousel({
            autoWidth : true,
            autoplay : true,
            margin : 20,
            loop : true,
        });
        
        nav_pos =  $('#navigation').position();
        nav_top_val = nav_pos.top;
        
        $(document).scroll(function(){
            
            var screenTop = $(document).scrollTop();
            
            if(screenTop > nav_top_val){
                $('#navigation').css('position', 'fixed');
                $('#navigation').css('z-index', '200');
                $('#navigation').css('top', '0');
                $('#navigation').css('width', $('.header').width());
            }else{
                $('#navigation').css('position', 'block');
                $('#navigation').css('width', 'auto');
            }
        });
        
        $('#order_by').change(function(){
            $('#shop-filter').submit();
        });
        
        //Them Vao Gio Hang
        $('.add-to-cart').live('click', function(){
            product_id = $(this).attr('id');
            product_id = product_id.substring(8);
            quantity = parseInt($('#quantity').val());
            
            if(!quantity || quantity <= 0){
                quantity = 1;
            }
            
            $.ajax({
                method: "POST",
                url: "shop/ajax_add_to_cart",
                data: { 'product_id': product_id, 'quantity': quantity , 'csrf_token' : $('input[name=csrf_token]').val()},
                dataType : "JSON"
            }).done(function( msg ) {
                if(msg.items_on_cart > 0){
                    $('.items-on-cart').html(msg.items_on_cart);
                }
                $.ajax({
                    method: "GET",
                    url: "shop/ajax_get_cart",
                }).done(function( data ) {
                    $('.cart-items table').remove();
                    $('.cart-items').append(data);
                });
                alert(msg.msg);
            });
        });
    });


    </script>
    
    <!--Custom Style-->
    <link rel="stylesheet" type="text/css" href="css/front_end/style.css" />
</head>

<body>
<?php echo form_open()?>
</form>
<!--Header-->
<div class="container">
    <div class="header">
        <div class="home-header-home">
            <div class="col-md-4 clearfix text-left"></div>
            
            <div class="col-md-4 clearfix text-center"><a href="#"><h1 class="header-logo"><span style="color: #fd614e;">MINHDUCCK's</span> STORE</h1></a></div>
            
            <div class="col-md-4 clearfix text-right cart-container">
                <div id="cart-box" class="#CART"><a href="checkout"><span class="glyphicon glyphicon-shopping-cart"></span> Cart (<span class="items-on-cart"><?php echo CountItemsOnCart();?></span>)</a></div>
                <div class="cart-items">
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <nav id="navigation">
                <div class="left-nav">
                    <ul class="main-navbar">
                        <li <?php echo (uri_string() == '') ? 'class="active"' : ''?>><a href="<?php echo $configs->homepage?>">Home</a></li>
                        <li <?php echo (uri_string() == 'shop') ? 'class="active"' : ''?>><a href="shop">Shop</a></li>
                        <!--<li class="nav-normal">
                            <a href="#">Category X <span class="badge">30</span><span class="caret"></span></a>
                            <ul class="navbar-items">
                                <li><a href="#">Category X-1</a></li>
                                <li><a href="#">Category X-2</a></li>
                                <li><a href="#">Category X-3</a></li>
                            </ul>
                        </li>-->
                        <?php 
                            if(isset($category_list) && count($category_list)){
                                foreach($category_list as $key => $val){
                        ?>
                        <li class="nav-mega <?php $url = 'category/'.$val->alias; if(uri_string() === ($url)){ echo 'active'; } else { echo ''; }?>">
                            <a href="category/<?php echo $val->alias?>"><?php echo $val->title?> <span class="badge"><?php echo CountItemInCategory($val->id)?></span><span class="caret"></span></a>
                            <div class="clearfix"></div>
                            <div class="nav-mega-item">
                                <?php
                                    $ProductsInCate = ProductListInCate($val->id, 3);
                                    
                                    if(isset($ProductsInCate) && count($ProductsInCate) > 0){
                                ?>                               
                                
                                <!--Carousel
                                <div style="height: 380px!important;">
                                    <div class="owl-carousel">-->
                                <div class="products-grid">
                                    <?php
                                        foreach($ProductsInCate as $keyPro => $valPro){
                                            $image = get_thumbnail_image($valPro->id);
                                            
                                            if(count($image) > 0){
                                    ?>
                                    
                                    <div class="item">
                                        <div class="featured-item">
                                            <a href="<?php echo $valPro->alias?>.html">
                                                <img class="featured-product-img" src="<?php echo (isset($image->image_link) ? ($image->image_link) : '');?>" height="300px"/>
                                            </a>
                                            
                                            <div class="col-md-12 featured-product-info">
                                                <h3 class="featured-product-title"><a href="<?php echo $valPro->alias?>.html"><?php echo $valPro->title?></a></h3>
                                                <div class="featured-product-data col-md-12">
                                                    <div class="col-sm-6">
                                                        <h3 class="featured-product-price"><?php echo number_format((($valPro->price > $valPro->sale_price && $valPro->sale_price > 0) ? $valPro->sale_price : $valPro->price))?> VNĐ</h3>
                                                    </div>
                                                    <div class="col-sm-6 text-right">
                                                        <a href="#add-to-cart-<?php echo $valPro->id;?>" id="product_<?php echo $valPro->id;?>" onclick="return false;" class="featured-product-cart add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span></a>
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
                                    <!--</div>
                                </div>
                                <div class="clearfix"></div>
                                <!--END Carousel-->
                                <?php
                                    }
                                ?>
                            </div>
                        </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
                
                <div class="right-nav text-right">
                    <span class="search-bx" href="#" onclick="return false"><span class="glyphicon glyphicon-search"></span>
                        <div class="header-search">
                            <form method="get" action="shop" class="search-form ajax-search">
                    			<input name="keyword" type="search" autocomplete="off" placeholder="Search..." value="<?php echo ($this->input->get('keyword', TRUE))?>" />
                    		</form>
                        </div>
                    </span>
                </div>
        </nav>
    </div>
</div>
<!--/Header-->
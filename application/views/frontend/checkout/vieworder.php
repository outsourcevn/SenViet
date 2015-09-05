<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="minhducck" />
    <meta charset="utf-8" />
	<title><?php echo (isset($seo['title']) ? $seo['title'] : 'Shop Online')?></title>
    
    <base href="<?php echo CMS_DOMAIN?>" />
    
    <!--Jquery-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    
    <!--Custom Style-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<br /><br />
<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Payment Information</h3>
        </div>
        
        <div class="panel-body">
            <div class="col-md-12 text-center">
                <h4>VIEW ORDER DETAIL #<?php printf("%010d", $order_id)?></h4>
            </div><br /><br /><br />
            <div class="col-md-6">
                <div class="col-sm-3"><strong>First Name</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="first_name"><?php echo $order->first_name?></div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Last Name</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="last_name"><?php echo $order->last_name?></div>
                </div>
            </div>
            <br /><br />
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Email</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="email"><?php echo $order->email?></div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Phone</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="phone"><?php echo $order->phone?></div>
                </div>
            </div>
            <br /><br />
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Address</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="address"><?php echo $order->address?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Trạng thái</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12"><?php 
                                    if(isset($order->status)){
                                        if($order->status == 2){
                                            echo '<strong><p class="text-success">Approved</p></strong>';
                                        }else{
                                            if($order->status == 1)
                                            {
                                                echo '<strong><p class="text-muted">Pending</p></strong>';
                                            }
                                            else{
                                                if($order->status == 3)
                                                {
                                                    echo '<strong><p class="text-danger">Rejected</p></strong>';
                                                }
                                                else{
                                                    echo '<strong><p class="text-info">Processing</p></strong>';
                                                }
                                            }
                                            
                                        }
                                    }else{
                                        echo '<strong><p class="text-muted">Pending</p></strong>';
                                    }
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Payment Info-->
    
    
    <!--Products-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Products</h3>
        </div>
        
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                    <tr>
                        <th class="text-center">PRODUCT</th>
                        <th class="text-center">PRICE</th>
                        <th class="text-center">QUANTITY</th>
                        <th class="text-center">SUBTOTAL</th>
                    </tr>
                    
                    <?php
                        if(isset($products) && count($products) && is_array($products)){
                            
                            $total = 0;
                            
                            foreach($products as $k => $v){
                                $product = $v;
                                if($product->sale_price > 0 && $product->sale_price < $product->price)
                                    $product->price = $product->sale_price;
                                $total += $product->price * $v->quantity;
                    ?>
                    <!--Cart Item-->
                    <tr>
                        <td>
                            <a href="<?php echo $v->alias?>.html">
                                <div class="col-sm-6">
                                    <img class="img-thumbnail" src="<?php echo get_thumbnail_image($product->product_id)->image_link;?>" style="max-height: 250px;" />
                                </div>
                                <div class="col-sm-6">
                                    <?php echo $product->title;?>
                                </div>
                            </a>
                        </td>
                        
                        <td class="text-center"><?php echo number_format($product->price)?> VNĐ</td>
                        <td class="text-center"><?php echo $v->quantity?></td>
                        <td class="text-center"><?php echo number_format($product->price * $v->quantity)?> VNĐ</td>
                    </tr>
                    <!--/Cart Item-->
                    <?php
                            }
                        } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Hiện tại vẫn chưa có sản phẩm nào trong giỏ.
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="4" class="text-right">TOTAL : <?php echo number_format($total);?> VNĐ</td>
                    </tr>
            </table>
        </div>
    </div>
    
</div>

</body>
</html>
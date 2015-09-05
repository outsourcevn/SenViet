
<!--Start Main Content-->
<div class="main-content">
    <?php echo form_open('');?>
    <div class="container">
        <div class="col-md-8">
            <h3 class="featured-product-heading">Shopping Cart</h3>
        </div>
        
        <div class="col-md-4 text-justify">
            <button name="cmd" value="checkout" style="margin: 20px 0px;" class="btn btn-info form-control">PROCEED TO CHECK OUT</button>
        </div>
        
        <div class="col-md-12">
            <?php                    
                if(validation_errors())
                {
            ?>
            <blockquote class="bg-warning">
                <ul class="errors">
                    <?php 
                        echo validation_errors('<li class="text-warning">', '</li>');
                    ?>
                </ul>
            </blockquote>
            <?php
                }
            ?>
        </div>
        
        <div class="col-lg-8">
            <div class="col-lg-12">
                <table class="table tableborder table-hover">
                    <tr>
                        <th class="text-center">PRODUCT</th>
                        <th class="text-center">PRICE</th>
                        <th class="text-center">QUANTITY</th>
                        <th class="text-center">SUBTOTAL</th>
                        <th></th>
                    </tr>
                    <?php
                        if(isset($cart) && count($cart) && is_array($cart)){
                            
                            $total = 0;
                            
                            foreach($cart as $k => $v){
                                $product = get_product_by_id($k);
                                if($product->sale_price > 0 && $product->sale_price < $product->price)
                                    $product->price = $product->sale_price;
                                $total += $product->price * $v;
                    ?>
                    <!--Cart Item-->
                    <tr>
                        <td>
                            <a href="<?php echo $product->alias;?>.html">
                                <div class="col-sm-6">
                                    <img class="img-thumbnail" src="<?php echo get_thumbnail_image($k)->image_link;?>" style="max-height: 250px; max-width: 140px;" />
                                </div>
                                <div class="col-sm-6">
                                    <?php echo $product->title;?>
                                </div>
                            </a>
                        </td>
                        
                        <td class="text-center"><?php echo number_format($product->price)?> VNĐ</td>
                        <td class="text-center"><input class="text-center" type="text" size="1" value="<?php echo $v?>" name="quantity[]" /></td>
                        <td class="text-center"><?php echo number_format($product->price * $v)?> VNĐ</td>
                        <td><a href="checkout/del/<?php echo $k?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                    <!--/Cart Item-->
                    <?php
                            }
                        } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            Hiện tại vẫn chưa có sản phẩm nào trong giỏ.
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                    <tr>
                        <td colspan="3">
                            <button class="btn btn-warning" onclick="return confirm('Are you want to empty cart ?');" name="cmd" value="empty" tabindex="5">EMPTY CART</button>
                        </td>
                        <td colspan="2">
                            <button class="btn btn-success" name="cmd" value="update" tabindex="0">UPDATE CART</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-md-4 text-justify">
            <div class="well well-sm">
                
                <div class="col-sm-6"><input style="width: 100%;" type="text" name="first_name" class="form-control-static" placeholder="FIRST NAME" value="<?php echo $this->input->post('first_name');?>" /></div>
                <div class="col-sm-6"><input style="width: 100%;" type="text" name="last_name" class="form-control-static" placeholder="LAST NAME"  value="<?php echo $this->input->post('last_name');?>" /></div>
                <br /><br />
                <div class="col-sm-12">
                    <input style="width: 100%;" type="email" name="email" class="form-control-static" placeholder="EMAIL" value="<?php echo $this->input->post('email');?>"  />
                </div>
                <br /><br />
                <div class="col-sm-12">
                    <input style="width: 100%;" type="text" name="phone" class="form-control-static" placeholder="PHONE" value="<?php echo $this->input->post('phone');?>"  />
                </div>
                <br /><br />
                <div class="col-sm-12">
                    <textarea name="address" class="form-control-static" style="width: 100%; resize: none;" placeholder="ADDRESS"><?php echo $this->input->post('address');?></textarea>
                </div>
                
                <div class="col-sm-5"><h5>GRAND TOTAL</h5></div>
                <div class="col-sm-7"><h5><strong><?php echo (isset($total) ? number_format($total) : 0);?> VNĐ</strong></h5></div>
                
                <div class="col-sm-12">
                    <button name="cmd" value="checkout" style="margin: 20px 0px;" class="btn btn-info form-control">PROCEED TO CHECK OUT</button>
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
    </div>     
    </form>
</div>
<!--End Main Content-->

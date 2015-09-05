<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders">Orders</a></li>
        <li class="active">Sửa chi tiết hóa đơn</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa chi tiết hóa đơn</h3>
        </div>
        
        <div class="panel-body">
            
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
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="product_name">Product Name</label></div>
                <input type="hidden" name="title" value="<?php echo (isset($post_data['title']) ? $post_data['title'] : '')?>" />
                <div class="col-md-9" style="line-height: 200%;"><?php echo (isset($post_data['title']) ? $post_data['title'] : '')?></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="quantity">Quantity</label></div>
                <div class="col-md-9"><input id="quantity" name="quantity" class="form-control" type="text" title="Số lượng" value="<?php echo (isset($post_data['quantity'])? $post_data['quantity'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="price">Price</label></div>
                <div class="col-md-9">
                    <select name="price" class="form-control" id="price">
                        <option value="<?php echo $post_data['ori_price'];?>" <?php echo ($post_data['ori_price'] == $post_data['price']) ? 'selected' : ''?>><?php echo number_format($post_data['ori_price']);?> VNĐ</option>
                        <?php 
                            if(isset($post_data['sale_price']) && $post_data['sale_price'] > 0){
                        ?>
                        <option value="<?php echo $post_data['sale_price'];?>" <?php echo ($post_data['sale_price'] == $post_data['price']) ? 'selected' : ''?>><?php echo number_format($post_data['sale_price']);?> VNĐ</option>
                        <?php
                            }
                            
                            if($post_data['price'] != $post_data['sale_price'] && $post_data['price'] != $post_data['ori_price']){
                        ?>
                            <option value="<?php echo $post_data['price']?>" selected=""><?php echo number_format($post_data['price']);?> VNĐ</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="quantity">Tổng Tiền</label></div>
                <div id="total" class="col-md-9" style="line-height: 200%;"><?php echo number_format($post_data['price'] * $post_data['quantity'])?> VNĐ</div>
            </div>
            <script>
                Number.prototype.format = function(n, x, s, c) {
                    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                        num = this.toFixed(Math.max(0, ~~n));
                
                    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
                };
                
                $(document).ready(function(){
                    $('.form-control').change(function(){
                        total = $('#quantity').val() * $('#price').val();
                        $('#total').html(total.format(0, 3, ',', '.') + ' VNĐ');
                    })
                });
            </script>
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
    </form>
</div>
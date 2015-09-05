<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders">Orders</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders/view/<?php echo $order_id?>">Order #<?php printf("%010d", $order_id)?></a></li>
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
            
            <div class="col-md-12">
                <div class="col-md-3" style="line-height: 200%;"><label>Sản phẩm</label></div>
                <div class="col-md-9">
                    <input type="hidden" name="product_id" value="<?php echo (isset($post_data['product_id'])) ? $post_data['product_id'] : ''?>" id="FK_id" />
                    <input type="hidden" name="price" value="<?php echo (isset($post_data['price'])) ? $post_data['price'] : ''?>" id="product_price" />
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading" style="height: 40px;" id="ProductInput" contenteditable="" onclick="this.innerHTML = ''">Nhập tên sản phẩm...</div>
                        
                        <!-- List group -->
                        <ul class="list-group" style="display: none;" id="ListProduct">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3">Số lượng</div>
                <div class="col-md-9"><input type="number" class="form-control" name="quantity" value="<?php echo (isset($post_data['quantity'])) ? $post_data['quantity'] : 0?>" /></div>
            </div>
            <script>
                $(document).ready(function(){
                    $.ajax({
                            type: "GET",
                            url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/orders/ajax_selected_item'?>',
                            data: {'FK_id' : $('#FK_id').val()},
                            success : function(data){
                                //$('#alias').val(data);
                                $('#ProductInput').html(data);
                            }
                        });
                    
                    $('#ProductInput').keyup(function(){
                        $.ajax({
                            type: "GET",
                            url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/orders/ajax_search'?>',
                            data: {'query' : $('#ProductInput').html()},
                            success : function(data){
                                //$('#alias').val(data);
                                $('#ListProduct').empty();
                                $('#ListProduct').append(data);
                                $('#ListProduct').slideDown('slow');
                            }
                        });
                    });
                    
                    $(".SelectProduct").live("click", function(){
                        $('#FK_id').val($(this).attr('rel'));
                        
                        $('#ProductInput').html($(this).html());
                        
                        $('#ListProduct').slideUp('slow');
                        arr = $('#ProductInput').html().split('|');
                        arr = arr[1].trim().split(' ');
                        
                        price = Number(arr[0].replace(/[^0-9\.]+/g,""));
                        
                        $('#product_price').val(price);
                    });
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
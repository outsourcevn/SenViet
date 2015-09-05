<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>

<script>
    var flag = 1;
    
    $(document).ready(function(){
        $('.payment-info').dblclick(function(){
            $(this).attr('contenteditable', 'true');
            $(this).addClass('form-control');
            flag = 1;
        });
        
        $( ".payment-info" ).keyup(function( event ) {
            
            $(this).focus()
            if(event.which == 13){
                $(this).removeClass('form-control');
                $(this).attr('contenteditable', 'false');
                var cur = $(this);
                $.ajax({
                    type: "POST",
                    url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/orders/ajax_update/'.$order['id']?>/',
                    data: {'field' : cur.attr('id'), 'value' : cur.html(), '<?php echo $this->security->get_csrf_token_name();?>' : '<?php echo $this->security->get_csrf_hash();?>'},
                    success : function(data){
                        if(data == 'Error' && flag == 1) {
                            alert('Lỗi nhập dữ liệu đầu vào');
                            flag = 0;
                        }
                    }
                });
            }else{
                flag = 1;
            }
        }).keydown(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
            }
        });
    });

</script>

<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders">Orders</a></li>
        <li class="active">ORDER #<?php printf("%010d", $order['id']);?></li>
    </ol>
    <div class="col-lg-12">
        <?php
    		echo form_open('', array('method' => 'POST'));
    	?>
            <div class="col-lg-3 text-left">
                <a href="<?php echo (isset($_GET['redir']) ? base64_decode($_GET['redir']) : CMS_DEFAULT_BACKEND_URL.'/orders/')?>" class="btn btn-default">&laquo; Back</a>
            </div>
            <div class="col-lg-9 text-right">
                <button name="cmd" type="submit" class="btn btn-default" value="pending">Pending</button>
                <button name="cmd" type="submit" class="btn btn-info" value="processing">Processing</button>
                <button name="cmd" type="submit" class="btn btn-success" value="approve">Approve</button>
                <button name="cmd" type="submit" class="btn btn-danger" value="reject">Reject</button>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
    
    <br />
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Payment Information</h3>
        </div>
        
        <blockquote class="bg-warning hidden">
            <ul class="errors">
                <li>Error Trong quá trình nhập dữ liệu.</li>
            </ul>
        </blockquote>
        
        <div class="panel-body">
            <div class="col-md-6">
                <div class="col-sm-3"><strong>First Name</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="first_name"><?php echo $order['first_name']?></div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Last Name</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="last_name"><?php echo $order['last_name']?></div>
                </div>
            </div>
            <br /><br />
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Email</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="email"><?php echo $order['email']?></div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Phone</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="phone"><?php echo $order['phone']?></div>
                </div>
            </div>
            <br /><br />
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Address</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12 payment-info" id="address"><?php echo $order['address']?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-sm-3"><strong>Trạng thái</strong></div>
                <div class="col-sm-9">
                    <div class="col-sm-12"><?php 
                                    if(isset($order['status'])){
                                        if($order['status'] == 2){
                                            echo '<strong><p class="text-success">Approved</p></strong>';
                                        }else{
                                            if($order['status'] == 1)
                                            {
                                                echo '<strong><p class="text-muted">Pending</p></strong>';
                                            }
                                            else{
                                                if($order['status'] == 3)
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
    
    <div class="col-lg-12 text-right">
        <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders/addProduct/<?php echo $order['id']?>" class="btn btn-success">Thêm sản phẩm vào hóa đơn</a>
    </div>
    
    <div class="clearfix"></div><br />
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách sản phẩm</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th colspan="2">Action</th>
                </tr>
                
            <?php
            if(count($order_detail) > 0 && is_array($order_detail)){
                $total = 0;
                foreach($order_detail as $key => $val){
                    $total += $val['price'] * $val['quantity']; 
            ?>
                <tr>
                    <td><?php echo $val['title']?></td>
                    <td><?php echo $val['quantity']?></td>
                    <td><?php echo number_format($val['price'])?> VNĐ</td>
                    <td><?php echo number_format($val['price'] * $val['quantity'])?> VNĐ</td>
                    <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders/edit_detail/<?php echo $order['id']?>/<?php echo $val['id']?>">Sửa</a></td>
                    <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders/del_detail/<?php echo $order['id']?>/<?php echo $val['id']?>">Xóa</a></td>
                </tr>
            <?php
                }
            ?>
                <tr>
                    <th colspan="3" style="text-align: right;">Tổng tiền</th>
                    <th colspan="3" class="text-success" style="text-align: left;"><?php echo number_format($total)?> VNĐ</th>
                </tr>
            <?php
            }else{
            ?>
                <tr>
                    <td colspan="6">Không tìm thấy sản phẩm nào trong hóa đơn này.</td>
                </tr>
            <?php
            }
            ?>
            </table>
        </div>
    </div>
</div>
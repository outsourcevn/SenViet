
<!--Start Main Content-->
<div class="main-content">
    <div class="container"><br /><br />
        <div class="panel panel-success">
            <div class="panel-heading"><strong>YOUR PAYMENT WAS SUCCESSFUL</strong></div>
            <div class="panel-body text-center">
                YOUR ORDER #<?php printf('%010d', $order_id);?> has saved.<br />
                Thank you for using our services.<br />
                You can check your order status <a href="checkout/order/<?php echo $order_id;?>">here</a> ( Remember this link ).
            </div>
        </div>
    </div>     
</div>
<!--End Main Content-->

<style>
    table.table tr th, table.table tr td{
        text-align: center;
    }
</style>

<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">

    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/contacts">Liên Hệ</a></li>
        <li class="active"><?php echo $post_data->title;?></li>
    </ol>
    <div class="col-lg-12">
        <?php
        echo form_open('', array('method' => 'POST'));
        ?>
        <div class="col-lg-3 text-left">
            <a href="<?php echo (isset($_GET['redir']) ? base64_decode($_GET['redir']) : CMS_DEFAULT_BACKEND_URL.'/contacts/')?>" class="btn btn-default">&laquo; Back</a>
        </div>
        <div class="col-lg-9 text-right">
            <button name="cmd" type="submit" value="viewed" class="btn btn-success">Đánh dấu đã xem</button>
            <button name="cmd" type="submit" value="unview" class="btn btn-warning">Đánh dấu chưa xem</button>
        </div>
        </form>
    </div>
    <div class="clearfix"></div>

    <br />
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Message Detail</h3>
        </div>

        <blockquote class="bg-warning hidden">
            <ul class="errors">
                <li>Error Trong quá trình nhập dữ liệu.</li>
            </ul>
        </blockquote>

        <div class="panel-body">
            <div class="col-md-6">
                <div class="col-md-3"><strong>Họ tên</strong></div>
                <div class="col-md-9">
                    <div class="col-sm-12 payment-info" id="first_name"><?php echo $post_data->full_name;?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-3"><strong>Số điện thoại</strong></div>
                <div class="col-md-9">
                    <div class="col-sm-12 payment-info" id="tel"><?php echo $post_data->tel;?></div>
                </div>
            </div>
            <br /><br />
            <div class="col-md-6">
                <div class="col-md-3"><strong>Email</strong></div>
                <div class="col-md-9">
                    <div class="col-sm-12 payment-info" id="email"><?php echo $post_data->email;?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="col-md-3"><strong>Trạng thái</strong></div>
                <div class="col-md-9">
                    <div class="col-md-12"><?php
                        if(isset($post_data->seen)){
                            if($post_data->seen == 1){
                                echo '<strong><p class="text-success">Đã xem</p></strong>';
                            } else {
                                echo '<strong><p class="text-muted">Chưa xem</p></strong>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <div class="col-md-6">
                <div class="col-md-3"><strong>Tiêu đề</strong></div>
                <div class="col-md-9">
                    <div class="col-sm-12"><?php echo strip_tags($post_data->title)?></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br />
            <br />
            <div class="col-md-12" style="padding: 0px 30px;">
                <?php echo $post_data->content;?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div><br />
</div>
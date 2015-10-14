<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row"></div>
            <div class="col-lg-9 row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                    <li><a href="/tro-giup/"><i>Trợ giúp</i></a></li>
                    <li class="active"><i>Quy Trình - Biểu Mẫu</i></li>
                </ol>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <div class="panel-left">
                    <div class="left-panel-heading">Trợ giúp khác</div>
                    <div class="panel-left-body">
                        <ul class="left-panel-contain">
                            <li><a href="/tro-giup/hoi-dap-thuong-gap">Hỏi đáp thường gặp</a></li>
                            <li><a href="/tro-giup/huong-dan-dang-ky">Hướng dẫn đăng ký</a></li>
                            <li class="active"><a href="/tro-giup/quy-trinh-bieu-mau">Quy trình - biểu mẫu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 main-content-container">
<!--                <h3 class="news-container-heading">Quy Trình - Biểu Mẫu</h3>-->
                <div class="main-content col-md-12">
                    <?php if(isset($sheet_data) && count($sheet_data) > 0):?>
                        <table style="width: 100%; margin: 5px auto; padding: 0px 5px;" class="table table-bordered table-hover">
                            <tr>
                                <th style="text-align: center;">Tên Tập Tin</th>
                                <th style="text-align: center;">Kích thước</th>
                                <th style="text-align: center;">Lượt tải về</th>
                                <th style="text-align: center;">Lượt sửa</th>
                                <th style="text-align: center;">Tải xuống</th>
                            </tr>
                            <?php foreach($sheet_data as $_sheet):
                                $_sheet->link = urldecode($_sheet->link);
                                $workFolder = getcwd();
                                if(file_exists($workFolder.$_sheet->link)):
                                ?>

                            <tr>
                                <td style="text-align: center;"><?php echo $_sheet->file_name;?></td>
                                <td style="text-align: center;"><?php echo number_format(filesize($workFolder.$_sheet->link)/1024);?> KB</td>
                                <td style="text-align: center;"><?php echo $_sheet->update_times;?></td>
                                <td style="text-align: center;"><?php echo $_sheet->downloaded_times;?></td>
                                <td style="text-align: center;"><a href="/tro-giup/quy-trinh-bieu-mau/?id=<?php echo $_sheet->id;?>"><span class="glyphicon glyphicon-cloud-download" style="color: #ffa84d;"></span></a></td>
                            </tr>
                            <?php endif; endforeach;?>
                        </table>
                    <?php else :?>
                        <p class="text-center">Hiện tại chưa có dữ liệu trong mục này.</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
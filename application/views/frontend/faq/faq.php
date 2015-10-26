<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <div class="panel-left">
                    <div class="left-panel-heading">Trợ giúp khác</div>
                    <div class="panel-left-body">
                        <ul class="left-panel-contain">
                            <li class="active"><a href="/tro-giup/hoi-dap-thuong-gap">Hỏi đáp thường gặp</a></li>
                            <li><a href="/tro-giup/huong-dan-dang-ky">Hướng dẫn đăng ký</a></li>
                            <li><a href="/tro-giup/quy-trinh-bieu-mau">Quy trình - biểu mẫu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 main-content-container">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                    <li><a href="/tro-giup/"><i>Trợ giúp</i></a></li>
                    <li class="active"><i>Hỏi đáp thường gặp</i></li>
                </ol>
<!--                <h3 class="news-container-heading">Câu hỏi thường gặp</h3>-->
                <div class="main-content col-md-12 row">
                    <?php if(isset($faq_data) && count($faq_data) > 0):?>
                    <ul class="faq-list">
                        <?php foreach($faq_data as $_faq):?>
                        <li id="faq-<?php echo $_faq->id;?>">
                            <div class="col-lg-12 faq-question" data-for="answer-<?php echo $_faq->id;?>">
                                <span class="icon-question"></span> <strong><?php echo $_faq->question;?></strong> <span class="glyphicon glyphicon-chevron-right"></span>
                            </div>

                            <div class="col-lg-12 faq-answer" id="answer-<?php echo $_faq->id;?>"><span class="icon-answer"></span> <?php echo $_faq->answer;?></div>
                            <div class="clearfix"></div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php else :?>
                        <p class="text-center">Hiện tại chưa có dữ liệu trong mục này.</p>
                    <?php endif;?>

                    <script>
                        $(document).ready(function(){
                            $('.faq-question').click(function(){
                                $('ul.faq-list .active').removeClass('active');

                                answerShowId = $(this).attr('data-for');
                                $('.faq-answer').slideUp();
                                if($('#'+answerShowId).css('display') != 'none'){
                                    $('#'+answerShowId).slideUp();
                                    $arrow = $(this).find('span.glyphicon.glyphicon-chevron-down');
                                    $($arrow).removeClass('glyphicon-chevron-down');
                                    $($arrow).addClass('glyphicon-chevron-right');
                                } else {
                                    $('ul.faq-list .active').removeClass('active');
                                    $(this).parent().addClass('active');
                                    $('#'+answerShowId).slideDown();
                                    $arrow = $(this).find('span.glyphicon.glyphicon-chevron-right');
                                    $($arrow).removeClass('glyphicon-chevron-right');
                                    $($arrow).addClass('glyphicon-chevron-down');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
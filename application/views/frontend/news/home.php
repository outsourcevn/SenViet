<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row"></div>
            <div class="col-lg-9 row">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb as $_item) :?>
                        <?php if($_item->id === 1):?>
                            <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                        <?php else:?>
                            <li><a href="<?php echo $_item->alias;?>"><i><?php echo $_item->title;?></i></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ol>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <div class="panel-left">
                    <?php if(is_array($list_left_category) && count($list_left_category) > 0) :?>
                    <div class="left-panel-heading">Tin Tức Khác</div>
                    <div class="panel-left-body">
                        <ul class="left-panel-contain">
                            <?php foreach($list_left_category as $_category):?>
                            <li class="<?php echo ($cur_category->id === $_category->id) ? 'active' : ''?>"><a href="<?php echo $_category->alias?>"><?php echo $_category->title?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-9 main-content-container">
                <h3 class="news-container-heading"><?php echo (isset($cur_category->title)) ? $cur_category->title : '-';?></h3>
                <div class="main-content col-md-12 row">
                    <?php if(is_array($list_post) && count($list_post) > 0) :
                            foreach($list_post as $_postitem):
                    ?>
                    <article class="col-md-6 post-item item">
                        <a href="<?php echo $_postitem->alias;?>.html" class="post-title"><h3><?php echo $_postitem->title;?></h3></a>
                        <div class="col-md-12 row text-justify">
                            <img class="pull-left" src="<?php echo $_postitem->thumbnail;?>" alt="<?php echo $_postitem->title;?>"/>
                            <div class="post-date">
                                <span class="glyphicon glyphicon-calendar"></span> <?php echo gmdate('H:i', strtotime($_postitem->created_date));?> | <?php echo gmdate('d/m/Y', strtotime($_postitem->created_date));?>
                            </div>

                            Kỷ niệm 20 năm Việt Nam gia nhập Hiệp hội các quốc gia loon ...
                            <a class="post-detail-link" href="<?php echo $_postitem->alias;?>.html">Xem tiêp</a>
                        </div>

                    </article>
                    <?php endforeach; else:?>
                        <p class="text-center">Hiện tại chưa có bài đăng nào trong mục này</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
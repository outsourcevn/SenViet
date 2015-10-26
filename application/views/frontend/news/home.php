<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <?php if(is_array($list_left_category) && count($list_left_category) > 0) :?>
                <div class="panel-left">
                    <div class="left-panel-heading">Tin Tức Khác</div>
                    <div class="panel-left-body">
                        <ul class="left-panel-contain">
                            <?php foreach($list_left_category as $_category):?>
                            <li class="<?php echo ($cur_category->id === $_category->id) ? 'active' : ''?>"><a href="<?php echo $_category->alias?>"><?php echo $_category->title?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php endif;?>
                <?php if(isset($featuredProducts) && is_array($featuredProducts) && count($featuredProducts) > 0) :?>
                <div class="panel-left">
                        <div class="left-panel-heading">Sản phẩm nổi bật</div>
                        <div class="panel-left-body">
                            <ul class="left-panel-contain featured-products">
                                <?php foreach($featuredProducts as $_product):
                                    $featuredImage = get_image_list($_product->id, true);
                                    ?>
                                    <li>
                                        <?php if(isset($featuredImage)) : ?>
                                        <a href="<?php echo "/san-pham/".$_product->alias?>.html"><img style="width: 100%" src="<?php echo urldecode($featuredImage->image_link);?>" alt="<?php echo $featuredImage->title?>"/></a>
                                    <?php endif;?>
                                        <a href="<?php echo "/san-pham/".$_product->alias?>.html"><?php echo $_product->title?></a>
                                        <div style="clear: both"></div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-lg-9 main-content-container">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb as $_item) :?>
                        <?php if($_item->id === 1):?>
                            <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                        <?php else:?>
                            <li><a href="<?php echo $_item->alias;?>"><i><?php echo $_item->title;?></i></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ol>
<!--                <h3 class="news-container-heading">--><?php //echo (isset($cur_category->title)) ? $cur_category->title : '-';?><!--</h3>-->
                <div class="main-content col-md-12">
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

                            <?php echo html_entity_decode($_postitem->description)?>
                            <a class="post-detail-link" href="<?php echo $_postitem->alias;?>.html">Xem tiêp</a>
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <?php endforeach; else:?>
                        <p class="text-center">Hiện tại chưa có bài đăng nào trong mục này</p>
                    <?php endif;?>
                </div>

                <div class="col-lg-12 text-center"><?php echo $pagination;?></div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 row">
                <div class="panel-left">
                    <?php if(isset($navLeft)) : ?>
                        <div class="left-panel-heading">Tin Tức Khác</div>
                        <div class="panel-left-body">
                            <?php echo $navLeft; ?>
                        </div>
                    <?php endif;?>
                </div>
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
                                            <a href="<?php echo "/san-pham/".$_product->alias?>.html"><img src="<?php echo urldecode($featuredImage->image_link);?>" alt="<?php echo $featuredImage->title?>"/></a>
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
                    <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                    <?php foreach($breadcrumb as $_item):?>
                        <li><a href="<?php echo $_item['href'];?>"><i><?php echo $_item['title'];?></i></a></li>
                    <?php endforeach;?>
                </ol>
<!--                <h3 class="news-container-heading">--><?php //echo $detail->title;?><!--</h3>-->
                <article class="col-md-12 item row">
                    <div class="col-md-12 row text-justify">
                        <div class="post-date">
                            <span class="glyphicon glyphicon-log-in"></span> <?php echo gmdate('H:i', strtotime($detail->start_time)+7*3600);?> | <?php echo gmdate('d/m/Y', strtotime($detail->start_time)+7*3600);?>
                            <span class="glyphicon glyphicon-log-out"></span> <?php echo gmdate('H:i', strtotime($detail->end_time)+7*3600);?> | <?php echo gmdate('d/m/Y', strtotime($detail->end_time)+7*3600);?>
                        </div>
                        <br/><br/>
                        <strong><?php //echo html_entity_decode($detail->description)?></strong>

                        <div class="post-content">
                            <?php echo html_entity_decode($detail->content);?>
                        </div>
                    </div>

                </article>
                <div class="clearfix"></div>
                <div class="social-links">
                    <div class="fb-like" data-share="true"></div>
                </div>

                <div class="fb-comments" data-href="<?php echo current_url();?>" data-width="100%" data-numposts="5"></div>
                <?php if(isset($relatedNews) && count($relatedNews) > 0) : ?>
                <div class="related-news">
                    <h3 class="related-news-heading">Tin tức liên quan</h3>
                    <ul>
                        <?php foreach($relatedNews as $_relatedNews): ?>
                            <li><span class="glyphicon glyphicon-play"></span> <a href="<?php echo $_relatedNews->alias;?>.html"><?php echo $_relatedNews->title;?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
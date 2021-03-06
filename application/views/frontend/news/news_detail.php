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
                    <?php foreach($breadcrumb as $_item) :?>
                        <?php if($_item->id === 1):?>
                            <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
                        <?php else:?>
                            <li><a href="<?php echo $_item->alias;?>"><i><?php echo $_item->title;?></i></a></li>
                        <?php endif;?>
                    <?php endforeach;?>
                    <li><a href="<?php echo $cur_news->alias;?>.html"><i><?php echo $cur_news->title;?></i></a></li>
                </ol>
<!--                <h3 class="news-container-heading">--><?php //echo $cur_news->title;?><!--</h3>-->
                <article class="col-md-12 item row">
                    <div class="col-md-12 row text-justify">
                        <div class="post-date">
                            <span class="glyphicon glyphicon-calendar"></span> <?php echo gmdate('H:i', strtotime($cur_news->created_date));?> | <?php echo gmdate('d/m/Y', strtotime($cur_news->created_date));?>
                        </div>
                        <br/><br/>
                        <strong><?php echo html_entity_decode($cur_news->description)?></strong>

                        <div class="post-content">
                            <?php echo html_entity_decode($cur_news->content);?>
                        </div>
                    </div>

                </article>
                <div class="clearfix"></div>
                <?php if($cur_news->fb_share_like == 1): ?>
                    <div class="social-links">
                        <div class="fb-like" data-share="true"></div>
                    </div>
                <?php endif;?>

                <?php if($cur_news->fb_comment == 1): ?>
                    <div class="fb-comments" data-href="<?php echo current_url();?>" data-width="100%" data-numposts="5"></div>
                <?php endif;?>
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
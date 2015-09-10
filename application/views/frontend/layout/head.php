<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($configuration->meta_title) ? $configuration->meta_title : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo ($configuration->meta_description) ? $configuration->meta_description : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group'?>">
    <meta name="keywords" content="<?php echo ($configuration->meta_keyword) ? $configuration->meta_keyword : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group'?>">
    <meta name="author" content="minhducck">

    <base href="<?php echo base_url();?>"/>
    
    <!--Jquer-->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script type="text/javascript" src="js/fixedScroll.js"></script>
    <!--/Jquer-->

    <!--Bootstrap-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <!--/Bootstrap-->

    <!--Custom Css-->
    <link rel="stylesheet" href="css/style_new.css" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <!--/Custom Css-->

    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.fixedContent').fixedScroll();

            jQuery('#product-slider').carouFredSel({
                responsive: true,
                width: '100%',
                scroll: 2,
                prev : '#prev',
                next : '#next',
                items: {
                    width: 200,
                    //	height: '30%',	//	optionally resize item-height
                    visible: {
                        min: 2,
                        max: 6
                    }
                }
            });

            jQuery('nav .main-nav li li').hover(
                function(){
                    var parentNode = jQuery(this).parent().parent();

                    jQuery(parentNode).css({'background-color': '#9ece0d'});
                    jQuery(parentNode).children('a').css('color', '#0c6902');
                },
                function(){
                    var parentNode = jQuery(this).parent().parent();

                    jQuery(parentNode).removeAttr('style');
                    jQuery(parentNode).children('a').removeAttr('style');
                }
            );

            var activeNav = '.<?php echo $active_nav;?>';

            jQuery(activeNav).addClass('active');
        });
    </script>
</head>
<body>
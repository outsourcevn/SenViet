<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo (isset($seo['title']) ? ($seo['title'] . ' - ') : "") ;echo ($configuration->meta_title) ? $configuration->meta_title : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group';?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo (isset($seo['description']) ? ($seo['description'] . ' - ') : "") ;echo ($configuration->meta_description) ? $configuration->meta_description : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group'?>">
    <meta name="keywords" content="<?php echo (isset($seo['keywords']) ? ($seo['keywords'] . ', ') : "") ;echo ($configuration->meta_keyword) ? $configuration->meta_keyword : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group'?>">
    <meta name="author" content="minhducck">

    <!--For openGraph Facebook-->
    <meta property="og:url" content="<?php echo current_url();?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo (isset($seo['title']) ? ($seo['title'] . ' - ') : "") ;echo ($configuration->meta_title) ? $configuration->meta_title : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group';?>" />
    <meta property="og:description"   content="<?php echo (isset($seo['description']) ? ($seo['description'] . ' - ') : "") ;echo ($configuration->meta_description) ? $configuration->meta_description : 'Công ty cổ phần ĐT SX &amp; TM Sen Việt Group'?>" />
    <?php if(isset($seo['og_image'])) echo '<meta property="og:image" content="'.$seo['og_image'].'"/>';?>

    <base href="<?php echo base_url();?>"/>
    <!--Facebook SDK-->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '<?php echo isset($configuration->fb_app_id)? $configuration->fb_app_id : '1492390527753008'?>',
                xfbml      : true,
                version    : 'v2.4'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="/library/fullCalendar/lib/moment.min.js"></script>
    <!--Jquer-->
    <script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script type="text/javascript" src="/js/fixedScroll.js"></script>
    <script type="text/javascript" src="/js/imgLiquid-min.js"></script>
    <!--/Jquer-->

    <!--FullCalendar-->
    <script type="text/javascript" src="/library/fullCalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="/library/fullCalendar/lang-all.js"></script>
    <link rel="stylesheet" href="/library/fullCalendar/fullcalendar.css" type="text/css"/>
    <link rel="stylesheet" href="/library/fullCalendar/fullcalendar.print.css"  media='print' type="text/css"/>
    <!--/FullCalendar-->

    <!--Bootstrap-->
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
    <!--/Bootstrap-->

    <!--Custom Css-->
    <link rel="stylesheet" href="/css/style_new.css" type="text/css"/>
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
<!DOCTYPE HTML>
<html>
<head>
	<meta name="author" content="minhducck" />
    <meta charset="utf-8" />
    <meta name="author" content="Ta Minh Duc" />
    <meta name="description" content="<?php echo (isset($seo['meta_description']) ? $seo['meta_description'] : '')?>" />
    <meta name="keywords" content="<?php echo (isset($seo['meta_keywords']) ? $seo['meta_keywords'] : '')?>" />
    
    <base href="http://senviet.vn" />
	<title><?php echo (isset($seo['title']) ? $seo['title'] : '') ?></title>
    
    <!--Jquery-->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <!--Bootstrap-->
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
    <script src="js/bootstrap.js"></script>
    
    <!--Owl.Carousel-->
    <script src="js/owl/owl.carousel.js"></script>
    <link rel="stylesheet" href="js/owl/assets/owl.carousel.css"/>
</head>
<body>
<!--Start Main Content-->
<script>
    $(document).ready(function(){
        panel_height = $('.panel-info').height();
        document_height = $(document).height();
        
         $('.panel-info').css('margin-top', 50);
    })
</script>
<div class="main-content">
    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Cáo lỗi</h3>
            </div>
            <div class="panel-body">
                <?php echo html_entity_decode($configs->maintain_message)?>
            </div>
        </div>
    </div>     
</div>
<!--End Main Content-->
</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="minhducck"/>
    <meta charset="utf-8" />
    <base href="<?php echo base_url()?>" />
	<title>Quản trị</title>
    
    <!--Jquery-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!--DatePicker-->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <!--Bootstrap-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    
    <!--Custom Style-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    
    <!--CKEditor-->
    <script type="text/javascript" src="library/ckeditor/ckeditor.js"></script>
    <!--CKFinder-->
    <script type="text/javascript" src="library/ckfinder/ckfinder.js"></script>
    
    <!--Chart-->
    <script type="text/javascript" src="library/Chart/chart.js"></script>
    
    <!--Backend Common Function-->
    <script type="text/javascript" src="js/common_backend_function.js"></script>
    <script>
        $(document).ready(function(){
            $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("active");
            });
        });
    </script>
</head>

<body>
    <div class="" id="wrapper">
    
    <!-- Sidebar -->
    <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="sidebar_menu">
                <li class="sidebar-brand"><a href="#" id="menu-toggle">Menu<span class="glyphicon glyphicon-align-justify" id="main_icon"></span></a></li>
            </ul>
            <ul id="sidebar" class="sidebar-nav">
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs">Cấu Hình<span class="sub_icon glyphicon glyphicon-cog"></span></a>
                    <ul>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs/index">Configs</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs/permlist">Permission</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/slide">Slide<span class="sub_icon glyphicon glyphicon-file"></span></a>
                </li>
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user">Tài Khoản<span class="sub_icon glyphicon glyphicon-user"></span></a>
                    <ul>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user/usergroup">Nhóm người dùng</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user/add_group">Thêm nhóm</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user">Người sử dụng</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user/add">Thêm user</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products">Sản phẩm<span class="sub_icon glyphicon glyphicon-shopping-cart"></span></a>
                    <ul>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/brand">Thương Hiệu</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/category">Danh Mục</a></li>
                        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products">Sản Phẩm</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/images">Images<span class="sub_icon glyphicon glyphicon-camera"></span></a>
                </li>
                
                <li>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders">Orders<span class="sub_icon glyphicon glyphicon-usd"></span></a>
                </li>
                
                <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/reports">Reports<span class="sub_icon glyphicon glyphicon-calendar"></span></a></li>
            </ul>
        </div>
    
    <!-- Page content -->
        <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="backend-navbar">
                            <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/auth/logout">Đăng Xuất <span class="glyphicon glyphicon-log-out"></span></a></li>
                            <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user/info">Thông tin tài khoản <span class="glyphicon glyphicon-info-sign"></span></a></li>
                            <li>Xin Chào, <strong><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user/info"><?php echo (isset($auth['fullname']) ? $auth['fullname']: $auth['username'])?></a></strong></li>
                        </ul>
                        
                        <div class="clearfix"></div>
                    </div>
                    <?php
                        $this->load->view((isset($tpl))? $tpl : '', (isset($data))? $data : NULL);
                    ?>
                    <div class="col-lg-12 text-center" style="position: fixed; z-index:10000; bottom: 0px; background: #222; color:#999999; padding : 3px;">
                        Created by minhducck
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    
</body>
</html>
<!--Navigation For mobile-->
<nav class="navbar navbar-default navbar-static-top hidden-lg">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo base_url();?>" class="navbar-brand">Sen Việt Group</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="nav_home"><a href="<?php echo base_url()?>">Trang chủ</a></li>
                <li class="nav_introduce"><a href="/gioi-thieu/">Giới thiệu</a></li>
                <li class="nav_news"><a href="/tin-tuc/">Tin tức</a></li>
                <li class="nav_product"><a href="/san-pham/">Sản phẩm</a></li>
                <li class="nav_training"><a href="/dao-tao/">Đào Tạo</a></li>
                <li class="nav_department"><a href="/chi-nhanh/">Chi nhánh</a></li>
                <li class="nav_npp"><a href="/thong-tin-npp/">Thông tin NPP</a></li>
                <li class="nav_faq"><a href="/tro-giup/">Trợ giúp</a></li>
                <li class="nav_contact"><a href="/lien-he/">Liên hệ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://dangnhap.senvietgroup.vn/" target="_blank">Đăng Nhập</a></li>
                <li>
                    <div id="search-mobile" class="text-center">
                        <form name="nav-search" method="GET" action="./">
                            <input name="keyword" type="text" placeholder="Tìm kiếm..." />
                        </form>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<!--Navigation For mobile-->
<header>
    <div class="container">
        <!--Banner-->
        <div class="main-banner pull-left col-lg-11">
            <a href="<?php echo base_url();?>" title="Công ty cổ phần ĐT SX &amp; TM Sen Việt Group"><img src="images/banner.png" alt="Công ty cổ phần ĐT SX &amp; TM Sen Việt Group"/></a>
        </div>
        <!--/Banner-->

        <!--Login Area-->
        <div class="login-dialog pull-right hidden-sm hidden-xs col-lg-1">
            <a href="//dangnhap.senvietgroup.vn" target="_blank">
                <button class="btn btn-success" type="button" name="login-btn">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp; &nbsp;&nbsp;Đăng nhập&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </a>
        </div>
        <!--/Login Area-->
        <div class="clearfix"></div>
    </div>
</header>

<nav class="fixedContent">
    <div class="container">
        <ul class="pull-left main-nav">
            <li  class="nav_home"><a href="<?php echo base_url()?>">Trang chủ</a></li>
            <li class="nav_introduce">
                <a href="/gioi-thieu/">Giới thiệu</a>
                <?php echo genIntroduceNavItem();?>
            </li>
            <li class="nav_news">
                <a href="/tin-tuc/">Tin tức</a>
                <?php echo genNewsNavItem();?>
            </li>
            <li class="nav_product">
                <a href="/san-pham/">Sản phẩm</a>
                <?php echo genProductCategoryNav();?>
            </li>
            <li class="nav_training">
                <a href="/dao-tao/">Đào Tạo</a>
                <?php echo genTrainingNavItem();?>
            </li>
            <li class="nav_department">
                <a href="/chi-nhanh/">Chi nhánh</a>
                <?php echo getDepartmentNavItem()?>
            </li>
            <li class="nav_npp">
                <a href="/thong-tin-npp/">Thông tin NPP</a>
                <?php echo genNppNavItem();?>
            </li>
            <li class="nav_faq">
                <a href="/tro-giup/">Trợ giúp</a>
                <ul>
                    <li class="subItems"><a href="/tro-giup/hoi-dap-thuong-gap">Hỏi - đáp thường gặp</a></li>
                    <li class="subItems"><a href="/tro-giup/huong-dan-dang-ky/">Hướng dẫn đăng ký</a></li>
                    <li class="subItems"><a href="/tro-giup/quy-trinh-bieu-mau/">Quy trình - biểu mẫu</a></li>
                </ul>
            </li>
            <li class="nav_contact"><a href="/lien-he/">Liên hệ</a></li>
        </ul>

        <div id="search-box" class="pull-right">
            <form name="nav-search" method="GET" action="./">
                <input name="keyword" type="text" placeholder="Tìm kiếm..." />
            </form>
        </div>
        <div class="clearfix" style="clear: both;"></div>
    </div>
</nav>
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
                <li class="nav_news"><a href="#">Tin tức</a></li>
                <li class="nav_product"><a href="#">Sản phẩm</a></li>
                <li class="nav_training"><a href="/dao-tao/">Đào Tạo</a></li>
                <li class="nav_department"><a href="#">Chi nhánh</a></li>
                <li class="nav_npp"><a href="#">Thông tin NPP</a></li>
                <li class="nav_faq"><a href="#">Trợ giúp</a></li>
                <li class="nav_contact"><a href="/lien-he/">Liên hệ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://login.senvietgroup.vn/">Login</a></li>
                <li><a href="http://senvietgroup.vn/">Register</a></li>
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
            <button class="btn btn-success" type="button" name="login-btn" onclick="location.href='http://login.senvietgroup.vn'">&nbsp;&nbsp;<i class="fa fa-key"></i>&nbsp;&nbsp; Login &nbsp;&nbsp;</button>
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
                <a href="#">Sản phẩm</a>
                <ul>
                    <li class="subItems"><a href="#">Sản phẩm chức năng</a></li>
                    <li class="subItems"><a href="#">Mỹ phẩm</a></li>
                    <li class="subItems"><a href="#">Hàng tiêu dùng</a></li>
                </ul>
            </li>
            <li class="nav_training">
                <a href="/dao-tao/">Đào Tạo</a>
                <?php echo genTrainingNavItem();?>
            </li>
            <li class="nav_department">
                <a href="#">Chi nhánh</a>
                <ul>
                    <li class="subItems"><a href="#">Chi nhánh miền Bắc</a></li>
                    <li class="subItems"><a href="#">Chi nhánh miền Trung</a></li>
                    <li class="subItems"><a href="#">Chi nhánh miền Nam</a></li>
                </ul>
            </li>
            <li class="nav_npp">
                <a href="#">Thông tin NPP</a>
                <ul>
                    <li class="subItems"><a href="#">Lịch sự kiện NPP</a></li>
                    <li class="subItems"><a href="#">Danh hiệu NPP</a></li>
                    <li class="subItems"><a href="#">QL thành công chia</a></li>
                    <li class="subItems"><a href="#">CLB Sen Việt</a></li>
                    <li class="subItems"><a href="#">Hình ảnh</a></li>
                </ul>
            </li>
            <li class="nav_faq"><a href="#">Trợ giúp</a></li>
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
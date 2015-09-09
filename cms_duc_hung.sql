-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2015 at 03:53 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms_duc_hung`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_brand`
--

CREATE TABLE IF NOT EXISTS `cms_brand` (
`id` int(11) NOT NULL,
  `brand_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `userid_created` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_brand`
--

INSERT INTO `cms_brand` (`id`, `brand_name`, `userid_created`, `created_date`, `updated_date`, `publish`) VALUES
(1, 'Apple', 1, '2015-03-12 11:30:26', '2015-03-12 16:49:24', 1),
(2, 'Samsung', 1, '2015-03-12 11:30:26', '2015-03-12 11:30:26', 1),
(3, 'Apple 3', 1, '2015-03-12 02:28:34', '2015-03-12 03:14:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_category`
--

CREATE TABLE IF NOT EXISTS `cms_category` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `navigation` text COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `level` tinyint(4) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_category`
--

INSERT INTO `cms_category` (`id`, `title`, `alias`, `parentid`, `description`, `navigation`, `source`, `order`, `level`, `lft`, `rgt`, `image`, `publish`, `meta_title`, `meta_keywords`, `meta_description`, `userid_created`, `userid_updated`, `created_date`, `updated_date`) VALUES
(1, 'HOME', 'HOME', 0, '', '', '', 0, 1, 2, 23, '', 0, '', '', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Smart phones', 'smart-phones', 1, '<p>Smart phones</p>\r\n', '', '', 0, 2, 7, 20, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:16', '2015-03-12 09:43:16'),
(11, 'Main stream', 'main-stream', 10, '<p>Main Stream</p>\r\n', '', '', 0, 3, 8, 15, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:16', '2015-03-12 10:24:06'),
(9, 'Sales', 'featured-phones/sales', 8, '&lt;p&gt;featured-phones-sales&lt;/p&gt;\r\n', '', '', 0, 3, 4, 5, '', 1, '', '', '', 0, 0, '0000-00-00 00:00:00', '2015-03-26 10:15:03'),
(8, 'Featured phones', 'featured-phones', 1, '&lt;p&gt;Featured phones&lt;/p&gt;\r\n', '', '', 0, 2, 3, 6, '', 1, '', '', '', 0, 0, '0000-00-00 00:00:00', '2015-03-15 19:26:32'),
(12, 'Android', 'main-stream-android', 11, '<p>Android</p>\r\n', '', '', 0, 4, 9, 10, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:43', '2015-03-12 09:44:47'),
(13, 'iOs', 'main-stream-ios', 11, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis</p>\r\n', '', '', 0, 4, 11, 12, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:43', '2015-03-12 09:52:28'),
(14, 'Others', 'main-stream-others', 11, '<p>Others</p>\r\n', '', '', 0, 4, 13, 14, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:43', '2015-03-12 09:46:43'),
(15, 'Luxury', 'luxury', 10, '&lt;p&gt;Luxury&lt;/p&gt;\r\n', '', '', 0, 3, 16, 17, '', 1, '', '', '', 1, 0, '2015-03-12 09:43:16', '2015-03-13 08:44:33'),
(16, 'Sales', 'smart-phones-sales', 10, '<p>SmartPhone Sales</p>\r\n', '', '', 0, 3, 18, 19, '', 1, '', '', '', 1, 0, '2015-03-12 09:48:46', '2015-03-12 09:48:46'),
(17, 'Accessories', 'accessories', 1, '<p>accessories</p>\r\n', '', '', 0, 2, 21, 22, '', 1, '', '', '', 1, 0, '2015-03-12 09:49:11', '2015-03-12 09:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `cms_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `cms_ci_sessions` (
  `session_id` text COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` text COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` text COLLATE utf8_unicode_ci NOT NULL,
  `user_data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_ci_sessions`
--

INSERT INTO `cms_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d116b663a03dae60164ab98e927162eb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '1427417672', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('f4f68d571b0c3a81370a4e4098451ed3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', '1427424320', 'a:3:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;s:13:"session_login";a:14:{s:2:"id";s:1:"1";s:8:"username";s:9:"minhducck";s:8:"password";s:40:"39f844a4a9b20c131e9d0ccd833ea3437751c562";s:5:"email";s:19:"minhducck@gmail.com";s:8:"fullname";s:16:"Tạ Minh Đức";s:4:"salt";s:20:"BLRnbAPlaqFRirwHXMxQ";s:9:"resetcode";s:20:"BOVOtxWYRcQGrPuVksFe";s:6:"active";s:1:"1";s:5:"token";s:20:"wuZBMvJbOuHlahHCELKH";s:12:"created_date";s:19:"2015-01-28 14:36:12";s:12:"updated_date";s:19:"2015-02-01 06:05:52";s:11:"usergroupid";s:1:"1";s:13:"usercreatedid";s:1:"0";s:13:"userupdatedid";s:1:"1";}}'),
('8de009b7fd48e0e8cd43e80931d28193', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', '1427673926', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('5465d5b934bdbf6390fee4ff1c4d1315', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', '1427692614', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('6922cef725574e0c18e5d3b20e7543ae', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0', '1427759860', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('c6d0616d8103e3113d76d0fd6c320fd6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', '1428415997', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('b361f85e4e685b98b525e31d8c541f6a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', '1428488742', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}'),
('1aa44d440877aa144d52771e81d305e2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', '1428633590', 'a:2:{s:9:"user_data";s:0:"";s:13:"session_login";a:14:{s:2:"id";s:1:"1";s:8:"username";s:9:"minhducck";s:8:"password";s:40:"39f844a4a9b20c131e9d0ccd833ea3437751c562";s:5:"email";s:19:"minhducck@gmail.com";s:8:"fullname";s:16:"Tạ Minh Đức";s:4:"salt";s:20:"BLRnbAPlaqFRirwHXMxQ";s:9:"resetcode";s:20:"BOVOtxWYRcQGrPuVksFe";s:6:"active";s:1:"1";s:5:"token";s:20:"UgyCikPAyvhRomppyJBH";s:12:"created_date";s:19:"2015-01-28 14:36:12";s:12:"updated_date";s:19:"2015-02-01 06:05:52";s:11:"usergroupid";s:1:"1";s:13:"usercreatedid";s:1:"0";s:13:"userupdatedid";s:1:"1";}}'),
('45ffa23c64d00a8c814f2713aef77a0f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', '1428969156', 'a:2:{s:9:"user_data";s:0:"";s:12:"showed_flash";i:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `cms_configs`
--

CREATE TABLE IF NOT EXISTS `cms_configs` (
  `homepage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8_unicode_ci NOT NULL,
  `perpage` int(11) NOT NULL DEFAULT '10',
  `is_active` tinyint(1) NOT NULL,
  `maintain_message` text COLLATE utf8_unicode_ci NOT NULL,
  `flash_message` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_configs`
--

INSERT INTO `cms_configs` (`homepage`, `meta_description`, `meta_keyword`, `meta_title`, `perpage`, `is_active`, `maintain_message`, `flash_message`) VALUES
('http://shoponline.local/', 'Bán hàng Online DESC', 'Bán hàng Online KEY', 'Bán hàng Online', 1, 1, '&lt;blockquote&gt;\r\n&lt;p&gt;M&amp;igrave;nh cũng chẳng biết n&amp;oacute;i g&amp;igrave; hơn nữa nhưng hiện tại website đang bảo tr&amp;igrave;&lt;br /&gt;\r\n&lt;br /&gt;\r\nQuay lại trong &amp;iacute;t ph&amp;uacute;t nh&amp;aacute; cưng&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n', '&lt;p&gt;Test Flash Message&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis&lt;/p&gt;\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `cms_images`
--

CREATE TABLE IF NOT EXISTS `cms_images` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_image` tinyint(1) NOT NULL DEFAULT '0',
  `FK_id` int(11) NOT NULL,
  `featured_images` tinyint(1) NOT NULL DEFAULT '0',
  `userid_created` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_images`
--

INSERT INTO `cms_images` (`id`, `title`, `image_link`, `main_image`, `FK_id`, `featured_images`, `userid_created`, `created_date`, `updated_date`) VALUES
(2, 'iPhone 5s', '/public/images/iphone-5s-16gb-1-400x533.png', 1, 2, 1, 1, '2015-03-21 20:29:56', '2015-03-21 20:29:56'),
(6, 'HTC One', '/public/images/htc-one(1).jpg', 1, 4, 0, 1, '2015-03-21 21:33:39', '2015-03-21 21:33:39'),
(12, 'Apple Iphone 5s', '/public/images/iphone-5s-16gb-1-400x533.png', 0, 2, 0, 1, '2015-03-23 07:29:12', '2015-03-23 07:29:12'),
(13, 'Iphone 6', '/public/images/maxresdefault.jpg', 1, 1, 1, 1, '2015-03-25 22:18:01', '2015-03-26 10:26:55'),
(14, 'Samsung Galaxy S6', '/public/images/Samsung-Galaxy-S6---the-best-renders-yet.jpg', 1, 3, 1, 1, '2015-03-26 10:34:23', '2015-03-26 10:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `cms_orders`
--

CREATE TABLE IF NOT EXISTS `cms_orders` (
`id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_viewed` tinyint(1) NOT NULL DEFAULT '0',
  `userid_created` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_orders`
--

INSERT INTO `cms_orders` (`id`, `first_name`, `last_name`, `address`, `phone`, `email`, `status`, `is_viewed`, `userid_created`, `created_date`, `updated_date`) VALUES
(2, 'Tạ', 'Đức', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis', '0978364071', 'minhducck@gmail.com', 0, 1, 0, '2015-03-25 19:05:41', '2015-03-26 04:43:37'),
(4, 'Luu', 'Hung', '12345678910', '0978364071', 'hung@gmail.com', 0, 1, 0, '2015-03-25 19:19:42', '2015-03-25 19:19:54'),
(5, 'Bui', 'Quyet', '15646546546546546', '0978364071', 'bqq@gmail.com', 2, 1, 0, '2015-03-25 19:23:28', '2015-03-25 22:14:48'),
(6, 'Ta', 'Dyc', 'lorrem ssssssss', '0978364071', 'minhducck@smartosc.com', 3, 1, 0, '2015-03-25 19:32:25', '2015-03-25 22:18:48'),
(7, 'Tạ Minh<br>', 'Đức', '[removed]alert&#40;1&#41;[removed]', '0978364071', 'minhducck@gmail.com', 0, 1, 0, '2015-03-26 02:30:04', '2015-03-26 02:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `cms_order_details`
--

CREATE TABLE IF NOT EXISTS `cms_order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_order_details`
--

INSERT INTO `cms_order_details` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(4, 3, 1, 26000000),
(4, 1, 5, 18300000),
(5, 3, 20, 26000000),
(5, 1, 5, 18300000),
(6, 3, 2, 26000000),
(6, 2, 1, 14900000),
(6, 1, 121, 18300000),
(7, 1, 100, 18300000),
(7, 2, 1, 14900000);

-- --------------------------------------------------------

--
-- Table structure for table `cms_permlist`
--

CREATE TABLE IF NOT EXISTS `cms_permlist` (
`id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `uri` text COLLATE utf8_unicode_ci NOT NULL,
  `group` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_permlist`
--

INSERT INTO `cms_permlist` (`id`, `title`, `uri`, `group`) VALUES
(1, 'Đăng nhập quản trị', 'home/index', 'Common'),
(2, 'Cấu hình', 'configs/index', 'Configure'),
(3, 'Xem permission list', 'configs/permlist', 'Configure'),
(4, 'Thêm permission', 'configs/add_permlist', 'Configure'),
(5, 'Sửa permission', 'configs/edit_permlist', 'Configure'),
(6, 'Xóa permission', 'configs/del_permission', 'Configure'),
(7, 'Danh sách slide', 'slide/index', 'Slide Manager'),
(8, 'Thêm Slide', 'slide/add', 'Slide Manager'),
(9, 'Sửa Slide', 'slide/edit', 'Slide Manager'),
(10, 'Xóa Slide', 'slide/del', 'Slide Manager'),
(11, 'Quản trị nhóm người dùng', 'user/usergroup', 'Users Manager'),
(12, 'Thêm nhóm người dùng', 'user/add_group', 'Users Manager'),
(13, 'Sửa nhóm người dùng', 'user/editgroup', 'Users Manager'),
(14, 'Xóa nhóm người dùng', 'user/delgroup', 'Users Manager'),
(15, 'Quản trị người dùng', 'user/index', 'Users Manager'),
(16, 'Thêm người dùng', 'user/add', 'Users Manager'),
(17, 'Sửa người dùng', 'user/edit', 'Users Manager'),
(18, 'Thông tin tài khoản', 'user/info', 'Common'),
(19, 'Xóa tài khoản người dùng', 'user/del', 'Users Manager'),
(20, 'Quản trị hình ảnh', 'images/index', 'Images Manager'),
(21, 'Thêm hình ảnh', 'images/add', 'Images Manager'),
(22, 'Sửa hình ảnh', 'images/edit', 'Images Manager'),
(23, 'Xóa hình ảnh', 'images/del', 'Images Manager');

-- --------------------------------------------------------

--
-- Table structure for table `cms_products`
--

CREATE TABLE IF NOT EXISTS `cms_products` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `userid_created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_products`
--

INSERT INTO `cms_products` (`id`, `title`, `description`, `alias`, `brand_id`, `meta_description`, `meta_keyword`, `meta_title`, `status`, `publish`, `is_featured`, `order`, `price`, `sale_price`, `created_date`, `updated_date`, `userid_created`) VALUES
(1, 'Iphone 6', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis&lt;/p&gt;\r\n', 'iphone-6', 1, 'Iphone 6 ', '', 'Iphone Bá đạo', 1, 1, 1, 0, 19999000, 18300000, '2015-03-21 20:26:37', '2015-03-25 22:16:12', 1),
(2, 'iPhone 5s', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis&lt;/p&gt;\r\n', 'iphone-5s', 1, '', '', '', 1, 1, 1, 0, 15000000, 14900000, '2015-03-21 20:29:20', '2015-03-26 10:26:31', 1),
(3, 'Samsung Galaxy S6', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis&lt;/p&gt;\r\n\r\n &lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;/public/images/htc-one.jpg&quot;  /&gt;&lt;/p&gt;\r\n', 'samsung-galaxy-s6', 2, '', '', '', 1, 1, 0, 0, 26000000, 0, '2015-03-21 20:41:36', '2015-03-26 10:26:11', 1),
(4, 'HTC One', '&lt;h1&gt;H&amp;agrave;ng ngh&amp;igrave;n người đội mưa gi&amp;oacute; giải cứu nạn nh&amp;acirc;n vụ sập gi&amp;agrave;n gi&amp;aacute;o&lt;/h1&gt;\r\n\r\n&lt;h2&gt;D&amp;acirc;n tr&amp;iacute; Ngay từ đ&amp;ecirc;m qua 25/3, đ&amp;atilde; c&amp;oacute; khoảng hơn 1.000 người thuộc nhiều lực lượng cứu hộ của tỉnh H&amp;agrave; Tĩnh, c&amp;aacute;c nh&amp;agrave; thầu tham gia giải ph&amp;oacute;ng hiện trường, t&amp;igrave;m kiếm nạn nh&amp;acirc;n với hy vọng cứu th&amp;ecirc;m được c&amp;ocirc;ng nh&amp;acirc;n sống s&amp;oacute;t trong vụ sập gi&amp;agrave;n gi&amp;aacute;o.&lt;/h2&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;Những thiết bị hiện đại có sức giải phóng đống sắt thép đổ nát đã được đưa đến hiện trường&quot; src=&quot;http://dantri4.vcmedia.vn/7lXquCM9LuoeLdYfHNLONJ8bTPLCrd/Image/2015/03/z5-578ae.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;Những thiết bị hiện đại có sức giải phóng đống sắt thép đổ nát đã được đưa đến hiện trường&quot; src=&quot;http://dantri4.vcmedia.vn/7lXquCM9LuoeLdYfHNLONJ8bTPLCrd/Image/2015/03/vd6-578ae.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Những thiết bị hiện đại c&amp;oacute; sức giải ph&amp;oacute;ng đống sắt th&amp;eacute;p đổ n&amp;aacute;t đ&amp;atilde; được đưa đến hiện trường&lt;/p&gt;\r\n\r\n&lt;p&gt;[removed]alert(&amp;#39;Hello[removed]&lt;/p&gt;\r\n', 'htc-one/new', 3, '', '', '', 1, 1, 1, 0, 8000000, 0, '2015-03-21 21:03:12', '2015-03-26 10:26:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_product_cate`
--

CREATE TABLE IF NOT EXISTS `cms_product_cate` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_product_cate`
--

INSERT INTO `cms_product_cate` (`product_id`, `category_id`) VALUES
(1, 1),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(4, 1),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(3, 1),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(2, 8),
(2, 9),
(2, 13),
(2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `cms_slide`
--

CREATE TABLE IF NOT EXISTS `cms_slide` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_slide`
--

INSERT INTO `cms_slide` (`id`, `title`, `link`, `image_link`, `caption`, `created_date`, `updated_date`, `userid_created`, `order`, `publish`) VALUES
(20, 'IPhone 5s', 'http://shoponline.local/admin', '/public/images/Slider/maxresdefault.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis', '2015-03-21 14:14:53', '2015-03-21 14:45:32', 1, 1, 1),
(21, 'Quản trị', 'http://shoponline.local/admin', '/public/images/Slider/batllo-0853.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla nisl id nulla varius placerat ac eu diam. Fusce ornare mi ut elit rhoncus tincidunt. Suspendisse semper, orci at convallis luctus, sem ex mattis sapien, sed lobortis elit quam sit amet turpis. Sed sit amet orci et ipsum placerat cursus. Vivamus quis mi porttitor, commodo lectus non, vulputate dui. Praesent porta aliquam dui, sed porta est tempor ut. Morbi lobortis, mi ac convallis imperdiet, eros nibh viverra dui, mollis dapibus turpis', '2015-03-21 14:18:04', '2015-03-26 04:36:59', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_usergroup`
--

CREATE TABLE IF NOT EXISTS `cms_usergroup` (
`id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `permission_key` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_usergroup`
--

INSERT INTO `cms_usergroup` (`id`, `title`, `created_date`, `updated_date`, `userid_created`, `permission_key`, `status`) VALUES
(1, 'Administrator', '2015-02-02 08:10:23', '2015-03-17 05:50:04', 1, '["home\\/index","user\\/info","configs\\/index","configs\\/permlist","configs\\/add_permlist","configs\\/edit_permlist","configs\\/del_permission"]', 1),
(2, 'CTV', '2015-02-02 08:10:39', '2015-03-26 02:42:40', 1, '["home\\/index"]', 1),
(3, 'Member', '2015-02-02 08:11:15', '2015-02-02 08:11:15', 1, '["controller\\/user\\/info"]', 1),
(4, 'Test', '2015-03-26 02:44:14', '2015-03-26 02:44:14', 1, '["home\\/index","user\\/info"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_username`
--

CREATE TABLE IF NOT EXISTS `cms_username` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci,
  `salt` text COLLATE utf8_unicode_ci NOT NULL,
  `resetcode` text COLLATE utf8_unicode_ci,
  `active` tinyint(11) NOT NULL DEFAULT '1',
  `token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `usergroupid` int(11) NOT NULL,
  `usercreatedid` int(11) NOT NULL,
  `userupdatedid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_username`
--

INSERT INTO `cms_username` (`id`, `username`, `password`, `email`, `fullname`, `salt`, `resetcode`, `active`, `token`, `created_date`, `updated_date`, `usergroupid`, `usercreatedid`, `userupdatedid`) VALUES
(1, 'minhducck', '39f844a4a9b20c131e9d0ccd833ea3437751c562', 'minhducck@gmail.com', 'Tạ Minh Đức', 'BLRnbAPlaqFRirwHXMxQ', 'BOVOtxWYRcQGrPuVksFe', 1, 'UgyCikPAyvhRomppyJBH', '2015-01-28 14:36:12', '2015-02-01 06:05:52', 1, 0, 1),
(43, 'taduc', 'c4da2048cf6279eb42795af066bfc5eb3f82815d', '', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(47, 'taduc', 'RAND()', 'RAND()', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(51, '0.31758094049764884', '0.06121125916131889', '0.3533135050472929', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(52, '0.15334130558496462', '0.5127215483344361', '0.10358385565093146', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(53, '0.9932303260948792', '0.5258207270184725', '0.6494126875413699', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(54, '0.861471244004994', '0.432342346228978', '0.5772980298635532', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(55, '0.5298181739913469', '0.5111052584937823', '0.9660718012285157', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(56, '0.3502883029638681', '0.5271183387628927', '0.5847268156565044', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(57, '0.1602959811317697', '0.7048907845326613', '0.04356601000164264', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(58, '0.14285340918493775', '0.2323517801541386', '0.7331987039495248', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(59, '0.7674809133331114', '0.2584613675796067', '0.9898641286323444', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(60, '0.5700643766392622', '0.1128048217974648', '0.8538310098031825', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(61, '0.3419558930601514', '0.6721256009043433', '0.33476035607490723', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(62, '0.5436888398078167', '0.12434857257115521', '0.9906763741659712', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(63, '0.7107782733727044', '0.04411498461301903', '0.08824013368062687', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(64, '0.7080948061385144', '0.8235725032385183', '0.9935781285106932', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(65, '0.8851238031733072', '0.5665686834292195', '0.17747203835982087', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(66, '0.40617894884774364', '0.08689422261611952', '0.21593429727101168', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(67, '0.0531899408001359', '0.7078259202724564', '0.37955980969551933', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(68, '0.18678213859608597', '0.7456904889509924', '0.1681060597003494', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(69, '0.6076702816483288', '0.6698543957153842', '0.5262611643655796', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(70, '0.5701523204987424', '0.758551905638121', '0.08230259742802251', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(71, '0.25807178696437905', '0.6624044176772278', '0.5378067582266468', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(72, '0.4323466843295346', '0.7328516391411904', '0.36721817345099356', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(73, '0.42269130369898983', '0.5912705050700069', '0.6882786449867102', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(74, '0.4053858019461723', '0.3409728429661811', '0.48870683972603346', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(75, '0.20413501486567315', '0.37989278638725427', '0.2870589180728969', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(76, '0.6371200370016694', '0.3581603703630719', '0.8794417715439962', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(77, '0.4916098057214262', '0.3290045385519085', '0.17019330632890883', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(78, '0.8707055327209695', '0.490980795110558', '0.8427874081235261', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(79, '0.4841168881246046', '0.8170418560663628', '0.6328586466916452', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(80, '0.32591594320341566', '0.04735919558197185', '0.2590481790332572', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(81, '0.2397802418468336', '0.7012289936665715', '0.786804273526002', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(82, '0.8675140076014344', '0.6134556286162284', '0.46473615101048366', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(83, '0.9844631329034111', '0.24380353022720994', '0.26562828315946113', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(84, '0.3739823190253063', '0.07892576146770805', '0.2726818809962663', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(85, '0.5108050373483496', '0.26744062199018953', '0.8047880286395438', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(86, '0.7337814259657464', '0.05894857277995774', '0.09339861673619469', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(87, '0.31666327576773545', '0.5444160891179145', '0.7720906490200112', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(88, '0.0030988091631781395', '0.21640598235317132', '0.07273351500996716', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(89, '0.29610506100217354', '0.3239784439317681', '0.7315770673859651', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(90, '0.021776303669229433', '0.988818762813526', '0.8787649337935867', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(91, '0.9963622894104219', '0.5156603199575658', '0.5892147622902084', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(92, '0.5791503075316086', '0.9906953051599631', '0.21602563393863441', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(93, '0.7566624374656589', '0.3443449664342636', '0.4517375505079865', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(94, '0.2256528839707867', '0.7730517990636191', '0.18830037413938006', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(95, '0.6223465042396882', '0.5468314295139457', '0.8671176655843087', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(96, '0.6950940701133517', '0.874117384547477', '0.28530474313097515', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(97, '0.956360339146443', '0.9209979809084888', '0.73590891783676', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(98, '0.9165506771919789', '0.37502666318325945', '0.12548131507400545', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(99, '0.5023266165538939', '0.13518916828109806', '0.1689660224774536', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(100, '0.4392626382776188', '0.6894151546893782', '0.12928788934767982', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(101, '0.24233301285871586', '0.15413702293684428', '0.04368610684171888', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(102, '0.7560194961317065', '0.6490391908670209', '0.97713749667363', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(103, '0.9385699415007326', '0.7614372482164179', '0.9914764473135363', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(104, '0.6730705226520733', '0.3909233020534025', '0.9354049730444374', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(105, '0.24187329992826404', '0.25167487398877264', '0.532754500892716', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(106, '0.9087479132309071', '0.9454760942100324', '0.0011367620910860245', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(107, '0.16925555855897773', '0.8428675372552755', '0.7065710413330896', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(108, '0.004252625633266406', '0.9015500349007082', '0.49499232833738654', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(109, '0.23855950798705175', '0.05110564367017303', '0.5398497251233549', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(110, '0.5459317253399004', '0.11010948206308249', '0.9127522650293561', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(111, '0.23343290969117816', '0.4289077841014674', '0.4442402221674474', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(112, '0.93447778926648', '0.33966831056370245', '0.8949082157527173', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(113, '0.5252915960972119', '0.8241494585053525', '0.5448725349687715', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(114, '0.2519143300614453', '0.624954076134557', '0.3690274212220939', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(115, '0.9702749084404436', '0.7442923092695812', '0.8106368517602206', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(116, '0.820307361726004', '0.6696262840830034', '0.8872093659706501', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(117, '0.8249624761053943', '0.07883089136223392', '0.9192670592286317', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(118, '0.35984265279010186', '0.041412116998259085', '0.12753265735463487', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(119, '0.5134269665120421', '0.18453689122995073', '0.3824035873472724', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(120, '0.35840729378015485', '0.6448257375926019', '0.14890683735619004', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(121, '0.362998822110704', '0.049656769307010594', '0.15928741093658602', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(122, '0.6474667774955433', '0.7594716854016033', '0.8549581252550317', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(123, '0.9963756008039932', '0.41700365898851643', '0.09589152326424748', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(124, '0.228446670089333', '0.8545588113875676', '0.587454077403484', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(125, '0.417952313477129', '0.1417627633938219', '0.4549569072713674', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(126, '0.8494962769090163', '0.8826106934646244', '0.864564667329718', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(127, '0.674991286988362', '0.7812624636863009', '0.8813384882000633', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(128, '0.06290508067505908', '0.6705099695087503', '0.16383463625221945', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(129, '0.6797937673328386', '0.31031810707442287', '0.5122092641072434', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(130, '0.6300920300465934', '0.6138323886448819', '0.17888588381827425', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(131, '0.052932283890370545', '0.7280037987306749', '0.48122217271590806', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(132, '0.22209949812116056', '0.6668310031917235', '0.6678565523287808', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(133, '0.5413723946934309', '0.9357631075529038', '0.05469838441787137', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(134, '0.4662026301642904', '0.16691802830148306', '0.4359822817481889', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(135, '0.6791573545701405', '0.08783995833978053', '0.40172775872212624', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(136, '0.7451189493249347', '0.5204115011919397', '0.3667006887185394', NULL, 'owOtskFSNmWzmXpneMCf', NULL, 1, 'NjsRbOcZKRcBXCroQGcd', '2015-03-08 18:34:47', NULL, 2, 1, NULL),
(137, '&lt;script', '61ef3f6721b37c298cb555d87772216d5a2fc4c3', 'minhducck@smartosc.com', NULL, 'bYEdetNNfENtbsOGpKrR', NULL, 1, NULL, '2015-03-12 16:20:56', NULL, 2, 1, NULL),
(138, 'minhducck2', '625f4bfc88909bc186b9d982482d792017a176da', 'minhducck3@smartosc.com', '32', 'XhfhbDrDUjpJydbgJKNp', NULL, 1, 'JWmXPzqdsajBOpqqrOul', '2015-03-17 05:49:38', NULL, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_brand`
--
ALTER TABLE `cms_brand`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_category`
--
ALTER TABLE `cms_category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `alias` (`alias`);

--
-- Indexes for table `cms_images`
--
ALTER TABLE `cms_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_orders`
--
ALTER TABLE `cms_orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_permlist`
--
ALTER TABLE `cms_permlist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_products`
--
ALTER TABLE `cms_products`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `alias` (`alias`);

--
-- Indexes for table `cms_slide`
--
ALTER TABLE `cms_slide`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_usergroup`
--
ALTER TABLE `cms_usergroup`
 ADD PRIMARY KEY (`id`,`title`);

--
-- Indexes for table `cms_username`
--
ALTER TABLE `cms_username`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_brand`
--
ALTER TABLE `cms_brand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_category`
--
ALTER TABLE `cms_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `cms_images`
--
ALTER TABLE `cms_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cms_orders`
--
ALTER TABLE `cms_orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cms_permlist`
--
ALTER TABLE `cms_permlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cms_products`
--
ALTER TABLE `cms_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cms_slide`
--
ALTER TABLE `cms_slide`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `cms_usergroup`
--
ALTER TABLE `cms_usergroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cms_username`
--
ALTER TABLE `cms_username`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=139;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

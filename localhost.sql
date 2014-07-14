-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-04-15 14:00:31
-- 服务器版本： 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shuxiuclothes`
--

-- --------------------------------------------------------

--
-- 表的结构 `sx_accessory_type`
--

CREATE TABLE IF NOT EXISTS `sx_accessory_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `sx_accessory_type`
--

INSERT INTO `sx_accessory_type` (`id`, `type`) VALUES
(1, '鞋子'),
(2, '领带'),
(3, '领结'),
(4, '衬衣'),
(5, '正装');

-- --------------------------------------------------------

--
-- 表的结构 `sx_admin_user`
--

CREATE TABLE IF NOT EXISTS `sx_admin_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL DEFAULT '1',
  `user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `logintime` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `sx_admin_user`
--

INSERT INTO `sx_admin_user` (`id`, `gid`, `user`, `password`, `logintime`, `ip`, `status`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1397314707, '::1', 1),
(7, 1, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 1390664311, '127.0.0.1', 1),
(8, 2, 'we', 'ff1ccf57e98c817df1efcd9fe44a8aeb', 1397312430, '::1', 1),
(9, 3, 're', '12eccbdd9b32918131341f38907cbbb5', 1397312653, '::1', 0),
(10, 2, 'qw', '006d2143154327a64d86a264aea225f3', 1397314722, '::1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sx_category`
--

CREATE TABLE IF NOT EXISTS `sx_category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT '0' COMMENT '父栏目id',
  `sequence` int(10) NOT NULL DEFAULT '0',
  `show` int(1) NOT NULL DEFAULT '1',
  `type` int(5) NOT NULL COMMENT '0:列表栏目；1：单页栏目',
  `name` varchar(250) NOT NULL,
  `tplname` varchar(100) NOT NULL DEFAULT 'list.html',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sx_category`
--

INSERT INTO `sx_category` (`cid`, `pid`, `sequence`, `show`, `type`, `name`, `tplname`) VALUES
(2, 0, 0, 1, 0, 'TEST', 'list.html'),
(3, 0, 0, 1, 1, 'TEST2', 'content2.html'),
(4, 0, 0, 1, 0, 'TEST2', 'list.html');

-- --------------------------------------------------------

--
-- 表的结构 `sx_clothes_accessory`
--

CREATE TABLE IF NOT EXISTS `sx_clothes_accessory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL COMMENT '0:衣服;1:配件',
  `accessory_type` int(10) DEFAULT '5' COMMENT '配件种类',
  `gender` tinyint(1) NOT NULL COMMENT '0:男;1:女',
  `price` varchar(250) NOT NULL DEFAULT '10',
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `total` int(5) NOT NULL DEFAULT '0',
  `sold` int(5) NOT NULL DEFAULT '0' COMMENT '已售出件数',
  `serial` varchar(60) DEFAULT NULL COMMENT '编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `sx_clothes_accessory`
--

INSERT INTO `sx_clothes_accessory` (`id`, `type`, `accessory_type`, `gender`, `price`, `description`, `status`, `total`, `sold`, `serial`) VALUES
(19, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(20, 1, 1, 1, '12', '配件', 1, 12, 0, '20143120011'),
(21, 0, 5, 0, '11111', 'sdasfasfasf', 1, 0, 0, NULL),
(22, 1, 1, 1, '1212', 'sddsds', 1, 0, 0, '112134234'),
(23, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(24, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(25, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(26, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(27, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212'),
(28, 0, 5, 0, '23', '测试', 1, 21, 0, '201403141212');

-- --------------------------------------------------------

--
-- 表的结构 `sx_clothes_accessory_image`
--

CREATE TABLE IF NOT EXISTS `sx_clothes_accessory_image` (
  `id` int(10) NOT NULL,
  `imgurl` varchar(250) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sx_clothes_accessory_image`
--

INSERT INTO `sx_clothes_accessory_image` (`id`, `imgurl`) VALUES
(19, '/2014/03/20/532a7c186c704.jpg'),
(20, '/2014/03/20/532a830fcb4f3.jpg'),
(21, '532a7c186c704.jpg'),
(22, '532a830fcb4f3.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `sx_color`
--

CREATE TABLE IF NOT EXISTS `sx_color` (
  `id` int(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sx_color`
--

INSERT INTO `sx_color` (`id`, `color`) VALUES
(19, '蓝色'),
(20, '黑色'),
(21, 'blue'),
(22, 'blue'),
(23, 'blue'),
(24, 'blue'),
(25, 'blue'),
(26, 'blue'),
(27, 'blue'),
(28, 'blue');

-- --------------------------------------------------------

--
-- 表的结构 `sx_content`
--

CREATE TABLE IF NOT EXISTS `sx_content` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text,
  `description` varchar(250) DEFAULT NULL,
  `show` int(1) NOT NULL DEFAULT '1',
  `updatetime` int(10) DEFAULT NULL,
  `inputtime` int(10) DEFAULT NULL,
  `sequence` int(10) NOT NULL DEFAULT '0',
  `tplname` varchar(100) NOT NULL DEFAULT 'content.html',
  `views` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `sx_content`
--

INSERT INTO `sx_content` (`aid`, `cid`, `title`, `content`, `description`, `show`, `updatetime`, `inputtime`, `sequence`, `tplname`, `views`) VALUES
(2, 2, 'TEST', '你好11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111\n11111111111111111111111111111111', NULL, 1, 1390650946, 1390650857, 0, 'content.html', 20),
(3, 3, 'SinglePage', 'asasasasasasasaa', NULL, 1, 1390653947, 1390653947, 0, 'content.html', 2),
(4, 2, 'TE', 'aaaaa', NULL, 1, 1390656015, 1390656015, 0, 'content.html', 0),
(5, 2, 'TE', 'aaaaa', NULL, 1, 1390656035, 1390656035, 0, 'content.html', 0),
(6, 2, 'TE2', 'aaaaa', NULL, 1, 1390661170, 1390661170, 0, 'content.html', 1),
(7, 2, 'TE3', '', NULL, 1, 1390661196, 1390661196, 0, 'content.html', 0),
(8, 2, 'TE3', '', NULL, 1, 1390661249, 1390661249, 0, 'content.html', 0),
(9, 2, 'TE3', '', NULL, 1, 1390661285, 1390661285, 0, 'content.html', 0),
(10, 2, 'TE3', '', NULL, 1, 1390663670, 1390663670, 0, 'content.html', 0),
(11, 2, 'TE3', '', NULL, 1, 1390664706, 1390664706, 0, 'content.html', 0),
(13, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../Public/upload/20140126/1390672334236115.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p&gt;aaa&lt;/p&gt;', NULL, 1, 1390675504, 1390675504, 0, 'content.html', 40),
(14, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../public/upload/20140126/1390672334236115.jpg\\&quot;/&gt;&lt;/p&gt;', NULL, 1, 1390678193, 1390678193, 0, 'content.html', 1),
(15, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../public/upload/20140126/1390678561112734.jpg\\&quot; title=\\&quot;KT板模版（创新创业展）.jpg\\&quot;/&gt;&lt;/p&gt;', NULL, 1, 1390678573, 1390678573, 0, 'content.html', 2),
(16, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../public/upload/20140126/1390678561112734.jpg\\&quot; title=\\&quot;KT板模版（创新创业展）.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;text-align: center', NULL, 1, 1390678634, 1390678634, 0, 'content.html', 3),
(17, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../public/upload/20140126/1390678561112734.jpg\\&quot; title=\\&quot;KT板模版（创新创业展）.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;text-align: center', NULL, 1, 1390678759, 1390678759, 0, 'content.html', 4),
(18, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/ueditor/php/../../public/upload/20140126/1390678561112734.jpg\\&quot; title=\\&quot;KT板模版（创新创业展）.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;text-align: center', NULL, 0, 1390678861, 1390678861, 1, 'content.html', 0),
(19, 2, 'UETest', '&lt;p&gt;&lt;img src=\\&quot;http:', NULL, 1, 1390679089, 1390679089, 0, 'content.html', 0),
(20, 2, 'UETest', '&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/public/upload/20140126/1390678561112734.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal; text-align: center;\\&quot;&gt;&lt;span style=\\&quot;font-size: 36px; color: rgb(255, 0, 0);\\&quot;&gt;测试&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', NULL, 1, 1390679661, 1390679661, 0, 'content.html', 3),
(21, 2, 'UETest', '&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;测试测试测试&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/public/upload/20140126/1390678561112734.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal; text-align: center;\\&quot;&gt;&lt;span style=\\&quot;font-size: 36px; color: rgb(255, 0, 0);\\&quot;&gt;测试&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', NULL, 1, 1390681549, 1390681549, 0, 'content.html', 1),
(22, 2, 'UETest', '&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;测试测试测试&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/public/upload/20140126/1390678561112734.jpg\\&quot;/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal; text-align: center;\\&quot;&gt;&lt;span style=\\&quot;font-size: 36px; color: rgb(255, 0, 0);\\&quot;&gt;测试&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;测试测试测试&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=\\&quot;white-space: normal;\\&quot;&gt;&lt;img src=\\&quot;http://localhost/shuxiu/Tpl/SPage/admin/publ', 1, 1390681651, 1390681651, 0, 'content.html', 1),
(23, 2, 'UETest', '&lt;p&gt;&lt;strong&gt;Flash视频测试&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;embed type=\\&quot;application/x-shockwave-flash\\&quot; class=\\&quot;edui-faked-video\\&quot; pluginspage=\\&quot;http://www.macromedia.com/go/getflashplayer\\&quot; src=\\&quot;http://player.youku.com/player.php/Type/Folder/Fid/21788418/Ob/1/sid/XNjY1NDU3MjU2/v.swf\\&quot; width=\\&quot;420\\&quot; height=\\&quot;280\\&quot; wmode=\\&quot;transparent\\&quot; play=\\&quot;true\\&quot; loop=\\&quot;false\\&quot; menu=\\&quot;false\\&quot; allowscriptaccess=\\&quot;never\\&quot; allowfullscreen=\\&quot;true\\&quot;/&gt;&lt;/p&gt;', '&lt;p&gt;&lt;strong&gt;Flash视频测试&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;embed type=\\&quot;application/x-shockwave-flash\\&quot; class=\\&quot;edui-faked-video\\&quot; pluginspage=\\&quot;http://www.macromedia.com/go/getflashplayer\\&quot; src=\\&quot;http://', 1, 1390682155, 1390682155, 0, 'content.html', 3);

-- --------------------------------------------------------

--
-- 表的结构 `sx_order`
--

CREATE TABLE IF NOT EXISTS `sx_order` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `complete` tinyint(2) NOT NULL DEFAULT '0',
  `uid` bigint(15) NOT NULL,
  `caid` int(10) NOT NULL,
  `casize` int(10) NOT NULL,
  `cacolor` int(10) NOT NULL,
  `price` varchar(250) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` int(10) NOT NULL,
  `from` int(10) NOT NULL,
  `end` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `sx_order`
--

INSERT INTO `sx_order` (`id`, `complete`, `uid`, `caid`, `casize`, `cacolor`, `price`, `ip`, `time`, `from`, `end`) VALUES
(13, 0, 7, 20, 1, 19, '35', '127.0.0.1', 1393596011, 1393596011, 1393597011),
(14, 0, 7, 20, 3, 19, '35', '127.0.0.1', 1393596224, 1393597011, 1393599011),
(15, 0, 7, 19, 21, 19, '222', '127.0.0.1', 1393596011, 1393596011, 1393996011);

-- --------------------------------------------------------

--
-- 表的结构 `sx_size`
--

CREATE TABLE IF NOT EXISTS `sx_size` (
  `id` int(10) NOT NULL,
  `size` varchar(20) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sx_size`
--

INSERT INTO `sx_size` (`id`, `size`) VALUES
(19, '160'),
(19, '175'),
(21, 'on'),
(21, 'on');

-- --------------------------------------------------------

--
-- 表的结构 `sx_slide`
--

CREATE TABLE IF NOT EXISTS `sx_slide` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `img` varchar(250) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `listorder` int(10) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sx_slide`
--

INSERT INTO `sx_slide` (`id`, `title`, `img`, `url`, `listorder`, `status`) VALUES
(1, 'hi.jpg', '/2014/04/12/53493befee85c.jpg', NULL, 1, 1),
(2, 'hi2.jpg', '/2014/04/12/53493bf937002.jpg', NULL, 1, 1),
(3, 'hi3.jpg', '/2014/04/12/53493c0524c78.jpg', NULL, 1, 1),
(4, 'hi4.jpg', '/2014/04/12/53493c0deb7bd.jpg', NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sx_user`
--

CREATE TABLE IF NOT EXISTS `sx_user` (
  `uid` bigint(15) NOT NULL AUTO_INCREMENT,
  `real_name` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(32) NOT NULL,
  `regi_time` int(10) NOT NULL,
  `checked` bit(1) NOT NULL,
  `group` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `sx_user`
--

INSERT INTO `sx_user` (`uid`, `real_name`, `phone`, `email`, `password`, `regi_time`, `checked`, `group`) VALUES
(7, '王海阳', '18782246522', '529570509@qq.com', '202cb962ac59075b964b07152d234b70', 1390638395, b'1', 0),
(14, 'www', '18782256522', '222@qq.com', '099b3b060154898840f0ebdfb46ec78f', 1395138523, b'0', 0),
(15, 'whywhy', '1212121212', 'www@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 1395139992, b'0', 0),
(16, 'qq', '1111111', 'qq@qq.com', '099b3b060154898840f0ebdfb46ec78f', 1395140067, b'1', 0),
(17, 'qqq', '1111111', 'qqq@qq.com', 'b2ca678b4c936f905fb82f2733f5297f', 1395140930, b'1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sx_user_extra`
--

CREATE TABLE IF NOT EXISTS `sx_user_extra` (
  `uid` bigint(15) NOT NULL,
  `PWId` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sx_user_extra`
--

INSERT INTO `sx_user_extra` (`uid`, `PWId`) VALUES
(2, '1390293525');

-- --------------------------------------------------------

--
-- 表的结构 `sx_usergroup`
--

CREATE TABLE IF NOT EXISTS `sx_usergroup` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `right` varchar(100) NOT NULL,
  `righton` varchar(500) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sx_usergroup`
--

INSERT INTO `sx_usergroup` (`id`, `name`, `right`, `righton`, `status`) VALUES
(1, '经理层', '1', NULL, 1),
(2, '市场推广部', '2', NULL, 1),
(3, '店面管理', '3', NULL, 1);

--
-- 限制导出的表
--

--
-- 限制表 `sx_clothes_accessory_image`
--
ALTER TABLE `sx_clothes_accessory_image`
  ADD CONSTRAINT `sx_clothes_accessory_image_ibfk_1` FOREIGN KEY (`id`) REFERENCES `sx_clothes_accessory` (`id`) ON DELETE CASCADE;

--
-- 限制表 `sx_color`
--
ALTER TABLE `sx_color`
  ADD CONSTRAINT `sx_color_ibfk_1` FOREIGN KEY (`id`) REFERENCES `sx_clothes_accessory` (`id`) ON DELETE CASCADE;

--
-- 限制表 `sx_size`
--
ALTER TABLE `sx_size`
  ADD CONSTRAINT `sx_size_ibfk_1` FOREIGN KEY (`id`) REFERENCES `sx_clothes_accessory` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

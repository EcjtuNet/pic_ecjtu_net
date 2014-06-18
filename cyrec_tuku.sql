-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 24 日 04:12
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cyrec_tuku`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_message`
--

CREATE TABLE IF NOT EXISTS `admin_message` (
  `id` int(15) NOT NULL AUTO_INCREMENT COMMENT '留言序号',
  `message_name` varchar(50) NOT NULL,
  `message_content` text NOT NULL,
  `message_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `admin_message`
--

INSERT INTO `admin_message` (`id`, `message_name`, `message_content`, `message_date`) VALUES
(10, '日新网友', '拍的很好呀，很喜欢这样的颜色!我爱交大!', '2013-03-11'),
(11, '日新网友', '拍的很好呀，很喜欢这样的颜色!我爱交大!也许有一天你会离开这里，也许你会觉得,这块土地你应该踏遍了每一个角落。而留念。储存在每一个瞬间，包括这个夜晚，安静而美好。', '2013-03-17'),
(12, '输入名字', '', '2013-03-17'),
(13, '输入名字', '来说一点什么吧！', '2013-03-17'),
(14, '输入名字', '来说一点什么吧！', '2013-03-17'),
(15, '输入名字', '来说一点什么吧！', '2013-03-24'),
(16, '输入名字', '来说一点什么吧！', '2013-03-24');

-- --------------------------------------------------------

--
-- 表的结构 `cyrec_category`
--

CREATE TABLE IF NOT EXISTS `cyrec_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_slug` varchar(30) DEFAULT NULL,
  `category_name` varchar(30) DEFAULT NULL,
  `category_keywords` varchar(100) DEFAULT NULL,
  `category_description` varchar(100) DEFAULT NULL,
  `category_count` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `cyrec_category`
--

INSERT INTO `cyrec_category` (`category_id`, `category_slug`, `category_name`, `category_keywords`, `category_description`, `category_count`) VALUES
(1, 'tuji1', '风景', '图集1的关键字', '这是图集1的描述', 0),
(2, 'tuji2', '创意', '图集2的关键字', '这是图集2的描述', 0),
(3, 'tuji3', '故事', '图集3的关键字', '这是图集3的描述', 0),
(4, 'tuji5', '青春', '图集5的标题', '图集5的描述', 0),
(5, 'tuji6', '记忆', NULL, NULL, 0),
(6, 'tuji7', '天下', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cyrec_comments`
--

CREATE TABLE IF NOT EXISTS `cyrec_comments` (
  `comments_posts_id` int(10) unsigned NOT NULL,
  `comments_time` int(10) unsigned DEFAULT '0',
  `comments_author` varchar(30) DEFAULT NULL,
  `comments_text` text NOT NULL,
  `comments_ip` varchar(16) DEFAULT '0',
  `comments_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `cyrec_comments`
--

INSERT INTO `cyrec_comments` (`comments_posts_id`, `comments_time`, `comments_author`, `comments_text`, `comments_ip`, `comments_id`) VALUES
(26, 1329987449, '日新网友', '随风飞', '127.0.0.1', 1),
(20, 1329988104, '呵哈', '图库差不多完成了', '127.0.0.1', 2),
(22, 1330585826, '日新网友', 'sf ', '127.0.0.1', 3),
(22, 1330586035, 'edferf', 'sdaf地方', '127.0.0.1', 4),
(22, 1330586043, '反对搞活', '但是法国', '127.0.0.1', 5),
(22, 1330586049, '日新网友', '使得法国', '127.0.0.1', 6),
(18, 1330673318, 'ewrtwe4t', 'ewtfew ', '172.16.86.89', 7),
(20, 1330696753, 'lin', '非常好！！', '172.16.86.3', 8),
(27, 1331012787, '日新网友', '美女~~', '172.16.86.89', 9),
(0, 1363776221, '日新网友', '0', '127.0.0.1', 12),
(27, 1363366021, '日新网友', '好美', '127.0.0.1', 11),
(27, 1363776666, '日新网友', '来说一点什么吧！', '127.0.0.1', 13),
(22, 1363784789, '日新网友', '我都市', '127.0.0.1', 14),
(22, 1363784808, '苏丹皇宫撒', '海地发生反弹', '127.0.0.1', 15),
(22, 1363784835, '日新网友', '十大死敌', '127.0.0.1', 16);

-- --------------------------------------------------------

--
-- 表的结构 `cyrec_options`
--

CREATE TABLE IF NOT EXISTS `cyrec_options` (
  `options_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `options_name` varchar(60) DEFAULT NULL,
  `options_slug` varchar(60) DEFAULT NULL,
  `options_value` varchar(100) DEFAULT NULL COMMENT '站点名称',
  PRIMARY KEY (`options_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cyrec_options`
--

INSERT INTO `cyrec_options` (`options_id`, `options_name`, `options_slug`, `options_value`) VALUES
(1, '网站名称', 'webtitle', '日新图库'),
(2, '关键词（KeyWords）', 'keywords', '日新图库,日新网图库'),
(3, '描述（Description）', 'description', '日新网的图库,华东交通大学'),
(4, '版权信息', 'copyright', '2001-2011 By [ecjtu.net] .All Rights Reserved '),
(5, '缓存设置', 'cache', 'a:2:{s:13:"cache_enabled";s:1:"0";s:17:"cache_expire_time";s:4:"2000";}');

-- --------------------------------------------------------

--
-- 表的结构 `cyrec_posts`
--

CREATE TABLE IF NOT EXISTS `cyrec_posts` (
  `posts_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '图集ID',
  `posts_category` int(10) unsigned NOT NULL COMMENT '所属分类ID',
  `posts_slug` varchar(60) DEFAULT NULL COMMENT '别名',
  `posts_title` varchar(80) DEFAULT NULL COMMENT '标题',
  `posts_description` char(255) DEFAULT NULL COMMENT '描述',
  `posts_keywords` varchar(80) DEFAULT NULL COMMENT '关键字',
  `posts_author` varchar(30) NOT NULL,
  `posts_thumb` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `posts_pictures` text COMMENT '图集所有图片地址',
  `posts_count` int(10) unsigned DEFAULT NULL COMMENT '图片数量',
  `posts_pubdate` int(6) unsigned DEFAULT NULL COMMENT '发布时间',
  `posts_hit` int(6) unsigned DEFAULT NULL COMMENT '点击数',
  `posts_type` int(1) unsigned DEFAULT NULL COMMENT '图集类别',
  `posts_check` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`posts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `cyrec_posts`
--

INSERT INTO `cyrec_posts` (`posts_id`, `posts_category`, `posts_slug`, `posts_title`, `posts_description`, `posts_keywords`, `posts_author`, `posts_thumb`, `posts_pictures`, `posts_count`, `posts_pubdate`, `posts_hit`, `posts_type`, `posts_check`) VALUES
(21, 1, '测试图集9', '测试图集9', '测试图集9', '测试图集9', 'admin', 'pic/201111/26/2088ee2a1d577c331fe6519c42abe901.jpg', 'a:2:{i:0;s:50:"pic/201111/26/2088ee2a1d577c331fe6519c42abe901.jpg";i:1;s:50:"pic/201111/26/dacec9e3e7ebfcdf5d0599c9aac92ade.jpg";}', 2, 1322323985, 21, 1, 1),
(22, 1, '测试图集10', '测试图集10', '测试图集10', '测试图集10', 'admin', 'pic/201111/26/6ca17b5086070b65740aad5d0de3793b.jpg', 'a:2:{i:0;s:50:"pic/201111/26/6ca17b5086070b65740aad5d0de3793b.jpg";i:1;s:50:"pic/201111/26/180ef8c784497fd4044676775cf7132d.jpg";}', 2, 1322324059, 268, 2, 1),
(14, 1, '测试图集1', '测试图集1', '测试图集1', '测试图集1', 'admin', 'pic/201111/26/625b93426b97a8b7c998bda741a3e7f7.jpg', 'a:2:{i:0;s:50:"pic/201111/26/625b93426b97a8b7c998bda741a3e7f7.jpg";i:1;s:50:"pic/201111/26/32697084580da510bd82be8f17bae848.jpg";}', 2, 1322323704, 127, 1, 1),
(15, 2, '测试图集1', '测试图集2', '测试图集1', '测试图集2', 'admin', 'pic/201111/26/d36dee63f536134ad486c5e2165ae45c.jpg', 'a:2:{i:0;s:50:"pic/201111/26/d36dee63f536134ad486c5e2165ae45c.jpg";i:1;s:50:"pic/201111/26/bb2dfb11b6327314e4e1fce3bd791b77.jpg";}', 2, 1322323745, 6, 2, 1),
(16, 2, '测试图集3', '测试图集3', '测试图集3', '测试图集3', 'admin', 'pic/201111/26/14373517321ac4343bfecacd16efe2d0.jpg', 'a:2:{i:0;s:50:"pic/201111/26/14373517321ac4343bfecacd16efe2d0.jpg";i:1;s:50:"pic/201111/26/0a5dfe0d9acc195941329fef6ac1ba02.jpg";}', 2, 1322323777, 24, 1, 1),
(17, 1, '测试图集4', '测试图集4', '测试图集4', '测试图集4', 'admin', 'pic/201111/26/52d0c102b88f8fcd11dd986f0b1cc9cf.jpg', 'a:2:{i:0;s:50:"pic/201111/26/7bda69e4cc9b795b2aa0eb96512bf9b9.jpg";i:1;s:50:"pic/201111/26/52d0c102b88f8fcd11dd986f0b1cc9cf.jpg";}', 2, 1322323817, 130, 2, 1),
(18, 1, '测试图集5', '测试图集5', '测试图集1', '测试图集5', 'admin', 'pic/201111/26/a8cb2f0ece524243a37e08d2d048a7de.jpg', 'a:2:{i:0;s:50:"pic/201111/26/a8cb2f0ece524243a37e08d2d048a7de.jpg";i:1;s:50:"pic/201111/26/e5c8cfc05771cf16946e3f2d0f4b055f.jpg";}', 2, 1322323841, 121, 2, 1),
(19, 1, '测试图集6', '测试图集7', '测试图集7', '测试图集7', 'admin', 'pic/201111/26/c5ddd8312e107fd4f5ba725d0603c9f4.jpg', 'a:2:{i:0;s:50:"pic/201111/26/c5ddd8312e107fd4f5ba725d0603c9f4.jpg";i:1;s:50:"pic/201111/26/d6e4f28e7f23153fe2b162fe3f5166c5.jpg";}', 2, 1322323884, 28, 2, 1),
(20, 3, '测试图集8', '测试图集8', '撒旦', '测试图集8', 'admin', 'pic/201111/26/a078922467e53f42bf503ea4f7075486.jpg', 'a:2:{i:0;s:50:"pic/201111/26/9a83642f90adfcd85cf04da0ffe84828.jpg";i:1;s:50:"pic/201111/26/a078922467e53f42bf503ea4f7075486.jpg";}', 2, 1322323946, 140, 2, 1),
(25, 3, '上传测试一下', '上传测试一下', '上传测试一下', '上传测试一下', '日新网友', 'pic/201111/27/f0ada50cf16ffdbbb2e5c0ee3b3794e4.jpg', 'a:1:{i:0;s:50:"pic/201111/27/f0ada50cf16ffdbbb2e5c0ee3b3794e4.jpg";}', 1, 1322400985, 7, 0, 1),
(26, 3, '10连杀', '10连杀', '10连杀', '10连杀', 'admin', 'pic/201111/27/2586db9597d098ddb5e53c36e085e971.jpg', 'a:2:{i:0;s:50:"pic/201111/27/cd1ca81eed95c0183c66d7fa78104602.jpg";i:1;s:50:"pic/201111/27/2586db9597d098ddb5e53c36e085e971.jpg";}', 2, 1322406646, 9, 1, 1),
(27, 1, '测试一下。。。', '测试一下。。。', '测试一下。。。\n测试一下。。。测试一下。。。', '测试一下。。。', '日新网友', 'pic/201203/01/fa933d13a97a81070f1f0cd3ddacb2fe.jpg', 'a:4:{i:0;s:50:"pic/201203/01/fa933d13a97a81070f1f0cd3ddacb2fe.jpg";i:1;s:50:"pic/201203/01/dd4d4a58a1c8fbb2fd039aecce797ce0.jpg";i:2;s:50:"pic/201203/01/5fd56b31fcde554ab4a2847f357b9a8f.jpg";i:3;s:50:"pic/201203/01/abd193710f694333ea0dc3406b8eac92.jpg";}', 4, 1331047889, 130, 1, 1),
(29, 1, '测试1234', '测试1234', '测试1234\n测试1234', '测试1234', '日新网友', 'pic/201203/06/7a02a8843c48b41b0c4c054469832116.jpg', 'a:2:{i:0;s:50:"pic/201203/06/7a02a8843c48b41b0c4c054469832116.jpg";i:1;s:50:"pic/201203/06/fa0126eab1c44c7b9758f63c8fb68310.jpg";}', 2, 1331009366, 8, 0, 1),
(30, 1, '测试图集12345', '测试图集12345', '测试图集12345测试图集12345', '测试图集12345', '日新网友', 'pic/201203/06/82c977b0097e7a507b1addcaba7d783d.jpg', 'a:1:{i:0;s:50:"pic/201203/06/82c977b0097e7a507b1addcaba7d783d.jpg";}', 1, 1294289739, 4, 1, 1),
(31, 1, '测试图集1234546', '测试图集1234546', '测试图集12345测试图集12345', '测试图集1234546', 'Cyrec', 'pic/201203/06/233bb3415a5024fcae8d11333daab835.jpg', 'a:2:{i:0;s:50:"pic/201203/06/233bb3415a5024fcae8d11333daab835.jpg";i:1;s:50:"pic/201203/06/b28492b283a1b0d8236fba14a3342da3.jpg";}', 2, 1325825865, 5, 1, 1),
(32, 1, '12345', '测试图集123456', '测试图集12345测试图集12345', '测试图集123456', 'admin', 'pic/201203/06/59a2ad3a6a3e1b5c32926262f56ee17b.jpg', 'a:2:{i:0;s:50:"pic/201203/06/59a2ad3a6a3e1b5c32926262f56ee17b.jpg";i:1;s:50:"pic/201203/06/98eb49b4490198d9178bfbba3ed463e4.jpg";}', 2, 1315285351, 125, 0, 1),
(37, 1, '', '旅游图集', '旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集旅游图集', '旅游图集', '无边的蓝天', 'pic/201303/23/0bd2beef064ff77866a4c75efa137d54.jpg', 'a:12:{i:0;s:50:"pic/201303/23/0bd2beef064ff77866a4c75efa137d54.jpg";i:1;s:50:"pic/201303/23/466a51b91cd5787bc417d3e7ce770172.jpg";i:2;s:50:"pic/201303/23/29f17926e5bad021a09921b9ef83ba84.jpg";i:3;s:50:"pic/201303/23/a9ae435fb996d689a0f7c423d4919e3c.jpg";i:4;s:50:"pic/201303/23/63822472a4552a1f1a789527e84bc083.jpg";i:5;s:50:"pic/201303/23/e6fd4bfca24d8ee10113a17a48dc9dc0.jpg";i:6;s:50:"pic/201303/23/ccd0bd0fddb381f58ef9399011496841.jpg";i:7;s:50:"pic/201303/23/0db251891f65271be419aba6a1885ff0.jpg";i:8;s:50:"pic/201303/23/8ced61d65b3b1f4a5311c82c920abeb1.jpg";i:9;s:50:"pic/201303/23/2bce605f107329111eccdc4797444329.jpg";i:10;s:50:"pic/201303/23/b2ef6d19e227a9220806ea158c170996.jpg";i:11;s:50:"pic/201303/23/c1d8537442c862d874dd6e3773d6f90f.jpg";}', 12, 1364057827, 0, 0, 1),
(36, 6, '无边的蓝天', '习主席出访俄罗斯', '习主席出访俄罗斯习主席出访俄罗斯习主席出访俄罗斯习主席出访俄罗斯习主席出访俄罗斯', '习主席出访俄罗斯', 'slient', 'pic/201303/23/ddb2a0057d5618e786c415a50356c859.jpg', 'a:6:{i:0;s:50:"pic/201303/23/ddb2a0057d5618e786c415a50356c859.jpg";i:1;s:50:"pic/201303/23/33f78abd3dbc7e69c26951e3b6c0de09.jpg";i:2;s:50:"pic/201303/23/f1271330130308b7a417ad3eb50d5a4a.jpg";i:3;s:50:"pic/201303/23/e31a1da3c5f95fd02aca6a8fb3217c12.jpg";i:4;s:50:"pic/201303/23/ac4ef5dec56be8680b6ff091e7593aed.jpg";i:5;s:50:"pic/201303/23/17ca1efcd0cae7abe95113bbd99f6afe.jpg";}', 6, 1364055746, 0, 0, 1),
(38, 5, '', '铁路局', '铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局铁路局', '铁路局', '黑色的小角落', 'pic/201303/23/77a6b6baedddbd9acb121e78df221426.jpg', 'a:9:{i:0;s:50:"pic/201303/23/f638505fc10512b42874979feb1013a3.jpg";i:1;s:50:"pic/201303/23/77a6b6baedddbd9acb121e78df221426.jpg";i:2;s:50:"pic/201303/23/4ee5dcda47b99e63b4174d776bfa6bac.jpg";i:3;s:50:"pic/201303/23/b5f0c4b37dec4be5dd8222c90d987c5f.jpg";i:4;s:50:"pic/201303/23/79f2b2ff442c873e4bfcf7a84c9a48f2.jpg";i:5;s:50:"pic/201303/23/c692deb5d92965561dc6ed09c11abea6.jpg";i:6;s:50:"pic/201303/23/bd3a2d1e2c4c4acc9108b282ce931e9b.jpg";i:7;s:50:"pic/201303/23/3eafe1cf3edf833393c341907d2f193f.jpg";i:8;s:50:"pic/201303/23/be4b487ffdb2d9ad485c09096b3f3ec5.jpg";}', 9, 1364057895, 16, 0, 1),
(39, 6, '', '中国舰队', '中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队中国舰队', '中国舰队', 'admin', 'pic/201303/23/06827749075e60f6848cfcef164c7a26.jpg', 'a:7:{i:0;s:50:"pic/201303/23/06827749075e60f6848cfcef164c7a26.jpg";i:1;s:50:"pic/201303/23/144eebe9516e2cd68552c9c32e440e93.jpg";i:2;s:50:"pic/201303/23/23e65eccf024df2052647c2fb1cabc01.jpg";i:3;s:50:"pic/201303/23/29332879abd398d81cd40e5297367c90.jpg";i:4;s:50:"pic/201303/23/cc8e5f46497d79688ea0eff8d3b13abe.jpg";i:5;s:50:"pic/201303/23/ae2526bb3f6a21edb3bf69dee5c95055.jpg";i:6;s:50:"pic/201303/23/36cf204abfffefceac52ba668a538ddf.jpg";}', 7, 1364057943, 7, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cyrec_sessions`
--

CREATE TABLE IF NOT EXISTS `cyrec_sessions` (
  `session_id` varchar(50) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) DEFAULT '0',
  `user_agent` varchar(50) DEFAULT NULL,
  `last_activity` int(10) unsigned DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cyrec_sessions`
--


-- --------------------------------------------------------

--
-- 表的结构 `cyrec_users`
--

CREATE TABLE IF NOT EXISTS `cyrec_users` (
  `users_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_name` varchar(50) DEFAULT NULL,
  `users_password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `cyrec_users`
--

INSERT INTO `cyrec_users` (`users_id`, `users_name`, `users_password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

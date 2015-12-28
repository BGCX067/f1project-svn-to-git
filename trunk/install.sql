-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 03 月 10 日 01:35
-- 服务器版本: 5.1.30
-- PHP 版本: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jj`
--

-- --------------------------------------------------------

--
-- 表的结构 `yui_admin`
--

CREATE TABLE IF NOT EXISTS `yui_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `typer` enum('system','manager','editor') NOT NULL DEFAULT 'editor',
  `user` varchar(100) NOT NULL DEFAULT '',
  `pass` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `modulelist` text NOT NULL COMMENT '可管理的模块，系统管理员无效',
  `menuid` varchar(255) NOT NULL COMMENT '常用菜单ID号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `yui_admin`
--

INSERT INTO `yui_admin` (`id`, `typer`, `user`, `pass`, `email`, `modulelist`, `menuid`) VALUES
(1, 'system', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yui_book`
--

CREATE TABLE IF NOT EXISTS `yui_book` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `ifcheck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0为未审核，1为已审核所有人可以看，2为已审核但仅限会员能查看',
  `reply` text NOT NULL,
  `replydate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `yui_book`
--

INSERT INTO `yui_book` (`id`, `user`, `subject`, `content`, `postdate`, `email`, `ifcheck`, `reply`, `replydate`) VALUES
(1, '测试', '测试留言', '测试留言', 1221922909, 'test@126.com', 1, '<div>测试审核\r\n<div><img border="0" alt="" src="upfiles/200809/03/mark_1220426054.jpg" /></div>\r\n</div>', 1221923491),
(2, '测试2', '图片展示5', 'fsdfasdfasd', 1221923587, 'test@126.com', 1, '', 0),
(3, '谢大哥', '1', '123233', 1236065490, 'xxz@live.cn', 0, '', 1236218946),
(5, '234-093', '720394', '879238479', 1236133716, '27@hdfj.com', 0, '', 0),
(6, '234', '234234', '234234234', 1236133785, '234@76j.com', 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yui_category`
--

CREATE TABLE IF NOT EXISTS `yui_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号，也是分类ID号',
  `catetype` enum('article','product','picture','download') NOT NULL DEFAULT 'article' COMMENT '分类类别',
  `rootid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '根分类ID号',
  `parentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '父分类ID号',
  `catename` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `catestyle` varchar(255) NOT NULL DEFAULT '' COMMENT '样式',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，值越小越往前靠',
  `tpl_index` varchar(255) NOT NULL DEFAULT '' COMMENT '封面模板',
  `tpl_list` varchar(255) NOT NULL DEFAULT '' COMMENT '列表模板',
  `tpl_msg` varchar(255) NOT NULL DEFAULT '' COMMENT '内容模板',
  `ifcheck` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为正常，0为隐藏',
  `psize` tinyint(3) unsigned NOT NULL DEFAULT '30' COMMENT '分类列表每页显示个数，默认是30',
  `keywords` varchar(255) NOT NULL COMMENT '分类关键字',
  `description` varchar(255) NOT NULL COMMENT '分类描述',
  `note` varchar(255) NOT NULL COMMENT '分类描述',
  PRIMARY KEY (`id`),
  KEY `rootid` (`rootid`,`ifcheck`),
  KEY `parentid` (`parentid`,`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `yui_category`
--

INSERT INTO `yui_category` (`id`, `catetype`, `rootid`, `parentid`, `catename`, `catestyle`, `taxis`, `tpl_index`, `tpl_list`, `tpl_msg`, `ifcheck`, `psize`, `keywords`, `description`, `note`) VALUES
(1, 'article', 0, 0, '新闻中心', '', 10, '', '', '', 1, 30, '', '', '关于本站的一些新闻信息~~'),
(2, 'product', 0, 0, '产品中心', '', 10, '', '', '', 1, 10, '', '', '展示产品相关信息'),
(3, 'picture', 0, 0, '图片展示', '', 10, '', '', '', 1, 30, '', '', '展示本公司里的一些图片信息'),
(5, 'article', 0, 0, '促销新闻', '', 255, '', '', '', 1, 30, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yui_codes`
--

CREATE TABLE IF NOT EXISTS `yui_codes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `sign` varchar(50) NOT NULL COMMENT '自定义标签，必须是唯一值或空值',
  `subject` varchar(255) NOT NULL COMMENT '广告题头，用于后台管理',
  `content` text NOT NULL COMMENT '广告内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为未审核，1为正常',
  PRIMARY KEY (`id`),
  KEY `start_date` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `yui_codes`
--


-- --------------------------------------------------------

--
-- 表的结构 `yui_content`
--

CREATE TABLE IF NOT EXISTS `yui_content` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主题ID号，对应msg表中的自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID号，用于索引',
  `content` longtext NOT NULL COMMENT '内容信息',
  PRIMARY KEY (`id`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `yui_content`
--

INSERT INTO `yui_content` (`id`, `cateid`, `content`) VALUES
(2, 1, '<div>这是应用于新闻测试的~~</div>'),
(3, 2, '<div>简单测试dfasdfsdfasdf</div>'),
(8, 1, '<div>好饿啊.</div>'),
(5, 1, '<div>不错不错fsdafsdfsdafsdafsafsdfsad</div>'),
(6, 1, '<div>fsdfsdfsfsdfsdfg</div>'),
(7, 2, '<div>呵呵~~~~</div>'),
(9, 1, '<div>345345</div>\r\n<div>我要看一下</div>\r\n<div>是不是真的有问题</div>'),
(11, 1, '<div>666666666666666666666666666666</div>'),
(12, 1, '<div>55555555555</div>'),
(13, 1, '<div>456456456</div>'),
(14, 1, '<div>67567</div>'),
(15, 1, '<div>hggg</div>'),
(16, 1, '<div>cdf5fg</div>'),
(17, 1, '<div>aadf345</div>'),
(18, 1, '<div>asdfasdf</div>'),
(20, 1, '<div>4444444444444444444444</div>'),
(21, 1, '<div>444444444444444444444442222222</div>'),
(22, 1, '<div>2222222222222222222222</div>'),
(23, 1, '<div>345345345</div>'),
(24, 1, '<div>345345345</div>'),
(25, 1, '<div>7777</div>'),
(26, 1, '<div>45345345345</div>'),
(27, 5, '<div>小新新</div>');

-- --------------------------------------------------------

--
-- 表的结构 `yui_driver`
--

CREATE TABLE IF NOT EXISTS `yui_driver` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `holder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0æ— é©¾é©¶è¯ï¼?æœ‰é©¾é©¶è¯',
  `ifcheck` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0ä¸ºæœªå®¡æ ¸ï¼?ä¸ºå·²å®¡æ ¸æ‰€æœ‰äººå¯ä»¥çœ‹ï¼Œ2ä¸ºå·²å®¡æ ¸ä½†ä»…é™ä¼šå‘˜èƒ½æŸ¥çœ‹',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `yui_driver`
--

INSERT INTO `yui_driver` (`id`, `user`, `subject`, `content`, `postdate`, `email`, `phone`, `holder`, `ifcheck`) VALUES
(3, '谢大哥大', '1', '1232343333', 1236217580, 'xxz@live.cn', '15013707091', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yui_link`
--

CREATE TABLE IF NOT EXISTS `yui_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` mediumint(9) NOT NULL COMMENT '对应linktype的类别',
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) DEFAULT NULL,
  `taxis` tinyint(3) unsigned DEFAULT '255',
  `width` tinyint(3) unsigned NOT NULL COMMENT '图片链接宽度',
  `height` tinyint(3) unsigned NOT NULL COMMENT '图片链接高度',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `yui_link`
--

INSERT INTO `yui_link` (`id`, `typeid`, `name`, `url`, `picture`, `taxis`, `width`, `height`) VALUES
(2, 2, '我要买车', 'special.php/7.html', 'upfiles/1236241455.jpg', 1, 90, 20),
(3, 2, '试驾预约', 'driver.php', 'upfiles/1236241511.jpg', 2, 90, 20),
(4, 2, '企业网站', 'http://www.ford.com.cn/', 'upfiles/1236241194.jpg', 0, 90, 20);

-- --------------------------------------------------------

--
-- 表的结构 `yui_linktype`
--

CREATE TABLE IF NOT EXISTS `yui_linktype` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '链接类型',
  `typename` varchar(80) NOT NULL COMMENT '链接类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `yui_linktype`
--

INSERT INTO `yui_linktype` (`id`, `typename`) VALUES
(2, '右上角');

-- --------------------------------------------------------

--
-- 表的结构 `yui_msg`
--

CREATE TABLE IF NOT EXISTS `yui_msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '信息自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID对应category表的自增ID号',
  `subject` varchar(255) NOT NULL DEFAULT '' COMMENT '主题',
  `style` varchar(255) NOT NULL DEFAULT '' COMMENT '主题CSS样式',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者名称',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `tplfile` varchar(255) NOT NULL DEFAULT '' COMMENT '模板文件，为空使用系统默认',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击率',
  `taxis` int(11) NOT NULL DEFAULT '0' COMMENT '排序，值越大越往前排',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶，0为普通，1－9为不同级别的置顶',
  `isvouch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐，0为不推荐，1－9为不同级别的推荐',
  `isbest` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否精华，0为普通，1－9为不同级别的精华',
  `ifcheck` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为已审核，0为未审核',
  `clou` varchar(255) NOT NULL COMMENT '简要描述',
  `url` varchar(255) DEFAULT '' COMMENT '外部网址',
  `mark` varchar(255) NOT NULL COMMENT '商品大图',
  `standard` varchar(30) NOT NULL COMMENT '规格',
  `number` varchar(30) NOT NULL COMMENT '型号',
  `m_price` varchar(30) NOT NULL COMMENT '市场价',
  `s_price` varchar(30) NOT NULL COMMENT '市城价',
  `promotions` varchar(255) NOT NULL COMMENT '促销活动',
  `softsize` varchar(50) NOT NULL COMMENT '软件大小',
  `softlang` varchar(255) NOT NULL COMMENT '软件语言',
  `softsystem` varchar(255) NOT NULL COMMENT '软件应用平台',
  `softdemo` varchar(80) NOT NULL COMMENT '软件演示地址',
  `softadmin` varchar(80) NOT NULL COMMENT '软件开发者',
  `softemail` varchar(80) NOT NULL COMMENT '联系邮箱',
  `softother` varchar(255) NOT NULL COMMENT '其他说明',
  `softlicense` varchar(255) NOT NULL COMMENT '授权方式',
  PRIMARY KEY (`id`,`cateid`),
  KEY `cateid` (`cateid`,`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 导出表中的数据 `yui_msg`
--

INSERT INTO `yui_msg` (`id`, `cateid`, `subject`, `style`, `author`, `postdate`, `tplfile`, `hits`, `taxis`, `thumb`, `istop`, `isvouch`, `isbest`, `ifcheck`, `clou`, `url`, `mark`, `standard`, `number`, `m_price`, `s_price`, `promotions`, `softsize`, `softlang`, `softsystem`, `softdemo`, `softadmin`, `softemail`, `softother`, `softlicense`) VALUES
(2, 1, '测试新闻', '', 'admin', 1220437251, '', 6, 0, '', 0, 0, 0, 1, '本新闻应用于测试使用', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 2, '测试产品', '', 'admin', 1220371200, '', 36, 0, 'upfiles/200809/21/thumb_1221989172_51.jpg', 0, 0, 0, 1, '简单测试', '', 'upfiles/200809/21/mark_1221989172_51.jpg', 'SD983', 'DDP9', '98.00', '78.00', '购买本商品可物赠……', '', '', '', '', '', '', '', ''),
(8, 1, '我的爱', '', 'admin', 1235007630, '', 5, 0, '', 0, 0, 0, 1, 'bicth', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 1, '不错不错', '', 'admin', 1220544000, '', 5, 0, '', 0, 0, 0, 1, '3.0啊ffsdfsfsdfsdfsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 1, 'sdfsdfsdfsdfsdf', '', 'admin', 1220544000, '', 11, 0, '', 0, 0, 0, 1, 'sdfasfsadfsdafsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 2, '测试产品二', '', 'admin', 1221840000, '', 19, 0, 'upfiles/200809/21/thumb_1221989058_20.jpg', 0, 0, 0, 1, '这是测试产品二噢', '', 'upfiles/200809/21/mark_1221989058_20.jpg', '吨', 'DS-100', '98.50', '90.00', '买二赠一', '', '', '', '', '', '', '', ''),
(9, 1, '345345', '', 'admin', 1235543599, '', 72, 0, '', 0, 0, 0, 1, '345345', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 1, '666666666666', '', 'admin', 1235716106, '', 0, 0, '', 0, 0, 0, 1, '66666666666666', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 1, '5555555', '', 'admin', 1235716116, '', 0, 0, '', 0, 0, 0, 1, '5555555555', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 1, '456456', '', 'admin', 1235716130, '', 0, 0, '', 0, 0, 0, 1, '456456', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 1, '66666666666666667', '', 'admin', 1235716150, '', 2, 0, '', 0, 0, 0, 1, '5666666666', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 1, 'dgh', '', 'admin', 1235716160, '', 0, 0, '', 0, 0, 0, 1, 'fh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 1, 'bs45', '', 'admin', 1235716178, '', 3, 0, '', 0, 0, 0, 1, 'sf3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 1, '458gh234', '', 'admin', 1235716191, '', 9, 0, '', 0, 0, 0, 1, 'daga45', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 1, 'adfadf', '', 'admin', 1235716201, '', 47, 0, '', 0, 0, 0, 1, 'adfadf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 1, '324', '', 'admin', 1235975861, '', 0, 0, '', 0, 0, 0, 1, '44444444444444444444', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 1, '33333333333333333', '', 'admin', 1235975871, '', 0, 0, '', 0, 0, 0, 1, '33333333334444', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 1, '222222222222', '', 'admin', 1235975879, '', 0, 0, '', 0, 0, 0, 1, '2222222222222223', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 1, '555555555555555556', '', 'admin', 1235975898, '', 1, 0, '', 0, 0, 0, 1, '7834534', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, 1, '34444', '', 'admin', 1235975919, '', 5, 0, '', 0, 0, 0, 1, '44534', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 1, '6456456', '', 'admin', 1235975933, '', 10, 0, '', 0, 0, 0, 1, '23767', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 1, '345345345', '', 'admin', 1235975949, '', 104, 0, '', 0, 0, 0, 1, '3453', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 5, '小新新', '', 'admin', 1236222699, '', 1, 0, '', 0, 0, 0, 1, '小新新', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `yui_nav`
--

CREATE TABLE IF NOT EXISTS `yui_nav` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `css` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `target` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `yui_nav`
--

INSERT INTO `yui_nav` (`id`, `name`, `css`, `url`, `target`, `taxis`) VALUES
(1, '网站首页', '', 'home.php', 0, 10),
(2, '企业介绍', '', 'special.php?id=6', 0, 20),
(3, '新闻资讯', '', 'list.php?id=1', 0, 30),
(4, '图片展示', '', 'list.php?id=3', 0, 40),
(5, '产品展示', '', 'list.php?id=2', 0, 50),
(7, '在线留言', '', 'book.php', 0, 70),
(8, '联系我们', '', 'special.php?id=2', 0, 80);

-- --------------------------------------------------------

--
-- 表的结构 `yui_notice`
--

CREATE TABLE IF NOT EXISTS `yui_notice` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `style` varchar(255) NOT NULL COMMENT '样式管理',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '公告链接的网址',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `yui_notice`
--

INSERT INTO `yui_notice` (`id`, `subject`, `style`, `url`, `content`, `postdate`) VALUES
(1, '测试站内公告', 'color:#008080;', '', '<div>这是测试站内公告\r\n<div>这是测试站内公告\r\n<div>这是测试站内公告\r\n<div>这是测试站内公告\r\n<div>这是测试站内公告</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 1220874079),
(2, '测试公告二', '', '', '<div>测试第二个公告\r\n<div>测试第二个公告\r\n<div>测试第二个公告\r\n<div>测试第二个公告</div>\r\n</div>\r\n</div>\r\n</div>', 1220875440),
(3, '测试带图片的公告', '', '', '<div>\r\n<div><img border="0" alt="" src="upfiles/200809/05/1220602126.gif" />这里是图片噢~~~</div>\r\n</div>', 1220875488),
(4, '测试第五个公告', '', '', '<div>测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告测试第五个公告</div>', 1220875564);

-- --------------------------------------------------------

--
-- 表的结构 `yui_onegroup`
--

CREATE TABLE IF NOT EXISTS `yui_onegroup` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '自增ID号，也是组ID号',
  `groupname` varchar(255) NOT NULL COMMENT '组名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `yui_onegroup`
--

INSERT INTO `yui_onegroup` (`id`, `groupname`) VALUES
(1, '简介组'),
(5, '客户服务'),
(3, '企业介绍'),
(4, '车型介绍'),
(6, '福友会');

-- --------------------------------------------------------

--
-- 表的结构 `yui_onepage`
--

CREATE TABLE IF NOT EXISTS `yui_onepage` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号，也是专题ID号',
  `groupid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '分组ID，未分组的ID将在任意组中显示',
  `subject` varchar(255) NOT NULL DEFAULT '' COMMENT '专题名称',
  `style` varchar(255) NOT NULL DEFAULT '' COMMENT 'CSS样式',
  `sub_content` text NOT NULL COMMENT '简单说明内容',
  `content` text NOT NULL COMMENT '专题内容',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转网址',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，值越小越往前靠',
  `ifcheck` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '专题状态，0为锁定，1为正常',
  `tpl` varchar(255) NOT NULL COMMENT '模板文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `yui_onepage`
--

INSERT INTO `yui_onepage` (`id`, `groupid`, `subject`, `style`, `sub_content`, `content`, `url`, `taxis`, `ifcheck`, `tpl`) VALUES
(6, 3, '小企', '', '', '<div style="text-align: center"><a href="templates/default/images/966222.jpg"><img alt="" src="templates/default/images/966222.jpg" /></a></div>\r\n<div style="">&nbsp;</div>\r\n<div style="text-align: center">我是小企</div>', '', 255, 1, ''),
(2, 1, '联系我们', '', '', '<div>广东广物福恒汽车贸易有限公司[长安福特授权经销商]</div>\r\n<div>地址：广州市东晓南路瑞宝路段（晓港湾斜对面）&nbsp;</div>\r\n<div>24小时销售热线：020-34102088&nbsp;34102188</div>\r\n<div>24小时服务热线：020-84081111</div>\r\n<div>24小时保险热线：020-84086672</div>\r\n<div>预约(客户关系中心):020-84081220</div>\r\n<div>传真：020-84071356</div>\r\n<div>网址：<a href="http://www.gwfh-ford.com.cn/">http://www.gwfh-ford.com.cn</a></div>\r\n<div>全国首批广州首家通过福特QualityCare机电钣喷双项认证</div>\r\n<div>五年蝉联广州地区福特销售、服务双料冠军</div>\r\n<div>长安福特十佳经销商<span>&nbsp;&nbsp; </span>福特广州第一店</div>\r\n<div>2008羊城汽车经销商五星级认证&nbsp;超白金服务店</div>\r\n<div>2008羊城汽车经销商五星级认证&nbsp;五星级汽车经销商</div>\r\n<div>2008年度羊城十佳汽车经销商</div>', '', 20, 1, ''),
(3, 1, '诚聘英才', '', '', '<div>老总致词信息~~~</div>', '', 30, 1, ''),
(4, 1, '公司概况', '', '', '<div>公司制度</div>', '', 40, 1, ''),
(7, 4, '车型展示', '', '', '<p style="text-align: center"><a   href="http://www.ford.com.cn/servlet/ContentServer?cid=1178860906492&amp;pagename=Page&amp;site=FCN&amp;c=DFYPage"><img alt="" border="0" src="upfiles/1236329172.jpg" /></a></p>\r\n<p style="text-align: center"><a   href="http://www.fordmondeo.com.cn/"><img alt="" border="0" src="upfiles/1236329161.jpg" /></a></p>\r\n<p style="text-align: center"><a   href="http://www.ford-focus.com.cn/"><img alt="" border="0" src="upfiles/1236329146.jpg" /></a></p>\r\n<p style="text-align: center"><a   href="http://www.fords-max.com.cn/"><img alt="" border="0" src="upfiles/1236329154.jpg" /></a></p>\r\n<p style="text-align: center">&nbsp;</p>\r\n<p style="text-align: center">&nbsp;</p>\r\n<div style="text-align: center">&nbsp;</div>', '', 255, 1, ''),
(8, 4, '帮您选车', '', '', '<div>帮您选车</div>', '', 255, 1, ''),
(9, 4, '购车信贷', '', '', '<div>购车信贷</div>', '', 255, 1, ''),
(10, 5, '服务承诺', '', '', '<div>服务承诺</div>', '', 255, 1, ''),
(11, 5, '维修服务', '', '', '<div>维修服务</div>', '', 255, 1, ''),
(12, 5, '增值服务', '', '', '<div>增值服务</div>', '', 255, 1, ''),
(13, 6, '车务通', '', '', '<div>车务通</div>', '', 255, 1, ''),
(14, 6, '车友活动', '', '', '<div>车友活动</div>', '', 255, 1, ''),
(15, 1, '电子地图', '', '', '<iframe src=''http://channel.mapabc.com/openmap/fmap.jsp?id=15424&eid=102181&uid=7066&z=14&w=475&h=290'' scrolling=no frameborder=0 width=475 height=290 align=middle></iframe>', '', 25, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `yui_phpok`
--

CREATE TABLE IF NOT EXISTS `yui_phpok` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `sign` varchar(50) NOT NULL COMMENT '自定义标签，必须是唯一值或空值',
  `subject` varchar(255) NOT NULL COMMENT '标题，用于后台管理',
  `content` text NOT NULL COMMENT '自定义内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为未审核，1为正常',
  PRIMARY KEY (`id`),
  KEY `start_date` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `yui_phpok`
--

INSERT INTO `yui_phpok` (`id`, `sign`, `subject`, `content`, `status`) VALUES
(1, 'contactus', '加工厂', '<div>我要加工加工</div>', 1),
(2, 'about', '简介', '<div>\r\n<table cellspacing="0" cellpadding="0" width="80%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td height="2">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td><span class="str">请随时留意我店活动预告</span><br />\r\n            这里将及时公布我店的活动预告，敬请广大车主和有购车意项的用户随时留意我店活动公告。谢谢！</td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</div>', 1),
(3, 'footer', '页脚版权说明', '<div>页脚版权说明 我是版权说明</div>', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yui_session`
--

CREATE TABLE IF NOT EXISTS `yui_session` (
  `id` varchar(32) NOT NULL COMMENT 'session_id',
  `data` text NOT NULL COMMENT 'session 内容',
  `lasttime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `yui_session`
--

INSERT INTO `yui_session` (`id`, `data`, `lasttime`) VALUES
('oob8gnhdhp8h7r9fnb3vkm94r6', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}return_url|s:44:"admin.php?file=attachments&act=list&pageid=0";', 1236589607);

-- --------------------------------------------------------

--
-- 表的结构 `yui_sysmenu`
--

CREATE TABLE IF NOT EXISTS `yui_sysmenu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `rootid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '所属为子分类ID，0为他本身就是根分类，不存在链接',
  `parentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '左侧菜单父级ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `menu_url` varchar(255) NOT NULL COMMENT '链接网址',
  `taxis` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排序，值越小越往前靠',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正在使用0未使用',
  `ifsystem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为系统菜单0为可编辑菜单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- 导出表中的数据 `yui_sysmenu`
--

INSERT INTO `yui_sysmenu` (`id`, `rootid`, `parentid`, `name`, `menu_url`, `taxis`, `status`, `ifsystem`) VALUES
(1, 0, 0, '系统设置', 'admin.php?file=left&act=system', 255, 1, 1),
(2, 1, 0, '常规设置', '', 10, 1, 1),
(3, 1, 2, '网站基本信息', 'admin.php?file=system&act=siteset', 10, 1, 1),
(57, 15, 19, '分类管理', 'admin.php?file=category&act=list', 50, 1, 0),
(5, 1, 2, '后台菜单管理', 'admin.php?file=sysmenu&act=index', 254, 1, 1),
(7, 1, 2, 'GD图形库设置', 'admin.php?file=system&act=gdset', 30, 1, 1),
(8, 1, 2, '附件上传设置', 'admin.php?file=system&act=ftpset', 40, 1, 1),
(15, 0, 0, '内容管理', 'admin.php?file=left&act=msg', 10, 1, 0),
(19, 15, 0, '内容信息', '', 10, 1, 0),
(20, 15, 19, '文章内容', 'admin.php?file=article&act=list', 10, 1, 0),
(24, 15, 0, '附件管理', '', 20, 1, 0),
(25, 15, 24, '添加附件链接', 'admin.php?file=attachments&act=link', 10, 1, 0),
(26, 15, 24, 'Xupfiles上传大文件', 'admin.php?file=attachments&act=xupfiles', 20, 0, 0),
(27, 15, 24, '简单的小文件上传', 'admin.php?file=attachments&act=upfiles', 40, 1, 0),
(29, 15, 24, '附件列表', 'admin.php?file=attachments&act=list', 255, 1, 0),
(30, 15, 19, '单页面管理', 'admin.php?file=onepage&act=list', 60, 1, 0),
(45, 0, 0, '其他管理', 'admin.php?file=left&act=other', 30, 1, 0),
(47, 45, 71, '网站留言', 'admin.php?file=book&act=list', 20, 1, 0),
(52, 45, 71, '站内公告', 'admin.php?file=notice&act=list', 10, 1, 0),
(58, 15, 19, '产品管理', 'admin.php?file=product&act=list', 20, 0, 0),
(61, 45, 71, '导航菜单', 'admin.php?file=nav&act=list', 30, 1, 0),
(64, 45, 71, '管理投票', 'admin.php?file=vote&act=list', 40, 1, 0),
(72, 45, 71, '自定义链接', 'admin.php?file=link&act=list', 60, 1, 0),
(67, 45, 71, '自定义代码', 'admin.php?file=phpok&act=list', 50, 1, 0),
(68, 15, 19, '图片播放器', 'admin.php?file=index.img&act=set', 255, 1, 0),
(69, 15, 19, '图片展示', 'admin.php?file=picture&act=list', 30, 0, 0),
(70, 15, 19, '下载信息', 'admin.php?file=download&act=list', 40, 0, 0),
(71, 45, 0, '基本功能管理', '', 10, 1, 0),
(73, 0, 0, '人力管理', '', 20, 0, 0),
(75, 45, 0, '试驾预约', '', 255, 1, 0),
(76, 45, 75, '试驾预约', 'admin.php?file=driver&act=list', 255, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yui_upfiles`
--

CREATE TABLE IF NOT EXISTS `yui_upfiles` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号，也是附件的ID号',
  `filetype` varchar(10) NOT NULL COMMENT '文件格式，如jpg,gif等',
  `tmpname` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名称，即在客户端显示的名称',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '新文件名称，这是以时间及随机数整合生成的唯一值',
  `folder` varchar(255) NOT NULL DEFAULT '' COMMENT '文件目录，基于网站的根目录的路径',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `thumbfile` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图文件，假如附件是图片的话',
  `markfile` varchar(255) NOT NULL DEFAULT '' COMMENT '水印图文件，假如附件是图片的话',
  PRIMARY KEY (`id`),
  KEY `filetype` (`filetype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- 导出表中的数据 `yui_upfiles`
--

INSERT INTO `yui_upfiles` (`id`, `filetype`, `tmpname`, `filename`, `folder`, `postdate`, `thumbfile`, `markfile`) VALUES
(54, 'jpg', 'lm01.jpg', '1236241455.jpg', 'upfiles/', 1236241455, 'thumb_1236241455.jpg', 'mark_1236241455.jpg'),
(55, 'jpg', 'lm02.jpg', '1236241511.jpg', 'upfiles/', 1236241511, 'thumb_1236241511.jpg', 'mark_1236241511.jpg'),
(47, 'gif', 'title-logo.gif', '1234920867.gif', 'upfiles/', 1234920867, 'thumb_1234920867.gif', 'mark_1234920867.gif'),
(48, 'svn', '.svn', '1236065513_82.svn', 'upfiles/200903/03/', 1236065513, '', ''),
(49, 'jpg', 'bb12.jpg', '1236066692.jpg', 'upfiles/', 1236066692, 'thumb_1236066692.jpg', 'mark_1236066692.jpg'),
(50, 'jpg', 'bb13.jpg', '1236066713.jpg', 'upfiles/', 1236066713, 'thumb_1236066713.jpg', 'mark_1236066713.jpg'),
(51, 'svn', '.svn', '1236215447_7.svn', 'upfiles/200903/05/', 1236215447, '', ''),
(52, 'jpg', 'lm00.jpg', '1236240263.jpg', 'upfiles/', 1236240263, 'thumb_1236240263.jpg', 'mark_1236240263.jpg'),
(53, 'jpg', 'lm00.jpg', '1236241194.jpg', 'upfiles/', 1236241194, 'thumb_1236241194.jpg', 'mark_1236241194.jpg'),
(56, 'svn', '.svn', '1236324084_100.svn', 'upfiles/200903/06/', 1236324084, '', ''),
(65, 'jpg', '1236570890_1.jpg', '1236570890_1.jpg', 'upfiles/', 1236570890, 'thumb_1236570890_1.jpg', 'mark_1236570890_1.jpg'),
(66, 'jpg', '1236570890_2.jpg', '1236570890_2.jpg', 'upfiles/', 1236570890, 'thumb_1236570890_2.jpg', 'mark_1236570890_2.jpg'),
(61, 'jpg', '3b_ex_focus_img1.jpg', '1236329146.jpg', 'upfiles/', 1236329146, 'thumb_1236329146.jpg', 'mark_1236329146.jpg'),
(62, 'jpg', 'FCN_smax_exGallery_03_IMG,01.jpg', '1236329154.jpg', 'upfiles/', 1236329154, 'thumb_1236329154.jpg', 'mark_1236329154.jpg'),
(63, 'jpg', 'FCN_zhisheng_ExGallery_01_IMG1.jpg', '1236329161.jpg', 'upfiles/', 1236329161, 'thumb_1236329161.jpg', 'mark_1236329161.jpg'),
(64, 'jpg', 'FCN_zhisheng_ExGallery_01_IMG12.jpg', '1236329172.jpg', 'upfiles/', 1236329172, 'thumb_1236329172.jpg', 'mark_1236329172.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `yui_vote`
--

CREATE TABLE IF NOT EXISTS `yui_vote` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID号',
  `voteid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '是否是主题，0为主题，其他ID为选项',
  `subject` varchar(255) NOT NULL DEFAULT '' COMMENT '主题或被选项名称',
  `vtype` enum('single','pl') NOT NULL DEFAULT 'pl' COMMENT '投票类型，single单选，pl是复选',
  `vcount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '票数',
  `ifcheck` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认是否选中，0为不选中，1为选中',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `yui_vote`
--

INSERT INTO `yui_vote` (`id`, `voteid`, `subject`, `vtype`, `vcount`, `ifcheck`) VALUES
(1, 0, '改进服务计划', 'single', 3, 1),
(2, 1, '相当不错', 'single', 3, 1),
(3, 1, '一般般！', 'single', 1, 0),
(4, 1, '不是很好', 'single', 0, 0),
(5, 1, '无法满意', 'single', 0, 0);

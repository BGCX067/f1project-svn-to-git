-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2008 年 09 月 21 日 17:44
-- 服务器版本: 5.0.27
-- PHP 版本: 5.2.0
-- 
-- 数据库: `phpok3s`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_admin`
-- 

CREATE TABLE `yui_admin` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `typer` enum('system','manager','editor') NOT NULL default 'editor',
  `user` varchar(100) NOT NULL default '',
  `pass` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `modulelist` text NOT NULL COMMENT '可管理的模块，系统管理员无效',
  `menuid` varchar(255) NOT NULL COMMENT '常用菜单ID号',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `yui_admin`
-- 

INSERT INTO `yui_admin` (`id`, `typer`, `user`, `pass`, `email`, `modulelist`, `menuid`) VALUES 
(1, 'system', 'admin', '5f1d81ea31359130eec025c057ec218d', 'admin@admin.com', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_book`
-- 

CREATE TABLE `yui_book` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user` varchar(255) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL default '0',
  `email` varchar(255) NOT NULL default '',
  `ifcheck` tinyint(3) unsigned NOT NULL default '0' COMMENT '0为未审核，1为已审核所有人可以看，2为已审核但仅限会员能查看',
  `reply` text NOT NULL,
  `replydate` int(10) unsigned NOT NULL default '0' COMMENT '回复时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `yui_book`
-- 

INSERT INTO `yui_book` (`id`, `user`, `subject`, `content`, `postdate`, `email`, `ifcheck`, `reply`, `replydate`) VALUES 
(1, '测试', '测试留言', '测试留言', 1221922909, 'test@126.com', 1, '<div>测试审核\r\n<div><img border="0" alt="" src="upfiles/200809/03/mark_1220426054.jpg" /></div>\r\n</div>', 1221923491),
(2, '测试2', '图片展示5', 'fsdfasdfasd', 1221923587, 'test@126.com', 1, '', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_category`
-- 

CREATE TABLE `yui_category` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是分类ID号',
  `catetype` enum('article','product','picture','download') NOT NULL default 'article' COMMENT '分类类别',
  `rootid` mediumint(8) unsigned NOT NULL default '0' COMMENT '根分类ID号',
  `parentid` mediumint(8) unsigned NOT NULL default '0' COMMENT '父分类ID号',
  `catename` varchar(255) NOT NULL default '' COMMENT '分类名称',
  `catestyle` varchar(255) NOT NULL default '' COMMENT '样式',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `tpl_index` varchar(255) NOT NULL default '' COMMENT '封面模板',
  `tpl_list` varchar(255) NOT NULL default '' COMMENT '列表模板',
  `tpl_msg` varchar(255) NOT NULL default '' COMMENT '内容模板',
  `ifcheck` tinyint(1) unsigned NOT NULL default '1' COMMENT '1为正常，0为隐藏',
  `psize` tinyint(3) unsigned NOT NULL default '30' COMMENT '分类列表每页显示个数，默认是30',
  `keywords` varchar(255) NOT NULL COMMENT '分类关键字',
  `description` varchar(255) NOT NULL COMMENT '分类描述',
  `note` varchar(255) NOT NULL COMMENT '分类描述',
  PRIMARY KEY  (`id`),
  KEY `rootid` (`rootid`,`ifcheck`),
  KEY `parentid` (`parentid`,`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类管理' AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `yui_category`
-- 

INSERT INTO `yui_category` (`id`, `catetype`, `rootid`, `parentid`, `catename`, `catestyle`, `taxis`, `tpl_index`, `tpl_list`, `tpl_msg`, `ifcheck`, `psize`, `keywords`, `description`, `note`) VALUES 
(1, 'article', 0, 0, '新闻中心', '', 10, '', '', '', 1, 30, '', '', '关于本站的一些新闻信息~~'),
(2, 'product', 0, 0, '产品中心', '', 10, '', '', '', 1, 10, '', '', '展示产品相关信息'),
(3, 'picture', 0, 0, '图片展示', '', 10, '', '', '', 1, 30, '', '', '展示本公司里的一些图片信息'),
(4, 'download', 0, 0, '相关下载', '', 10, '', '', '', 1, 30, '', '', '关于本站的一些文件下载'),
(5, 'article', 1, 1, '公司新闻', '', 10, '', '', '', 1, 30, '', '', ''),
(6, 'article', 1, 1, '行业新闻', '', 20, '', '', '', 1, 30, '', '', ''),
(7, 'article', 1, 5, '测试第三级分类', '', 10, '', '', '', 1, 30, '', '', ''),
(8, 'article', 1, 7, '测试第四级分类', '', 10, '', '', '', 1, 30, '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_codes`
-- 

CREATE TABLE `yui_codes` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `sign` varchar(50) NOT NULL COMMENT '自定义标签，必须是唯一值或空值',
  `subject` varchar(255) NOT NULL COMMENT '广告题头，用于后台管理',
  `content` text NOT NULL COMMENT '广告内容',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为未审核，1为正常',
  PRIMARY KEY  (`id`),
  KEY `start_date` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自定义代码管理' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `yui_codes`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `yui_content`
-- 

CREATE TABLE `yui_content` (
  `id` int(10) unsigned NOT NULL default '0' COMMENT '主题ID号，对应msg表中的自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类ID号，用于索引',
  `content` longtext NOT NULL COMMENT '内容信息',
  PRIMARY KEY  (`id`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容';

-- 
-- 导出表中的数据 `yui_content`
-- 

INSERT INTO `yui_content` (`id`, `cateid`, `content`) VALUES 
(1, 4, '<div>\r\n<div>这是内容的说明~~~~~~~</div>\r\n<div>\r\n<div><a   href="dfile.php?id=45" target=''_blank''>点击下载附件</a> &nbsp; 001.jpg</div>\r\n</div>\r\n</div>\r\n<div>&nbsp;</div>'),
(2, 1, '<div>这是应用于新闻测试的~~</div>'),
(3, 2, '<div>简单测试dfasdfsdfasdf</div>'),
(4, 3, '<div>这是测试图片展示用滴~</div>'),
(5, 1, '<div>不错不错fsdafsdfsdafsdafsafsdfsad</div>'),
(6, 1, '<div>fsdfsdfsfsdfsdfg</div>'),
(7, 2, '<div>呵呵~~~~</div>');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_link`
-- 

CREATE TABLE `yui_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `typeid` mediumint(9) NOT NULL COMMENT '对应linktype的类别',
  `name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `picture` varchar(255) default NULL,
  `taxis` tinyint(3) unsigned default '255',
  `width` tinyint(3) unsigned NOT NULL COMMENT '图片链接宽度',
  `height` tinyint(3) unsigned NOT NULL COMMENT '图片链接高度',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `yui_link`
-- 

INSERT INTO `yui_link` (`id`, `typeid`, `name`, `url`, `picture`, `taxis`, `width`, `height`) VALUES 
(1, 1, 'PHPOK企业站', 'http://www.phpok.com', '', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_linktype`
-- 

CREATE TABLE `yui_linktype` (
  `id` mediumint(9) NOT NULL auto_increment COMMENT '链接类型',
  `typename` varchar(80) NOT NULL COMMENT '链接类型',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='链接类型管理' AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `yui_linktype`
-- 

INSERT INTO `yui_linktype` (`id`, `typename`) VALUES 
(1, '友情链接');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_msg`
-- 

CREATE TABLE `yui_msg` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '信息自增ID号',
  `cateid` mediumint(8) unsigned NOT NULL default '0' COMMENT '分类ID对应category表的自增ID号',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题',
  `style` varchar(255) NOT NULL default '' COMMENT '主题CSS样式',
  `author` varchar(50) NOT NULL default '' COMMENT '作者名称',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '发布时间',
  `tplfile` varchar(255) NOT NULL default '' COMMENT '模板文件，为空使用系统默认',
  `hits` int(10) unsigned NOT NULL default '0' COMMENT '点击率',
  `taxis` int(11) NOT NULL default '0' COMMENT '排序，值越大越往前排',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `istop` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否置顶，0为普通，1－9为不同级别的置顶',
  `isvouch` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否推荐，0为不推荐，1－9为不同级别的推荐',
  `isbest` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否精华，0为普通，1－9为不同级别的精华',
  `ifcheck` tinyint(1) unsigned NOT NULL default '1' COMMENT '1为已审核，0为未审核',
  `clou` varchar(255) NOT NULL COMMENT '简要描述',
  `url` varchar(255) default '' COMMENT '外部网址',
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
  PRIMARY KEY  (`id`,`cateid`),
  KEY `cateid` (`cateid`,`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `yui_msg`
-- 

INSERT INTO `yui_msg` (`id`, `cateid`, `subject`, `style`, `author`, `postdate`, `tplfile`, `hits`, `taxis`, `thumb`, `istop`, `isvouch`, `isbest`, `ifcheck`, `clou`, `url`, `mark`, `standard`, `number`, `m_price`, `s_price`, `promotions`, `softsize`, `softlang`, `softsystem`, `softdemo`, `softadmin`, `softemail`, `softother`, `softlicense`) VALUES 
(1, 4, '测试下载', '', 'admin', 1220371200, '', 17, 0, '', 1, 0, 0, 1, '这里测试下载的相关描述', 'http://www.phpok.com', '', '', '', '', '', '', '150KB', '简体中文', 'Windows XP/2003/Vista', 'http://demo.phpok.com', '情感', 'qinggan@188.com', '', 'LGPL'),
(2, 1, '测试新闻', '', 'admin', 1220437251, '', 0, 0, '', 0, 0, 0, 1, '本新闻应用于测试使用', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 2, '测试产品', '', 'admin', 1220371200, '', 36, 0, 'upfiles/200809/21/thumb_1221989172_51.jpg', 0, 0, 0, 1, '简单测试', '', 'upfiles/200809/21/mark_1221989172_51.jpg', 'SD983', 'DDP9', '98.00', '78.00', '购买本商品可物赠……', '', '', '', '', '', '', '', ''),
(4, 3, '测试图片展示', '', 'admin', 1220371200, '', 16, 0, 'upfiles/200809/21/thumb_1221989172_51.jpg', 0, 0, 0, 1, '', '', 'upfiles/200809/21/mark_1221989172_51.jpg', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 1, '不错不错', '', 'admin', 1220544000, '', 4, 0, '', 0, 0, 0, 1, '3.0啊ffsdfsfsdfsdfsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 1, 'sdfsdfsdfsdfsdf', '', 'admin', 1220544000, '', 9, 0, '', 1, 1, 0, 1, 'sdfasfsadfsdafsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 2, '测试产品二', '', 'admin', 1221840000, '', 19, 0, 'upfiles/200809/21/thumb_1221989058_20.jpg', 0, 0, 0, 1, '这是测试产品二噢', '', 'upfiles/200809/21/mark_1221989058_20.jpg', '吨', 'DS-100', '98.50', '90.00', '买二赠一', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_nav`
-- 

CREATE TABLE `yui_nav` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `css` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `target` tinyint(3) unsigned NOT NULL default '0',
  `taxis` tinyint(3) unsigned NOT NULL default '255',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `yui_nav`
-- 

INSERT INTO `yui_nav` (`id`, `name`, `css`, `url`, `target`, `taxis`) VALUES 
(1, '网站首页', '', 'home.php', 0, 10),
(2, '公司简介', '', 'special.php?id=1', 0, 20),
(3, '新闻中心', '', 'list.php?id=1', 0, 30),
(4, '图片展示', '', 'list.php?id=3', 0, 40),
(5, '产品中心', '', 'list.php?id=2', 0, 50),
(6, '相关下载', '', 'list.php?id=4', 0, 60),
(7, '在线留言', '', 'book.php', 0, 70),
(8, '联系我们', '', 'special.php?id=2', 0, 80);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_notice`
-- 

CREATE TABLE `yui_notice` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `subject` varchar(255) NOT NULL default '',
  `style` varchar(255) NOT NULL COMMENT '样式管理',
  `url` varchar(255) NOT NULL default '' COMMENT '公告链接的网址',
  `content` text NOT NULL,
  `postdate` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
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

CREATE TABLE `yui_onegroup` (
  `id` mediumint(9) NOT NULL auto_increment COMMENT '自增ID号，也是组ID号',
  `groupname` varchar(255) NOT NULL COMMENT '组名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页面分组' AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `yui_onegroup`
-- 

INSERT INTO `yui_onegroup` (`id`, `groupname`) VALUES 
(1, '简介组'),
(2, '人物组');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_onepage`
-- 

CREATE TABLE `yui_onepage` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是专题ID号',
  `groupid` mediumint(9) NOT NULL default '0' COMMENT '分组ID，未分组的ID将在任意组中显示',
  `subject` varchar(255) NOT NULL default '' COMMENT '专题名称',
  `style` varchar(255) NOT NULL default '' COMMENT 'CSS样式',
  `sub_content` text NOT NULL COMMENT '简单说明内容',
  `content` text NOT NULL COMMENT '专题内容',
  `url` varchar(255) NOT NULL default '' COMMENT '跳转网址',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `ifcheck` tinyint(1) unsigned NOT NULL default '1' COMMENT '专题状态，0为锁定，1为正常',
  `tpl` varchar(255) NOT NULL COMMENT '模板文件',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页面管理' AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `yui_onepage`
-- 

INSERT INTO `yui_onepage` (`id`, `groupid`, `subject`, `style`, `sub_content`, `content`, `url`, `taxis`, `ifcheck`, `tpl`) VALUES 
(1, 1, '公司简介', '', '', '<div>这里是公司简介信息~~~嘿嘿</div>', '', 10, 1, ''),
(2, 1, '联系我们', '', '', '<div>联系我们页面</div>', '', 20, 1, ''),
(3, 1, '老总致词', '', '', '<div>老总致词信息~~~</div>', '', 30, 1, ''),
(4, 1, '公司荣誉', '', '', '<div>公司制度</div>', '', 40, 1, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_phpok`
-- 

CREATE TABLE `yui_phpok` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `sign` varchar(50) NOT NULL COMMENT '自定义标签，必须是唯一值或空值',
  `subject` varchar(255) NOT NULL COMMENT '标题，用于后台管理',
  `content` text NOT NULL COMMENT '自定义内容',
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '0为未审核，1为正常',
  PRIMARY KEY  (`id`),
  KEY `start_date` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='自定义代码表' AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `yui_phpok`
-- 

INSERT INTO `yui_phpok` (`id`, `sign`, `subject`, `content`, `status`) VALUES 
(1, 'contactus', '联系我们', '<div>联系手机：15818533971</div>\r\n<div>联系人：苏相锟</div>\r\n<div>网络昵称：情感</div>', 1),
(2, 'about', 'PHPOK简介', '<div>　　&ldquo;PHPOK企业站&rdquo;（简称PHPOK）建设系统是一套基于PHP和MySQL构建的高效企业网站建设方案之一，全面针对企业网（以展示为中心）进行合理的设计规划。这是一套开源的，免费的企业网站程序！您在遵守<a   href="http://www.gnu.org/copyleft/lesser.html" target=''_blank''>LGPL协议</a>的基础上即可免费使用。</div>\r\n<div>　　三年来，我们一直在&ldquo;探索、思考、批评和自我批评&rdquo;中走了过来，未来，我们将还继续执行这一不变的法则，以保证PHPOK程序的先进。</div>\r\n<div>　　只有不停的向往走，我才有可能会成功！</div>', 1),
(3, 'footer', '页脚版权说明', '<div>CopyRight&nbsp; &copy;&nbsp; All Right Reserved&nbsp; [<a   href="admin.php" target=''_blank''>后台管理</a>]</div>\r\n<div>QQ：40782502&nbsp; 邮箱：<a   href="mailto:qinggan@188.com" target=''_blank''>qinggan@188.com</a>&nbsp; 手机：15818533971</div>', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_session`
-- 

CREATE TABLE `yui_session` (
  `id` varchar(32) NOT NULL COMMENT 'session_id',
  `data` text NOT NULL COMMENT 'session 内容',
  `lasttime` int(10) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='SESSION信息';

-- 
-- 导出表中的数据 `yui_session`
-- 

INSERT INTO `yui_session` (`id`, `data`, `lasttime`) VALUES 
('2d1f3988bb19f759fd1a57590dfd45fc', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"5f1d81ea31359130eec025c057ec218d";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}return_url|s:44:"admin.php?file=attachments&act=list&pageid=0";input_name|s:4:"mark";', 1221990168);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_sysmenu`
-- 

CREATE TABLE `yui_sysmenu` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `rootid` mediumint(8) unsigned NOT NULL default '0' COMMENT '所属为子分类ID，0为他本身就是根分类，不存在链接',
  `parentid` mediumint(8) unsigned NOT NULL default '0' COMMENT '左侧菜单父级ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `menu_url` varchar(255) NOT NULL COMMENT '链接网址',
  `taxis` tinyint(3) unsigned NOT NULL default '255' COMMENT '排序，值越小越往前靠',
  `status` tinyint(1) unsigned NOT NULL default '1' COMMENT '1正在使用0未使用',
  `ifsystem` tinyint(1) NOT NULL default '0' COMMENT '1为系统菜单0为可编辑菜单',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统菜单管理' AUTO_INCREMENT=73 ;

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
(26, 15, 24, 'Xupfiles上传大文件', 'admin.php?file=attachments&act=xupfiles', 20, 1, 0),
(27, 15, 24, '简单的小文件上传', 'admin.php?file=attachments&act=upfiles', 40, 1, 0),
(29, 15, 24, '附件列表', 'admin.php?file=attachments&act=list', 255, 1, 0),
(30, 15, 19, '单页面管理', 'admin.php?file=onepage&act=list', 60, 1, 0),
(45, 0, 0, '其他管理', 'admin.php?file=left&act=other', 30, 1, 0),
(47, 45, 71, '网站留言', 'admin.php?file=book&act=list', 20, 1, 0),
(52, 45, 71, '站内公告', 'admin.php?file=notice&act=list', 10, 1, 0),
(58, 15, 19, '产品管理', 'admin.php?file=product&act=list', 20, 1, 0),
(61, 45, 71, '导航菜单', 'admin.php?file=nav&act=list', 30, 1, 0),
(64, 45, 71, '管理投票', 'admin.php?file=vote&act=list', 40, 1, 0),
(72, 45, 71, '自定义链接', 'admin.php?file=link&act=list', 60, 1, 0),
(67, 45, 71, '自定义代码', 'admin.php?file=phpok&act=list', 50, 1, 0),
(68, 15, 19, '图片播放器', 'admin.php?file=index.img&act=set', 255, 1, 0),
(69, 15, 19, '图片展示', 'admin.php?file=picture&act=list', 30, 1, 0),
(70, 15, 19, '下载信息', 'admin.php?file=download&act=list', 40, 1, 0),
(71, 45, 0, '基本功能管理', '', 10, 1, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_upfiles`
-- 

CREATE TABLE `yui_upfiles` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号，也是附件的ID号',
  `filetype` varchar(10) NOT NULL COMMENT '文件格式，如jpg,gif等',
  `tmpname` varchar(255) NOT NULL default '' COMMENT '原文件名称，即在客户端显示的名称',
  `filename` varchar(255) NOT NULL default '' COMMENT '新文件名称，这是以时间及随机数整合生成的唯一值',
  `folder` varchar(255) NOT NULL default '' COMMENT '文件目录，基于网站的根目录的路径',
  `postdate` int(10) unsigned NOT NULL default '0' COMMENT '上传时间',
  `thumbfile` varchar(255) NOT NULL default '' COMMENT '缩略图文件，假如附件是图片的话',
  `markfile` varchar(255) NOT NULL default '' COMMENT '水印图文件，假如附件是图片的话',
  PRIMARY KEY  (`id`),
  KEY `filetype` (`filetype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- 
-- 导出表中的数据 `yui_upfiles`
-- 

INSERT INTO `yui_upfiles` (`id`, `filetype`, `tmpname`, `filename`, `folder`, `postdate`, `thumbfile`, `markfile`) VALUES 
(46, 'jpg', 'phpok3s_01.jpg', '1221989172_51.jpg', 'upfiles/200809/21/', 1221989172, 'thumb_1221989172_51.jpg', 'mark_1221989172_51.jpg'),
(45, 'jpg', '001.jpg', '1221989058_20.jpg', 'upfiles/200809/21/', 1221989058, 'thumb_1221989058_20.jpg', 'mark_1221989058_20.jpg');

-- --------------------------------------------------------

-- 
-- 表的结构 `yui_vote`
-- 

CREATE TABLE `yui_vote` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '自增ID号',
  `voteid` mediumint(8) unsigned NOT NULL default '0' COMMENT '是否是主题，0为主题，其他ID为选项',
  `subject` varchar(255) NOT NULL default '' COMMENT '主题或被选项名称',
  `vtype` enum('single','pl') NOT NULL default 'pl' COMMENT '投票类型，single单选，pl是复选',
  `vcount` int(10) unsigned NOT NULL default '0' COMMENT '票数',
  `ifcheck` tinyint(1) unsigned NOT NULL default '0' COMMENT '默认是否选中，0为不选中，1为选中',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- 导出表中的数据 `yui_vote`
-- 

INSERT INTO `yui_vote` (`id`, `voteid`, `subject`, `vtype`, `vcount`, `ifcheck`) VALUES 
(1, 0, '您认为PHPOK3.0精简版是否符合要求', 'single', 0, 1),
(2, 1, '相当不错，基本符合我的要求', 'single', 2, 1),
(3, 1, '一般般！没有任何特色', 'single', 1, 0),
(4, 1, '不是很好，我要的功能都没有', 'single', 0, 0),
(5, 1, '无法满足，我使用其他程序', 'single', 0, 0);

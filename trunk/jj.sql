-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 03 月 25 日 04:09
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `yui_book`
--

INSERT INTO `yui_book` (`id`, `user`, `subject`, `content`, `postdate`, `email`, `ifcheck`, `reply`, `replydate`) VALUES
(1, '测试', '测试留言', '测试留言', 1221922909, 'test@126.com', 1, '<div>测试审核\r\n<div><img border="0" alt="" src="upfiles/200809/03/mark_1220426054.jpg" /></div>\r\n</div>', 1221923491),
(2, '测试2', '图片展示5', 'fsdfasdfasd', 1221923587, 'test@126.com', 1, '', 0),
(7, '12312', '123', '123', 1237344449, '1212@4325.xx', 1, '<div>我叼反你.</div>', 1237344936),
(18, '得不了', '嘉年华 | 电话:3849234 | 地址:9829348', '89238495324', 1237347792, 'jkjklads@iu.com', 0, '', 1237347797),
(9, '谢轩仲', '蒙迪欧-致胜', '修下啦.修到地狱', 1237345734, 'xxz@live.cn', 1, '<div>你可以....</div>', 1237345741),
(16, '蝇', '嘉年华 | 电话:213948 | 地址:892384', '89238409234', 1237346934, 'xxz@live.cn', 1, '<div>不用理我.</div>', 1237346982),
(15, '小白2', '嘉年华 | 239482394 | 8923849', '8923894', 1237346893, 'xxz@live.cn', 1, '', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `yui_category`
--

INSERT INTO `yui_category` (`id`, `catetype`, `rootid`, `parentid`, `catename`, `catestyle`, `taxis`, `tpl_index`, `tpl_list`, `tpl_msg`, `ifcheck`, `psize`, `keywords`, `description`, `note`) VALUES
(1, 'article', 0, 0, '新闻中心', '', 10, '', 'list.news', 'new.detail', 1, 10, '', '', '关于本站的一些新闻信息~~'),
(2, 'product', 0, 0, '产品中心', '', 10, '', '', '', 1, 10, '', '', '展示产品相关信息'),
(3, 'picture', 0, 0, '图片展示', '', 10, '', '', '', 1, 30, '', '', '展示本公司里的一些图片信息'),
(5, 'article', 0, 0, '活动新闻', '', 255, '', 'list.sp', 'new.play', 1, 30, '', '', ''),
(6, 'article', 0, 0, '首页活动', '', 255, '', '', '', 1, 2, '', '', '');

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
(11, 1, '<div>Loveing you</div>'),
(12, 1, '<div>55555555555</div>'),
(13, 1, '<div>456456456</div>'),
(14, 1, '<div>67567</div>'),
(15, 1, '<div>hggg</div>'),
(16, 1, '<div>cdf5fg</div>'),
(17, 1, '<div>aadf345</div>'),
(18, 1, '<div>asdfasdf</div>'),
(28, 5, '<div>11111111111111111111111111111111111</div>'),
(20, 1, '<div>4444444444444444444444</div>'),
(21, 1, '<div>444444444444444444444442222222</div>'),
(22, 1, '<div>2222222222222222222222</div>'),
(23, 1, '<div>345345345</div>'),
(24, 1, '<div>345345345</div>'),
(25, 1, '<div>7777</div>'),
(26, 1, '<div>中国轿车行业发展趋势报告显示，近年来，中国经济的快速稳定增长使私人用车成为国内轿车需求的主体，这一趋势在公私兼用的中高级车领域优为明显。截至2008年，国内中高级车消费市场中有近80%是私人购车。该报告同时指出，中高级轿车的消费群体对车辆的综合要求日益提高，选购车型的配置级别也从原来的标准化向豪华化过渡。市场的内在需求变化及竞争的激烈化推动国内汽车消费市场整体漂移，使其出现中级车中高级化、中高级车高级化的现象。\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 业内专家表示，在汽车消费私人化的时代，对于车主而言，车辆职能正日益扩展：它已不仅仅是代步工具，而且还是与生活和工作密切相关的身份象征和伙伴助手，同时也为车主提供一个家庭生活和工作之外的&ldquo;第三空间&rdquo;。这对于中高级车的消费群体而言更是如此。所以豪华感与舒适性一直是评价一款中高级车最重要的两大标尺。因此，在消费需求的驱动下，中高级车一直在向更豪华、更舒适这个方向升级。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 在这个背景下，2月18日荣耀登场的新凯美瑞，无疑具有里程碑式的意义。从06年首款上市的凯美瑞，到如今驰骋中高级车市场的新凯美瑞，其间的每次变更，都意味着超越；每次的超越，都为国内中高级车市场带来不同的震撼，为中国消费者带来全新的理念和价值观。此次新凯美瑞在技术、配置、外形、价格及服务上进行了全面革新，尤其是G-BOOK智能副驾系统的导入，把中高级车带入到一个新的发展阶段，有力地推动了中高级车的不断超越。</div>\r\n<div>&nbsp;</div>\r\n<div><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;外观超越&mdash;动感尊贵，势领风潮</b></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第六代凯美瑞的外观造型尊贵大气，内饰空间宽敞舒适，整车配置高级、丰富。它以完美的产品均衡性，满足了国内大部分消费者的用车和审美需求，稳稳占据了中高级车的价值标杆地位。而此次改款的新凯美瑞，在调查了当下国内消费主流审美趋势后，在保持原有的尊贵感、高级感基础之上融入洋溢动感风格的设计元素，完美融合了尊贵感、运动感与力量感，打造出&ldquo;动感而尊贵&rdquo;的外观风格。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 新凯美瑞的前脸是更动感锐利的X型布局，令人产生一种以保险杠为中心向上、左、右三个方向流动的视觉印象，彰显出锐意进取的气度；前脸格栅边框及横条经过了重新设计，不仅增加了宽度和厚度，而且具有更强烈的立体感、层次感和流动感；前大灯采用了三层立体结构，呈现出三维雕刻的厚实感，而尾灯的设计则与其相呼应，形状由原先的圆形改为平行四边形；此外，新凯美瑞全新的16英寸和17英寸铝合金轮毂采用多纵深的立体设计，大小双辐条的造型更显层次感。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;从车辆前脸45度角方向观望，新凯美瑞的前格栅、前大灯和前雾灯的造型调整使其与车身融为一体，整车感觉舒展流畅，一气呵成。正是这些细节处的精心雕琢，使新凯美瑞具备了超越同级车水平的豪华感。</div>\r\n<div>&nbsp;</div>\r\n<div><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 内蕴超越&mdash;豪华丰富，直指人心</b></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 有业内人士表示，当汽车消费从一种生活需求演变为生活追求之时，单纯以精致华丽的外观并不能诠释豪华的全部意义。事实上，豪华是一种无微不致的高水准呵护，是一种无时无刻不为顾客全面设想的态度。而这恰是广汽丰田凯美瑞一直延承的基因。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;曾有国内知名汽车媒体把Camry凯美瑞的命名分拆为&ldquo;My Car&rdquo;，意喻&ldquo;居者有其屋，驾者有其车&rdquo;的深厚内蕴，此虽为一家之言，但实际上，在不少人的印象中，凯美瑞作为丰田车的代表之作，一直是令驾乘者舒适安心、无后顾之忧的尊贵座驾。历经一番精心的升级与进化，如今的新凯美瑞进一步强化了尊贵与贴心的特色。诸多此前只见于C级车的豪华配置均被导入，新凯美瑞的舒适便捷性和豪华高级感大幅超越了目前市场主流中高级车的标准。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后座侧窗遮阳帘、8扬声器原声音场音响系统、车顶尊贵迎宾照明系统为顾客营造出更舒适安心的驾乘空间；倒车摄像系统、倒车辅助外后视镜两项尊贵配置及与外后视镜联动的电动座椅记忆功能为顾客提供了更便捷灵活的驾乘操控；经过改善升级的中控台与仪表板布局、多碟连放音响系统等多项配置、AUX多功能音频接口以及哑光木纹内饰为顾客带来更人性化的驾乘感受，这些细致周到的升级与改善无一不让人体验到纯正的丰田式持续改善的独特魅力。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这些豪华装备，很多也是首次出现在中国的中高级车序列的配置清单中。业内专家认为，&ldquo;新凯美瑞在配置上不遗余力的重磅增加，大有将中高级与高级豪华泾渭分明的分野抹平之势&rdquo;。</div>\r\n<div>&nbsp;</div>\r\n<div><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;技术超越</b><b>&mdash;智能副驾，贴心服务</b></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 除了自内而外的全面革新，新凯美瑞最重要的技术升级，当属将于5月份导入的、丰田旗下最先进的G-BOOK智能副驾系统。据悉，该系统是丰田全球最顶尖的智能车辆服务平台之一，被外界誉为&ldquo;开启汽车生活e时代的钥匙&rdquo;。早在2006年，广汽丰田便首先提出&ldquo;汽车e时代&rdquo;的理念，并导入丰田独步天下的e-CRB系统，倾力打造信息时代的&ldquo;e店&rdquo;，构成广汽丰田&ldquo;e工厂&rdquo;、&ldquo;e店&rdquo;、&ldquo;e车&rdquo;&ldquo;三位一体&rdquo;体系中的重要一环，为顾客提供全面而及时的服务。此次新凯美瑞导入G-BOOK智能副驾系统，把高科技手段跟生活及网络信息技术相结合，让驾车成为一种真正的享受。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; G-BOOK智能副驾系统将热线中心和客户的爱车通过无线网络连接起来，实现高科技电子装备与一对一人工服务的融合，每时每刻为顾客创造更加尊贵贴心的驾乘体验，以无微不至的服务担当了顾客用车生活中&ldquo;影子管家&rdquo;的角色，构筑安心、安全、舒适的汽车生活。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 毫无疑问，此次G-BOOK智能副驾系统的导入，使新凯美瑞的技术水平远远领先于同级任何一款车型，同时树立了中高级车最具含金量的豪华标杆。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;此外，自3月1日起销售的新凯美瑞将实行3年或10万公里的保修服务，此举势必引起中高级车市服务政策标准升级，将全面确立中高级车市新的服务标杆。</div>\r\n<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 在2006年6月，凯美瑞在中国的荣耀诞生，其在品质、服务等多个层面的卓越品质有力推动了中国车市的健康发展。如今，在此基础上更上一层楼的新凯美瑞，以在外形、配置、技术、服务等方面的全面革新，充分满足了中高级车消费主流群体的深层需求。业内专家表示，新凯美瑞将重新定义中高级车的价值标杆，并引领中高级车坛越级向更豪华方向不断超越。</div>\r\n</div>'),
(27, 5, '<div>小新新</div>'),
(29, 5, '<div>2008年7月6日-7月13日，丰田 FJ酷路泽深入云南，穿越诸多复杂且前无所晓的路况，亲历鲜为人知的彝文化，这将是FJ进半个世纪以来，最为神秘也是最能触及原始人性的旅程！<br />\r\n<br />\r\n这7天，FJ酷路泽将带领我们全程穿越 中国云南省 彝族地区， 解锁彝族神秘密码，挑战无法想象的意外路况；<br />\r\n这7天，我们将看到丰田FJ酷路泽生来越野的真实表现，感悟这个世界越野传奇所代表的越野文化；<br />\r\n这7天，更是FJ 酷路泽驾驭者自由特质的绽放、极限越野的佐证，以及人与车复古时尚的阐释；<br />\r\n这7天，受丰田及广汽丰田邀请的知名人士、著名摄影师、专业媒体记者，将一路同行，见证FJ 酷路泽新传奇延续的每时每刻，记载新一代 FJ人尽逐自由的征途。 <br />\r\n<br />\r\n<strong>酷旅路线</strong>（先初步告知，将随时更新旅程消息）<br />\r\n&middot;启程&mdash;&mdash;红万村祭火<br />\r\n&middot;壮行&mdash;&mdash;土著摔跤\r\n<table cellspacing="0" cellpadding="0" width="95%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="middle" align="center" height="140"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/001.jpg" /></a></td>\r\n            <td valign="middle" align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/002.jpg" /></a></td>\r\n            <td align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/003.jpg" /></a></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n红万村，祭火仪式的所在地，只是个不足500人的小村庄。看祭火的时间为每年农历2月初3,从弥勒县乘车20公里到弥勒县西一乡红万村，红万村的阿细语中称为&ldquo;木邓赛鲁比&rdquo;，有为祭祀火神而举行狂欢活动的意思。现场地形奇特，四周的山体均匀围绕着一块平坦的土地，与罗马大剧场真是非常相似。 人们通过祭火，是希望火神保佑来年的丰收，保佑一年的平安，祭火过后，雨水很快就会落到地面，滋润着这里的山川万物，让这块贫瘠的喀斯特高原风调雨顺，等待来年的又一次狂欢。<br />\r\n<br />\r\n&middot;探秘&mdash;&mdash;花腰彝<br />\r\n<table cellspacing="0" cellpadding="0" width="95%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="middle" align="center" height="140"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/004.jpg" /></a></td>\r\n            <td valign="middle" align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/005.jpg" /></a></td>\r\n            <td valign="middle" align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/006.jpg" /></a></td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n花腰彝是生活在我国云南省红河哈尼族彝族自治州石屏县北部高寒山区的龙武、哨冲镇一带的彝族尼苏支系的一部分，现有3万多人。花腰彝的称谓来源与他们所穿的服饰鲜艳夺目、腰系绣花腰带的着装打扮有关。长期以来，花腰彝用他们的勤劳和智慧，创造了辉煌灿烂、具有浓郁地方特色的服饰。 <br />\r\n<br />\r\n<strong>穿越&mdash;东川 </strong><br />\r\n&middot;东川--泥流河赛车场<br />\r\n<table cellspacing="0" cellpadding="0" width="95%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="middle" align="center" height="140"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/007.jpg" /></a></td>\r\n            <td valign="middle" align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/008.jpg" /></a></td>\r\n            <td valign="middle" align="center">\r\n            <table height="112" cellspacing="0" cellpadding="0" width="150" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n东川地貌独特，其小江流域河谷断裂带规模宏大，结构复杂，经泥石流冲击后地壳脆弱、复杂多变，在全世界是独一无二的，享有&ldquo;世界泥石流博物馆&rdquo;的美誉。东川充分利用泥石流资源开展汽车越野运动文化是从2003年开始的，经过2004年、2005年二届汽车越野赛事的成功举办，东川受到了中国汽车联合会和社会各界的广泛关注、重、视，2005年6月中国汽车联合会授予东川&ldquo;中国泥石流汽车越野赛道&rdquo;称号，是除哈尔滨冰上赛道、撒哈拉大沙漠赛道之外，中国最有特色的全国赛道之一，也是广大越野发烧友必经体验的特色赛道。 &middot;东川&mdash;红土地<br />\r\n<table cellspacing="0" cellpadding="0" width="95%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="middle" align="center" height="140"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/009.jpg" /></a></td>\r\n            <td valign="middle" align="center"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/010.jpg" /></a></td>\r\n            <td valign="middle" align="center">\r\n            <table height="112" cellspacing="0" cellpadding="0" width="150" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n&ldquo;红土地&rdquo;指的就是新田乡一处名叫&ldquo;花石头&rdquo;(位于109公里路牌处)的地方，这里方圆近百里的区域是云南红土高原上最集中、最典型、最具特色的红土地。 <br />\r\n<br />\r\n<strong>绽放&mdash;元谋土林</strong><br />\r\n&middot;元谋&mdash;土林<br />\r\n<table cellspacing="0" cellpadding="0" width="95%" align="center" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td valign="middle" align="center" height="140"><a href="http://channel.gac-toyota.com.cn/news/gy_img1.htm"><img height="112" alt="" width="150" border="0" src="http://channel.gac-toyota.com.cn/images/eventdetail09/012.jpg" /></a></td>\r\n            <td align="center">\r\n            <table height="112" cellspacing="0" cellpadding="0" width="150" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n            <td align="center">\r\n            <table height="112" cellspacing="0" cellpadding="0" width="150" border="0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>&nbsp;</td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n自然造化、诡异迷离的地质地貌，鬼斧神工、姿态万千的沙雕泥塑，原始神秘、粗犷荒蛮的西部风韵，构筑成元谋土林这座令人神往的殿堂。元谋土林与路南石林、陆良彩色沙林并称为云南三大天造奇林。 <br />\r\n<br />\r\n<strong>收官</strong><br />\r\n全部参与车辆人员将圆满到达XX地，以一场盛大的PARTY结束这次旅程。<br />\r\n<br />\r\n<strong>活动关注视窗</strong><br />\r\nFJ酷路泽期待天下越野爱好者、户外探险者、文化倡导者等等社会各界都来关注这次承载人文、地理、越野、自然、民族等诸多内涵的传奇之旅，活动全程都向社会开放，所有人都可以通过下面的媒体跟随我们一路看过、听过、最终感悟到自由的绽放、人与车的极限魅力、自然的神妙、文明的伟大&hellip;&hellip;\r\n<p>&nbsp;</p>\r\n<table cellspacing="0" cellpadding="0" width="100%" border="0">\r\n    <tbody>\r\n        <tr>\r\n            <td align="center"><img alt="" width="730" src="http://channel.gac-toyota.com.cn/images/eventdetail09/013.jpg" /></td>\r\n        </tr>\r\n        <tr>\r\n            <td align="center">\r\n            <p>&nbsp;</p>\r\n            <p><a href="http://www.fjcruiserchina.com/caravan_tour/">关注此活动</a></p>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</div>'),
(30, 6, '<div>爽死了爽死了爽死了爽死了爽死了爽死了爽死了爽死了爽死了爽死了爽死了爽死了</div>'),
(31, 6, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `yui_driver`
--

INSERT INTO `yui_driver` (`id`, `user`, `subject`, `content`, `postdate`, `email`, `phone`, `holder`, `ifcheck`) VALUES
(3, '谢大哥大', '1', '1232343333', 1236217580, 'xxz@live.cn', '15013707091', 1, 0),
(5, '谢小哥', 'S-MAX', '123123', 1237343429, 'xxz@live.cn', '135789785945', 1, 0),
(6, '333', '嘉年华', '33333', 1237343882, '23@dfg.ccc', '33333333333', 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 导出表中的数据 `yui_msg`
--

INSERT INTO `yui_msg` (`id`, `cateid`, `subject`, `style`, `author`, `postdate`, `tplfile`, `hits`, `taxis`, `thumb`, `istop`, `isvouch`, `isbest`, `ifcheck`, `clou`, `url`, `mark`, `standard`, `number`, `m_price`, `s_price`, `promotions`, `softsize`, `softlang`, `softsystem`, `softdemo`, `softadmin`, `softemail`, `softother`, `softlicense`) VALUES
(2, 1, '测试新闻', '', 'admin', 1220437251, '', 6, 0, '', 0, 0, 0, 1, '本新闻应用于测试使用', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 2, '测试产品', '', 'admin', 1220371200, '', 36, 0, 'upfiles/200809/21/thumb_1221989172_51.jpg', 0, 0, 0, 1, '简单测试', '', 'upfiles/200809/21/mark_1221989172_51.jpg', 'SD983', 'DDP9', '98.00', '78.00', '购买本商品可物赠……', '', '', '', '', '', '', '', ''),
(8, 1, '我的爱', '', 'admin', 1235007630, '', 5, 0, '', 0, 0, 0, 1, 'bicth', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 1, '不错不错', '', 'admin', 1220544000, '', 5, 0, '', 0, 0, 0, 1, '3.0啊ffsdfsfsdfsdfsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 1, 'sdfsdfsdfsdfsdf', '', 'admin', 1220544000, '', 13, 0, '', 0, 0, 0, 1, 'sdfasfsadfsdafsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 2, '测试产品二', '', 'admin', 1221840000, '', 19, 0, 'upfiles/200809/21/thumb_1221989058_20.jpg', 0, 0, 0, 1, '这是测试产品二噢', '', 'upfiles/200809/21/mark_1221989058_20.jpg', '吨', 'DS-100', '98.50', '90.00', '买二赠一', '', '', '', '', '', '', '', ''),
(9, 1, '345345', '', 'admin', 1235543599, '', 72, 0, '', 0, 0, 0, 1, '345345', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 1, '11', '', 'admin', 1235716106, '', 13, 0, '', 0, 0, 0, 1, '66666666666666', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 1, '5555555', '', 'admin', 1235716116, '', 0, 0, '', 0, 0, 0, 1, '5555555555', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 1, '456456', '', 'admin', 1235716130, '', 0, 0, '', 0, 0, 0, 1, '456456', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 1, '66666666666666667', '', 'admin', 1235716150, '', 2, 0, '', 0, 0, 0, 1, '5666666666', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 1, 'dgh', '', 'admin', 1235716160, '', 0, 0, '', 0, 0, 0, 1, 'fh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 1, 'bs45', '', 'admin', 1235716178, '', 3, 0, '', 0, 0, 0, 1, 'sf3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 1, '458gh234', '', 'admin', 1235716191, '', 9, 0, '', 0, 0, 0, 1, 'daga45', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 1, 'adfadf', '', 'admin', 1235716201, '', 48, 0, '', 0, 0, 0, 1, 'adfadf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 1, '324', '', 'admin', 1235975861, '', 1, 0, '', 0, 0, 0, 1, '44444444444444444444', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 1, '33333333333333333', '', 'admin', 1235975871, '', 1, 0, '', 0, 0, 0, 1, '33333333334444', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 1, '222222222222', '', 'admin', 1235975879, '', 1, 0, '', 0, 0, 0, 1, '2222222222222223', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 1, '555555555555555556', '', 'admin', 1235975898, '', 1, 0, '', 0, 0, 0, 1, '7834534', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, 1, '34444', '', 'admin', 1235975919, '', 11, 0, '', 0, 0, 0, 1, '44534', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 1, '新凯美瑞带动中高级车新凯美瑞带动中高级车豪华升级', '', 'admin', 1235975933, '', 13, 0, '', 0, 0, 0, 1, '23767', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 1, '新凯美瑞带动中高级车豪华升级', '', 'admin', 1235975949, '', 143, 0, '', 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 5, '小新新', '', 'admin', 1236222699, '', 1, 0, 'upfiles/thumb_1237171790.jpg', 0, 0, 0, 1, '小新新', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 5, '傻哥', '', 'admin', 1236912274, '', 1, 0, 'upfiles/thumb_1237171721.jpg', 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 5, 'FJ酷路泽 酷视觉之旅', '', 'admin', 1236912290, '', 27, 0, 'upfiles/thumb_1237171721.jpg', 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 6, '新CAMRY凯美瑞 震撼登场!', '', 'admin', 1237256319, '', 5, 0, '', 0, 0, 0, 1, '爽死了', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 6, '共庆2周年30万台,CAMRY凯美瑞谢谢您！', '', 'admin', 1237258408, '', 3, 0, 'upfiles/thumb_1237171721.jpg', 0, 0, 0, 1, '2周年来临之际，第30万台CAMRY\n凯美瑞成功下线，我们感谢您的...', 'msg.php/29.html', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `yui_onegroup`
--

INSERT INTO `yui_onegroup` (`id`, `groupname`) VALUES
(1, '简介组'),
(5, '尊贵服务'),
(7, '在线业务'),
(4, '车型介绍');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 导出表中的数据 `yui_onepage`
--

INSERT INTO `yui_onepage` (`id`, `groupid`, `subject`, `style`, `sub_content`, `content`, `url`, `taxis`, `ifcheck`, `tpl`) VALUES
(2, 1, '公司介绍', '', '', '<div>\r\n<p align="left">我们以植根于血统中的基因&ldquo;顾客第一&rdquo;而自豪，凭借对顾客核心需要的深刻洞察，我们恪守Persona &amp; Premium 渠道概念和《广汽丰田宪章》的指导准则，充满激情并一如既往地满足客户的核心需求。</p>\r\n<p align="left">&nbsp;</p>\r\n<p align="left">&nbsp;</p>\r\n<p align="left">对经销商，我们以HALLMARK金字招牌郑重承诺，缔结起富有竞争力的厂商联盟；对顾客，我们以三位一体品质真诚奉献，赢得顾客的衷心赞赏。在此基础上，我们还不断致力于将全球领先品质转化为顾客的亲身体验。在销售和服务的每一个细节中，我们通过不断丰富和完善的CAMRY体验，竭诚为顾客奉上&ldquo;尊重&middot;安心&rdquo;的核心价值；让顾客在尊贵享受和贴心服务中，体会到&ldquo;被认同的成功&rdquo;的自信和满足，进而建立与广汽TOYOTA渠道长期的信赖关系。</p>\r\n</div>', '', 20, 1, 'intro.company'),
(3, 1, '团队活动', '', '', '<div>&nbsp;团队活动</div>', '', 30, 1, 'intro.play'),
(4, 1, '111111111111111111111', '', '', '<div>\r\n<p align="left">我们以植根于血统中的基因&ldquo;顾客第一&rdquo;而自豪，凭借对顾客核心需要的深刻洞察，我们恪守Persona &amp; Premium 渠道概念和《广汽丰田宪章》的指导准则，充满激情并一如既往地满足客户的核心需求。</p>\r\n<p align="left">&nbsp;</p>\r\n<p align="left">&nbsp;</p>\r\n<p align="left">对经销商，我们以HALLMARK金字招牌郑重承诺，缔结起富有竞争力的厂商联盟；对顾客，我们以三位一体品质真诚奉献，赢得顾客的衷心赞赏。在此基础上，我们还不断致力于将全球领先品质转化为顾客的亲身体验。在销售和服务的每一个细节中，我们通过不断丰富和完善的CAMRY体验，竭诚为顾客奉上&ldquo;尊重&middot;安心&rdquo;的核心价值；让顾客在尊贵享受和贴心服务中，体会到&ldquo;被认同的成功&rdquo;的自信和满足，进而建立与广汽TOYOTA渠道长期的信赖关系。</p>\r\n</div>', '', 40, 1, ''),
(10, 5, '售后服务', '', '', '<div>服务承诺</div>', '', 255, 1, 'service.af'),
(11, 5, '保险理赔', '', '', '<div>保险理赔</div>', '', 255, 1, 'service.insurance'),
(12, 5, '购车服务', '', '', '<div>购车服务</div>', '', 255, 1, 'service.sell'),
(15, 1, '企业荣誉', '', '', '我是荣誉', '', 25, 1, 'intro.honor'),
(16, 5, '尊贵服务', '', '', '<div>尊贵服务</div>', '', 255, 1, 'service'),
(17, 7, '预约试驾', '', '', '', 'driver.php', 255, 1, ''),
(18, 1, '福昌之窗', '', '', '<div>福昌之窗</div>', '', 255, 1, 'intro'),
(19, 0, '招贤纳士', '', '', '<div>招贤纳士</div>', '', 255, 1, 'person'),
(20, 4, '嘉年华', '', '', '<div>fiesta</div>', '', 255, 1, 'fiesta'),
(21, 4, '福克斯', '', '', '<div>focus</div>', '', 255, 1, 'focus'),
(22, 4, '蒙迪欧-致胜', '', '', '<div>mondeo</div>', '', 255, 1, 'mondeo'),
(23, 4, '麦柯斯S-MAX', '', '', '<div>s-max</div>', '', 255, 1, 's-max');

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
('i2gu689cgvahrstclbiqbkhui3', '', 1237953882),
('obsirs7rl1mce1kudtj19olo03', '', 1237947529),
('c8bnf0bc95pf8it0kf1j2b1dg2', '', 1237875188),
('vqn3l2le7js5f280m5o114f8p4', '', 1237874229),
('o15qn01po11877a4pn154lpq36', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}', 1237366875),
('6uhgjhocsllu3p99g5lfgu35l1', '', 1237441734),
('6d04ukfk9b742n1m8tjpcspik5', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}', 1237365562),
('i02c6odc3p5bl6dph9vv3brfm7', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}', 1237450056),
('8cehcdp3olpp5hehd527arqhr5', '', 1237441804),
('6do3nt8g08h1m9v92rqu2b2ll0', '', 1237447308),
('9cd335dmog0u11gko33ae6ajd2', '', 1237442590),
('kk13qkat9nl81ep06f9mudelj0', '', 1237442962),
('6ehkt5e5nm40k39qp40n05loo4', '', 1237525286),
('1effsg3774ifr4275f8ii6poi6', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}', 1237517972),
('k5j639g40bc2bpcker0n5b99t7', '', 1237538095),
('1o6lfif6vn116oitea2v5evom5', '', 1237538475),
('30q5le4bus9mjf8nn9sm294u83', '', 1237863976),
('o4m7f0u0sf5mt7p12q0fng5u00', '', 1237775360),
('sv57k853jp3qih0dnlif951e57', '', 1237780369),
('8u5sj4l7ibclpoe7jc5ido05u7', '', 1237786014),
('jtvpof83qftvnvc5qira3bt0c0', '', 1237780810),
('j40rns6mms0l262ad1m3g365l2', 'qgLoginChk|s:0:"";admin|a:7:{s:2:"id";s:1:"1";s:5:"typer";s:6:"system";s:4:"user";s:5:"admin";s:4:"pass";s:32:"21232f297a57a5a743894a0e4a801fc3";s:5:"email";s:15:"admin@admin.com";s:10:"modulelist";s:0:"";s:6:"menuid";s:0:"";}', 1237785202),
('oce9d3jmac74q58fe5kl4cv3m3', '', 1237785086),
('s05dp2he1nsnbuc2tab6ogujo1', 'qgLoginChk|s:32:"ac4395adcb3da3b2af3d3972d7a10221";', 1237787995),
('i0ufmooho9elifko0k4pehlsf7', '', 1237793682),
('rugergce9057a4n23bdk4gno37', '', 1237790091),
('gi6t3hob513goh5mjmhjr6sq25', '', 1237861905),
('su3ckb2hulo68k95vsgpp7lqq1', '', 1237862386),
('jojdipd5fgo0kq5tcjatsv7hv0', '', 1237862978),
('cbn59sbkf3anp03q43327hsu56', '', 1237864975);

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
(47, 15, 75, '网站留言', 'admin.php?file=book&act=list', 20, 1, 0),
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
(75, 15, 0, '预约', '', 15, 1, 0),
(76, 15, 75, '试驾预约', 'admin.php?file=driver&act=list', 255, 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

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
(70, 'jpg', 'benner-6.jpg', '1237171627.jpg', 'upfiles/', 1237171627, 'thumb_1237171627.jpg', 'mark_1237171627.jpg'),
(71, 'jpg', 'benner-2-1.jpg', '1237171721.jpg', 'upfiles/', 1237171721, 'thumb_1237171721.jpg', 'mark_1237171721.jpg'),
(61, 'jpg', '3b_ex_focus_img1.jpg', '1236329146.jpg', 'upfiles/', 1236329146, 'thumb_1236329146.jpg', 'mark_1236329146.jpg'),
(62, 'jpg', 'FCN_smax_exGallery_03_IMG,01.jpg', '1236329154.jpg', 'upfiles/', 1236329154, 'thumb_1236329154.jpg', 'mark_1236329154.jpg'),
(63, 'jpg', 'FCN_zhisheng_ExGallery_01_IMG1.jpg', '1236329161.jpg', 'upfiles/', 1236329161, 'thumb_1236329161.jpg', 'mark_1236329161.jpg'),
(64, 'jpg', 'FCN_zhisheng_ExGallery_01_IMG12.jpg', '1236329172.jpg', 'upfiles/', 1236329172, 'thumb_1236329172.jpg', 'mark_1236329172.jpg'),
(72, 'jpg', 'benner-7.jpg', '1237171790.jpg', 'upfiles/', 1237171790, 'thumb_1237171790.jpg', 'mark_1237171790.jpg'),
(73, 'jpg', 'img-car2.jpg', '1237258366.jpg', 'upfiles/', 1237258366, 'thumb_1237258366.jpg', 'mark_1237258366.jpg');

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

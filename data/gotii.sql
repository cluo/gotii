-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014-09-01 11:49:14
-- 服务器版本: 5.6.14
-- PHP 版本: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `gotii`
--

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_group`
--

CREATE TABLE IF NOT EXISTS `wx_auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_auth_group`
--

INSERT INTO `wx_auth_group` (`id`, `title`, `status`) VALUES
(1, '管理员', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_group_rule`
--

CREATE TABLE IF NOT EXISTS `wx_auth_group_rule` (
  `gid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`gid`,`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组-规则关联表';

--
-- 转存表中的数据 `wx_auth_group_rule`
--

INSERT INTO `wx_auth_group_rule` (`gid`, `rid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_group_user`
--

CREATE TABLE IF NOT EXISTS `wx_auth_group_user` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户-用户组关联表';

--
-- 转存表中的数据 `wx_auth_group_user`
--

INSERT INTO `wx_auth_group_user` (`uid`, `gid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_rule`
--

CREATE TABLE IF NOT EXISTS `wx_auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT '规则名',
  `title` varchar(20) NOT NULL COMMENT '标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='规则表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_auth_rule`
--

INSERT INTO `wx_auth_rule` (`id`, `name`, `title`) VALUES
(1, 'superadmin', '超级管理员');

-- --------------------------------------------------------

--
-- 表的结构 `wx_user`
--

CREATE TABLE IF NOT EXISTS `wx_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(15) NOT NULL,
  `regtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_user`
--

INSERT INTO `wx_user` (`id`, `username`, `password`, `lasttime`, `lastip`, `regtime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1409554253, '127.0.0.1', 1407913465);

-- --------------------------------------------------------

--
-- 表的结构 `wx_wechat`
--

CREATE TABLE IF NOT EXISTS `wx_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(23) NOT NULL COMMENT '唯一token',
  `name` varchar(20) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '账号类型0订阅1服务',
  `verified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未认证1认证',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像图片路径',
  `appid` varchar(20) DEFAULT NULL,
  `appsecret` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='绑定的公众号' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_wechat`
--

INSERT INTO `wx_wechat` (`id`, `token`, `name`, `type`, `verified`, `avatar`, `appid`, `appsecret`) VALUES
(1, '53fe8c3884436', 'xici2013', 0, 1, 'http://weiyundian.xici.net/uploads/2014/03/04/53157e9587066.jpg?hash=529b706af0654823f87ca92a7b9bf74e', 'wx123ab9294dd26366', '5454b6ab95fb335044206bf5802982fb');

-- --------------------------------------------------------

--
-- 表的结构 `wx_wechat_acl`
--

CREATE TABLE IF NOT EXISTS `wx_wechat_acl` (
  `uid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `list` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户管理公众号授权';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014-08-22 11:33:44
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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1408694710, '127.0.0.1', 1407913465);

-- --------------------------------------------------------

--
-- 表的结构 `wx_wechat`
--

CREATE TABLE IF NOT EXISTS `wx_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(23) NOT NULL COMMENT '唯一token',
  `name` varchar(13) NOT NULL COMMENT '微信公众号名称',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '账号类型0订阅1服务',
  `verified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未认证1认证',
  `avatar` varchar(200) NOT NULL COMMENT '头像图片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='绑定的公众号' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_wechat`
--

INSERT INTO `wx_wechat` (`id`, `token`, `name`, `type`, `verified`, `avatar`) VALUES
(1, '53f70e3370cfe', '11111', 1, 1, 'uploads/img/201408/22/696ee10ca6d8cfccd71adece4b9d8bc2.gif');

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

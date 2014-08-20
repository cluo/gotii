-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014-08-20 07:19:59
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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1408430214, '127.0.0.1', 1407913465);

-- --------------------------------------------------------

--
-- 表的结构 `wx_wechat`
--

CREATE TABLE IF NOT EXISTS `wx_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(23) NOT NULL COMMENT '唯一token',
  `type` enum('sub','serv') NOT NULL DEFAULT 'sub' COMMENT '账号类型sub订阅serv服务',
  `verified` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='绑定的公众号' AUTO_INCREMENT=1 ;

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

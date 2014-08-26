-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014-08-26 11:36:52
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
-- 表的结构 `wx_wechat`
--

CREATE TABLE IF NOT EXISTS `wx_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(23) NOT NULL COMMENT '唯一token',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '账号类型0订阅1服务',
  `name` varchar(20) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未认证1认证',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像图片路径',
  `appid` varchar(20) DEFAULT NULL,
  `appsecret` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='绑定的公众号' AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

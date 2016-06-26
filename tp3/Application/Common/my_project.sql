/*
Navicat MySQL Data Transfer

Source Server         : 我的数据库
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : my_project

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-03-16 19:07:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '账号',
  `password` char(40) NOT NULL COMMENT '密码(使用sha1()加密)',
  `email` varchar(50) DEFAULT NULL COMMENT '管理员邮箱',
  `power` varchar(255) DEFAULT NULL COMMENT '权限',
  `auto_key` char(20) DEFAULT NULL COMMENT '自动登录的KEY',
  `access_token` char(40) DEFAULT NULL COMMENT '自动登录TOKEN',
  `status` tinyint(2) NOT NULL COMMENT '管理员状态',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录的时间',
  `last_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台管理员信息表';

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'gongyan', 'eda3d8cb5282a4522ad1f1209891ba8a9b321d6f', '610455122@qq.com', '', '', '', '1', '1457604078', '1458093850', '127.0.0.1');
INSERT INTO `my_admin` VALUES ('2', 'liujinxing', 'a75d5dd01d9a3ff45da4a304fdbbaf80596a0bc3', '821901008@qq.com', '', '', '', '1', '1457606311', '1458097738', '127.0.0.1');

-- ----------------------------
-- Table structure for my_article
-- ----------------------------
DROP TABLE IF EXISTS `my_article`;
CREATE TABLE `my_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文字内容',
  `img` varchar(100) DEFAULT '' COMMENT '文章的图片',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '文章的分类（1 普通文章 ...）',
  `see_num` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  `recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐（0 不推荐 1 推荐）',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（0 停用 1 启用）',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_id` int(11) NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改的用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章信息表';

-- ----------------------------
-- Records of my_article
-- ----------------------------
INSERT INTO `my_article` VALUES ('1', '住在手机里的朋友', '通信时代，无论是初次相见还是老友重逢，交换联系方式，常常是彼此交换名片，然后郑重或是出于礼貌用手机记下对方的电话号码。在快节奏的生活里，我们不知不觉中就成为住在别人手机里的朋友。又因某些意外，变成了别人手机里匆忙的过客，这种快餐式的友谊 ...', '/Public/20160316/56e927cb5a057.jpg', '1', '0', '0', '1', '1', '1458110398', '1', '1458120653', '1');
INSERT INTO `my_article` VALUES ('2', '我的测试数据哦！', '我的测试数据哦！', '', '1', '0', '0', '0', '1', '1458126033', '1', '1458126033', '1');

-- ----------------------------
-- Table structure for my_image
-- ----------------------------
DROP TABLE IF EXISTS `my_image`;
CREATE TABLE `my_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '' COMMENT '图片标题',
  `desc` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `type` tinyint(1) DEFAULT NULL COMMENT '图片类型（1 首页轮播图片 2 首页广告图片）',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '图片状态',
  `sort` tinyint(4) NOT NULL DEFAULT '100' COMMENT '图片排序',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `create_id` int(11) NOT NULL COMMENT '创建用户',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `update_id` int(11) NOT NULL COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='图片信息';

-- ----------------------------
-- Records of my_image
-- ----------------------------
INSERT INTO `my_image` VALUES ('1', '我的博客哦！', '我的博客', '/Public/20160316/56e92b9ed1f07.jpg', '1', '1', '1', '1458121635', '1', '1458121635', '1');
INSERT INTO `my_image` VALUES ('2', '我的博客哦02', '我的博客哦02', '/Public/20160316/56e92c3f17a22.jpg', '1', '1', '2', '1458121795', '1', '1458121795', '1');

-- ----------------------------
-- Table structure for my_menu
-- ----------------------------
DROP TABLE IF EXISTS `my_menu`;
CREATE TABLE `my_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID(只支持两级分类)',
  `menu_name` varchar(50) NOT NULL COMMENT '栏目名称',
  `icons` varchar(50) NOT NULL DEFAULT 'icon-desktop' COMMENT '使用的icons',
  `url` varchar(50) DEFAULT NULL COMMENT '访问地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（1启用 0 停用）',
  `sort` int(4) NOT NULL DEFAULT '100' COMMENT '排序字段',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建用户',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='使用SimpliQ的样式的导航栏样式';

-- ----------------------------
-- Records of my_menu
-- ----------------------------
INSERT INTO `my_menu` VALUES ('1', '0', '后台管理', 'icon-tasks', '#', '1', '2', '1457939341', '1457939341', '0', '0');
INSERT INTO `my_menu` VALUES ('2', '1', '管理员管理', 'icon-user', 'admin/index', '1', '3', '1457939341', '1457926720', '0', '0');
INSERT INTO `my_menu` VALUES ('3', '1', '后台栏目管理', 'icon-reorder', 'menu/index', '1', '4', '1457939341', '1457585799', '0', '1');
INSERT INTO `my_menu` VALUES ('4', '1', 'Icons预览', 'icon-star', 'other/index', '1', '5', '1457939341', '1457585807', '0', '1');
INSERT INTO `my_menu` VALUES ('5', '0', '前台管理', ' icon-desktop', '#', '1', '1', '1457939341', '1458095919', '0', '1');
INSERT INTO `my_menu` VALUES ('6', '5', '图片管理', 'icon-picture', 'image/index', '1', '2', '1457939654', '1457939670', '1', '1');
INSERT INTO `my_menu` VALUES ('7', '0', '图片查看', 'icon-picture', 'image/view', '1', '2', '1458012694', '1458012694', '1', '1');
INSERT INTO `my_menu` VALUES ('8', '5', '文章管理', ' icon-file-alt', 'article/index', '1', '2', '1458096224', '1458097408', '1', '1');

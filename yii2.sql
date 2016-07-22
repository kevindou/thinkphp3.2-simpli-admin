/*
Navicat MySQL Data Transfer

Source Server         : 我的数据库
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-07-22 19:12:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员账号',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `face` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理员头像',
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user' COMMENT '角色',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '自动登录密钥',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码哈希值',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '重新登录哈希值',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `create_id` int(11) NOT NULL COMMENT '创建用户',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `update_id` int(11) DEFAULT NULL COMMENT '修改用户',
  `last_time` int(11) DEFAULT NULL COMMENT '上一次登录时间',
  `last_ip` char(12) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上一次登录IP',
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '地址信息',
  `age` tinyint(3) DEFAULT '18' COMMENT '年龄',
  `maxim` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '座右铭',
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '真实姓名',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别（1 男 0 女）',
  `home_url` varchar(50) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '个人主页',
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT '' COMMENT 'facebook账号',
  `birthday` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '生日',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role`),
  KEY `status` (`status`),
  KEY `created_at` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'super', 'Super@admin.com', '/public/assets/avatars/5791ddb2efd3c.jpg', 'admin', '1', 'gKkLFMdB2pvIXOFNpF_Aeemvdf1j0YUM', '$2y$13$Nuf1mzDRoCMxrWI.rIjENu20QshJG41smdEeHFHxq0qdmS99YytHy', '5vLaPpUS-I-XxJaoGP-GZDk474WdnaK3_1469073015', '1457337222', '1', '1469179297', '1', '1469174907', '127.0.0.1', '', '19', '学会微笑，学会面对，学会放下，让一切随心，随意，随缘！', '', '1', '', '', '');
INSERT INTO `my_admin` VALUES ('3', 'liujinxing', '1136261505@qq.com', '/public/assets/avatars/avatar.jpg', 'user', '1', 'Ja4xO7lSPmj_4Gtshkiied-_8EolgX7b', '$2y$13$NUDMG9NMx0BpXotoTP9Xj.qDsFih94meRHuMBfWM8w28qpCzX3Hxm', 'ggsBHJf2nVtiG69i-Xn6H1E8TGVdcJmt_1469083899', '1469077822', '1', '1469095955', '3', null, null, '', '18', '', '', '1', '', '', '');
INSERT INTO `my_admin` VALUES ('4', 'gongyan', '6104155122@qq.com', '/public/assets/avatars/avatar.jpg', 'user', '1', 'GQFk-KpdJhYiyP4PTC9jnXE-BbiSmXRG', '$2y$13$k1ZD3/FL5LSmKulS3BPXme6a.IptIYqgcfsgoBNdFhPzLekgIHyzC', 'Z1APs8xqLv27wF_WRnyofu1yjRS9qw54_1469095775', '1469095775', '3', '1469095913', '3', null, null, '', '18', '', '', '1', '', '', '');

-- ----------------------------
-- Table structure for my_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_assignment`;
CREATE TABLE `my_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `my_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `my_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_assignment
-- ----------------------------
INSERT INTO `my_auth_assignment` VALUES ('admin', '1', '1469076860');
INSERT INTO `my_auth_assignment` VALUES ('OrdinaryUsers', '3', '1469096255');
INSERT INTO `my_auth_assignment` VALUES ('user', '3', '1469095955');
INSERT INTO `my_auth_assignment` VALUES ('user', '4', '1469095913');

-- ----------------------------
-- Table structure for my_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_item`;
CREATE TABLE `my_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `my_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `my_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_item
-- ----------------------------
INSERT INTO `my_auth_item` VALUES ('admin', '1', '超级管理员', null, null, '1469009779', '1469009779');
INSERT INTO `my_auth_item` VALUES ('admin/editable', '2', '管理员信息行内编辑', null, null, '1469177671', '1469177671');
INSERT INTO `my_auth_item` VALUES ('admin/index', '2', '管理员信息显示', null, null, '1469009816', '1469009816');
INSERT INTO `my_auth_item` VALUES ('admin/search', '2', '管理员信息搜索', null, null, '1469009816', '1469009816');
INSERT INTO `my_auth_item` VALUES ('admin/update', '2', '管理员信息编辑', null, null, '1469009816', '1469009816');
INSERT INTO `my_auth_item` VALUES ('admin/upload', '2', '管理员头像上传', null, null, '1469157297', '1469157297');
INSERT INTO `my_auth_item` VALUES ('admin/view', '2', '管理员个人信息', null, null, '1469096927', '1469096927');
INSERT INTO `my_auth_item` VALUES ('authority/index', '2', '权限信息显示', null, null, '1469078967', '1469080494');
INSERT INTO `my_auth_item` VALUES ('authority/search', '2', '权限信息搜索', null, null, '1469078967', '1469080591');
INSERT INTO `my_auth_item` VALUES ('authority/update', '2', '权限信息编辑', null, null, '1469094174', '1469094174');
INSERT INTO `my_auth_item` VALUES ('deleteAdmin', '2', '管理员信息删除', null, null, '1469081818', '1469081818');
INSERT INTO `my_auth_item` VALUES ('deleteAuthority', '2', '权限信息删除', null, null, '1469081803', '1469081803');
INSERT INTO `my_auth_item` VALUES ('menu/deleteAll', '2', '导航信息多删除', null, null, '1469085213', '1469085213');
INSERT INTO `my_auth_item` VALUES ('menu/index', '2', '导航信息显示', null, null, '1469081716', '1469081716');
INSERT INTO `my_auth_item` VALUES ('menu/search', '2', '导航信息搜索', null, null, '1469081752', '1469081752');
INSERT INTO `my_auth_item` VALUES ('menu/update', '2', '导航信息编辑', null, null, '1469081736', '1469081736');
INSERT INTO `my_auth_item` VALUES ('module/create', '2', '模块生成预览表单', null, null, '1469091119', '1469091119');
INSERT INTO `my_auth_item` VALUES ('module/index', '2', '模块生成显示', null, null, '1469091078', '1469091078');
INSERT INTO `my_auth_item` VALUES ('module/produce', '2', '模块生成最终文件', null, null, '1469091179', '1469091179');
INSERT INTO `my_auth_item` VALUES ('module/update', '2', '模块生成预览文件', null, null, '1469091147', '1469091147');
INSERT INTO `my_auth_item` VALUES ('OrdinaryUsers', '1', '普通用户', null, null, '1469096255', '1469096255');
INSERT INTO `my_auth_item` VALUES ('role/create', '2', '角色信息分配权限', null, null, '1469094244', '1469094244');
INSERT INTO `my_auth_item` VALUES ('role/index', '2', '角色信息显示', null, null, '1469080022', '1469080022');
INSERT INTO `my_auth_item` VALUES ('role/search', '2', '角色信息搜索', null, null, '1469081628', '1469081628');
INSERT INTO `my_auth_item` VALUES ('role/update', '2', '角色信息编辑', null, null, '1469081575', '1469081575');
INSERT INTO `my_auth_item` VALUES ('role/view', '2', '角色信息查看详情', null, null, '1469094284', '1469094284');
INSERT INTO `my_auth_item` VALUES ('user', '1', '管理员', null, null, '1469083867', '1469098773');

-- ----------------------------
-- Table structure for my_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_item_child`;
CREATE TABLE `my_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `my_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `my_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `my_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `my_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_item_child
-- ----------------------------
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/editable');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/index');
INSERT INTO `my_auth_item_child` VALUES ('user', 'admin/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/search');
INSERT INTO `my_auth_item_child` VALUES ('user', 'admin/search');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/update');
INSERT INTO `my_auth_item_child` VALUES ('user', 'admin/update');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/upload');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/view');
INSERT INTO `my_auth_item_child` VALUES ('user', 'admin/view');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'authority/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'authority/search');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'authority/update');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'deleteAdmin');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'deleteAuthority');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'menu/deleteAll');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'menu/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'menu/search');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'menu/update');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'module/create');
INSERT INTO `my_auth_item_child` VALUES ('user', 'module/create');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'module/index');
INSERT INTO `my_auth_item_child` VALUES ('user', 'module/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'module/produce');
INSERT INTO `my_auth_item_child` VALUES ('user', 'module/produce');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'module/update');
INSERT INTO `my_auth_item_child` VALUES ('user', 'module/update');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'role/create');
INSERT INTO `my_auth_item_child` VALUES ('user', 'role/create');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'role/index');
INSERT INTO `my_auth_item_child` VALUES ('user', 'role/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'role/search');
INSERT INTO `my_auth_item_child` VALUES ('user', 'role/search');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'role/update');
INSERT INTO `my_auth_item_child` VALUES ('user', 'role/update');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'role/view');
INSERT INTO `my_auth_item_child` VALUES ('user', 'role/view');

-- ----------------------------
-- Table structure for my_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_rule`;
CREATE TABLE `my_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for my_menu
-- ----------------------------
DROP TABLE IF EXISTS `my_menu`;
CREATE TABLE `my_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID(只支持两级分类)',
  `menu_name` varchar(50) NOT NULL COMMENT '栏目名称',
  `icons` varchar(50) NOT NULL DEFAULT 'icon-desktop' COMMENT '使用的icons',
  `url` varchar(50) DEFAULT 'site/index' COMMENT '访问的地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（1启用 0 停用）',
  `sort` int(4) NOT NULL DEFAULT '100' COMMENT '排序字段',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建用户',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='导航栏信息表';

-- ----------------------------
-- Records of my_menu
-- ----------------------------
INSERT INTO `my_menu` VALUES ('1', '0', '后台管理', 'menu-icon fa fa-cog', '', '1', '1', '1468985587', '1', '1468985587', '1');
INSERT INTO `my_menu` VALUES ('2', '1', '导航栏目', '', 'menu/index', '1', '4', '1468987221', '1', '1468994846', '1');
INSERT INTO `my_menu` VALUES ('3', '1', '模块生成', '', 'module/index', '1', '5', '1468994283', '1', '1468994860', '1');
INSERT INTO `my_menu` VALUES ('4', '1', '角色管理', '', 'role/index', '1', '2', '1468994665', '1', '1468994676', '1');
INSERT INTO `my_menu` VALUES ('5', '1', '管理员信息', '', 'admin/index', '1', '1', '1468994769', '1', '1468994769', '1');
INSERT INTO `my_menu` VALUES ('6', '1', '权限管理', '', 'authority/index', '1', '3', '1468994819', '1', '1469091044', '1');

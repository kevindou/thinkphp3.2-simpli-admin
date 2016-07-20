/*
Navicat MySQL Data Transfer

Source Server         : 我的数据库
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-07-20 19:33:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员账号',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '自动登录密钥',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码哈希值',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '重新登录哈希值',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user' COMMENT '角色',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `created_id` int(11) NOT NULL COMMENT '创建用户',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `update_id` int(11) DEFAULT NULL COMMENT '修改用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role`),
  KEY `status` (`status`),
  KEY `created_at` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'admin', '_6VUW2b54_ZU462nofkeSFTWJZmcrENT', '$2y$13$bpCp64LJlsiW.TvDC8pDmuZMS2pMVlyQfczzgmx5Dapo54PABf9Uy', '5lYi85syoP9V-uGaUA_w1TQD6nkSIXPJ_1463018816', 'Super@admin.com', 'admin', '1', '1457337222', '1', '1464258243', null);

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
INSERT INTO `my_auth_item` VALUES ('admin/index', '2', '管理员信息显示', null, null, '1469009816', '1469009816');
INSERT INTO `my_auth_item` VALUES ('admin/search', '2', '管理员信息搜索', null, null, '1469009816', '1469009816');
INSERT INTO `my_auth_item` VALUES ('admin/update', '2', '管理员信息编辑', null, null, '1469009816', '1469009816');

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
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/index');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/search');
INSERT INTO `my_auth_item_child` VALUES ('admin', 'admin/update');

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
INSERT INTO `my_menu` VALUES ('6', '1', '权限管理', '', 'authority/index', '1', '3', '1468994819', '1', '1468994819', '1');

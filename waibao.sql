/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100116
Source Host           : localhost:3306
Source Database       : waibao

Target Server Type    : MYSQL
Target Server Version : 100116
File Encoding         : 65001

Date: 2017-06-09 02:35:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for invite_code
-- ----------------------------
DROP TABLE IF EXISTS `invite_code`;
CREATE TABLE `invite_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户邀请码',
  `user_id` int(11) NOT NULL COMMENT '邀请者',
  `code` varchar(20) DEFAULT NULL COMMENT '邀请码',
  `invited_num` int(11) DEFAULT NULL COMMENT '已邀请人数',
  `status` tinyint(1) DEFAULT '1' COMMENT '邀请状态：0不可邀请，1可邀请',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invite_code
-- ----------------------------
INSERT INTO `invite_code` VALUES ('1', '1', '666666', '0', '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_12_155631_create_user_models_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上次登录的ip',
  `last_login_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '上次登录时间',
  `uclass` tinyint(2) DEFAULT NULL COMMENT '用户等级：1超级管理员，2普通管理员',
  `enable` tinyint(1) DEFAULT '0' COMMENT '账户状态：0禁用，1正常',
  `salt` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码加的盐',
  `invite_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邀请码',
  `status` tinyint(1) DEFAULT '1' COMMENT '激活状态：0未激活，1激活',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '596740325@qq.com', 'dc295ae6a42d06c68eba5be870941dc3', null, '0000-00-00 00:00:00', '2017-01-03 00:42:10', '127.0.0.1', '2017-01-03 00:42:10', '1', '1', '123456', null, null);
INSERT INTO `users` VALUES ('2', 'sy_11059', '894481778@qq.com', '1a100d2c0dab19c4430e7d73762b3423', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', '0000-00-00 00:00:00', null, '0', null, '', null);

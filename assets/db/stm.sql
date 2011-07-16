/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : stm

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2011-07-17 00:15:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `uur_activities`
-- ----------------------------
DROP TABLE IF EXISTS `uur_activities`;
CREATE TABLE `uur_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text,
  `estimate_hours` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `uur_activities_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `uur_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_activities
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_hours`
-- ----------------------------
DROP TABLE IF EXISTS `uur_hours`;
CREATE TABLE `uur_hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `start` int(10) NOT NULL,
  `end` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `uur_hours_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `uur_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `uur_hours_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `uur_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_hours
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_projects`
-- ----------------------------
DROP TABLE IF EXISTS `uur_projects`;
CREATE TABLE `uur_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `trashed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_projects
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_roles`
-- ----------------------------
DROP TABLE IF EXISTS `uur_roles`;
CREATE TABLE `uur_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_roles
-- ----------------------------
INSERT INTO `uur_roles` VALUES ('1', 'login', 'Login privileges, granted after account confirmation');
INSERT INTO `uur_roles` VALUES ('2', 'admin', 'Administrative user, has access to everything.');

-- ----------------------------
-- Table structure for `uur_roles_users`
-- ----------------------------
DROP TABLE IF EXISTS `uur_roles_users`;
CREATE TABLE `uur_roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `uur_roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uur_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `uur_roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `uur_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_roles_users
-- ----------------------------
INSERT INTO `uur_roles_users` VALUES ('1', '1');
INSERT INTO `uur_roles_users` VALUES ('1', '2');

-- ----------------------------
-- Table structure for `uur_tags`
-- ----------------------------
DROP TABLE IF EXISTS `uur_tags`;
CREATE TABLE `uur_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_tags
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_tags_activities`
-- ----------------------------
DROP TABLE IF EXISTS `uur_tags_activities`;
CREATE TABLE `uur_tags_activities` (
  `tag_id` int(10) unsigned NOT NULL,
  `activity_id` int(10) unsigned NOT NULL,
  KEY `tag_id` (`tag_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `uur_tags_activities_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `uur_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `uur_tags_activities_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `uur_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_tags_activities
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_user_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `uur_user_tokens`;
CREATE TABLE `uur_user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `uur_user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uur_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_user_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `uur_users`
-- ----------------------------
DROP TABLE IF EXISTS `uur_users`;
CREATE TABLE `uur_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_users
-- ----------------------------
INSERT INTO `uur_users` VALUES ('1', 'sammy@subrise.com', 'admin', '294948fc2a768e3c435609d32e03aa54e1a181c62e3ca984e0af9552d370835e', '7', '1310840332');
INSERT INTO `uur_users` VALUES ('2', 'sammy@maeksm.com', 'sammy', '294948fc2a768e3c435609d32e03aa54e1a181c62e3ca984e0af9552d370835e', '0', null);

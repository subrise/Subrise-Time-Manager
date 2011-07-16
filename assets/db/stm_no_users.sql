/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : stm

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2011-07-16 23:26:41
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
  `name` varchar(100) NOT NULL,
  `trashed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uur_projects
-- ----------------------------

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

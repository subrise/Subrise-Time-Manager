/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50514
 Source Host           : localhost
 Source Database       : stm

 Target Server Type    : MySQL
 Target Server Version : 50514
 File Encoding         : utf-8

 Date: 07/17/2011 16:18:21 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `uur_tags_activities`
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

SET FOREIGN_KEY_CHECKS = 1;

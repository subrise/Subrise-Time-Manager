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

 Date: 07/20/2011 23:33:52 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `uur_activities`
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

SET FOREIGN_KEY_CHECKS = 1;

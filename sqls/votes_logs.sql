/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : arkalys

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-08-29 15:15:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `votes_logs`
-- ----------------------------
DROP TABLE IF EXISTS `votes_logs`;
CREATE TABLE `votes_logs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account` int(100) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of votes_logs
-- ----------------------------
INSERT INTO `votes_logs` VALUES ('6', '16896', '2012-08-28 01:20:15', '127.0.0.1');
INSERT INTO `votes_logs` VALUES ('7', '16899', '2012-08-28 14:41:18', '127.0.0.1');

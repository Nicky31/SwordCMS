/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : arkalys

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-08-29 15:15:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `credits_logs`
-- ----------------------------
DROP TABLE IF EXISTS `credits_logs`;
CREATE TABLE `credits_logs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account` int(100) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of credits_logs
-- ----------------------------
INSERT INTO `credits_logs` VALUES ('9', '16899', '2012-08-29 15:15:01', '127.0.0.1');

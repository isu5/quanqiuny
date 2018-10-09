/*
Navicat MySQL Data Transfer

Source Server         : 59
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xcxisu5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-09 17:05:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `qq_files`
-- ----------------------------
DROP TABLE IF EXISTS `qq_files`;
CREATE TABLE `qq_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL DEFAULT '' COMMENT '文件名称',
  `filepath` varchar(200) NOT NULL DEFAULT '' COMMENT '文件路径',
  `filesize` varchar(20) NOT NULL DEFAULT '' COMMENT '文件大小',
  `fileext` varchar(10) NOT NULL DEFAULT '' COMMENT '文件扩展名',
  `addtime` int(11) NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='文件存储';

-- ----------------------------
-- Records of qq_files
-- ----------------------------
INSERT INTO `qq_files` VALUES ('1', '案例大赛', '\\uploads\\20180927\\f5a8cd46e18f6b42a710d63a283c402b.doc', '114176', 'doc', '1538053569');
INSERT INTO `qq_files` VALUES ('2', '测试1', '\\uploads\\20180927\\8f0574b17c150e0927bde26e26ca9a10.txt', '1854', 'txt', '1538054002');
INSERT INTO `qq_files` VALUES ('8', 'dASDa', '\\uploads\\20180929\\ae1c52fb4f8d67120cc4d9338cc93e11.jpg', '57934', 'jpg', '1538199963');
INSERT INTO `qq_files` VALUES ('10', '阿萨德', '\\uploads\\20180929\\09e23c716a535c8d4c147ee1592f561b.rar', '57469', 'rar', '1538200717');
INSERT INTO `qq_files` VALUES ('12', '阿萨德啊', '\\uploads\\20180929\\013ac7d4dd5dd3a3538d12f8ba5bfc31.xlsx', '8714', 'xlsx', '1538202115');
INSERT INTO `qq_files` VALUES ('13', '技术文档', '\\uploads\\20180929\\b64c784913bf76923b2b85c320f31463.doc', '91136', 'doc', '1538205230');
INSERT INTO `qq_files` VALUES ('14', '空文档', '\\uploads\\20180929\\07837b7067ab2c27ab8c9cc920076da9.doc', '11264', 'doc', '1538205500');
INSERT INTO `qq_files` VALUES ('15', '空Excel', '\\uploads\\20180929\\46b1371f6ec8ba7b835125cf3b099a03.xls', '15872', 'xls', '1538205622');

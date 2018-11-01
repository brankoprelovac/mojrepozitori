/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100135
 Source Host           : localhost:3306
 Source Schema         : sajt

 Target Server Type    : MySQL
 Target Server Version : 100135
 File Encoding         : 65001

 Date: 31/10/2018 16:56:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cash
-- ----------------------------
DROP TABLE IF EXISTS `cash`;
CREATE TABLE `cash`  (
  `cash_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(14, 0) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`cash_id`) USING BTREE,
  INDEX `fk_cash_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_cash_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cash
-- ----------------------------
INSERT INTO `cash` VALUES (1, 'Zenina plata', 'Svakog dana', 3500, '2018-09-28 03:03:10', 1);
INSERT INTO `cash` VALUES (2, 'Racun za struju', 'Svakog 15 u mesecu', 252, '2018-09-28 02:51:46', 1);
INSERT INTO `cash` VALUES (3, 'Plata', 'Svakog prvog u mesecu', 1000, '2018-09-28 02:58:14', 1);
INSERT INTO `cash` VALUES (4, 'Uplata za more', 'Uplata za mesec Oktobar', 1250, '2018-10-21 18:20:09', 1);
INSERT INTO `cash` VALUES (60, 'Avgust unos', 'opis unosa', 4444, '2018-08-23 17:35:04', 1);
INSERT INTO `cash` VALUES (61, 'Avgust rashod', 'opis rashoda', 1504, '2018-08-16 17:52:08', 1);
INSERT INTO `cash` VALUES (64, 'Plata za Oktobar', 'Opis plate', 1405, '2018-10-30 15:50:11', 1);
INSERT INTO `cash` VALUES (70, 'Sklopljen posao o Veb stranici', 'Opis posla', 1700, '2018-10-31 12:37:56', 1);
INSERT INTO `cash` VALUES (71, 'Skolarina za cerku', 'Svakog meseca 10 procenata', 650, '2018-10-31 12:38:55', 1);

-- ----------------------------
-- Table structure for cash_category_cash
-- ----------------------------
DROP TABLE IF EXISTS `cash_category_cash`;
CREATE TABLE `cash_category_cash`  (
  `cash_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`category_id`, `cash_id`) USING BTREE,
  INDEX `fk_ccc_cash_id`(`cash_id`) USING BTREE,
  CONSTRAINT `fk_ccc_cash_id` FOREIGN KEY (`cash_id`) REFERENCES `cash` (`cash_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_ccc_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cash_category_cash
-- ----------------------------
INSERT INTO `cash_category_cash` VALUES (4, 3);
INSERT INTO `cash_category_cash` VALUES (1, 4);
INSERT INTO `cash_category_cash` VALUES (2, 4);
INSERT INTO `cash_category_cash` VALUES (61, 4);
INSERT INTO `cash_category_cash` VALUES (71, 4);
INSERT INTO `cash_category_cash` VALUES (3, 5);
INSERT INTO `cash_category_cash` VALUES (60, 5);
INSERT INTO `cash_category_cash` VALUES (64, 5);
INSERT INTO `cash_category_cash` VALUES (70, 19);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` char(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` enum('prihodi','rashodi') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'prihodi',
  PRIMARY KEY (`category_id`) USING BTREE,
  INDEX `fk_category_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_category_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (3, 'Uplata za more', '1-more', 1, 'rashodi');
INSERT INTO `category` VALUES (4, 'Računi', '1-racuni', 1, 'rashodi');
INSERT INTO `category` VALUES (5, 'Plata', '1-plata', 1, 'prihodi');
INSERT INTO `category` VALUES (7, 'test2', '2-ttteeest', 2, 'prihodi');
INSERT INTO `category` VALUES (12, 'Računi', '15-racuni', 15, 'prihodi');
INSERT INTO `category` VALUES (13, 'Uplate za more', '15-uplate-za-more', 15, 'prihodi');
INSERT INTO `category` VALUES (19, 'Privatni biznis', '1-privatni-biznis', 1, 'prihodi');

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image`  (
  `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cash_id` int(10) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`image_id`) USING BTREE,
  INDEX `fk_image_cash_id`(`cash_id`) USING BTREE,
  CONSTRAINT `fk_image_cash_id` FOREIGN KEY (`cash_id`) REFERENCES `cash` (`cash_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (2, '2018-09-24 18:43:14', 'test@test.com', 'Prvi pokusaj poruke', 'test1');
INSERT INTO `message` VALUES (9, '2018-10-29 01:11:02', 'branko.prelovac.11@singimail.rs', 'Ovo je moja poruka.', 'Nova poruka');
INSERT INTO `message` VALUES (10, '2018-10-29 01:11:02', 'branko.prelovac.11@singimail.rs', 'Ovo je moja poruka.', 'Nova poruka');
INSERT INTO `message` VALUES (11, '2018-10-30 17:32:01', 'prelovacbranko1@hotmail.com', '67667ujy', 'rtyu');
INSERT INTO `message` VALUES (12, '2018-10-30 17:32:01', 'prelovacbranko1@hotmail.com', '67667ujy', 'rtyu');
INSERT INTO `message` VALUES (13, '2018-10-30 17:32:44', 'prelovacbranko21@hotmail.com', '67667ujyed3', 'rtyu3e3e3');
INSERT INTO `message` VALUES (14, '2018-10-30 17:32:44', 'prelovacbranko21@hotmail.com', '67667ujyed3', 'rtyu3e3e3');
INSERT INTO `message` VALUES (15, '2018-10-30 17:33:27', 'prelovacbranko2w1@hotmail.com', '67667ujyed3eded', 'rtyu3e3e3ede');
INSERT INTO `message` VALUES (16, '2018-10-30 17:33:27', 'prelovacbranko2w1@hotmail.com', '67667ujyed3eded', 'rtyu3e3e3ede');
INSERT INTO `message` VALUES (17, '2018-10-30 17:34:20', 'prelovacbrank23o2w1@hotmail.com', '67667ujyed3eded456456456', 'rtyu3e3e3ede456456');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `page_id` int(10) NOT NULL AUTO_INCREMENT,
  `seo_url` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`page_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (1, 'o_nama', 'O nama | Aplikacija za vodjenje licknih finansija', 'O nama', '<p>Dobro dosli na nasu aplikaciju za vodjenje licnih finansija.</p><p>Pomocu nase Veb aplikacije svako moze da na jedan vrlo lak i jednostavan nacin drzi evidenciju o stanju na svom racunu.</p><p>Veb aplikacija registrovanim korisnicima nudi mogucnost unosa podataka, klasifikacije po kategorijama, pregled balansa kao i graficki prikaz stanja.</p><p>Takodje, korisnicima je omogucena komunikacija sa administratorom Veb stranice, putem Kontakt formulara.</p><p>Za sva pitanja obratite se administratoru.</p><p>Hvala Vam sto ste nas posetili.</p>');
INSERT INTO `page` VALUES (2, 'portfolio', 'Nas portfolio | Aplikacija za vodjenje licknih finansija', 'Portfolio', '<p> Sadrzaj portfolija.</p>');
INSERT INTO `page` VALUES (3, '404', 'Stranica nije pronadjena  | Aplikacija za vodjenje licknih finansija', 'Stranica nije pronadjena', '<p>Doslo je do greske, trazena stranica ne postoji.</p>');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`  (
  `tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tag_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES (1, 'ime', 'klasa');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` char(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'branko', 'prelovac', '33a5456f218b0f6f8f687bba2ffc4f2b185ae955bf8bad9d4c0751fbcfea118c74940715c99b7d05202cbf51e4f745a55b3043608505d2f03cacd2a7a9192a0f', 'email', 'salt', 1);
INSERT INTO `user` VALUES (2, 'ankica', 'prelovac', '33a5456f218b0f6f8f687bba2ffc4f2b185ae955bf8bad9d4c0751fbcfea118c74940715c99b7d05202cbf51e4f745a55b3043608505d2f03cacd2a7a9192a0f', 'mejl', 'salt2', 1);
INSERT INTO `user` VALUES (9, 'adriana', 'Adriana Prelovac', '33a5456f218b0f6f8f687bba2ffc4f2b185ae955bf8bad9d4c0751fbcfea118c74940715c99b7d05202cbf51e4f745a55b3043608505d2f03cacd2a7a9192a0f', 'mejl3@email.com', '', 1);
INSERT INTO `user` VALUES (14, 'testtest4', 'test xxx', '33a5456f218b0f6f8f687bba2ffc4f2b185ae955bf8bad9d4c0751fbcfea118c74940715c99b7d05202cbf51e4f745a55b3043608505d2f03cacd2a7a9192a0f', 'ggg@htmail.com', '', 1);
INSERT INTO `user` VALUES (15, 'testtesttest1', 'bfghfg gf fg jgh', '74d66b46ba4e123f526f25b68a01341ceccec9ba202773d79daf6a3d3763fd46d9721a155a0db04bf8965f0b0ab943810509e8b54039b3cf053e87c462744ec8', 'rthfghfg@fgf.tt', '', 1);
INSERT INTO `user` VALUES (16, 'test321test', 'Prezime Ime', '4d3a9309a5851ee9e68867fe6d2994ef8a9f24c6a2a344066226e459614f6afe268a6e5ed21eb64b4d2bef9c474cd80f8c8873cc1571d52a11e6fa03b745fa72', 'mejl4@mejl.com', '', 1);

-- ----------------------------
-- Triggers structure for table category
-- ----------------------------
DROP TRIGGER IF EXISTS `trigger_category_bi`;
delimiter ;;
CREATE TRIGGER `trigger_category_bi` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
SET NEW.slug = CONCAT(NEW.user_id, '-', REPLACE(LOWER( NEW.`name`), ' ', '-'));
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

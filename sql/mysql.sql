# SQL Dump for wgslider module
# PhpMyAdmin Version: 4.0.4
# https://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Sat Feb 28, 2026 to 12:04:09
# Server version: 9.1.0
# PHP Version: 8.3.14

#
# Structure table for `wgslider_category` 11
#

CREATE TABLE `wgslider_category` (
  `id`          INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255)    NOT NULL DEFAULT '',
  `display`     INT(10)         NOT NULL DEFAULT '0',
  `key`         VARCHAR(255)    NOT NULL DEFAULT '',
  `status`      INT(1)          NOT NULL DEFAULT '0',
  `maximg`      INT(10)         NOT NULL DEFAULT '0',
  `imgwidth`    INT(10)         NOT NULL DEFAULT '0',
  `imgheight`   INT(10)         NOT NULL DEFAULT '0',
  `slideshow`   INT(10)         NOT NULL DEFAULT '0',
  `datecreated` INT(11)         NOT NULL DEFAULT '0',
  `submitter`   INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#
# Structure table for `wgslider_image` 10
#

CREATE TABLE `wgslider_image` (
  `id`          INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255)    NOT NULL DEFAULT '',
  `description` VARCHAR(255)    NOT NULL DEFAULT '',
  `realname`    VARCHAR(255)    NOT NULL DEFAULT '',
  `width`       INT(10)         NOT NULL DEFAULT '0',
  `height`      INT(10)         NOT NULL DEFAULT '0',
  `category`    INT(10)         NOT NULL DEFAULT '0',
  `status`      INT(1)          NOT NULL DEFAULT '0',
  `weight`      INT(10)         NOT NULL DEFAULT '0',
  `datecreated` INT(11)         NOT NULL DEFAULT '0',
  `submitter`   INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


#
# Structure table for `wgslider_slideshow` 3
#

CREATE TABLE `wgslider_slideshow` (
  `id`      INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`    VARCHAR(255)    NOT NULL DEFAULT '',
  `descr`   VARCHAR(255)    NOT NULL DEFAULT '',
  `tpl`     VARCHAR(255)    NOT NULL DEFAULT '',
  `credits` VARCHAR(255)    NOT NULL DEFAULT '',
  `params`  VARCHAR(2000)   NOT NULL DEFAULT '',
  `status`  INT(1)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

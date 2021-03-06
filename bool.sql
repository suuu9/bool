#bool商城sql语句

#栏目表
create table category(
  cat_id int auto_increment primary key,
  cat_name varchar(20) not null default '',
  intro varchar(20) not null default '',
  parent_id int not null default 0
)engine myisam charset utf8;

#商品表 单引号转义
CREATE TABLE IF NOT EXISTS `goods` (
  `goods_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_sn` CHAR(15) NOT NULL DEFAULT '',
  `cat_id` SMALLINT(6) NOT NULL DEFAULT '0',
  `brand_id` SMALLINT(6) NOT NULL DEFAULT '0',
  `goods_name` VARCHAR(30) NOT NULL DEFAULT '',
  `shop_price` DECIMAL(9, 2) NOT NULL DEFAULT '0.00',
  `market_price` DECIMAL(9, 2) NOT NULL DEFAULT '0.00',
  `goods_number` SMALLINT(6) NOT NULL DEFAULT '1',
  `click_count` MEDIUMINT(9) NOT NULL DEFAULT '0',
  `goods_weight` DECIMAL(6, 3) NOT NULL DEFAULT '0.000',
  `goods_brief` VARCHAR(100) NOT NULL DEFAULT '',
  `goods_desc` TEXT NOT NULL,
  `thumb_img` VARCHAR(30) NOT NULL DEFAULT '',
  `goods_img` VARCHAR(30) NOT NULL DEFAULT '',
  `ori_img` VARCHAR(30) NOT NULL DEFAULT '',
  `is_on_sale` TINYINT(4) NOT NULL DEFAULT '1',
  `is_delete` TINYINT(4) NOT NULL DEFAULT '0',
  `is_best` TINYINT(4) NOT NULL DEFAULT '0',
  `is_new` TINYINT(4) NOT NULL DEFAULT '0',
  `is_hot` TINYINT(4) NOT NULL DEFAULT '0',
  `add_time` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_update` INT(10) UNSIGNED NOT NULL DEFAULT '0', PRIMARY KEY (`goods_id`), UNIQUE KEY `goods_sn` (`goods_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#用户表
CREATE TABLE IF NOT EXISTS user (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(16) NOT NULL DEFAULT '',
  email VARCHAR(30) NOT NULL DEFAULT '',
  passwd VARCHAR(32) NOT NULL DEFAULT '',
  regtime INT UNSIGNED NOT NULL DEFAULT 0,
  lastlogin INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#订单表
CREATE TABLE IF NOT EXISTS orderinfo (
  order_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_sn CHAR(15) NOT NULL DEFAULT '',
  user_id INT UNSIGNED NOT NULL DEFAULT 0,
  username VARCHAR(20) NOT NULL DEFAULT '',
  zone VARCHAR(30) NOT NULL DEFAULT '',
  address VARCHAR(30) NOT NULL DEFAULT '',
  zipcode CHAR(6) NOT NULL DEFAULT '',
  reciver VARCHAR(10) NOT NULL DEFAULT '',
  email VARCHAR(40) NOT NULL DEFAULT '',
  tel VARCHAR(20) NOT NULL DEFAULT '',
  mobile CHAR(11) NOT NULL DEFAULT '',
  building VARCHAR(30) NOT NULL DEFAULT '',
  best_time VARCHAR(10) NOT NULL DEFAULT '',
  order_amount DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  pay TINYINT(1) NOT NULL DEFAULT 0,
  add_time VARCHAR(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#订单与商品的对应表
CREATE TABLE IF NOT EXISTS ordergoods (
  og_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id INT UNSIGNED NOT NULL DEFAULT 0,
  order_sn CHAR(15) NOT NULL DEFAULT '',
  goods_id INT UNSIGNED NOT NULL DEFAULT 0,
  goods_name VARCHAR(60) NOT NULL DEFAULT '',
  goods_number SMALLINT NOT NULL DEFAULT 1,
  shop_price DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  subtotal DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  add_time VARCHAR(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

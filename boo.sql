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

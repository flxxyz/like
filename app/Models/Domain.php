<?php

namespace App\Models;


use Col\Model;

class Domain extends Model
{
    protected $table = 'domain';

    public $DDL = <<<EOP
CREATE TABLE `like_domain` (
  `id` int NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '域名',
  `hash` varchar(32) DEFAULT NULL COMMENT '随机的盐',
  `ctime` timestamp NULL COMMENT '创建时间',
  `utime` timestamp NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='域名表';
EOP;
}
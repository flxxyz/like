<?php

namespace App\Models;


use Col\Model;

class User extends Model
{
    public $DDL = <<<EOP
CREATE TABLE `like_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `passwd` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `role` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'visitor',
  `ctime` timestamp NULL COMMENT '创建时间',
  `utime` timestamp NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  unique key `UK_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';
EOP;
}
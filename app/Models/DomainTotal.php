<?php

namespace App\Models;


use Col\Model;

class DomainTotal extends Model
{
    protected $table = 'domain_total';

    public $DDL = <<<EOP
CREATE TABLE `like_domain_total` (
  `domain_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '域名id',
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `total` bigint(20) unsigned DEFAULT 0 COMMENT '点赞数',
  PRIMARY KEY (`domain_id`),
  index IK_user_id (`user_id`),
  index IK_domain_id (`domain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;
EOP;
}
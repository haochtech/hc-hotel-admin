<?php
//升级数据表
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `storeid` varchar(1000) NOT NULL COMMENT '门店id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `from_user` varchar(100) NOT NULL DEFAULT '',
  `accountname` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `salt` varchar(10) NOT NULL DEFAULT '',
  `pwd` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pay_account` varchar(200) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态',
  `role` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:店长,2:店员',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(15) NOT NULL,
  `areaid` int(10) NOT NULL DEFAULT '0' COMMENT '区域id',
  `is_admin_order` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_notice_order` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_notice_queue` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_notice_service` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_notice_boss` tinyint(1) NOT NULL DEFAULT '0',
  `remark` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注',
  `lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度',
  `lng` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度',
  `authority` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_account','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_account','weid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号'");}
if(!pdo_fieldexists('zh_jdgjb_account','storeid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `storeid` varchar(1000) NOT NULL COMMENT '门店id'");}
if(!pdo_fieldexists('zh_jdgjb_account','uid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `uid` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('zh_jdgjb_account','from_user')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `from_user` varchar(100) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('zh_jdgjb_account','accountname')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `accountname` varchar(50) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('zh_jdgjb_account','password')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `password` varchar(200) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('zh_jdgjb_account','salt')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `salt` varchar(10) NOT NULL DEFAULT ''");}
if(!pdo_fieldexists('zh_jdgjb_account','pwd')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `pwd` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','mobile')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `mobile` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','email')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `email` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','username')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `username` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','pay_account')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `pay_account` varchar(200) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','displayorder')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_account','dateline')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `dateline` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('zh_jdgjb_account','status')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态'");}
if(!pdo_fieldexists('zh_jdgjb_account','role')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `role` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:店长,2:店员'");}
if(!pdo_fieldexists('zh_jdgjb_account','lastvisit')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `lastvisit` int(10) unsigned NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('zh_jdgjb_account','lastip')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `lastip` varchar(15) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_account','areaid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `areaid` int(10) NOT NULL DEFAULT '0' COMMENT '区域id'");}
if(!pdo_fieldexists('zh_jdgjb_account','is_admin_order')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `is_admin_order` tinyint(1) unsigned NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_account','is_notice_order')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `is_notice_order` tinyint(1) unsigned NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_account','is_notice_queue')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `is_notice_queue` tinyint(1) unsigned NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_account','is_notice_service')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `is_notice_service` tinyint(1) unsigned NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_account','is_notice_boss')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `is_notice_boss` tinyint(1) NOT NULL DEFAULT '0'");}
if(!pdo_fieldexists('zh_jdgjb_account','remark')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `remark` varchar(1000) NOT NULL DEFAULT '' COMMENT '备注'");}
if(!pdo_fieldexists('zh_jdgjb_account','lat')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度'");}
if(!pdo_fieldexists('zh_jdgjb_account','lng')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `lng` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度'");}
if(!pdo_fieldexists('zh_jdgjb_account','authority')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_account')." ADD   `authority` text NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '轮播图标题',
  `logo` varchar(200) NOT NULL COMMENT '图片',
  `status` int(11) NOT NULL COMMENT '1.开启  2.关闭',
  `src` varchar(100) NOT NULL COMMENT '链接',
  `orderby` int(11) NOT NULL COMMENT '排序',
  `xcx_name` varchar(20) NOT NULL,
  `appid` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '小程序id',
  `type` int(11) NOT NULL COMMENT '1开屏',
  `wb_src` varchar(300) NOT NULL COMMENT '外部链接',
  `state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_ad','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_ad','title')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `title` varchar(50) NOT NULL COMMENT '轮播图标题'");}
if(!pdo_fieldexists('zh_jdgjb_ad','logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `logo` varchar(200) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('zh_jdgjb_ad','status')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `status` int(11) NOT NULL COMMENT '1.开启  2.关闭'");}
if(!pdo_fieldexists('zh_jdgjb_ad','src')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `src` varchar(100) NOT NULL COMMENT '链接'");}
if(!pdo_fieldexists('zh_jdgjb_ad','orderby')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `orderby` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_ad','xcx_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `xcx_name` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_ad','appid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `appid` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_ad','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `uniacid` int(11) NOT NULL COMMENT '小程序id'");}
if(!pdo_fieldexists('zh_jdgjb_ad','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `type` int(11) NOT NULL COMMENT '1开屏'");}
if(!pdo_fieldexists('zh_jdgjb_ad','wb_src')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `wb_src` varchar(300) NOT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('zh_jdgjb_ad','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_ad')." ADD   `state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_assess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `score` int(11) NOT NULL COMMENT '分数',
  `content` text NOT NULL COMMENT '评价内容',
  `img` varchar(1000) NOT NULL COMMENT '图片',
  `time` int(11) NOT NULL COMMENT '创建时间',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `uniacid` varchar(50) NOT NULL,
  `reply` varchar(1000) NOT NULL COMMENT '商家回复',
  `status` int(4) NOT NULL COMMENT '评价状态1，未回复，2已回复',
  `reply_time` int(11) NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评价表';

");

if(!pdo_fieldexists('zh_jdgjb_assess','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_assess','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `seller_id` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('zh_jdgjb_assess','score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `score` int(11) NOT NULL COMMENT '分数'");}
if(!pdo_fieldexists('zh_jdgjb_assess','content')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `content` text NOT NULL COMMENT '评价内容'");}
if(!pdo_fieldexists('zh_jdgjb_assess','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `img` varchar(1000) NOT NULL COMMENT '图片'");}
if(!pdo_fieldexists('zh_jdgjb_assess','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `time` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('zh_jdgjb_assess','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `user_id` int(11) NOT NULL COMMENT '用户ID'");}
if(!pdo_fieldexists('zh_jdgjb_assess','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_assess','reply')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `reply` varchar(1000) NOT NULL COMMENT '商家回复'");}
if(!pdo_fieldexists('zh_jdgjb_assess','status')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `status` int(4) NOT NULL COMMENT '评价状态1，未回复，2已回复'");}
if(!pdo_fieldexists('zh_jdgjb_assess','reply_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_assess')." ADD   `reply_time` int(11) NOT NULL COMMENT '回复时间'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_commission_withdrawal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝',
  `time` int(11) NOT NULL COMMENT '申请时间',
  `sh_time` int(11) NOT NULL COMMENT '审核时间',
  `uniacid` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL COMMENT '姓名',
  `account` varchar(100) NOT NULL COMMENT '账号',
  `tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额',
  `sj_cost` decimal(10,2) NOT NULL COMMENT '实际到账金额',
  `note` varchar(50) NOT NULL DEFAULT '提现',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='佣金提现';

");

if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `user_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `time` int(11) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','sh_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `sh_time` int(11) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','user_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `user_name` varchar(20) NOT NULL COMMENT '姓名'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','account')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `account` varchar(100) NOT NULL COMMENT '账号'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','tx_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','sj_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `sj_cost` decimal(10,2) NOT NULL COMMENT '实际到账金额'");}
if(!pdo_fieldexists('zh_jdgjb_commission_withdrawal','note')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_commission_withdrawal')." ADD   `note` varchar(50) NOT NULL DEFAULT '提现'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '门店ID',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(50) NOT NULL COMMENT '优惠券名称',
  `start_time` varchar(20) NOT NULL COMMENT '开始时间',
  `end_time` varchar(20) NOT NULL COMMENT '结束时间',
  `conditions` varchar(100) NOT NULL COMMENT '优惠条件',
  `number` int(11) NOT NULL COMMENT '发布数量',
  `cost` decimal(10,2) NOT NULL COMMENT '金额',
  `type` int(4) NOT NULL COMMENT '发布类型1,平台,2门店',
  `introduce` varchar(100) NOT NULL COMMENT '说明',
  `lq_num` int(11) NOT NULL COMMENT '领取数量',
  `klqzs` int(11) NOT NULL DEFAULT '1' COMMENT '每人可领取张数',
  `time` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '小程序id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券';

");

if(!pdo_fieldexists('zh_jdgjb_coupons','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_coupons','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `seller_id` int(11) NOT NULL COMMENT '门店ID'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `name` varchar(50) NOT NULL COMMENT '优惠券名称'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','start_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `start_time` varchar(20) NOT NULL COMMENT '开始时间'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','end_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `end_time` varchar(20) NOT NULL COMMENT '结束时间'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','conditions')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `conditions` varchar(100) NOT NULL COMMENT '优惠条件'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','number')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `number` int(11) NOT NULL COMMENT '发布数量'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `cost` decimal(10,2) NOT NULL COMMENT '金额'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `type` int(4) NOT NULL COMMENT '发布类型1,平台,2门店'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','introduce')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `introduce` varchar(100) NOT NULL COMMENT '说明'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','lq_num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `lq_num` int(11) NOT NULL COMMENT '领取数量'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','klqzs')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `klqzs` int(11) NOT NULL DEFAULT '1' COMMENT '每人可领取张数'");}
if(!pdo_fieldexists('zh_jdgjb_coupons','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_coupons','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_coupons')." ADD   `uniacid` int(11) NOT NULL COMMENT '小程序id'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_czhd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full` int(11) NOT NULL,
  `reduction` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_czhd','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_czhd')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_czhd','full')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_czhd')." ADD   `full` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_czhd','reduction')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_czhd')." ADD   `reduction` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_czhd','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_czhd')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_tel` varchar(20) NOT NULL,
  `state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝',
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分销申请';

");

if(!pdo_fieldexists('zh_jdgjb_distribution','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_distribution','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `user_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_distribution','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_distribution','user_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `user_name` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_distribution','user_tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `user_tel` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_distribution','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝'");}
if(!pdo_fieldexists('zh_jdgjb_distribution','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_distribution')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_dyj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dyj_title` varchar(50) NOT NULL COMMENT '打印机标题',
  `dyj_id` varchar(50) NOT NULL COMMENT '打印机编号',
  `dyj_key` varchar(50) NOT NULL COMMENT '打印机key',
  `uniacid` varchar(50) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1.365  2.易联云，3飞蛾',
  `name` varchar(20) NOT NULL COMMENT '打印机名称',
  `mid` varchar(100) NOT NULL COMMENT '打印机终端号',
  `api` varchar(100) NOT NULL COMMENT 'API密钥',
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `state` int(11) NOT NULL COMMENT '1开启2关闭',
  `yy_id` varchar(20) NOT NULL COMMENT '用户id',
  `token` varchar(50) NOT NULL COMMENT '打印机终端密钥',
  `dyj_title2` varchar(50) NOT NULL,
  `dyj_id2` varchar(50) NOT NULL,
  `dyj_key2` varchar(50) NOT NULL,
  `fezh` varchar(40) NOT NULL COMMENT '飞蛾账号',
  `fe_ukey` varchar(50) NOT NULL COMMENT 'ukey',
  `fe_dycode` varchar(20) NOT NULL COMMENT '打印机编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_dyj','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_title')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_title` varchar(50) NOT NULL COMMENT '打印机标题'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_id` varchar(50) NOT NULL COMMENT '打印机编号'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_key')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_key` varchar(50) NOT NULL COMMENT '打印机key'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_dyj','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `type` int(11) NOT NULL COMMENT '1.365  2.易联云，3飞蛾'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `name` varchar(20) NOT NULL COMMENT '打印机名称'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','mid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `mid` varchar(100) NOT NULL COMMENT '打印机终端号'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','api')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `api` varchar(100) NOT NULL COMMENT 'API密钥'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `seller_id` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `state` int(11) NOT NULL COMMENT '1开启2关闭'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','yy_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `yy_id` varchar(20) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','token')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `token` varchar(50) NOT NULL COMMENT '打印机终端密钥'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_title2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_title2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_id2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_id2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_dyj','dyj_key2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `dyj_key2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_dyj','fezh')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `fezh` varchar(40) NOT NULL COMMENT '飞蛾账号'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','fe_ukey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `fe_ukey` varchar(50) NOT NULL COMMENT 'ukey'");}
if(!pdo_fieldexists('zh_jdgjb_dyj','fe_dycode')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_dyj')." ADD   `fe_dycode` varchar(20) NOT NULL COMMENT '打印机编号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `user_id` int(11) NOT NULL,
  `son_id` int(11) NOT NULL COMMENT '下线',
  `money` decimal(10,2) NOT NULL,
  `time` int(11) NOT NULL,
  `note` varchar(50) NOT NULL COMMENT '备注',
  `state` int(4) NOT NULL COMMENT '佣金状态,1冻结,2有效,3无效',
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='佣金收益表';

");

if(!pdo_fieldexists('zh_jdgjb_earnings','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_earnings','order_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `order_id` int(11) NOT NULL COMMENT '订单ID'");}
if(!pdo_fieldexists('zh_jdgjb_earnings','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `user_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_earnings','son_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `son_id` int(11) NOT NULL COMMENT '下线'");}
if(!pdo_fieldexists('zh_jdgjb_earnings','money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `money` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_earnings','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_earnings','note')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `note` varchar(50) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('zh_jdgjb_earnings','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `state` int(4) NOT NULL COMMENT '佣金状态,1冻结,2有效,3无效'");}
if(!pdo_fieldexists('zh_jdgjb_earnings','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_earnings')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_fxset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fx_details` text NOT NULL COMMENT '分销商申请协议',
  `tx_details` text NOT NULL COMMENT '佣金提现协议',
  `is_fx` int(11) NOT NULL COMMENT '1.开启分销审核2.不开启',
  `is_ej` int(11) NOT NULL COMMENT '是否开启二级分销1.是2.否',
  `tx_rate` int(11) NOT NULL COMMENT '提现手续费',
  `commission` varchar(10) NOT NULL COMMENT '一级佣金',
  `commission2` varchar(10) NOT NULL COMMENT '二级佣金',
  `tx_money` int(11) NOT NULL COMMENT '提现门槛',
  `img` varchar(100) NOT NULL COMMENT '分销中心图片',
  `img2` varchar(100) NOT NULL COMMENT '申请分销图片',
  `uniacid` int(11) NOT NULL,
  `is_open` int(11) NOT NULL DEFAULT '1' COMMENT '1.开启2关闭',
  `instructions` text NOT NULL COMMENT '分销商说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_fxset','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_fxset','fx_details')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `fx_details` text NOT NULL COMMENT '分销商申请协议'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','tx_details')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `tx_details` text NOT NULL COMMENT '佣金提现协议'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','is_fx')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `is_fx` int(11) NOT NULL COMMENT '1.开启分销审核2.不开启'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','is_ej')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `is_ej` int(11) NOT NULL COMMENT '是否开启二级分销1.是2.否'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','tx_rate')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `tx_rate` int(11) NOT NULL COMMENT '提现手续费'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','commission')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `commission` varchar(10) NOT NULL COMMENT '一级佣金'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','commission2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `commission2` varchar(10) NOT NULL COMMENT '二级佣金'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','tx_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `tx_money` int(11) NOT NULL COMMENT '提现门槛'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `img` varchar(100) NOT NULL COMMENT '分销中心图片'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','img2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `img2` varchar(100) NOT NULL COMMENT '申请分销图片'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_fxset','is_open')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `is_open` int(11) NOT NULL DEFAULT '1' COMMENT '1.开启2关闭'");}
if(!pdo_fieldexists('zh_jdgjb_fxset','instructions')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxset')." ADD   `instructions` text NOT NULL COMMENT '分销商说明'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_fxuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '一级分销',
  `fx_user` int(11) NOT NULL COMMENT '二级分销',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_fxuser','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxuser')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_fxuser','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxuser')." ADD   `user_id` int(11) NOT NULL COMMENT '一级分销'");}
if(!pdo_fieldexists('zh_jdgjb_fxuser','fx_user')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxuser')." ADD   `fx_user` int(11) NOT NULL COMMENT '二级分销'");}
if(!pdo_fieldexists('zh_jdgjb_fxuser','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_fxuser')." ADD   `time` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_jfgoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `img` varchar(100) NOT NULL,
  `score` int(11) NOT NULL COMMENT '所需积分',
  `type_id` int(11) NOT NULL COMMENT '分类id',
  `goods_details` text NOT NULL,
  `process_details` text NOT NULL,
  `attention_details` text NOT NULL,
  `number` int(11) NOT NULL COMMENT '数量',
  `time` varchar(50) NOT NULL COMMENT '期限',
  `is_open` int(11) NOT NULL COMMENT '1.开启2关闭',
  `type` int(11) NOT NULL COMMENT '1.余额2.实物',
  `num` int(11) NOT NULL COMMENT '排序',
  `end_time` int(11) NOT NULL COMMENT '兑换截止时间',
  `uniacid` int(11) NOT NULL,
  `hb_moeny` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_jfgoods','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `name` varchar(50) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `img` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `score` int(11) NOT NULL COMMENT '所需积分'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','type_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `type_id` int(11) NOT NULL COMMENT '分类id'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','goods_details')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `goods_details` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','process_details')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `process_details` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','attention_details')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `attention_details` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','number')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `number` int(11) NOT NULL COMMENT '数量'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `time` varchar(50) NOT NULL COMMENT '期限'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','is_open')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `is_open` int(11) NOT NULL COMMENT '1.开启2关闭'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `type` int(11) NOT NULL COMMENT '1.余额2.实物'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `num` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','end_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `end_time` int(11) NOT NULL COMMENT '兑换截止时间'");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfgoods','hb_moeny')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfgoods')." ADD   `hb_moeny` decimal(10,2) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_jfhb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `money` decimal(10,2) NOT NULL COMMENT '红包金额',
  `state` int(4) NOT NULL DEFAULT '1' COMMENT '1新增,2使用',
  `time` int(11) NOT NULL COMMENT '时间',
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分红包表';

");

if(!pdo_fieldexists('zh_jdgjb_jfhb','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','goods_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `goods_id` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `money` decimal(10,2) NOT NULL COMMENT '红包金额'");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `state` int(4) NOT NULL DEFAULT '1' COMMENT '1新增,2使用'");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `time` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('zh_jdgjb_jfhb','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfhb')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_jfrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `time` varchar(20) NOT NULL COMMENT '兑换时间',
  `user_name` varchar(20) NOT NULL COMMENT '用户地址',
  `user_tel` varchar(20) NOT NULL COMMENT '用户电话',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `note` varchar(20) NOT NULL,
  `integral` int(11) NOT NULL COMMENT '积分',
  `good_name` varchar(50) NOT NULL COMMENT '商品名称',
  `good_img` varchar(100) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '2' COMMENT '1.未处理 2.已处理',
  `kd_name` varchar(30) NOT NULL COMMENT '快递公司',
  `kd_num` varchar(50) NOT NULL COMMENT '快递编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_jfrecord','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','good_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `good_id` int(11) NOT NULL COMMENT '商品id'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `time` varchar(20) NOT NULL COMMENT '兑换时间'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','user_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `user_name` varchar(20) NOT NULL COMMENT '用户地址'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','user_tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `user_tel` varchar(20) NOT NULL COMMENT '用户电话'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','address')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `address` varchar(200) NOT NULL COMMENT '地址'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','note')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `note` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','integral')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `integral` int(11) NOT NULL COMMENT '积分'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','good_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `good_name` varchar(50) NOT NULL COMMENT '商品名称'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','good_img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `good_img` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `state` int(11) NOT NULL DEFAULT '2' COMMENT '1.未处理 2.已处理'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','kd_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `kd_name` varchar(30) NOT NULL COMMENT '快递公司'");}
if(!pdo_fieldexists('zh_jdgjb_jfrecord','kd_num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jfrecord')." ADD   `kd_num` varchar(50) NOT NULL COMMENT '快递编号'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_jftype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `num` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分商城分类';

");

if(!pdo_fieldexists('zh_jdgjb_jftype','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jftype')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_jftype','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jftype')." ADD   `name` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jftype','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jftype')." ADD   `img` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jftype','num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jftype')." ADD   `num` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_jftype','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_jftype')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `name` varchar(50) NOT NULL COMMENT '会员名称',
  `value` decimal(10,2) NOT NULL COMMENT '设置金额',
  `icon` varchar(100) NOT NULL COMMENT '图标',
  `discount` varchar(10) NOT NULL COMMENT '折扣',
  `orderby` int(4) NOT NULL COMMENT '排序',
  `uniacid` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员等级表';

");

if(!pdo_fieldexists('zh_jdgjb_level','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_level','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `seller_id` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('zh_jdgjb_level','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `name` varchar(50) NOT NULL COMMENT '会员名称'");}
if(!pdo_fieldexists('zh_jdgjb_level','value')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `value` decimal(10,2) NOT NULL COMMENT '设置金额'");}
if(!pdo_fieldexists('zh_jdgjb_level','icon')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `icon` varchar(100) NOT NULL COMMENT '图标'");}
if(!pdo_fieldexists('zh_jdgjb_level','discount')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `discount` varchar(10) NOT NULL COMMENT '折扣'");}
if(!pdo_fieldexists('zh_jdgjb_level','orderby')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `orderby` int(4) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_level','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_level','content')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_level')." ADD   `content` text NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '名称',
  `logo` varchar(200) NOT NULL COMMENT '图标',
  `status` int(11) NOT NULL COMMENT '1.开启  2.关闭',
  `src` varchar(100) NOT NULL COMMENT '内部链接',
  `orderby` int(11) NOT NULL COMMENT '排序',
  `xcx_name` varchar(20) NOT NULL COMMENT '小程序名称',
  `appid` varchar(20) NOT NULL COMMENT 'APPID',
  `uniacid` int(11) NOT NULL COMMENT '小程序id',
  `wb_src` varchar(300) NOT NULL COMMENT '外部链接',
  `state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_nav','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_nav','title')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `title` varchar(50) NOT NULL COMMENT '名称'");}
if(!pdo_fieldexists('zh_jdgjb_nav','logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `logo` varchar(200) NOT NULL COMMENT '图标'");}
if(!pdo_fieldexists('zh_jdgjb_nav','status')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `status` int(11) NOT NULL COMMENT '1.开启  2.关闭'");}
if(!pdo_fieldexists('zh_jdgjb_nav','src')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `src` varchar(100) NOT NULL COMMENT '内部链接'");}
if(!pdo_fieldexists('zh_jdgjb_nav','orderby')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `orderby` int(11) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_nav','xcx_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `xcx_name` varchar(20) NOT NULL COMMENT '小程序名称'");}
if(!pdo_fieldexists('zh_jdgjb_nav','appid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `appid` varchar(20) NOT NULL COMMENT 'APPID'");}
if(!pdo_fieldexists('zh_jdgjb_nav','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `uniacid` int(11) NOT NULL COMMENT '小程序id'");}
if(!pdo_fieldexists('zh_jdgjb_nav','wb_src')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `wb_src` varchar(300) NOT NULL COMMENT '外部链接'");}
if(!pdo_fieldexists('zh_jdgjb_nav','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_nav')." ADD   `state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `js_tel` varchar(20) NOT NULL COMMENT '接收人手机号',
  `tpl_id` varchar(10) NOT NULL COMMENT '模板id',
  `appkey` varchar(50) NOT NULL COMMENT '应用密钥',
  `uniacid` int(11) NOT NULL,
  `aliyun_appkey` varchar(50) NOT NULL,
  `aliyun_appsecret` varchar(50) NOT NULL,
  `aliyun_sign` varchar(50) NOT NULL,
  `aliyun_id` varchar(50) NOT NULL,
  `item` int(1) NOT NULL DEFAULT '1' COMMENT '1聚合,2阿里云',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='通知表';

");

if(!pdo_fieldexists('zh_jdgjb_notice','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_notice','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `seller_id` int(11) NOT NULL COMMENT '商家ID'");}
if(!pdo_fieldexists('zh_jdgjb_notice','js_tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `js_tel` varchar(20) NOT NULL COMMENT '接收人手机号'");}
if(!pdo_fieldexists('zh_jdgjb_notice','tpl_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `tpl_id` varchar(10) NOT NULL COMMENT '模板id'");}
if(!pdo_fieldexists('zh_jdgjb_notice','appkey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `appkey` varchar(50) NOT NULL COMMENT '应用密钥'");}
if(!pdo_fieldexists('zh_jdgjb_notice','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_notice','aliyun_appkey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `aliyun_appkey` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_notice','aliyun_appsecret')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `aliyun_appsecret` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_notice','aliyun_sign')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `aliyun_sign` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_notice','aliyun_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `aliyun_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_notice','item')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_notice')." ADD   `item` int(1) NOT NULL DEFAULT '1' COMMENT '1聚合,2阿里云'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL COMMENT '房ID',
  `user_id` int(11) NOT NULL,
  `coupons_id` int(11) NOT NULL COMMENT '优惠券ID',
  `order_no` varchar(50) NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `seller_address` varchar(100) NOT NULL COMMENT '商家地址',
  `coordinates` varchar(50) NOT NULL COMMENT '经纬度',
  `arrival_time` datetime NOT NULL COMMENT '入住时间',
  `departure_time` datetime NOT NULL COMMENT '离店时间',
  `dd_time` varchar(10) NOT NULL COMMENT '到店时间',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `num` int(4) NOT NULL COMMENT '房间数量',
  `days` int(4) NOT NULL COMMENT '入住天数',
  `room_type` varchar(30) NOT NULL COMMENT '房型',
  `room_logo` varchar(100) NOT NULL COMMENT '房间主图',
  `bed_type` varchar(20) NOT NULL COMMENT '床型',
  `name` varchar(30) NOT NULL COMMENT '预定人',
  `tel` varchar(20) NOT NULL,
  `status` int(4) NOT NULL COMMENT '1未付款,2已付款，3取消,4完成,5已入住,6申请退款,7退款,8拒绝退款',
  `out_trade_no` varchar(32) NOT NULL COMMENT '商户订单号',
  `dis_cost` decimal(10,2) NOT NULL COMMENT '折扣后的价格',
  `yj_cost` decimal(10,2) NOT NULL COMMENT '押金金额',
  `yhq_cost` decimal(10,2) NOT NULL COMMENT '优惠券价格',
  `yyzk_cost` decimal(10,2) NOT NULL COMMENT '会员折扣金额',
  `total_cost` decimal(10,2) NOT NULL COMMENT '总价格',
  `is_delete` int(4) NOT NULL DEFAULT '0' COMMENT '是否删除,1删除',
  `time` int(11) NOT NULL COMMENT '创建时间',
  `uniacid` varchar(50) NOT NULL,
  `ytyj_cost` decimal(10,2) NOT NULL COMMENT '已退押金',
  `hb_cost` decimal(10,2) NOT NULL,
  `hb_id` int(11) NOT NULL,
  `from_id` varchar(50) NOT NULL,
  `classify` int(4) NOT NULL DEFAULT '1',
  `type` int(4) NOT NULL DEFAULT '1',
  `code` varchar(20) NOT NULL,
  `jj_time` int(11) NOT NULL,
  `voice` int(4) NOT NULL DEFAULT '1',
  `qr_fromid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_order','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_order','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `seller_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','room_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `room_id` int(11) NOT NULL COMMENT '房ID'");}
if(!pdo_fieldexists('zh_jdgjb_order','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `user_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','coupons_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `coupons_id` int(11) NOT NULL COMMENT '优惠券ID'");}
if(!pdo_fieldexists('zh_jdgjb_order','order_no')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `order_no` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','seller_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `seller_name` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','seller_address')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `seller_address` varchar(100) NOT NULL COMMENT '商家地址'");}
if(!pdo_fieldexists('zh_jdgjb_order','coordinates')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `coordinates` varchar(50) NOT NULL COMMENT '经纬度'");}
if(!pdo_fieldexists('zh_jdgjb_order','arrival_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `arrival_time` datetime NOT NULL COMMENT '入住时间'");}
if(!pdo_fieldexists('zh_jdgjb_order','departure_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `departure_time` datetime NOT NULL COMMENT '离店时间'");}
if(!pdo_fieldexists('zh_jdgjb_order','dd_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `dd_time` varchar(10) NOT NULL COMMENT '到店时间'");}
if(!pdo_fieldexists('zh_jdgjb_order','price')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('zh_jdgjb_order','num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `num` int(4) NOT NULL COMMENT '房间数量'");}
if(!pdo_fieldexists('zh_jdgjb_order','days')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `days` int(4) NOT NULL COMMENT '入住天数'");}
if(!pdo_fieldexists('zh_jdgjb_order','room_type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `room_type` varchar(30) NOT NULL COMMENT '房型'");}
if(!pdo_fieldexists('zh_jdgjb_order','room_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `room_logo` varchar(100) NOT NULL COMMENT '房间主图'");}
if(!pdo_fieldexists('zh_jdgjb_order','bed_type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `bed_type` varchar(20) NOT NULL COMMENT '床型'");}
if(!pdo_fieldexists('zh_jdgjb_order','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `name` varchar(30) NOT NULL COMMENT '预定人'");}
if(!pdo_fieldexists('zh_jdgjb_order','tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `tel` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','status')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `status` int(4) NOT NULL COMMENT '1未付款,2已付款，3取消,4完成,5已入住,6申请退款,7退款,8拒绝退款'");}
if(!pdo_fieldexists('zh_jdgjb_order','out_trade_no')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `out_trade_no` varchar(32) NOT NULL COMMENT '商户订单号'");}
if(!pdo_fieldexists('zh_jdgjb_order','dis_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `dis_cost` decimal(10,2) NOT NULL COMMENT '折扣后的价格'");}
if(!pdo_fieldexists('zh_jdgjb_order','yj_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `yj_cost` decimal(10,2) NOT NULL COMMENT '押金金额'");}
if(!pdo_fieldexists('zh_jdgjb_order','yhq_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `yhq_cost` decimal(10,2) NOT NULL COMMENT '优惠券价格'");}
if(!pdo_fieldexists('zh_jdgjb_order','yyzk_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `yyzk_cost` decimal(10,2) NOT NULL COMMENT '会员折扣金额'");}
if(!pdo_fieldexists('zh_jdgjb_order','total_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `total_cost` decimal(10,2) NOT NULL COMMENT '总价格'");}
if(!pdo_fieldexists('zh_jdgjb_order','is_delete')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `is_delete` int(4) NOT NULL DEFAULT '0' COMMENT '是否删除,1删除'");}
if(!pdo_fieldexists('zh_jdgjb_order','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `time` int(11) NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('zh_jdgjb_order','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','ytyj_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `ytyj_cost` decimal(10,2) NOT NULL COMMENT '已退押金'");}
if(!pdo_fieldexists('zh_jdgjb_order','hb_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `hb_cost` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','hb_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `hb_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','from_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `from_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','classify')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `classify` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_order','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `type` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_order','code')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `code` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','jj_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `jj_time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_order','voice')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `voice` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_order','qr_fromid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_order')." ADD   `qr_fromid` varchar(50) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `cz_money` decimal(10,2) NOT NULL COMMENT '充值金额',
  `zs_money` decimal(10,2) NOT NULL COMMENT '赠送金额',
  `note` varchar(30) NOT NULL DEFAULT '在线充值' COMMENT '备注信息',
  `out_trade_no` varchar(30) NOT NULL COMMENT '商户号',
  `state` int(4) NOT NULL DEFAULT '1' COMMENT '1未付款,2已付款',
  `time` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='充值表';

");

if(!pdo_fieldexists('zh_jdgjb_recharge','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_recharge','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','cz_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `cz_money` decimal(10,2) NOT NULL COMMENT '充值金额'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','zs_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `zs_money` decimal(10,2) NOT NULL COMMENT '赠送金额'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','note')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `note` varchar(30) NOT NULL DEFAULT '在线充值' COMMENT '备注信息'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','out_trade_no')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `out_trade_no` varchar(30) NOT NULL COMMENT '商户号'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `state` int(4) NOT NULL DEFAULT '1' COMMENT '1未付款,2已付款'");}
if(!pdo_fieldexists('zh_jdgjb_recharge','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_recharge','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_recharge')." ADD   `uniacid` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `img` text NOT NULL,
  `floor` varchar(100) NOT NULL,
  `people` int(4) NOT NULL,
  `bed` int(4) NOT NULL,
  `breakfast` int(4) NOT NULL,
  `facilities` varchar(200) NOT NULL,
  `windows` int(4) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `total_num` int(4) NOT NULL,
  `uniacid` varchar(50) NOT NULL,
  `size` varchar(30) NOT NULL,
  `is_refund` int(4) NOT NULL COMMENT '押金是否可退,1否，2是',
  `yj_state` int(4) NOT NULL COMMENT '1在线,2到店,3入住+到店',
  `yj_cost` decimal(10,2) NOT NULL COMMENT '押金金额',
  `sort` int(11) NOT NULL,
  `state` int(4) NOT NULL DEFAULT '1',
  `classify` int(4) NOT NULL DEFAULT '1',
  `rz_time` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_room','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_room','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `seller_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `name` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','price')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `price` decimal(10,2) NOT NULL COMMENT '价格'");}
if(!pdo_fieldexists('zh_jdgjb_room','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `img` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','floor')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `floor` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','people')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `people` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','bed')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `bed` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','breakfast')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `breakfast` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','facilities')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `facilities` varchar(200) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','windows')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `windows` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `logo` varchar(200) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','total_num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `total_num` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','size')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `size` varchar(30) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','is_refund')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `is_refund` int(4) NOT NULL COMMENT '押金是否可退,1否，2是'");}
if(!pdo_fieldexists('zh_jdgjb_room','yj_state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `yj_state` int(4) NOT NULL COMMENT '1在线,2到店,3入住+到店'");}
if(!pdo_fieldexists('zh_jdgjb_room','yj_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `yj_cost` decimal(10,2) NOT NULL COMMENT '押金金额'");}
if(!pdo_fieldexists('zh_jdgjb_room','sort')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `sort` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_room','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `state` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_room','classify')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `classify` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_room','rz_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_room')." ADD   `rz_time` varchar(4) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_roomnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `nums` int(11) NOT NULL,
  `dateday` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_roomnum','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomnum')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_roomnum','rid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomnum')." ADD   `rid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_roomnum','nums')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomnum')." ADD   `nums` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_roomnum','dateday')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomnum')." ADD   `dateday` int(11) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_roomprice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `dateday` int(11) NOT NULL,
  `mprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_roomprice','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomprice')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_roomprice','rid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomprice')." ADD   `rid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_roomprice','dateday')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomprice')." ADD   `dateday` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_roomprice','mprice')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_roomprice')." ADD   `mprice` decimal(10,2) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `assess_id` int(11) NOT NULL COMMENT '评论id',
  `score` int(11) NOT NULL COMMENT '积分',
  `note` varchar(100) NOT NULL COMMENT '备注',
  `time` int(11) NOT NULL COMMENT '时间',
  `uniacid` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `type` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='积分明细表';

");

if(!pdo_fieldexists('zh_jdgjb_score','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_score','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_score','order_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `order_id` int(11) NOT NULL COMMENT '订单id'");}
if(!pdo_fieldexists('zh_jdgjb_score','assess_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `assess_id` int(11) NOT NULL COMMENT '评论id'");}
if(!pdo_fieldexists('zh_jdgjb_score','score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `score` int(11) NOT NULL COMMENT '积分'");}
if(!pdo_fieldexists('zh_jdgjb_score','note')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `note` varchar(100) NOT NULL COMMENT '备注'");}
if(!pdo_fieldexists('zh_jdgjb_score','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `time` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('zh_jdgjb_score','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `uniacid` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_score','goods_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `goods_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_score','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_score')." ADD   `type` int(4) NOT NULL DEFAULT '1'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `owner` int(4) NOT NULL COMMENT '1后台添加,2入住',
  `name` varchar(100) NOT NULL,
  `star` varchar(30) NOT NULL COMMENT '星级',
  `address` varchar(100) NOT NULL,
  `link_name` varchar(20) NOT NULL COMMENT '联系人',
  `link_tel` varchar(20) NOT NULL COMMENT '联系电话',
  `tel` varchar(50) NOT NULL COMMENT '酒店电话',
  `handle` varchar(100) NOT NULL,
  `open_time` datetime NOT NULL,
  `wake` int(4) NOT NULL,
  `wifi` int(4) NOT NULL,
  `park` int(4) NOT NULL,
  `breakfast` int(4) NOT NULL,
  `unionPay` int(4) NOT NULL,
  `gym` int(4) NOT NULL,
  `boardroom` int(4) NOT NULL,
  `water` int(4) NOT NULL,
  `policy` varchar(1000) NOT NULL,
  `introduction` text NOT NULL,
  `img` text NOT NULL,
  `rule` varchar(1000) NOT NULL,
  `prompt` varchar(1000) NOT NULL,
  `bq_logo` varchar(100) NOT NULL,
  `support` varchar(300) NOT NULL,
  `ewm_logo` varchar(100) NOT NULL,
  `time` int(11) NOT NULL COMMENT '时间',
  `coordinates` varchar(100) NOT NULL COMMENT '经纬度',
  `scort` int(4) NOT NULL COMMENT '排序',
  `sfz_img1` varchar(100) NOT NULL COMMENT '身份证正面照',
  `sfz_img2` varchar(100) NOT NULL COMMENT '身份证反面照',
  `yy_img` varchar(100) NOT NULL COMMENT '营业执照',
  `other` text NOT NULL COMMENT '补充说明',
  `zd_money` decimal(10,2) NOT NULL COMMENT '房间最低价格',
  `state` int(4) NOT NULL DEFAULT '1' COMMENT '1待审核,2通过，3拒绝',
  `sq_time` int(11) NOT NULL COMMENT '申请时间',
  `uniacid` varchar(50) NOT NULL,
  `is_use` int(4) NOT NULL DEFAULT '1',
  `ll_num` int(11) NOT NULL,
  `bd_id` int(11) NOT NULL,
  `ye_open` decimal(10,2) NOT NULL,
  `wx_open` int(4) NOT NULL DEFAULT '1',
  `dd_open` int(4) NOT NULL DEFAULT '1',
  `cityName` varchar(30) NOT NULL COMMENT '城市名称',
  `provinceName` varchar(30) NOT NULL COMMENT '省名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_seller','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_seller','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `user_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','owner')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `owner` int(4) NOT NULL COMMENT '1后台添加,2入住'");}
if(!pdo_fieldexists('zh_jdgjb_seller','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `name` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','star')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `star` varchar(30) NOT NULL COMMENT '星级'");}
if(!pdo_fieldexists('zh_jdgjb_seller','address')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `address` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','link_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `link_name` varchar(20) NOT NULL COMMENT '联系人'");}
if(!pdo_fieldexists('zh_jdgjb_seller','link_tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `link_tel` varchar(20) NOT NULL COMMENT '联系电话'");}
if(!pdo_fieldexists('zh_jdgjb_seller','tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `tel` varchar(50) NOT NULL COMMENT '酒店电话'");}
if(!pdo_fieldexists('zh_jdgjb_seller','handle')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `handle` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','open_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `open_time` datetime NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','wake')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `wake` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','wifi')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `wifi` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','park')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `park` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','breakfast')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `breakfast` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','unionPay')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `unionPay` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','gym')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `gym` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','boardroom')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `boardroom` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','water')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `water` int(4) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','policy')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `policy` varchar(1000) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','introduction')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `introduction` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `img` text NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','rule')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `rule` varchar(1000) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','prompt')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `prompt` varchar(1000) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','bq_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `bq_logo` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','support')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `support` varchar(300) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','ewm_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `ewm_logo` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `time` int(11) NOT NULL COMMENT '时间'");}
if(!pdo_fieldexists('zh_jdgjb_seller','coordinates')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `coordinates` varchar(100) NOT NULL COMMENT '经纬度'");}
if(!pdo_fieldexists('zh_jdgjb_seller','scort')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `scort` int(4) NOT NULL COMMENT '排序'");}
if(!pdo_fieldexists('zh_jdgjb_seller','sfz_img1')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `sfz_img1` varchar(100) NOT NULL COMMENT '身份证正面照'");}
if(!pdo_fieldexists('zh_jdgjb_seller','sfz_img2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `sfz_img2` varchar(100) NOT NULL COMMENT '身份证反面照'");}
if(!pdo_fieldexists('zh_jdgjb_seller','yy_img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `yy_img` varchar(100) NOT NULL COMMENT '营业执照'");}
if(!pdo_fieldexists('zh_jdgjb_seller','other')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `other` text NOT NULL COMMENT '补充说明'");}
if(!pdo_fieldexists('zh_jdgjb_seller','zd_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `zd_money` decimal(10,2) NOT NULL COMMENT '房间最低价格'");}
if(!pdo_fieldexists('zh_jdgjb_seller','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `state` int(4) NOT NULL DEFAULT '1' COMMENT '1待审核,2通过，3拒绝'");}
if(!pdo_fieldexists('zh_jdgjb_seller','sq_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `sq_time` int(11) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('zh_jdgjb_seller','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','is_use')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `is_use` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_seller','ll_num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `ll_num` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','bd_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `bd_id` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','ye_open')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `ye_open` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_seller','wx_open')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `wx_open` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_seller','dd_open')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `dd_open` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_seller','cityName')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `cityName` varchar(30) NOT NULL COMMENT '城市名称'");}
if(!pdo_fieldexists('zh_jdgjb_seller','provinceName')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_seller')." ADD   `provinceName` varchar(30) NOT NULL COMMENT '省名称'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(100) NOT NULL COMMENT 'appid',
  `appsecret` varchar(200) NOT NULL COMMENT 'appsecret',
  `mchid` varchar(20) NOT NULL COMMENT '商户号',
  `wxkey` varchar(100) NOT NULL COMMENT '商户秘钥',
  `uniacid` varchar(50) NOT NULL,
  `jf_rule` text NOT NULL COMMENT '积分规则',
  `bq_name` varchar(50) NOT NULL COMMENT '版权名称',
  `link_name` varchar(30) NOT NULL COMMENT '网站名称',
  `link_logo` varchar(100) NOT NULL COMMENT '网站logo',
  `support` varchar(20) NOT NULL COMMENT '技术支持',
  `bq_logo` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL,
  `tz_appid` varchar(30) NOT NULL,
  `tz_name` varchar(30) NOT NULL,
  `pt_name` varchar(30) NOT NULL COMMENT '平台名称',
  `tel` varchar(20) NOT NULL COMMENT '平台电话',
  `total_num` int(11) NOT NULL COMMENT '访问量',
  `appkey` varchar(50) NOT NULL COMMENT '短信appkey',
  `tpl_id` varchar(20) NOT NULL COMMENT '短信模板id',
  `seller_id` int(11) NOT NULL COMMENT '默认门店ID',
  `apiclient_cert` text NOT NULL COMMENT '证书',
  `apiclient_key` text NOT NULL COMMENT '证书',
  `zd_money` decimal(10,2) NOT NULL COMMENT '最低提现金额',
  `tx_sxf` varchar(10) NOT NULL COMMENT '提现手续费',
  `rc_tk` text NOT NULL COMMENT '认筹条款',
  `tid1` varchar(50) NOT NULL COMMENT '报名成功通知模板id',
  `tx_notice` text NOT NULL COMMENT '提现须知',
  `type` int(4) NOT NULL DEFAULT '1' COMMENT '风格设置,1单店,2多店',
  `tx_mode` int(4) NOT NULL COMMENT '1手动打款,2自动打款',
  `is_sjrz` int(4) NOT NULL DEFAULT '1' COMMENT '商家入住1开通,2不开通',
  `client_ip` varchar(30) NOT NULL COMMENT 'IP地址',
  `rz_notice` text NOT NULL COMMENT '认证须知',
  `hy_rule` text NOT NULL COMMENT '会员规则',
  `bj_logo` varchar(100) NOT NULL COMMENT '首页背景logo',
  `map_key` varchar(50) NOT NULL COMMENT '地图key',
  `is_dxyz` int(4) NOT NULL DEFAULT '1' COMMENT '短信验证1开启,2关闭',
  `pl_score` int(11) NOT NULL COMMENT '评论积分',
  `xf_score` int(11) NOT NULL COMMENT '消费积分',
  `hy_img` varchar(100) NOT NULL,
  `rz_tid` varchar(50) NOT NULL,
  `open_member` int(4) NOT NULL DEFAULT '1',
  `jjrz_tid` varchar(50) NOT NULL,
  `is_sfz` int(4) NOT NULL DEFAULT '2',
  `tpl_id2` varchar(10) NOT NULL,
  `is_order` int(4) NOT NULL DEFAULT '2',
  `tid3` varchar(100) NOT NULL,
  `tid4` varchar(100) NOT NULL,
  `is_score` int(4) NOT NULL DEFAULT '1',
  `jd_custom` varchar(50) NOT NULL DEFAULT '查询酒店',
  `aliyun_appkey` varchar(50) NOT NULL,
  `aliyun_appsecret` varchar(50) NOT NULL,
  `aliyun_sign` varchar(50) NOT NULL,
  `aliyun_id` varchar(50) NOT NULL,
  `item` int(1) NOT NULL DEFAULT '1' COMMENT '1聚合,2阿里云',
  `aliyun_id2` varchar(50) NOT NULL,
  `openCity` int(1) NOT NULL DEFAULT '2' COMMENT '多城市，1开启，2关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_system','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_system','appid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `appid` varchar(100) NOT NULL COMMENT 'appid'");}
if(!pdo_fieldexists('zh_jdgjb_system','appsecret')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `appsecret` varchar(200) NOT NULL COMMENT 'appsecret'");}
if(!pdo_fieldexists('zh_jdgjb_system','mchid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `mchid` varchar(20) NOT NULL COMMENT '商户号'");}
if(!pdo_fieldexists('zh_jdgjb_system','wxkey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `wxkey` varchar(100) NOT NULL COMMENT '商户秘钥'");}
if(!pdo_fieldexists('zh_jdgjb_system','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','jf_rule')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `jf_rule` text NOT NULL COMMENT '积分规则'");}
if(!pdo_fieldexists('zh_jdgjb_system','bq_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `bq_name` varchar(50) NOT NULL COMMENT '版权名称'");}
if(!pdo_fieldexists('zh_jdgjb_system','link_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `link_name` varchar(30) NOT NULL COMMENT '网站名称'");}
if(!pdo_fieldexists('zh_jdgjb_system','link_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `link_logo` varchar(100) NOT NULL COMMENT '网站logo'");}
if(!pdo_fieldexists('zh_jdgjb_system','support')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `support` varchar(20) NOT NULL COMMENT '技术支持'");}
if(!pdo_fieldexists('zh_jdgjb_system','bq_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `bq_logo` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','color')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `color` varchar(20) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','tz_appid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tz_appid` varchar(30) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','tz_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tz_name` varchar(30) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','pt_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `pt_name` varchar(30) NOT NULL COMMENT '平台名称'");}
if(!pdo_fieldexists('zh_jdgjb_system','tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tel` varchar(20) NOT NULL COMMENT '平台电话'");}
if(!pdo_fieldexists('zh_jdgjb_system','total_num')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `total_num` int(11) NOT NULL COMMENT '访问量'");}
if(!pdo_fieldexists('zh_jdgjb_system','appkey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `appkey` varchar(50) NOT NULL COMMENT '短信appkey'");}
if(!pdo_fieldexists('zh_jdgjb_system','tpl_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tpl_id` varchar(20) NOT NULL COMMENT '短信模板id'");}
if(!pdo_fieldexists('zh_jdgjb_system','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `seller_id` int(11) NOT NULL COMMENT '默认门店ID'");}
if(!pdo_fieldexists('zh_jdgjb_system','apiclient_cert')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `apiclient_cert` text NOT NULL COMMENT '证书'");}
if(!pdo_fieldexists('zh_jdgjb_system','apiclient_key')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `apiclient_key` text NOT NULL COMMENT '证书'");}
if(!pdo_fieldexists('zh_jdgjb_system','zd_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `zd_money` decimal(10,2) NOT NULL COMMENT '最低提现金额'");}
if(!pdo_fieldexists('zh_jdgjb_system','tx_sxf')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tx_sxf` varchar(10) NOT NULL COMMENT '提现手续费'");}
if(!pdo_fieldexists('zh_jdgjb_system','rc_tk')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `rc_tk` text NOT NULL COMMENT '认筹条款'");}
if(!pdo_fieldexists('zh_jdgjb_system','tid1')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tid1` varchar(50) NOT NULL COMMENT '报名成功通知模板id'");}
if(!pdo_fieldexists('zh_jdgjb_system','tx_notice')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tx_notice` text NOT NULL COMMENT '提现须知'");}
if(!pdo_fieldexists('zh_jdgjb_system','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `type` int(4) NOT NULL DEFAULT '1' COMMENT '风格设置,1单店,2多店'");}
if(!pdo_fieldexists('zh_jdgjb_system','tx_mode')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tx_mode` int(4) NOT NULL COMMENT '1手动打款,2自动打款'");}
if(!pdo_fieldexists('zh_jdgjb_system','is_sjrz')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `is_sjrz` int(4) NOT NULL DEFAULT '1' COMMENT '商家入住1开通,2不开通'");}
if(!pdo_fieldexists('zh_jdgjb_system','client_ip')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `client_ip` varchar(30) NOT NULL COMMENT 'IP地址'");}
if(!pdo_fieldexists('zh_jdgjb_system','rz_notice')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `rz_notice` text NOT NULL COMMENT '认证须知'");}
if(!pdo_fieldexists('zh_jdgjb_system','hy_rule')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `hy_rule` text NOT NULL COMMENT '会员规则'");}
if(!pdo_fieldexists('zh_jdgjb_system','bj_logo')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `bj_logo` varchar(100) NOT NULL COMMENT '首页背景logo'");}
if(!pdo_fieldexists('zh_jdgjb_system','map_key')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `map_key` varchar(50) NOT NULL COMMENT '地图key'");}
if(!pdo_fieldexists('zh_jdgjb_system','is_dxyz')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `is_dxyz` int(4) NOT NULL DEFAULT '1' COMMENT '短信验证1开启,2关闭'");}
if(!pdo_fieldexists('zh_jdgjb_system','pl_score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `pl_score` int(11) NOT NULL COMMENT '评论积分'");}
if(!pdo_fieldexists('zh_jdgjb_system','xf_score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `xf_score` int(11) NOT NULL COMMENT '消费积分'");}
if(!pdo_fieldexists('zh_jdgjb_system','hy_img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `hy_img` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','rz_tid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `rz_tid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','open_member')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `open_member` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_system','jjrz_tid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `jjrz_tid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','is_sfz')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `is_sfz` int(4) NOT NULL DEFAULT '2'");}
if(!pdo_fieldexists('zh_jdgjb_system','tpl_id2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tpl_id2` varchar(10) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','is_order')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `is_order` int(4) NOT NULL DEFAULT '2'");}
if(!pdo_fieldexists('zh_jdgjb_system','tid3')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tid3` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','tid4')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `tid4` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','is_score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `is_score` int(4) NOT NULL DEFAULT '1'");}
if(!pdo_fieldexists('zh_jdgjb_system','jd_custom')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `jd_custom` varchar(50) NOT NULL DEFAULT '查询酒店'");}
if(!pdo_fieldexists('zh_jdgjb_system','aliyun_appkey')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `aliyun_appkey` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','aliyun_appsecret')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `aliyun_appsecret` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','aliyun_sign')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `aliyun_sign` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','aliyun_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `aliyun_id` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','item')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `item` int(1) NOT NULL DEFAULT '1' COMMENT '1聚合,2阿里云'");}
if(!pdo_fieldexists('zh_jdgjb_system','aliyun_id2')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `aliyun_id2` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_system','openCity')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_system')." ADD   `openCity` int(1) NOT NULL DEFAULT '2' COMMENT '多城市，1开启，2关闭'");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `join_time` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `openid` varchar(200) NOT NULL,
  `uniacid` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL COMMENT '手机号',
  `type` int(4) NOT NULL DEFAULT '1' COMMENT '1不是会员,2是会员',
  `level_id` int(11) NOT NULL COMMENT '会员等级id',
  `score` int(11) NOT NULL COMMENT '积分',
  `zs_name` varchar(20) NOT NULL COMMENT '真是姓名',
  `number` varchar(30) NOT NULL COMMENT '会员卡号',
  `commission` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `dj_money` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_user','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_user','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `name` varchar(100) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','join_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `join_time` int(11) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','img')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `img` varchar(500) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','openid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `openid` varchar(200) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `uniacid` varchar(50) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','tel')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `tel` varchar(20) NOT NULL COMMENT '手机号'");}
if(!pdo_fieldexists('zh_jdgjb_user','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `type` int(4) NOT NULL DEFAULT '1' COMMENT '1不是会员,2是会员'");}
if(!pdo_fieldexists('zh_jdgjb_user','level_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `level_id` int(11) NOT NULL COMMENT '会员等级id'");}
if(!pdo_fieldexists('zh_jdgjb_user','score')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `score` int(11) NOT NULL COMMENT '积分'");}
if(!pdo_fieldexists('zh_jdgjb_user','zs_name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `zs_name` varchar(20) NOT NULL COMMENT '真是姓名'");}
if(!pdo_fieldexists('zh_jdgjb_user','number')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `number` varchar(30) NOT NULL COMMENT '会员卡号'");}
if(!pdo_fieldexists('zh_jdgjb_user','commission')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `commission` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','balance')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `balance` decimal(10,2) NOT NULL");}
if(!pdo_fieldexists('zh_jdgjb_user','dj_money')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_user')." ADD   `dj_money` decimal(10,2) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_usercoupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `coupons_id` int(11) NOT NULL COMMENT '优惠券id',
  `state` int(11) NOT NULL COMMENT '1领取, 2使用',
  `time` int(11) NOT NULL COMMENT '领取时间',
  `sy_time` int(11) NOT NULL COMMENT '使用时间',
  `uniacid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_usercoupons','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','user_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `user_id` int(11) NOT NULL COMMENT '用户id'");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','coupons_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `coupons_id` int(11) NOT NULL COMMENT '优惠券id'");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `state` int(11) NOT NULL COMMENT '1领取, 2使用'");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `time` int(11) NOT NULL COMMENT '领取时间'");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','sy_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `sy_time` int(11) NOT NULL COMMENT '使用时间'");}
if(!pdo_fieldexists('zh_jdgjb_usercoupons','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_usercoupons')." ADD   `uniacid` varchar(50) NOT NULL");}
pdo_query("CREATE TABLE IF NOT EXISTS `ims_zh_jdgjb_withdrawal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL COMMENT '真实姓名',
  `username` varchar(100) NOT NULL COMMENT '账号',
  `type` int(11) NOT NULL COMMENT '1支付宝 2.微信 3.银行',
  `time` varchar(20) NOT NULL COMMENT '申请时间',
  `sh_time` varchar(20) NOT NULL COMMENT '审核时间',
  `state` int(11) NOT NULL COMMENT '1.待审核 2.通过  3.拒绝',
  `tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额',
  `sj_cost` decimal(10,2) NOT NULL COMMENT '实际金额',
  `seller_id` int(11) NOT NULL COMMENT '商家id',
  `is_delete` int(4) NOT NULL DEFAULT '1' COMMENT '1显示,2删除',
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

if(!pdo_fieldexists('zh_jdgjb_withdrawal','id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD 
  `id` int(11) NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','name')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `name` varchar(10) NOT NULL COMMENT '真实姓名'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','username')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `username` varchar(100) NOT NULL COMMENT '账号'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','type')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `type` int(11) NOT NULL COMMENT '1支付宝 2.微信 3.银行'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `time` varchar(20) NOT NULL COMMENT '申请时间'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','sh_time')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `sh_time` varchar(20) NOT NULL COMMENT '审核时间'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','state')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `state` int(11) NOT NULL COMMENT '1.待审核 2.通过  3.拒绝'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','tx_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','sj_cost')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `sj_cost` decimal(10,2) NOT NULL COMMENT '实际金额'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','seller_id')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `seller_id` int(11) NOT NULL COMMENT '商家id'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','is_delete')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `is_delete` int(4) NOT NULL DEFAULT '1' COMMENT '1显示,2删除'");}
if(!pdo_fieldexists('zh_jdgjb_withdrawal','uniacid')) {pdo_query("ALTER TABLE ".tablename('zh_jdgjb_withdrawal')." ADD   `uniacid` int(11) NOT NULL");}

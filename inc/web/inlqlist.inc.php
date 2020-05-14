<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$data[':uniacid']=$_W['uniacid'];
$data[':id']=$_GPC['id'];
$sql=" select c.name, b.name as nick_name ,b.img,a.time,a.state from ".tablename('zh_jdgjb_usercoupons')." a left join " . tablename("zh_jdgjb_user") . " b on a.user_id=b.id"."  left join " . tablename("zh_jdgjb_coupons")." c on a.coupons_id=c.id where a.uniacid=:uniacid and a.coupons_id=:id order by a.time desc";
$total=pdo_fetchcolumn("select count(*) from ".tablename('zh_jdgjb_usercoupons')." a left join " . tablename("zh_jdgjb_user") . " b on a.user_id=b.id"."  left join " . tablename("zh_jdgjb_coupons")." c on a.coupons_id=c.id where a.uniacid=:uniacid and a.coupons_id=:id",$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);

$pager = pagination($total, $pageindex, $pagesize);

include $this->template('web/inlqlist');
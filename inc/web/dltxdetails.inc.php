<?php
global $_GPC, $_W;
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$cur_store = $this->getStoreById($seller_id);
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$type=empty($_GPC['type']) ? 'now' :$_GPC['type'];

$state=empty($_GPC['state']) ? '2' :$_GPC['state'];
$where=' WHERE  uniacid=:uniacid and seller_id=:seller_id and is_delete=1';
$data[':uniacid']=$_W['uniacid'];
$data[':seller_id']=$seller_id;
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
if($type !='all'){
	$where.=" and state=$state ";
}

$sql="SELECT * FROM ".tablename('zh_jdgjb_withdrawal') .  $where." ORDER BY time DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_jdgjb_withdrawal') .  $where." ORDER BY time DESC",$data);

$list=pdo_fetchall( $sql,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
include $this->template('web/dltxdetails');
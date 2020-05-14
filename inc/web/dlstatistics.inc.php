<?php
global $_GPC, $_W;

if($_GPC['id']){
setcookie("storeid",$_GPC['id']);
$seller_id=$_GPC['id'];
}else{
	$seller_id=$_COOKIE["storeid"];
}
if($_GPC['uid']){
setcookie("uid",$_GPC['uid']);
$uid=$_GPC['uid'];
}else{
	$uid=$_COOKIE["uid"];
}
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$cur_store = $this->getStoreById($seller_id);
$time=strtotime(date("Y-m-d"));
$mttime=strtotime(date("Y-m-d",strtotime("+1 day")));
$zttime=strtotime(date("Y-m-d",strtotime("-1 day")));
$week=strtotime(date("Y-m-d",strtotime("-7 day")));

//今日新增(房间)
$sql3=" select sum(total_cost) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$time." and time<".$mttime."";
$total=pdo_fetch($sql3,array('uniacid'=>$_W['uniacid']));

//今日已退押金
$sql5=" select sum(ytyj_cost) as ytyj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$time." and time<".$mttime."";

$ytyj=pdo_fetch($sql5,array('uniacid'=>$_W['uniacid']));

//今日销售额
$jrmoney=$total['total']-$ytyj['ytyj'];


//昨日新增(房间)
$sql6=" select sum(total_cost) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$zttime." and time<".$time."";
$zrtotal=pdo_fetch($sql6,array('uniacid'=>$_W['uniacid']));

//昨日已退押金
$sql7=" select sum(ytyj_cost) as ytyj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$zttime." and time<".$time."";

$zrytyj=pdo_fetch($sql7,array('uniacid'=>$_W['uniacid']));

//昨日销售额
$zrmoney=$zrtotal['total']-$zrytyj['ytyj'];

//一周新增(房间)
$sql8=" select sum(total_cost) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$week." and time<".$mttime."";
//echo $sql8;die;
$weektotal=pdo_fetch($sql8,array('uniacid'=>$_W['uniacid']));

//一周已退押金
$sql9=" select sum(ytyj_cost) as ytyj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$week." and time<".$mttime."";

$weekytyj=pdo_fetch($sql9,array('uniacid'=>$_W['uniacid']));

 //一周销售额
$weekmoney=$weektotal['total']-$weekytyj['ytyj'];

//今日订单总数
$sql26=" select count(id) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id  and  time>=".$time." and time<".$mttime."";
$jrorder=pdo_fetch($sql26,array('uniacid'=>$_W['uniacid'],':seller_id'=>$seller_id));


//订单统计

$sql2="select count(*) as total,count(case when status=3 then 1 end) as yqx,count( case when status=5 then 1 end) as yrz, count( case when status=4 then 1 end) as ywc, count( case when status=7 then 1 end) as ytk from  ".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id ";

$order=pdo_fetch($sql2,array('uniacid'=>$_W['uniacid'],':seller_id'=>$seller_id));

//房间剩余数量
$sql10=" select id from".tablename('zh_jdgjb_room')."where uniacid=:uniacid and seller_id=:seller_id";
$room=pdo_fetchall($sql10,array('uniacid'=>$_W['uniacid'],'seller_id'=>$seller_id));

$nums=array();
foreach ($room as $key => $value) {
	$res1=pdo_get('zh_jdgjb_roomnum',array('rid'=>$value['id'],'dateday'=>$time));
	if($res1['id']){
		$nums[$key]=$res1['nums'];
	}else{
			$mnums=pdo_getcolumn('zh_jdgjb_room',array('id'=>$value['id']),'total_num');
			$nums[$key]=$mnums;
		}
}
$total_nums=array_sum($nums);

//今日入住数量
$rznums=pdo_get('zh_jdgjb_order',array('seller_id'=>$seller_id,'status'=>5),array('sum(num) as sl'));

$account=pdo_get('zh_jdgjb_account',array('storeid'=>$seller_id,'uid'=>$uid));
$arr=explode(',',$account['authority']);
$type=false;
if(in_array('dlstatistics',$arr)){
	$type=true;
}

$users = user_single($account['uid']);


if($account['role']==2 && !$type){
	include $this->template('web/dlhotel');
}
if($account['role']==1 or $type){
	include $this->template('web/dlstatistics');
}


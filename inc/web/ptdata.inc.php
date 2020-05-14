<?php
global $_GPC, $_W;
//echo  trim(strrchr($_W['referer'], '='),'=');die;
$GLOBALS['frames'] = $this->getMainMenu();
if($_GPC['time']){
	$time=strtotime($_GPC['time']['start']);
    $mttime=strtotime($_GPC['time']['end']);
}else{
	$time=strtotime(date("Y-m-d"));
	$mttime=strtotime(date("Y-m-d",strtotime("+1 day")));
}
$zttime=date("Y-m-d",strtotime("-1 day"));
$zttime="'%$zttime%'";

//酒店入住统计
$sql="select count(*) as total,count(case when state=1 then 1 end) as dsh,count( case when state=2 then 1 end) as yrz, count( case when state=3 then 1 end) as yjj from  ".tablename('zh_jdgjb_seller')." where uniacid=:uniacid and owner=2 and  sq_time>=".$time." and sq_time<".$mttime."";

$seller=pdo_fetch($sql,array('uniacid'=>$_W['uniacid']));


//订单统计

$sql2="select count(*) as total,count(case when status=3 then 1 end) as yqx,count( case when status=5 then 1 end) as yrz, count( case when status=4 then 1 end) as ywc, count( case when status=7 then 1 end) as ytk from  ".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and  time>=".$time." and time<".$mttime."";

$order=pdo_fetch($sql2,array('uniacid'=>$_W['uniacid']));


//今日新增储蓄值
$sql3=" select sum(total_cost) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$time." and time<".$mttime."";
$total=pdo_fetch($sql3,array('uniacid'=>$_W['uniacid']));

// //今日新增(押金)
// $sql4=" select sum('yj_cost') as yj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$time." and time<".$mttime."";

// $yj=pdo_fetch($sql4,array('uniacid'=>$_W['uniacid']));


/*//今日已退(押金)
$sql5=" select sum(ytyj_cost) as ytyj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) and  time>=".$time." and time<".$mttime."";

$ytyj=pdo_fetch($sql5,array('uniacid'=>$_W['uniacid']));*/

//今日新增money
$money=$total['total'];
//今日新增退款
//房价退款
$sql6=" select sum(dis_cost) as fjtk from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status=7 and  time>=".$time." and time<".$mttime."";
$fjtk=pdo_fetch($sql6,array('uniacid'=>$_W['uniacid']));

//押金退款
$sql7=$sql6=" select sum(ytyj_cost) as ytyj from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status not in (1,3,7) and  time>=".$time." and time<".$mttime."";
$ytyj=pdo_fetch($sql7,array('uniacid'=>$_W['uniacid']));

$tkmoney=$fjtk['fjtk']+$ytyj['ytyj'];





//会员统计


$time2=date("Y-m-d");
$time3=date("Y-m-d",strtotime("-1 day"));
$time4=date("Y-m");
//会员总数
$totalhy=pdo_get('zh_jdgjb_user', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//今日新增会员
$sql=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time2}%' ";
$jr=count(pdo_fetchall($sql));
//昨日新增
$sql2=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time3}%' ";
$zuor=count(pdo_fetchall($sql2));
//本月新增
$sql3=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time4}%' ";
$beny=count(pdo_fetchall($sql3));

//酒店总数
$totalSeller=pdo_get('zh_jdgjb_seller', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//有效订单
$sql11=" select count(id) as yx  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (2,4,5,6,8) ";
$yx=pdo_fetch($sql11,array('uniacid'=>$_W['uniacid']));
//无效订单
$sql12=" select count(id) as wx from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and status in (1,3,7) ";
$wx=pdo_fetch($sql12,array('uniacid'=>$_W['uniacid']));



include $this->template('web/ptdata');
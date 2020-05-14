<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();

//会员信息
$time=date("Y-m-d");
$time2=date("Y-m-d",strtotime("-1 day"));
$time3=date("Y-m");
//会员总数
$totalhy=pdo_get('zh_gjhdbm_user', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//今日新增会员
$sql=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_gjhdbm_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time}%' ";
$jir=count(pdo_fetchall($sql));
//昨日新增
$sql2=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_gjhdbm_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time2}%' ";
$zuor=count(pdo_fetchall($sql2));
//本月新增
$sql3=" select a.* from (select  id,FROM_UNIXTIME(join_time) as time  from".tablename('zh_gjhdbm_user')." where uniacid={$_W['uniacid']}) a where time like '%{$time3}%' ";
$beny=count(pdo_fetchall($sql3));
//活动一览
//活动总数
$goodstotal=pdo_get('zh_gjhdbm_activity', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//新增总数
$sql4=" select a.* from (select  id,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_activity')." where uniacid={$_W['uniacid']}) a where time like '%{$time}%' ";
$jrgoods=count(pdo_fetchall($sql4));
//新增票卷
$sql21=" select a.* from (select  id,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_bmlist')." where uniacid={$_W['uniacid']} and status=1) a where time like '%{$time}%' ";
$totalorder=count(pdo_fetchall($sql21));
//$totalorder=pdo_get('zhtc_order', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//票卷总数
$sql=" select count(id) as count from".tablename('zh_gjhdbm_bmlist')." where uniacid={$_W['uniacid']} and status=1 and state!=5 and state!=6";
$dfhorder=pdo_fetch($sql);


//活动待审核数量
$tztotal=pdo_get('zh_gjhdbm_activity', array('uniacid'=>$_W['uniacid'],'status'=>1), array('count(id) as count'));
//活动数量
$shtotal=pdo_get('zh_gjhdbm_activity', array('uniacid'=>$_W['uniacid'],'status'=>2), array('count(id) as count'));
//主办方数量
$pctotal=pdo_get('zh_gjhdbm_sponsor', array('uniacid'=>$_W['uniacid']), array('count(id) as count'));
//认证审核数量
$hytotal=pdo_get('zh_gjhdbm_attestation', array('uniacid'=>$_W['uniacid'],'state'=>1), array('count(id) as count'));
//认证数量
$zxtotal=pdo_get('zh_gjhdbm_attestation', array('uniacid'=>$_W['uniacid'],'state'=>2), array('count(id) as count'));
//票卷审核数量
$shpj_num=pdo_get('zh_gjhdbm_bmlist', array('uniacid'=>$_W['uniacid'],'state'=>1,'status'=>1), array('count(id) as count'));
//票卷数量
$sql22=" select count(*) as count from".tablename('zh_gjhdbm_bmlist')."where uniacid={$_W['uniacid']} and state in (2,3,4) and status=1";
$pj_num=pdo_fetch($sql22);
//$pj_num=pdo_get('zh_gjhdbm_bmlist', array('uniacid'=>$_W['uniacid'],'state'=>2,'state'=>3,'state'=>4), array('count(id) as count'));

//数据概况

//今日销售金额
//今日票卷销售金额
$sql7=" select  sum(a.money) as ordermoney from (select  id,money,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_bmlist')." where uniacid={$_W['uniacid']} and state in (1,2,3,4) and status=1) a  where time like '%{$time}%' ";
$ordermoney=pdo_fetch($sql7);
$ordermoney['ordermoney']=empty($ordermoney['ordermoney'])?0:$ordermoney['ordermoney'];
//今日新增活动
$sql8=" select  count(id) as count from (select  id,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_activity')." where uniacid={$_W['uniacid']} ) a  where time like '%{$time}%' ";
$jrxzhb=pdo_fetch($sql8);  
//今日新增主办方
$sql9=" select  count(id) as count from (select  id,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_sponsor')." where uniacid={$_W['uniacid']} ) a  where time like '%{$time}%' ";
$jrzzzbf=pdo_fetch($sql9); 
//今日新增票卷
$sql10=" select count(id) as count from (select  id,FROM_UNIXTIME(time) as time  from".tablename('zh_gjhdbm_bmlist')." where uniacid={$_W['uniacid']} and status=1) a where time like '%{$time}%' ";
$jrxzpj=pdo_fetch($sql10); 


include $this->template('web/index');
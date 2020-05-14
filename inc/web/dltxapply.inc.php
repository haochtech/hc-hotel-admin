<?php
global $_GPC, $_W;
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$cur_store = $this->getStoreById($seller_id);
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$data2[':seller_id']=$seller_id;
$data2[':uniacid']=$_W['uniacid'];
$system=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
  //总营业额
      $totalsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (4,5,8) and type!=3";
      $totalmoney=pdo_fetch($totalsql,$data2);
$sql2 = "select sum(tx_cost) as total from " . tablename("zh_jdgjb_withdrawal")." WHERE  seller_id=:seller_id and state in (1,2) and uniacid=:uniacid ";
$total2 = pdo_fetch($sql2,$data2);//已提现金额
$ktxcost=$totalmoney['total_money']-$totalmoney['yj_money']-$total2['total'];
//$ktxcost=number_format($ktxcost-($ktxcost*($system['tx_sxf']/100)),2, ".", "");
if(checksubmit('submit')){
  if($_GPC['tx_cost']>$ktxcost){
message('提现金额不能超过账户可提现金额','','error');
  }
  if($_GPC['tx_cost']<$system['tx_money']){
message('提现金额小于最低提现金额','','error');
  }
  $data['sj_cost']=number_format($_GPC['tx_cost']-($_GPC['tx_cost']*($system['tx_sxf']/100)),2, ".", "");
  $data['seller_id']=$seller_id;
  $data['name']=$_GPC['name'];
  $data['username']=$_GPC['username'];
  $data['state']=1;
  $data['tx_cost']=$_GPC['tx_cost'];
  $data['uniacid']=$_W['uniacid'];
  $data['time']=date("Y-m-d H:i:s");
  $res=pdo_insert('zh_jdgjb_withdrawal',$data);
 if($res){
        message('提交成功',$this->createWebUrl2('dltxapply',array()),'success');
    }else{
        message('提交失败','','error');
    }


}
include $this->template('web/dltxapply');
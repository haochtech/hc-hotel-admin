<?php
global $_GPC, $_W;
// $action = 'ad';
// $title = $this->actions_titles[$action];
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$sys=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']),'is_order');
$list=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']));
if(checksubmit('submit2')){
		$res=pdo_update('zhjd_order',array('online_price'=>$_GPC['newcost']),array('id'=>$_GPC['id']));
		if($res){
			message('编辑成功',$this->createWebUrl('ddgl',array()),'success');
		}else{
			message('编辑失败','','error');
		}
	}
//$newcost=$list['dis_cost']-$list['ytyj_cost'];
include $this->template('web/inorderinfo');
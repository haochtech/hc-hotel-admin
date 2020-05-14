<?php

global $_GPC, $_W;
load()->func('tpl');
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$cur_store = $this->getStoreById($seller_id);
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$sql="select a.* ,b.name from " . tablename("zh_jdgjb_assess") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id where a.uniacid=:uniacid and a.id=:id";
$list=pdo_fetch($sql, array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']));
if (checksubmit('submit')) {
	$data['content']=$_GPC['content'];
	$data['reply']=$_GPC['reply'];
	$res=pdo_update("zh_jdgjb_assess",$data,array('id'=>$_GPC['id']));
	if($res){
			message('修改成功',$this->createWebUrl2('dlassess',array()),'success');
		}else{
			message('修改失败','','error');
		}
}
include $this->template('web/dlassessinfo');
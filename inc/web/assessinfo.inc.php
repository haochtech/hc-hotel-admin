<?php

global $_GPC, $_W;

load()->func('tpl');

$storeid=$_COOKIE["storeid"];

$cur_store = $this->getStoreById($storeid);

$GLOBALS['frames'] = $this->getMainMenu2($storeid,$action);



$sql="select a.* ,b.name from " . tablename("zh_jdgjb_assess") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id where a.uniacid=:uniacid and a.id=:id";

$list=pdo_fetch($sql, array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']));

if (checksubmit('submit')) {

	$data['content']=$_GPC['content'];

	$data['reply']=$_GPC['reply'];

	$res=pdo_update("zh_jdgjb_assess",$data,array('id'=>$_GPC['id']));

	if($res){

			message('修改成功',$this->createWebUrl('assess',array()),'success');

		}else{

			message('修改失败','','error');

		}

}

include $this->template('web/assessinfo');
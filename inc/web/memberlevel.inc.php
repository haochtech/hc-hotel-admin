<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$list=pdo_getall('zh_jdgjb_level',array('uniacid'=>$_W['uniacid']),array() , '' , 'orderby ASC');
if($_GPC['id']){
	$res=pdo_delete('zh_jdgjb_level',array('id'=>$_GPC['id']));
	if($res){
		message('删除成功',$this->createWebUrl('memberlevel',array()),'success');
	}else{
		message('删除失败','','error');
	}
}
include $this->template('web/memberlevel');
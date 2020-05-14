<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$sql="SELECT * FROM ".tablename('zh_jdgjb_seller')."  where id=:id ";
$item=pdo_fetch($sql,array(':id'=>$_GPC['id']));
if(checksubmit('submit')){   
	$data['name']=$_GPC['name'];     
	$data['link_name']=$_GPC['link_name'];
	$data['link_tel']=$_GPC['link_tel'];
	$data['state']=$_GPC['state'];
	$data['other']=html_entity_decode($_GPC['other']);
	$rst=pdo_update('zh_jdgjb_seller',$data,array('id'=>$_GPC['id']));
	if($rst){
	     message('编辑成功！', $this->createWebUrl('auditorhotel'), 'success');
	}else{
	     message('编辑失败！','','error');
	}

}

include $this->template('web/auditorhotelinfo');
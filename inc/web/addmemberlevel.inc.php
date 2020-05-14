<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$list = pdo_get('zh_jdgjb_level',array('uniacid' => $_W['uniacid'],'id'=>$_GPC['id']));
if(checksubmit('submit')){
	$data['name']=$_GPC['name'];
	$data['uniacid']=$_W['uniacid'];
	$data['icon']=$_GPC['icon'];
	$data['value']=$_GPC['value'];
	$data['orderby']=$_GPC['orderby'];	
	$data['discount']=$_GPC['discount'];
	$data['content']=html_entity_decode($_GPC['content']);
	if($_GPC['id']==''){		
		$res=pdo_insert('zh_jdgjb_level',$data);
		if($res){
			message('添加成功',$this->createWebUrl('memberlevel',array()),'success');
		}else{
			message('添加失败','','error');
		}
	}else{			
		$res = pdo_update('zh_jdgjb_level', $data, array('id' => $_GPC['id']));
		if($res){
			message('编辑成功',$this->createWebUrl('memberlevel',array()),'success');
		}else{
			message('编辑失败','','error');
		}
	}
}
include $this->template('web/addmemberlevel');
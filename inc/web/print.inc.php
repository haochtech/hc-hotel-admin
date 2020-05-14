<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$item = pdo_get('zh_jdgjb_dyj',array('seller_id'=>$seller_id,'uniacid'=>$_W['uniacid']));
if(checksubmit('submit')){		
	$data['name']=$_GPC['name'];
	$data['dyj_title']=$_GPC['dyj_title'];
	$data['dyj_id']=$_GPC['dyj_id'];
	$data['dyj_key']=$_GPC['dyj_key'];
	$data['type']=$_GPC['type'];
	$data['mid']=$_GPC['mid'];
	$data['token']=$_GPC['token2'];
	$data['api']=$_GPC['api'];
	$data['uniacid']=$_W['uniacid'];
	$data['state']=$_GPC['state'];
	$data['yy_id']=$_GPC['yy_id'];
	$data['seller_id']=$seller_id;
	$data['fezh']=$_GPC['fezh'];
	$data['fe_ukey']=$_GPC['fe_ukey'];
	$data['fe_dycode']=$_GPC['fe_dycode'];
	if($_GPC['id']==''){
		$res=pdo_insert('zh_jdgjb_dyj',$data);
		if($res){
			message('添加成功',$this->createWebUrl('print',array()),'success');
		}else{
			message('添加失败','','error');
		}
	}else{
		$res = pdo_update('zh_jdgjb_dyj', $data, array('id' => $_GPC['id']));
		if($res){
			message('编辑成功',$this->createWebUrl('print',array()),'success');
		}else{
			message('编辑失败','','error');
		}
	}
}
include $this->template('web/print');
<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$sql="select a.*,b.img from".tablename('zh_jdgjb_distribution')." a left join ".tablename('zh_jdgjb_user')." b on a.user_id=b.id where a.id=:id";
$info = pdo_fetch($sql,array(':id'=>$_GPC['id']));
//查找上级分销商
$sj=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$info['user_id']),'user_id');
$user=pdo_getall('zh_jdgjb_distribution',array('uniacid'=>$_W['uniacid'],'user_id !='=>$info['user_id']));
if(checksubmit('submit')){
	$data['user_name']=$_GPC['user_name'];    
	$data['user_tel']=$_GPC['user_tel']; 
	$data['state']=$_GPC['state'];    
	$data['uniacid']=$_W['uniacid'];
	$res = pdo_update('zh_jdgjb_distribution', $data, array('id' => $_GPC['id']));
	$sj=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$info['user_id']),'user_id');
	if($sj){
		$rst=pdo_update('zh_jdgjb_fxuser',array('user_id'=>$_GPC['user_id']),array('fx_user'=>$info['user_id']));
	}else{
		$rst=pdo_insert('zh_jdgjb_fxuser',array('user_id'=>$_GPC['user_id'],'fx_user'=>$info['user_id']));
	}
	if($res or $rst ){
		message('编辑成功',$this->createWebUrl('fxlist',array()),'success');
	}else{
		message('编辑失败','','error');
	}

}
include $this->template('web/fxinfo');
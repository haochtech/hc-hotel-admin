<?php

global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$id=trim($_GPC['pid']);
$data['dateday']=strtotime(trim($_GPC['dateday']));
$data['nums']=trim($_GPC['nums']);
$data['rid']=trim($_GPC['rid']);
//var_dump($data);die;
$res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$data['rid'],'dateday'=>$data['dateday']));
if(!$res['id']){
	pdo_insert('zh_jdgjb_roomnum',$data);
}else{
	pdo_update('zh_jdgjb_roomnum',array('nums'=>$data['nums']),array('id'=>$res['id']));
}


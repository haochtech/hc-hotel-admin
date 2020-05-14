<?php
//管理房型
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$data[':uniacid']=$_W['uniacid'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=' WHERE  uniacid=:uniacid and seller_id=:seller_id';
if($_GPC['keywords']){
	$where.=" and name LIKE  concat('%', :name,'%') ";	
	$data[':name']=$_GPC['keywords'];
}	
$data[':seller_id']=$seller_id;
$sql="select * from " . tablename("zh_jdgjb_room").$where." ORDER BY sort asc";
$total=pdo_fetchcolumn("select count(*) from " . tablename("zh_jdgjb_room").$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($operation=='delete'){
	$id=$_GPC['id'];
	$result = pdo_delete('zh_jdgjb_room', array('id'=>$id));
	if($result){
		message('删除成功',$this->createWebUrl('room',array()),'success');
	}else{
		message('删除失败','','error');
	}
}

include $this->template('web/room');
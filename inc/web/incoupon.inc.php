<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$seller_id=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($seller_id);
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=' WHERE  uniacid=:uniacid and type=2 and seller_id=:seller_id';
if($_GPC['keywords']){
	$where.=" and name LIKE  concat('%', :name,'%') ";	
	$data[':name']=$_GPC['keywords'];
}
$data[':uniacid']=$_W['uniacid'];
$data[':seller_id']=$seller_id;
$sql="SELECT *  FROM ".tablename('zh_jdgjb_coupons').$where." order by id desc";
$total=pdo_fetchcolumn("SELECT count(*)  FROM ".tablename('zh_jdgjb_coupons').$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);

if($_GPC['id']){
	$res=pdo_delete('zh_jdgjb_coupons',array('id'=>$_GPC['id']));
	if($res){
		message('删除成功',$this->createWebUrl('incoupon',array()),'success');
	}else{
		message('删除失败','','error');
	}
}
include $this->template('web/incoupon');
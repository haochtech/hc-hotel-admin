<?php
global $_GPC, $_W;

$GLOBALS['frames'] = $this->getMainMenu();
 $pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=" where activity_id=:activity_id ";
$data[':activity_id']=$_GPC['id'];
$sql="SELECT * FROM ".tablename('zh_gjhdbm_ticket') . $where." ORDER BY id DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_gjhdbm_ticket') . $where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
	$id=$_GPC['id'];

	$res=pdo_delete('zh_gjhdbm_ticket',array('id'=>$id));
	if($res){
		message('删除成功',$this->createWebUrl('hdpjlist',array('id'=>$_GPC['activity_id'])),'success');
	}else{
		message('删除失败','','error');
	}
}
include $this->template('web/hdpjlist');

<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=" where a.uniacid=:uniacid";
$data[':uniacid']=$_W['uniacid'];
if($_GPC['keywords']){  
	$where.=" and a.name LIKE  concat('%', :name,'%') ";   
	$data[':name']=$_GPC['keywords'];
}
$sql="select a.* ,b.name as level_name from " . tablename("zh_jdgjb_user") .  " a"  . " left join " . tablename("zh_jdgjb_level") . " b on a.level_id=b.id". $where ." order by id desc";
$total=pdo_fetchcolumn("select count(*)  from " . tablename("zh_jdgjb_user").  " a"  . " left join " . tablename("zh_jdgjb_level") . " b on a.level_id=b.id" .$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
$res4=pdo_delete("zh_jdgjb_user",array('id'=>$_GPC['id']));
if($res4){
	message('删除成功！', $this->createWebUrl('user2'), 'success');
	}else{
		message('删除失败！','','error');
	}
}
include $this->template('web/user2');


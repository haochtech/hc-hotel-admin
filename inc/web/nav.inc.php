<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$sql="select * from".tablename('zh_jdgjb_nav')." where uniacid={$_W['uniacid']} ORDER BY orderby ASC";
$total=pdo_fetchcolumn("select count(*) from".tablename('zh_jdgjb_nav')." where uniacid={$_W['uniacid']} ");
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql);
$pager = pagination($total, $pageindex, $pagesize);
//$list=pdo_getall('zhtc_nav',array('uniacid'=>$_W['uniacid']),array(),'','orderby ASC');
if($_GPC['op']=='delete'){
	$res=pdo_delete('zh_jdgjb_nav',array('id'=>$_GPC['id']));
	if($res){
		 message('删除成功！', $this->createWebUrl('nav'), 'success');
		}else{
			  message('删除失败！','','error');
		}
}
if($_GPC['status']){
	$data['status']=$_GPC['status'];
	$res=pdo_update('zh_jdgjb_nav',$data,array('id'=>$_GPC['id']));
	if($res){
		 message('编辑成功！', $this->createWebUrl('nav'), 'success');
		}else{
			  message('编辑失败！','','error');
		}
}
include $this->template('web/nav');
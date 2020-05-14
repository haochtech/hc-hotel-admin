<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$sql="select a.* ,b.name,b.img as  user_img from " . tablename("zh_jdgjb_jfrecord") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id WHERE a.good_id =".$_GPC['good_id']." order by id DESC";
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list = pdo_fetchall($select_sql);	   
$total=pdo_fetchcolumn("select count(*) from " . tablename("zh_jdgjb_jfrecord") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id WHERE a.good_id =".$_GPC['good_id']."");
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='upd'){
	$res=pdo_update('zh_jdgjb_jfrecord',array('state'=>2),array('id'=>$_GPC['id']));
	if($res){
		message('修改成功',$this->createWebUrl('receivelist',array('good_id' => $_GPC['good_id'],'type'=>$_GPC['type'])),'success');
	}else{
		message('修改失败',$this->createWebUrl('receivelist',array('good_id' => $_GPC['good_id'],'type'=>$_GPC['type'])),'error');
	}
}

if(checksubmit('submit3')){
	$rst=pdo_get('zh_jdgjb_jfgoods',array('id'=>$_GPC['good_id']));
    $res=pdo_update('zh_jdgjb_jfrecord',array('state'=>2,'kd_num'=>$_GPC['kd_num'],'kd_name'=>$_GPC['kd_name']),array('id'=>$_GPC['fh_id']));
    if($res){
        message('发货成功！', $this->createWebUrl('receivelist',array('good_id' => $_GPC['good_id'],'type'=>$rst['type'])), 'success');
    }else{
        message('发货失败！','','error');
    }
}
include $this->template('web/receivelist');
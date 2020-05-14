<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$type=empty($_GPC['type']) ? 'all' :$_GPC['type'];
$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=20;
$where=' WHERE  uniacid=:uniacid  and owner=2';
$data[':uniacid']=$_W['uniacid'];
if($_GPC['keywords']){
    $op=$_GPC['keywords'];
    $where.=" and name LIKE  concat('%', :name,'%') ";    
    $data[':name']=$op;
}
if($type !='all'){
     $where.= " and state=".$state;
}
$sql="SELECT * FROM ".tablename('zh_jdgjb_seller'). $where." ORDER BY id DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_jdgjb_seller') .$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($operation=='adopt'){//审核通过 
    $id=$_GPC['id'];
    $res=pdo_update('zh_jdgjb_seller',array('state'=>2,'time'=>time(),'sq_time'=>time()),array('id'=>$id));  
    if($res){
        $rzinfo=pdo_get('zh_jdgjb_seller',array('id'=>$id));
        message('审核成功',$this->createWebUrl('auditorhotel',array()),'success');
    }else{
        message('审核失败','','error');
    }
}
if($operation=='reject'){
     $id=$_GPC['id'];
    $res=pdo_update('zh_jdgjb_seller',array('state'=>3,'time'=>time(),'sq_time'=>time()),array('id'=>$id));
     if($res){  
        message('拒绝成功',$this->createWebUrl('auditorhotel',array()),'success');
    }else{
        message('拒绝失败','','error');
    }
}
if($operation=='delete'){
     $id=$_GPC['id'];
     $res=pdo_delete('zh_jdgjb_seller',array('id'=>$id));
     if($res){
        message('删除成功',$this->createWebUrl('auditorhotel',array()),'success');
    }else{
        message('删除失败','','error');
    }

}

include $this->template('web/auditorhotel');
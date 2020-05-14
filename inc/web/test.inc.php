<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$type=empty($_GPC['type']) ? 'all' :$_GPC['type'];
$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=' WHERE  a.uniacid=:uniacid ';
$data[':uniacid']=$_W['uniacid'];
if($_GPC['keywords']){  
    $where.=" and a.title LIKE  concat('%', :name,'%') ";    
    $data[':name']=$_GPC['keywords'];
}
if($type !='all'){
   $where.= " and state=".$state;
}
  $sql="SELECT a.*,b.type_name,c.name FROM ".tablename('zh_gjhdbm_activity') . " a"  . " left join " . tablename("zh_gjhdbm_type") . " b on b.id=a.type_id". " left join " . tablename("zh_gjhdbm_user") . " c on c.id=a.user_id". $where." ORDER BY id DESC";
  $total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_gjhdbm_activity') . " a"  . " left join " . tablename("zh_gjhdbm_type") . " b on b.id=a.type_id". " left join " . tablename("zh_gjhdbm_user") . " c on c.id=a.user_id".$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($operation=='adopt'){//审核通过
    $id=$_GPC['id'];  
    $res=pdo_update('zh_gjhdbm_activity',array('state'=>2,'sh_time'=>time()),array('id'=>$id));  
    if($res){
        message('审核成功',$this->createWebUrl('activity',array()),'success');
    }else{
        message('审核失败','','error');
    }
}
if($operation=='reject'){
     $id=$_GPC['id'];
    $res=pdo_update('zh_gjhdbm_activity',array('state'=>3,'sh_time'=>time()),array('id'=>$id));
     if($res){  
       $list=pdo_get('zh_gjhdbm_activity',array('id'=>$id));
        pdo_update('zh_gjhdbm_user',array('money +='=>$list['tx_cost']),array('id'=>$list['user_id']));
        message('拒绝成功',$this->createWebUrl('activity',array()),'success');
    }else{
        message('拒绝失败','','error');
    }
}
if($operation=='delete'){
     $id=$_GPC['id'];
     $res=pdo_delete('zh_gjhdbm_activity',array('id'=>$id));
     if($res){
        message('删除成功',$this->createWebUrl('activity',array()),'success');
    }else{
        message('删除失败','','error');
    }
}

include $this->template('web/test');
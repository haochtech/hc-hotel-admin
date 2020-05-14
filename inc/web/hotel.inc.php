<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$type=empty($_GPC['type']) ? 'all' :$_GPC['type'];
$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$system = pdo_fetch("SELECT openCity FROM ". tablename('zh_jdgjb_system') . " WHERE uniacid = :weid", array('weid' => $_W['uniacid']));
$pagesize=10;
$where=' WHERE  uniacid=:uniacid  and state=2';
$data[':uniacid']=$_W['uniacid'];
if($_W['role']=='operator'){
    //查找商家ID;
    $seller=pdo_get('zh_jdgjb_account',array('weid'=>$_W['uniacid'],'uid'=>$_W['user']['uid']));
    $seller_id=$seller['storeid'];
    $where.=" and id =:id";
    $data[':id']=$seller_id;
}
if(!empty($_GPC['keywords'])){
    $where.=" and name LIKE  concat('%', :name,'%') ";
    $data[':name']=$_GPC['keywords'];   
}
$sql="SELECT * FROM ".tablename('zh_jdgjb_seller').$where." ORDER BY scort asc";
$data[':uniacid']=$_W['uniacid'];
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_jdgjb_seller').$where." ORDER BY scort asc",$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);

if($operation=='delete'){
        $id=$_GPC['id'];
        $result = pdo_delete('zh_jdgjb_seller', array('id'=>$id));
        if($result){
            message('删除成功',$this->createWebUrl('hotel',array()),'success');
        }else{
            message('删除失败','','error');
        }
}


include $this->template('web/hotel');
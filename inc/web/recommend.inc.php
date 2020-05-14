<?php

global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$where=" WHERE  uniacid=:uniacid ";
if($_GPC['keywords']){
    $op=$_GPC['keywords'];
      $where.=" and (gid LIKE  concat('%', :name,'%')  or name LIKE  concat('%', :name,'%'))";  
       $data[':name']=$op;
}
if(!empty($_GPC['time'])){
   $start=strtotime($_GPC['time']['start']);
   $end=strtotime($_GPC['time']['end']);
  $where.=" and time >={$start} and time<={$end}";

}
$state=$_GPC['state'];
$pageindex = max(1, intval($_GPC['page']));
$pagesize=20;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
 $data[':uniacid']=$_W['uniacid'];
  $sql="select * from " . tablename("zhjr_recommend")  .$where."  order by sort asc ";
  $total=pdo_fetchcolumn("select count(*) as wname from " . tablename("zhjr_recommend") .$where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
    $res=pdo_delete('zhjr_recommend',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl('recommend'), 'success');
        }else{
              message('删除失败！','','error');
        }
}

include $this->template('web/recommend');
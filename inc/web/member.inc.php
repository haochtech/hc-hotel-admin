
<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$member=$res=pdo_getall('zh_jdgjb_level',array('uniacid'=>$_W['uniacid']),array(),'','value asc');
$where=" where a.uniacid=:uniacid and a.type=2";
$data[':uniacid']=$_W['uniacid'];
if($_GPC['keywords']){  
	$where.=" and (a.name LIKE  concat('%', :name,'%') or a.tel LIKE  concat('%', :name,'%'))";   
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
	message('删除成功！', $this->createWebUrl('member'), 'success');
	}else{
		message('删除失败！','','error');
	}
}
if(checksubmit('submit3')){
      $res=pdo_update('zh_jdgjb_user',array('score +='=>$_GPC['reply']),array('id'=>$_GPC['id3']));
      if($res){
       $data2['score']=$_GPC['reply'];
       $data2['user_id']=$_GPC['id3'];
       $data2['type']=1;
       $data2['note']='后台充值';
       $data2['time']=time();
       $data2['uniacid']=$_W['uniacid'];//小程序id
       $res2=pdo_insert('zh_jdgjb_score',$data2); 
       if($res2){
       message('充值成功！', $this->createWebUrl('member'), 'success');
      }else{
       message('充值失败！','','error');
      }
    }
}
if(checksubmit('submit2')){
      global $_W, $_GPC; 
      $data3['cz_money']=$_GPC['cz_money'];
      $data3['zs_money']=0;
      $data3['user_id']=$_GPC['id2'];
      $data3['state']=2;
      $data3['note']='后台充值';
      $data3['time']=time();
      $data3['uniacid']=$_W['uniacid'];
      $res3=pdo_insert('zh_jdgjb_recharge',$data3); 
      if($res3){
      pdo_update('zh_jdgjb_user',array('balance +='=>$_GPC['cz_money']),array('id'=>$_GPC['id2']));
       message('充值成功！', $this->createWebUrl('member'), 'success');
      }else{
       message('充值失败！','','error');
      }
    
}
if(checksubmit('submit4')){
      global $_W, $_GPC; 
      $res4=pdo_update('zh_jdgjb_user',array('level_id'=>$_GPC['level_id'],'dj_money'=>0),array('id'=>$_GPC['id4'])); 
      if($res4){
       message('修改成功！', $this->createWebUrl('member'), 'success');
      }else{
       message('修改失败！','','error');
      }
    
}
include $this->template('web/member');


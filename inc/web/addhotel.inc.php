<?php
/**
 *门店添加;
 */
global $_GPC, $_W;
load()->func('tpl');
$weid = $this->_weid;
$action = 'fans';
$GLOBALS['frames'] = $this->getMainMenu($storeid,$action);
$title = $this->actions_titles[$action];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$list = pdo_get('zh_jdgjb_seller',array('id'=>$_GPC['id']));
$user=pdo_getall('zh_jdgjb_user',array('uniacid'=>$_W['uniacid']));
$sql =" select id,name from ".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}  and  openid like '%{$_GPC['keywords']}%' and id not in (select user_id from".tablename('zh_jdgjb_seller')." where  uniacid={$_W['uniacid']})";
$user2=pdo_fetchall($sql);
$userinfo2=pdo_get('zh_jdgjb_user',array('id'=>$list['user_id']));
$cityName= ["province"=> $list['provinceName'] ,"city"=>  $list['cityName'] ,"district"=>'' ];
 $system = pdo_fetch("SELECT openCity FROM ". tablename('zh_jdgjb_system') . " WHERE uniacid = :weid", array('weid' => $_W['uniacid']));
if($list['img']){
  if(strlen($list['img'])>51){
    $img= explode(',',$list['img']);
  }else{
    $img=array(
      0=>$list['img']
      );
  }  
}  
if(checksubmit('submit')){

  if(empty($_GPC['name'])){
    message('酒店名称不能为空','','error');
  }
  if(empty($_GPC['address'])){
    message('酒店具体地址不能为空','','error');
  }
  if(empty($_GPC['link_name'])){
    message('联系人姓名不能为空','','error');
  }
  if(empty($_GPC['link_tel'])){
    message('联系人电话不能为空','','error');
  }
  if($_GPC['img']){
    $data['img']=implode(",",$_GPC['img']);
  }
  $data['name']=$_GPC['name'];
  $data['star']=$_GPC['star'];
  $data['tel']=$_GPC['tel'];
  $data['address']=$_GPC['address'];
  $data['open_time']=$_GPC['open_time'];
  $data['handle']=$_GPC['handle'];
  $data['wake']=$_GPC['wake'];
  $data['wifi']=$_GPC['wifi'];
  $data['park']=$_GPC['park'];
  $data['breakfast']=$_GPC['breakfast'];
  $data['unionPay']=$_GPC['unionPay'];
  $data['support']=$_GPC['support'];
  $data['bq_logo']=$_GPC['bq_logo'];
  $data['gym']=$_GPC['gym'];
  $data['ewm_logo']=$_GPC['ewm_logo'];
  $data['cityName']=$_GPC['cityName']['city'];
  $data['provinceName']=$_GPC['cityName']['province'];
  $data['boardroom']=$_GPC['boardroom'];
  $data['introduction']=html_entity_decode($_GPC['introduction']);
  $data['water']=$_GPC['water'];
  $data['policy']=html_entity_decode($_GPC['policy']);
  $data['rule']=$_GPC['rule'];
  $data['prompt']=$_GPC['prompt'];
  $data['zd_money']=$_GPC['zd_money'];
  $data['uniacid']=$_W['uniacid'];
  $data['link_name']=$_GPC['link_name'];
  $data['link_tel']=$_GPC['link_tel'];
  $data['coordinates']=$_GPC['coordinates'];
  $data['scort']=$_GPC['scort'];
  $data['bd_id']=$_GPC['bd_id'];
   $data['ye_open']=$_GPC['ye_open'];
   $data['wx_open']=$_GPC['wx_open'];
   $data['dd_open']=$_GPC['dd_open'];
   $data['user_id']=$_GPC['user_id'];
  if($_GPC['id']==''){
    $data['owner']=1;
     $data['state']=2;
       $data['time']=time();
    $res=pdo_insert('zh_jdgjb_seller',$data);
    if($res){
      message('添加成功',$this->createWebUrl('hotel',array()),'success');
    }else{
      message('添加失败','','error');
    }

  }else{       
    $res = pdo_update('zh_jdgjb_seller', $data, array('id' => $_GPC['id']));
    if($res){
      message('编辑成功',$this->createWebUrl('hotel',array()),'success');
    }else{
      message('编辑失败','','error');
    }
  }
}

include $this->template('web/addhotel');
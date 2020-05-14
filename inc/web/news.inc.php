<?php
global $_GPC, $_W;
// $action = 'ad';
// $title = $this->actions_titles[$action];
$GLOBALS['frames'] = $this->getMainMenu();
$item=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
if(checksubmit('submit')){
    $data['tid1']=trim($_GPC['tid1']);
    $data['rz_tid']=trim($_GPC['rz_tid']);
    $data['jjrz_tid']=trim($_GPC['jjrz_tid']);
    $data['tid3']=trim($_GPC['tid3']);
    $data['tid4']=trim($_GPC['tid4']);
    $data['uniacid']=trim($_W['uniacid']);
    if($_GPC['id']==''){                
        $res=pdo_insert('zh_jdgjb_system',$data);
        if($res){
            message('添加成功',$this->createWebUrl('shares',array()),'success');
        }else{
            message('添加失败','','error');
        }
    }else{
        $res = pdo_update('zh_jdgjb_system', $data, array('id' => $_GPC['id']));
        if($res){
            message('编辑成功',$this->createWebUrl('news',array()),'success');
        }else{
            message('编辑失败','','error');
        }
    }
}
if($_GPC['op']=='generate'){
   $item=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
   $data['tid1']= $this->generateTemplate('AT0011',['酒店名称','预订时间','金额','地点','订单号','入住时间','离店时间','入住人','房间类型']);
   $data['rz_tid']= $this->generateTemplate('AT0390',['酒店名称','房间类型','入住人','入住时间','酒店电话','酒店地址']);
   $data['jjrz_tid']= $this->generateTemplate('AT0375',['拒绝原因','拒绝时间','支付金额','店铺名称','客服电话','订单号']);
   $data['tid3']= $this->generateTemplate('AT0163',['订单号','商户名称','订单状态','入住时间','退房时间']);
   $data['tid4']= $this->generateTemplate('AT0012',['失败原因','订单号','入住日期','入住人','酒店名称','地点','酒店电话']);
   
   if($item){
        $data['uniacid']=$_W['uniacid'];
        $res = pdo_update('zh_jdgjb_system', $data, array('uniacid' => $_W['uniacid']));
   }else{
        $res=pdo_insert('zh_jdgjb_system',$data);
   }
   if($res){
        message('更新成功',$this->createWebUrl('news',array()),'success');
    }else{
        message('更新失败','','error');
    }
}
    include $this->template('web/news');
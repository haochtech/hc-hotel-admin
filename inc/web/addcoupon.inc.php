<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$list = pdo_get('zh_jdgjb_coupons',array('id'=>$_GPC['id']));
if(checksubmit('submit')){
    $data['name']=$_GPC['name'];    
    $data['number']=$_GPC['number'];    
    $data['cost']=$_GPC['cost'];
    $data['introduce']=$_GPC['introduce'];
    $data['start_time']=$_GPC['time']['start'];
    $data['conditions']=$_GPC['conditions'];
    $data['end_time']=$_GPC['time']['end'];
    $data['uniacid']=$_W['uniacid'];
    if($_GPC['id']==''){
        $data['type']=1;
        $data['time']=time();
        $res=pdo_insert('zh_jdgjb_coupons',$data);
        if($res){
            message('添加成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('添加失败','','error');
        }
    }else{
        $res = pdo_update('zh_jdgjb_coupons', $data, array('id' => $_GPC['id']));
        if($res){
            message('编辑成功',$this->createWebUrl('coupon',array()),'success');
        }else{
            message('编辑失败','','error');
        }
    }
}
include $this->template('web/addcoupon');
<?php
//门店列表
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'fieldset_display';
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$cur_store = $this->getStoreById($seller_id);
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$list = pdo_get('zh_jdgjb_room',array('id'=>$_GPC['id']));
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

	$data['name']=$_GPC['name'];
	$data['price']=$_GPC['price'];
	$data['logo']=$_GPC['logo'];
	if($_GPC['img']){
		$data['img']=implode(",",$_GPC['img']);
	}	
	$data['floor']=$_GPC['floor'];
	$data['people']=$_GPC['people'];
	$data['bed']=$_GPC['bed'];
	$data['breakfast']=$_GPC['breakfast'];
	$data['facilities']=$_GPC['facilities'];
	$data['windows']=$_GPC['windows'];
	$data['size']=$_GPC['size'];
	$data['logo']=$_GPC['logo'];
	$data['total_num']=$_GPC['total_num'];
	$data['uniacid']=$_W['uniacid'];
	$data['seller_id']=$seller_id;
	$data['yj_cost']=$_GPC['yj_cost'];
	$data['state']=$_GPC['state'];
	$data['sort']=$_GPC['sort'];
	$data['classify']=$_GPC['classify'];
	if($_GPC['id']==''){			
		$res=pdo_insert('zh_jdgjb_room',$data);
		if($res){
			message('添加成功',$this->createWebUrl2('dlroom',array()),'success');
		}else{
			message('添加失败','','error');
		}

	}else{		
		$res = pdo_update('zh_jdgjb_room', $data, array('id' => $_GPC['id']));
		if($res){
			message('编辑成功',$this->createWebUrl2('dlroom',array()),'success');
		}else{
			message('编辑失败','','error');
		}
	}
}
include $this->template('web/dladdroom');
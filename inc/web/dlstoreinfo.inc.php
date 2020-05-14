<?php
global $_GPC, $_W;
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$cur_store = $this->getStoreById($seller_id);
$list=pdo_get('zh_jdgjb_seller',array('id'=>$seller_id));
$user=pdo_getall('zh_jdgjb_user',array('uniacid'=>$_W['uniacid']));
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
  $data['boardroom']=$_GPC['boardroom'];
  $data['introduction']=html_entity_decode($_GPC['introduction']);
  $data['water']=$_GPC['water'];
  $data['policy']=html_entity_decode($_GPC['policy']);
  $data['rule']=$_GPC['rule'];
  $data['prompt']=$_GPC['prompt'];
  $data['uniacid']=$_W['uniacid'];
  $data['link_name']=$_GPC['link_name'];
  $data['link_tel']=$_GPC['link_tel'];
  $data['coordinates']=$_GPC['coordinates'];
  $data['zd_money']=$_GPC['zd_money'];
  $data['scort']=$_GPC['scort']; 
  $data['bd_id']=$_GPC['bd_id'];
     $data['ye_open']=$_GPC['ye_open'];
   $data['wx_open']=$_GPC['wx_open'];
   $data['dd_open']=$_GPC['dd_open'];
	$res = pdo_update('zh_jdgjb_seller', $data, array('id' => $_GPC['id']));
	if($res){
		message('编辑成功',$this->createWebUrl2('dlstoreinfo',array()),'success');
	}else{
		message('编辑失败','','error');
	}
}
function  getCoade($storeid){
    function getaccess_token(){
      global $_W, $_GPC;
         $res=pdo_get('zh_jdgjb_system',array('uniacid' => $_W['uniacid']));
         $appid=$res['appid'];
         $secret=$res['appsecret'];
         
       $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
       $data = curl_exec($ch);
       curl_close($ch);
       $data = json_decode($data,true);
       return $data['access_token'];
}
     function set_msg($storeid){
       $access_token = getaccess_token();
        $data2=array(
        "scene"=>$storeid,
        "page"=>"zh_jdgjb/pages/hotel_list/hotel_info",
        "width"=>400
               );
    $data2 = json_encode($data2);
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=".$access_token."";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data2);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
         }
        $img=set_msg($storeid);
        $img=base64_encode($img);
  return $img;
  }

    $img=getCoade($seller_id);

include $this->template('web/dlstoreinfo');
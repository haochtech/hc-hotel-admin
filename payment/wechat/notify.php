<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
define('IN_MOBILE', true);
require '../../../../framework/bootstrap.inc.php';
global $_W, $_GPC;
$input = file_get_contents('php://input');
$isxml = true;
if (!empty($input) && empty($_GET['out_trade_no'])) {
	$obj = isimplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
	$res = $data = json_decode(json_encode($obj), true);
	if (empty($data)) {
		$result = array(
			'return_code' => 'FAIL',
			'return_msg' => ''
			);
		echo array2xml($result);
		exit;
	}
	if ($data['result_code'] != 'SUCCESS' || $data['return_code'] != 'SUCCESS') {
		$result = array(
			'return_code' => 'FAIL',
			'return_msg' => empty($data['return_msg']) ? $data['err_code_des'] : $data['return_msg']
			);
		echo array2xml($result);
		exit;
	}
	$get = $data;
} else {
	$isxml = false;
	$get = $_GET;
}
load()->web('common');
load()->model('mc');
load()->func('communication');
$_W['uniacid'] = $_W['weid'] = intval($get['attach']);

$_W['uniaccount'] = $_W['account'] = uni_fetch($_W['uniacid']);
$_W['acid'] = $_W['uniaccount']['acid'];
$paySetting = uni_setting($_W['uniacid'], array('payment'));
if($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS' ){
	$logno = trim($res['out_trade_no']);
	if (empty($logno)) {
		exit;
	}



	$str=$_W['siteroot'];
	$n = 0;
	for($i = 1;$i <= 3;$i++) {
		$n = strpos($str, '/', $n);
		$i != 3 && $n++;
	}
	$url=substr($str,0,$n);
//处理订单逻辑
	$order=pdo_get('zh_jdgjb_order',array('out_trade_no'=>$logno));
	//处理充值
	$czorder=pdo_get('zh_jdgjb_recharge',array('out_trade_no'=>$logno));
	if($order['status']==1){
		pdo_update('zh_jdgjb_order',array('status'=>2),array('out_trade_no'=>$logno));
		//修改房间数量
		$dt_start = strtotime(substr($order['arrival_time'],0,10));  
		$dt_end = strtotime(substr($order['departure_time'],0,10));
		while ($dt_start<$dt_end){
			$dateday=$dt_start;
			$res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$order['room_id'],'dateday'=>$dateday));
			if($res['id']){
				$nums=$res['nums']-$order['num'];
				pdo_update('zh_jdgjb_roomnum',array('nums'=>$nums),array('rid'=>$order['room_id'],'dateday'=>$dateday));
			}else{
				$uniacid=$_W['uniacid'];	
				$roomArr=pdo_get('zh_jdgjb_room',array('id'=>$order['room_id'],'uniacid'=>$order['uniacid']),array('total_num','id'));
				$nums=$roomArr['total_num']-$order['num'];
				pdo_insert('zh_jdgjb_roomnum',array('nums'=>$nums,'rid'=>$roomArr['id'],'dateday'=>$dateday));
			}
			$dt_start = strtotime('+1 day',$dt_start);
		}
		if($order['coupons_id']){//使用优惠券
			pdo_update('zh_jdgjb_usercoupons',array('state'=>2,'sy_time'=>time()),array('coupons_id'=>$order['coupons_id'],'user_id'=>$order['user_id']));
		}
		
		file_get_contents("".$url."/app/index.php?i=".$order['uniacid']."&c=entry&a=wxapp&do=print&m=zh_jdgjb&order_id=".$order['id']);//打印小票

		file_get_contents("".$url."/app/index.php?i=".$order['uniacid']."&c=entry&a=wxapp&do=sms&m=zh_jdgjb&seller_id=".$order['seller_id']);//短信通知

		//佣金计算
	$set=pdo_get('zh_jdgjb_fxset',array('uniacid'=>$order['uniacid']));
    if($set['is_open']==1){//开启分销
    	$user=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$order['user_id']));
    	if($user){
            $userid=$user['user_id'];//上线id
            $money=$order['dis_cost']*($set['commission']/100);//一级佣金
           //pdo_update('zh_jdgjb_user',array('commission +='=>$money),array('id'=>$userid));
            $data1['user_id']=$userid;//上线id       
            $data1['son_id']=$order['user_id'];//下线id
            $data1['money']=$money;//金额
            $data1['time']=time();//时间
            $data1['order_id']=$order['id'];
            $data1['note']='一级佣金';
            $data1['state']=1;
            $data1['uniacid']=$order['uniacid'];
            pdo_insert('zh_jdgjb_earnings',$data1);
        }
      if($set['is_ej']==1){//开启二级分销
          $user2=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$user['user_id']));//上线的上线
          if($user2){
            $userid2=$user2['user_id'];//上线的上线id
            $money=$order['dis_cost']*($set['commission2']/100);//二级佣金
            //pdo_update('zh_jdgjb_user',array('commission +='=>$money),array('id'=>$userid2));
            $data3['user_id']=$userid2;//上线id
            $data3['son_id']=$order['user_id'];//下线id
            $data3['money']=$money;//金额
            $data3['time']=time();//时间
            $data3['order_id']=$order['id'];
            $data3['note']='二级佣金';
            $data3['state']=1;
            $data3['uniacid']=$order['uniacid'];
            pdo_insert('zh_jdgjb_earnings',$data3);
        }
    }
}

	}

	if($czorder['state']==1){
		pdo_update('zh_jdgjb_recharge',array('state'=>2),array('out_trade_no'=>$logno));
		pdo_update('zh_jdgjb_user',array('balance +='=>$czorder['cz_money']+$czorder['zs_money']),array('id'=>$czorder['user_id']));
			//佣金计算
	$set=pdo_get('zh_jdgjb_fxset',array('uniacid'=>$czorder['uniacid']));
    if($set['is_open']==1){//开启分销
    	$user=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$czorder['user_id']));
    	if($user['user_id']>0){
            $userid=$user['user_id'];//上线id
            $money=$czorder['cz_money']*($set['commission']/100);//一级佣金
           //pdo_update('zh_jdgjb_user',array('commission +='=>$money),array('id'=>$userid));
            $data1['user_id']=$userid;//上线id       
            $data1['son_id']=$czorder['user_id'];//下线id
            $data1['money']=$money;//金额
            $data1['time']=time();//时间
            $data1['order_id']=$czorder['id'];
            $data1['note']='一级佣金';
            $data1['state']=2;
            $data1['uniacid']=$czorder['uniacid'];
            pdo_insert('zh_jdgjb_earnings',$data1);
        }
      if($set['is_ej']==1){//开启二级分销
          $user2=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$user['user_id']));//上线的上线
          if($user2['user_id']>0){
            $userid2=$user2['user_id'];//上线的上线id
            $money=$czorder['cz_money']*($set['commission2']/100);//二级佣金
            //pdo_update('zh_jdgjb_user',array('commission +='=>$money),array('id'=>$userid2));
            $data3['user_id']=$userid2;//上线id
            $data3['son_id']=$czorder['user_id'];//下线id
            $data3['money']=$money;//金额
            $data3['time']=time();//时间
            $data3['order_id']=$czorder['id'];
            $data3['note']='二级佣金';
            $data3['state']=2;
            $data3['uniacid']=$czorder['uniacid'];
            pdo_insert('zh_jdgjb_earnings',$data3);
        }
    }
}
	}
	

	$result = array(
		'return_code' => 'SUCCESS',
		'return_msg' => 'OK'
		);
	echo array2xml($result);
	exit;
	
}else{
		//订单已经处理过了
	$result = array(
		'return_code' => 'SUCCESS',
		'return_msg' => 'OK'
		);
	echo array2xml($result);
	exit;
}

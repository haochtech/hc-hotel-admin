<?php

/**

 * 酒店营销版模块小程序接口定义

 *

 * @author 智享工场

 * @url http://bbs.we7.cc/

 */

defined('IN_IA') or exit('Access Denied');



class Zh_jdgjbModuleWxapp extends WeModuleWxapp {

	public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}



	//登入

	public function doPageLogin(){
		global $_GPC, $_W;
		$openid=$_GPC['openid'];
		$res=pdo_get('zh_jdgjb_user',array('openid'=>$openid,'uniacid'=>$_W['uniacid']));
		if($res){
			$user_id=$res['id'];
			$data['openid']=$_GPC['openid'];
			$data['img']=$_GPC['img'];
			$data['name']=$_GPC['name'];
			$data['uniacid']=$_W['uniacid'];
			$res = pdo_update('zh_jdgjb_user', $data, array('id' =>$user_id));
			$sql="select a.*,b.name as level_name,b.discount  from " . tablename("zh_jdgjb_user") ." a left join".tablename('zh_jdgjb_level')." b on a.level_id=b.id WHERE  a.openid=:openid and a.uniacid=:uniacid";
			$user=pdo_fetch($sql,array(':openid'=>$openid ,'uniacid'=>$_W['uniacid']));
			if(empty($user['level_name'])){
				$user['level_name']='初始会员';
			}
			//$user=pdo_get('zhjd_user',array('openid'=>$openid));
			echo json_encode($user);
		}else{
			$data['openid']=$_GPC['openid'];
			$data['img']=$_GPC['img'];
			$data['name']=$_GPC['name'];
			$data['uniacid']=$_W['uniacid'];
			$data['join_time']=time();
			$data['type']=1;
			$res2=pdo_insert('zh_jdgjb_user',$data);
			$sql="select a.*,b.name as level_name,b.discount  from " . tablename("zh_jdgjb_user") ." a left join".tablename('zh_jdgjb_level')." b on a.level_id=b.id WHERE  a.openid=:openid and a.uniacid=:uniacid";
			$user=pdo_fetch($sql,array(':openid'=>$openid,'uniacid'=>$_W['uniacid'] ));
			if(empty($user['level_name'])){
				$user['level_name']='初始会员';;
			}
			echo json_encode($user);
		}

	}


	//图片路径(七牛)

	public function doPageAttachurl(){
		global $_W;		
		echo $_W['attachurl'];   

	}

		//获取url

	public function doPageUrl(){
		global $_W;	
		echo $_W['siteroot'];
	}


//获取openid

	public function doPageOpenid(){
		global $_W, $_GPC;
		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		$code=$_GPC['code'];
		$appid=$res['appid'];
		$secret=$res['appsecret'];
		$url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";
		function httpRequest($url,$data = null){ 
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			if (!empty($data)){
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
           //执行
			$output = curl_exec($curl);
			curl_close($curl);
			return $output;
		}
		$res=httpRequest($url);
		print_r($res);

	}


//系统设置

	public function doPageGetSystem(){
		global $_W, $_GPC;
		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		echo json_encode($res);
	}





	//获取轮播图

	public function doPageGetAd(){
		global $_GPC, $_W;
      //  $res=pdo_getall('zh_gjhdbm_ad',array('uniacid'=>$_W['uniacid'],'status'=>1,'type'=>$_GPC['type']));
		$where=" where uniacid=:uniacid and status=1 and type=:type ";
		$data[':uniacid']=$_W['uniacid'];
		$data[':type']=$_GPC['type'];
		$sql="select *  from " . tablename("zh_jdgjb_ad") .$where." order by id  desc ";
		$list=pdo_fetchall($sql,$data);
		echo json_encode($list);

	}


//导航列表

	public function  doPageGetNav(){
		global $_GPC, $_W;
		$res=pdo_getall('zh_jdgjb_nav',array('uniacid'=>$_W['uniacid'],'status'=>1),array(),'','orderby asc');
		echo json_encode($res);
	}


//酒店入住

	public  function doPageSaveHotelApply(){
		global $_GPC, $_W;
		$data['name']=$_GPC['name'];
		$data['star']=$_GPC['star'];
		$data['address']=$_GPC['address'];
		$data['coordinates']=$_GPC['coordinates'];
		$data['link_name']=$_GPC['link_name'];
		$data['link_tel']=$_GPC['link_tel'];
		$data['tel']=$_GPC['tel'];
		$data['user_id']=$_GPC['user_id'];
		$data['owner']=2;
		$data['state']=1;		
		$data['sfz_img1']=$_GPC['sfz_img1'];
		$data['sfz_img2']=$_GPC['sfz_img2'];
		$data['yy_img']=$_GPC['yy_img'];
		$data['other']=$_GPC['other'];
		$data['sq_time']=time();
		$data['uniacid']=$_W['uniacid'];
		$rst=pdo_get('zh_jdgjb_seller',array('user_id'=>$_GPC['user_id'],'uniacid'=>$_W['uniacid']));
		if($rst){			
			$res = pdo_update('zh_jdgjb_seller', $data, array('user_id' => $_GPC['user_id']));
		}else{     
			$res=pdo_insert('zh_jdgjb_seller',$data);  			
		}
		if($res){
			echo '1';
		}else{
			echo '2';
		}
	}

	//查看是否入住

	public function doPageCheckRz(){
		global $_W, $_GPC;
		$res=pdo_get('zh_jdgjb_seller',array('user_id'=>$_GPC['user_id'],'uniacid'=>$_W['uniacid']),'state');
		echo json_encode($res);
	}

//短信验证码

	public function doPageSms2(){
		global $_W, $_GPC;
		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		if($res['item']==2){
			if($_GPC['type']==1){
			$tpl_id=$res['aliyun_id'];
		}else{
			$tpl_id=$res['aliyun_id2'];
		}		
			 var_dump($this->doPageAliyun($_GPC['tel'],$_GPC['code'],$tpl_id)) ;
		}else{
		if($_GPC['type']==1){
			$tpl_id=$res['tpl_id'];
		}else{
			$tpl_id=$res['tpl_id2'];
		}		
		$tel=$_GPC['tel'];
		$code=$_GPC['code'];
		$key=$res['appkey'];
		$url = "http://v.juhe.cn/sms/send?mobile=".$tel."&tpl_id=".$tpl_id."&tpl_value=%23code%23%3D".$code."&key=".$key;
		$data=file_get_contents($url);
		print_r($data);
	}
	}


//上传图片

	public function doPageUpload(){
		global $_W, $_GPC;
		$uptypes=array(  
			'image/jpg',  
			'image/jpeg',  
			'image/png',  
			'image/pjpeg',  
			'image/gif',  
			'image/bmp',  
			'image/x-png'  
			);  
    $max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
    $destination_folder="../attachment/zh_gjjd/".date(Y)."/".date(m)."/".date(d)."/"; //上传文件路径  
    if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))  
    //是否存在文件  
    {  
    	echo "图片不存在!";  
    	exit;  
    }    
    $file = $_FILES["upfile"];  
    if($max_file_size < $file["size"])  
    //检查文件大小  
    {  
    	echo "文件太大!";  
    	exit;  
    }    
    // if(!in_array($file["type"], $uptypes))  
    // //检查文件类型  
    // {  
    // 	echo "文件类型不符!".$file["type"];  
    // 	exit;  
    // }
    if (!file_exists($destination_folder)){
    	mkdir ($destination_folder,0777,true);
    }
    $filename=$file["tmp_name"];
    $image_size = getimagesize($filename);
    $pinfo=pathinfo($file["name"]);  
    $ftype=$pinfo['extension'];  
    $destination = $destination_folder.str_shuffle(time().rand(111111,999999)).".".$ftype;  
    if (file_exists($destination) && $overwrite != true)  
    {  
    	echo "同名文件已经存在了";  
    	exit;  
    }  
    if(!move_uploaded_file ($filename, $destination))  
    {  
   	echo "移动文件出错";  
   	exit;  
    }  
    $pinfo=pathinfo($destination);  
    $fname="zh_gjjd/".date(Y)."/".date(m)."/".date(d)."/".$pinfo['basename'];  
   // var_dump($pinfo);die;
    echo $fname;
    @require_once (IA_ROOT . '/framework/function/file.func.php');
    @$filename=$fname;
    @file_remote_upload($filename); 

}

//解密

public function doPageJiemi(){
	global $_W, $_GPC;
	$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
	include_once  IA_ROOT . "/addons/zh_jdgjb/wxBizDataCrypt.php";
	$appid = $res['appid'];
	$sessionKey = $_GPC['sessionKey'];
	$encryptedData=$_GPC['data'];
	$iv = $_GPC['iv'];
	$pc = new WXBizDataCrypt($appid, $sessionKey);
	$errCode = $pc->decryptData($encryptedData, $iv, $data );
	if ($errCode == 0) {
       //echo json_encode($data);
		print($data . "\n");
	} else {
		print($errCode . "\n");
	}
}


//酒店列表
public function doPageJdList(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=$_GPC['pagesize']?:10;
	$data[':uniacid']=$_W['uniacid'];
	$item = pdo_fetch("SELECT openCity FROM ". tablename('zh_jdgjb_system') . " WHERE uniacid = :weid", array('weid' => $_W['uniacid']));
	$where=" where uniacid=:uniacid and state=2";
	if($_GPC['keywords']){
		$where.=" and name LIKE  concat('%', :name,'%') ";  
		$data[':name']=$_GPC['keywords'];
	}
	if($_GPC['cityName']&&$item['openCity']==1){
		$where.=" and cityName LIKE  concat('%', :cityName,'%') ";  
		$data[':cityName']=$_GPC['cityName'];
	}
	$sql="select *  from " . tablename("zh_jdgjb_seller") .$where." order by scort	asc ";
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,$data);
	echo json_encode($list);
}


//酒店详情

public function doPagePjDetails(){
	global $_GPC, $_W;
	$res=pdo_get("zh_jdgjb_seller",array('id'=>$_GPC['seller_id']));
	pdo_update('zh_jdgjb_seller',array('ll_num +='=>1),array('id'=>$_GPC['seller_id']));
	echo json_encode($res);
}


//房型列表

public function doPageRoomList(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=50;
	$data[':uniacid']=$_W['uniacid'];
	$data[':seller_id']=$_GPC['seller_id'];
	$where=" where uniacid=:uniacid and seller_id=:seller_id  ";
	$sql="select *  from " . tablename("zh_jdgjb_room") .$where." order by sort asc ";
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,$data);
	echo json_encode($list);
}


//房间详情

public  function doPageRoomDetails(){
	global $_GPC, $_W;
	$res=pdo_get("zh_jdgjb_room",array('id'=>$_GPC['room_id']));
	echo json_encode($res);
}


//平台(所有)优惠券

public function doPageGetSponsorCoupon(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$time=date("Y-m-d",time());
	$time=strtotime($time);
	$sql=" select * from".tablename('zh_jdgjb_coupons')." where uniacid=:uniacid  and lq_num < number and unix_timestamp(end_time) >= $time 
	 and id not in (select coupons_id from".tablename('zh_jdgjb_usercoupons')." where user_id={$_GPC['user_id']} and uniacid={$_W['uniacid']}) order by id desc";
	//echo $sql;die;
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,array(':uniacid'=>$_W['uniacid']));
	echo json_encode($list);

}


// //商家优惠券

// public function doPagegetSellerCoupon(){
// 	global $_GPC, $_W;
// 	$time=date("Y-m-d",time());
// 	$time=strtotime($time);
// 	$sql=" select * from".tablename('zh_jdgjb_coupons')." where uniacid=:uniacid  and seller_id=:seller_id and lq_num < number and unix_timestamp(end_time) >= $time order by id desc";
// 	$list=pdo_fetchall($sql,array(':uniacid'=>$_W['uniacid'],':seller_id'=>$_GPC['uniacid']));
// 	echo json_encode($list);
// }

//优惠券详情
public function doPageCouponDetails(){
	global $_GPC, $_W;
	$res=pdo_get("zh_jdgjb_coupons",array('id'=>$_GPC['coupon_id']));
	echo json_encode($res);
}


//领取优惠券
public function doPageReceiveCoupons(){
	global $_GPC, $_W;	
	$rst=pdo_get('zh_jdgjb_usercoupons',array('user_id'=>$_GPC['user_id'],'coupons_id'=>$_GPC['coupons_id'],'uniacid'=>$_W['uniacid']));
	if(!$rst){
	$data['user_id']=$_GPC['user_id'];
	$data['coupons_id']=$_GPC['coupons_id'];
	$data['state']=1;
	$data['time']=time();
	$data['uniacid']=$_W['uniacid'];
	$res=pdo_insert('zh_jdgjb_usercoupons',$data);
	if($res){
	//修改券的数量
	pdo_update('zh_jdgjb_coupons',array('lq_num +='=>1),array('id'=>$_GPC['coupons_id']));
	echo '1';
	}else{
		echo '2';
	}
}else{
	echo '重复领取';
}

}





//生成订单
public function doPageAddOrder(){
	global $_W, $_GPC;
	$data['user_id']=$_GPC['user_id'];
	$data['seller_id']=$_GPC['seller_id'];
	$data['coupons_id']=$_GPC['coupons_id'];
	$data['hb_id']=$_GPC['hb_id'];
	$data['room_id']=$_GPC['room_id'];
	$data['order_no']=date('YmdHis').rand(0,9999);
	$data['status']=1;
	$data['time']=time();
	$data['price']=$_GPC['price'];
	$data['seller_name']=$_GPC['seller_name'];
	$data['seller_address']=$_GPC['seller_address'];
	$data['coordinates']=$_GPC['coordinates'];
	$data['arrival_time']=$_GPC['arrival_time'];
	$data['departure_time']=$_GPC['departure_time'];
	$data['dd_time']=$_GPC['dd_time'];
	$data['tel']=$_GPC['tel'];
	$data['name']=$_GPC['name'];
	$data['room_type']=$_GPC['room_type'];
	$data['total_cost']=$_GPC['total_cost'];
	$data['num']=$_GPC['num'];
	$data['bed_type']=$_GPC['bed_type'];	
	$data['uniacid']=$_W['uniacid'];
	$data['out_trade_no']=time().rand(1000,9999).$_GPC['user_id'];
	
	$data['days']=$_GPC['days'];
	$data['dis_cost']=$_GPC['dis_cost'];//折扣后的金额		
	$data['yhq_cost']=$_GPC['yhq_cost'];
	$data['hb_cost']=$_GPC['hb_cost'];
	$data['yyzk_cost']=$_GPC['yyzk_cost'];
	$data['yj_cost']=$_GPC['yj_cost'];
	$data['room_logo']=$_GPC['room_logo'];
	// $data['out_trade_no']=$_GPC['out_trade_no'];//预定订单
	$data['from_id']=$_GPC['from_id'];
	$data['qr_fromid']=$_GPC['qr_fromid'];
	$data['classify']=$_GPC['classify'];
	$data['type']=$_GPC['type'];
	$data['code']=$_GPC['code'];
	$dt_start = strtotime($_GPC['arrival_time']);  
	$dt_end = strtotime($_GPC['departure_time']);
	$rid=$_GPC['room_id'];	
	$str='';
	$diffDay=$data['days'];
	$roomnum=$data['num'];
	while ($dt_start<$dt_end){ 
		$dateday=$dt_start;
		$res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$rid,'dateday'=>$dateday));
		$surplus=$res['nums'];
		if(!$res['id']){
			$surplus=pdo_getcolumn('zh_jdgjb_room',array('id'=>$rid),'total_num');
		}
		if(($roomnum-$surplus>0)){
			if($surplus==0){
				$str.=date('m月d日',$dateday).'已经没有房间了！';
			}else{
				$str.=date('m月d日',$dateday).'只剩下'.$surplus.'间房';
			}
		}
		$dt_start = strtotime('+1 day',$dt_start);
	}
	if($str){
		echo $str;
	}else{
		if($_GPC['type']==3){//到店付
			$data['status']=1;
			file_get_contents("".$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=Sms&m=zh_jdgjb&seller_id=".$_GPC['seller_id']);//短信
		}
		$res=pdo_insert('zh_jdgjb_order',$data);
		$order_id=pdo_insertid();
		if($_GPC['hb_id']){//使用积分红包
			pdo_update('zh_jdgjb_jfhb',array('state'=>2),array('id'=>$_GPC['hb_id']));
		}
		if($_GPC['type']==3){
			file_get_contents("".$_W['siteroot']."/app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=print&m=zh_jdgjb&order_id=".$order_id);
		if($_GPC['coupons_id']){//使用优惠券
			pdo_update('zh_jdgjb_usercoupons',array('state'=>2,'sy_time'=>time()),array('coupons_id'=>$_GPC['coupons_id'],'user_id'=>$_GPC['user_id']));
		}
	}

	echo $order_id;

}

}


//微信支付
public function doPagePay(){
	global $_W, $_GPC;
	include IA_ROOT.'/addons/zh_jdgjb/wxpay.php';
	$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
	$order=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));
	$appid=$res['appid'];
	$openid=$_GPC['openid'];//oQKgL0ZKHwzAY-KhiyEEAsakW5Zg
	$mch_id=$res['mchid'];
	$key=$res['wxkey'];
	$out_trade_no = $order['out_trade_no'];
	$root=$_W['siteroot'];
//	pdo_update('zh_jdgjb_order',array('out_trade_no'=>$out_trade_no),array('id'=>$_GPC['order_id']));  
	$total_fee =$order['total_cost'];
	if(empty($total_fee)) 
	{
		$body = "订单付款";
		$total_fee = floatval(99*100);
	}else{
		$body = "订单付款";
		$total_fee = floatval($total_fee*100);
	}
	$weixinpay = new WeixinPay($appid,$openid,$mch_id,$key,$out_trade_no,$body,$total_fee,$root);
	$return=$weixinpay->pay();
	echo json_encode($return);
}

//余额支付
public function doPageYePay(){
	global $_W, $_GPC;
	$orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));
	$data['user_id']=$orderInfo['user_id'];
	$data['cz_money']=$orderInfo['total_cost'];
	$data['note']='订单消费';
	$data['state']=2;
	$data['time']=time();
	$data['uniacid']=$_W['uniacid'];
	$res=pdo_insert('zh_jdgjb_recharge',$data);
	if($res){
      $dt_start = strtotime(substr($orderInfo['arrival_time'],0,10));  
		$dt_end = strtotime(substr($orderInfo['departure_time'],0,10));
		while ($dt_start<$dt_end){
			$dateday=$dt_start;
			$res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$orderInfo['room_id'],'dateday'=>$dateday));
			if($res['id']){
				$nums=$res['nums']-$orderInfo['num'];
				pdo_update('zh_jdgjb_roomnum',array('nums'=>$nums),array('rid'=>$orderInfo['room_id'],'dateday'=>$dateday));
			}else{
				$uniacid=$_W['uniacid'];	
				$roomArr=pdo_get('zh_jdgjb_room',array('id'=>$orderInfo['room_id'],'uniacid'=>$orderInfo['uniacid']),array('total_num','id'));
				$nums=$roomArr['total_num']-$order['num'];
				pdo_insert('zh_jdgjb_roomnum',array('nums'=>$nums,'rid'=>$roomArr['id'],'dateday'=>$dateday));
			}
			$dt_start = strtotime('+1 day',$dt_start);
		}
		pdo_update('zh_jdgjb_order',array('status'=>2),array('id'=>$_GPC['order_id']));
		if($orderInfo['coupons_id']){//使用优惠券
		    pdo_update('zh_jdgjb_usercoupons',array('state'=>2,'sy_time'=>time()),array('coupons_id'=>$orderInfo['coupons_id'],'user_id'=>$orderInfo['user_id']));
		}
		pdo_update('zh_jdgjb_user',array('balance -='=>$orderInfo['total_cost']),array('id'=>$orderInfo['user_id']));
		//echo "".$_W['siteroot']."/app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=print&m=zh_jdgjb&order_id=".$_GPC['order_id'];die;
		echo file_get_contents("".$_W['siteroot']."/app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=print&m=zh_jdgjb&order_id=".$_GPC['order_id']);//打印小票die;
		file_get_contents("".$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=Sms&m=zh_jdgjb&seller_id=".$orderInfo['seller_id']);//短信
		echo '1';
	}else{
		echo '2';
	}
}



//我的优惠券
public function doPageMyCoupons(){
	global $_W, $_GPC;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$data[':uniacid']=$_W['uniacid'];
	$data[':user_id']=$_GPC['user_id'];
	$where=" where a.uniacid=:uniacid and a.user_id=:user_id  ";
	$sql="select b.*,a.id as lq_id,a.state  from " . tablename("zh_jdgjb_usercoupons")." a left join".tablename('zh_jdgjb_coupons')." b on a.coupons_id=b.id" .$where." order by id desc ";
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,$data);
	echo json_encode($list);
}





//保存评价
public function  doPageSaveAssess(){
	global $_W, $_GPC;
	$res2=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
	$data['seller_id']=$_GPC['seller_id'];
	$data['score']=$_GPC['score'];
	$data['content']=html_entity_decode($_GPC['content']);
	$data['img']=$_GPC['img'];
	$data['user_id']=$_GPC['user_id'];
	$data['status']=1;
	$data['time']=time();
	$data['uniacid']=$_W['uniacid'];
	$res=pdo_insert('zh_jdgjb_assess',$data);
	$assess_id=pdo_insertid();
	if($res){
		echo '1';
		//完成订单
	pdo_update('zh_jdgjb_order',array('status'=>4),array('id'=>$_GPC['order_id']));
	$data2['user_id']=$_GPC['user_id'];
    $data2['assess_id']=$assess_id;
    $data2['score']=$res2['pl_score'];
    $data2['note']='评论所得';
    $data2['time']=time();
    $data2['uniacid']=$_W['uniacid'];
    pdo_insert('zh_jdgjb_score',$data2);
    pdo_update('zh_jdgjb_user',array('score +='=>$res2['pl_score']),array('id'=>$_GPC['user_id']));
	}else{
		echo '2';
	}
}

//评价列表
public function doPageAssessList(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$sql=" select a.*,b.name,b.img as logo from".tablename('zh_jdgjb_assess')." a left join ".tablename('zh_jdgjb_user')." b on a.user_id=b.id  where a.uniacid=:uniacid  and a.seller_id=:seller_id order by a.id desc";
	//echo $sql;die;
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,array(':uniacid'=>$_W['uniacid'],':seller_id'=>$_GPC['seller_id']));
	echo json_encode($list);
}
//打印机
public function doPagePrint(){
	global $_W, $_GPC;
	include IA_ROOT.'/addons/zh_jdgjb/print/dyj.php';
	$orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));
	$dyj=pdo_get('zh_jdgjb_dyj',array('seller_id'=>$orderInfo['seller_id']));
	$yh_money=$orderInfo['yhq_cost']+$orderInfo['yyzk_cost']+$orderInfo['hb_cost'];
	if($orderInfo['type']==1){
		$type='微信支付';
	}
	if($orderInfo['type']==2){
		$type='余额支付';
	}
	if($orderInfo['type']==3){
		$type='到店支付';
	}
if($dyj['state']==1){//打印机开启
	if($dyj['type']==3){
		$content = "<BR><BR>";
		$content .= "          ".$dyj['dyj_title']."<BR>";
		$content .= "--------------------------------<BR>";
		$content .="酒店名称: ". $orderInfo['seller_name']."<BR>";
		$content .="酒店地址: ". $orderInfo['seller_address']."<BR>";
		$content .="房型: ". $orderInfo['room_type']."<BR>";
		$content .="房间价格: ". $orderInfo['dis_cost']."<BR>";
		$content .="押金: ". $orderInfo['yj_cost']."<BR>";
		$content .="优惠金额: ". $yh_money."<BR>";
		$content .="房间数量: ". $orderInfo['num']."<BR>";
		$content .="入住时间: ". substr($orderInfo['arrival_time'],0,10)."<BR>";
		$content .="离店时间: ". substr($orderInfo['departure_time'],0,10)."<BR>";
		$content .="到店时间: ". $orderInfo['dd_time']."<BR>";
		$content .="入住天数: ". $orderInfo['days']."<BR>";
		$content .="入住人姓名: ". $orderInfo['name']."<BR>";
		$content .="入住人电话: ". $orderInfo['tel']."<BR>";
		$content .="支付方式: ". $type."<BR>";
		$content .= "<BR><BR>";
	}else{
		$content = "\n\n\n";
		$content .= "          ".$dyj['dyj_title']."\n\n";
		$content .= "--------------------------------\n\n";
		$content .="酒店名称: ". $orderInfo['seller_name']."\n\n";
		$content .="酒店地址: ". $orderInfo['seller_address']."\n\n";
		$content .="房型: ". $orderInfo['room_type']."\n\n";
		$content .="房间价格: ". $orderInfo['dis_cost']."\n\n";
		$content .="押金: ". $orderInfo['yj_cost']."\n\n";
		$content .="优惠金额: ". $yh_money."\n\n";
		$content .="房间数量: ". $orderInfo['num']."\n\n";
		$content .="入住时间: ". substr($orderInfo['arrival_time'],0,10)."\n\n";
		$content .="离店时间: ". substr($orderInfo['departure_time'],0,10)."\n\n";
		$content .="到店时间: ". $orderInfo['dd_time']."\n\n";
		$content .="入住天数: ". $orderInfo['days']."\n\n";
		$content .="入住人姓名: ". $orderInfo['name']."\n\n";
		$content .="入住人电话: ". $orderInfo['tel']."\n\n";
		$content .="支付方式: ". $type."\n";
		$content .= "\n\n\n";
	}
if($dyj['type']==1){//365
	$rst=Dyj::dy($dyj['dyj_id'],$content,$dyj['dyj_key']);
}
if($dyj['type']==2){//易联云
	$rst=Dyj::ylydy($dyj['api'],$dyj['token'],$dyj['yy_id'],$dyj['mid'],$content);
}
if($dyj['type']==3){//飞蛾
	$rst=Dyj::fedy($dyj['fezh'],$dyj['fe_ukey'],$dyj['fe_dycode'],$content);
}

}



}

//短信通知
  public function doPageSms(){
  	global $_W, $_GPC;
  	$res=pdo_get('zh_jdgjb_notice',array('uniacid'=>$_W['uniacid'],'seller_id'=>$_GPC['seller_id']));
  	if($res['item']==2){
		$tpl_id=$res['aliyun_id2'];		
		var_dump( $this->doPageAliyun2($res['js_tel'],$res['aliyun_appkey'],$res['aliyun_appsecret'],$res['aliyun_sign'],$res['aliyun_id'])) ;
	}else{
  	$tpl_id=$res['tpl_id'];
  	$tel=$res['js_tel'];
  	$key=$res['appkey'];
  	$url = "http://v.juhe.cn/sms/send?mobile=".$tel."&tpl_id=".$tpl_id."&tpl_value=%23code%23%3D654654&key=".$key;
  	$data=file_get_contents($url);
  	print_r($data);
  }
  }


//我的订单
public function doPageMyOrder(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$data[':uniacid']=$_W['uniacid'];
	$data[':user_id']=$_GPC['user_id'];
	$where=" where uniacid=:uniacid and user_id=:user_id  ";
	if($_GPC['status']){
		$where.=" and status=:status";
		$data[':status']=$_GPC['status'];
	}
	$sql="select *  from " . tablename("zh_jdgjb_order") .$where." order by id desc ";
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,$data);
	foreach($list as $key=>$val){
	$list[$key]['count']=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_jdgjb_order') .$where.' and id<='.$val['id'].' and user_id='.$val['user_id'] ,$data)?:0;	
}
	echo json_encode($list);
}

//订单详情
public function doPageOrderDetails(){
	global $_GPC, $_W;
	$res=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));
	echo json_encode($res);
}

//取消订单
public function doPageCancelOrder(){
	global $_GPC, $_W;
	$res=pdo_update('zh_jdgjb_order',array('status'=>3),array('id'=>$_GPC['order_id']));
	if($res){
			if($_GPC['hb_id']){//使用积分红包
				pdo_update('zh_jdgjb_jfhb',array('state'=>1),array('id'=>$_GPC['hb_id']));
			}
			echo '1';
		}else{
			echo '2';
		}
	}

//申请退款
public function doPageApplyOrder(){
	global $_GPC, $_W;
	$res=pdo_update('zh_jdgjb_order',array('status'=>6),array('id'=>$_GPC['order_id']));
	if($res){
		echo '1';
	}else{
		echo '2';
	}
}



//获取实时房价
public function doPageGetRoomCost(){
	global $_W, $_GPC;
	$rid=$_GPC['room_id'];
	$dt_start = strtotime($_GPC['start']);  
	$dt_end = strtotime($_GPC['end']);
	$pricelist=array();
	$i=0;
	while ($dt_start<$dt_end){ 
		$dateday=$dt_start;
		$res1=pdo_get('zh_jdgjb_roomprice',array('rid'=>$rid,'dateday'=>$dateday));
		$pricelist[$i]['dateday']=date('m月d日',$dateday);
		if($res1['mprice']){
			$pricelist[$i]['mprice']=$res1['mprice'];
		}else{
			$mprice=pdo_getcolumn('zh_jdgjb_room',array('id'=>$rid),'price');
			$pricelist[$i]['mprice']=$mprice;
		}
		$dt_start = strtotime('+1 day',$dt_start);
		$i++;
	}
	echo json_encode($pricelist);
}


//微信支付退款
public  function doPageRefund(){
	global $_W, $_GPC;
	include_once IA_ROOT . '/addons/zh_jdgjb/cert/WxPay.Api.php';
	load()->model('account');
	load()->func('communication');
	$refund_order =pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));  
	$WxPayApi = new WxPayApi();
	$input = new WxPayRefund();
	$path_cert = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_cert_' .$_W['uniacid'] . '.pem';
	$path_key = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
	$account_info = $_W['account'];  	
	$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
	$appid=$res['appid'];
	$key=$res['wxkey'];
	$mchid=$res['mchid']; 
	$out_trade_no=$refund_order['out_trade_no'];
	$fee = $refund_order['total_cost'] * 100;
	$input->SetAppid($appid);
	$input->SetMch_id($mchid);
	$input->SetOp_user_id($mchid);
	$input->SetRefund_fee($fee);
	$input->SetTotal_fee($fee);
           // $input->SetTransaction_id($refundid);
	$input->SetOut_refund_no($refund_order['order_no']);
	$input->SetOut_trade_no($out_trade_no);
	$result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);
    if ($result['result_code'] == 'SUCCESS') {//退款成功
        //更改订单操作
        pdo_update('zh_jdgjb_order',array('status'=>7),array('id'=>$_GPC['order_id']));           
        echo '1';
        }else{
          echo $result['err_code_des'];
        }
    }

    public  function doPageRefund2(){
		global $_W, $_GPC;
		include_once IA_ROOT . '/addons/zh_jdgjb/cert/WxPay.Api.php';
		load()->model('account');
		load()->func('communication');
		$refund_order =pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));  
		$WxPayApi = new WxPayApi();
		$input = new WxPayRefund();
		$path_cert = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_cert_' .$_W['uniacid'] . '.pem';
		$path_key = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
		$account_info = $_W['account'];  	
		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		$appid=$res['appid'];
		$key=$res['wxkey'];
		$mchid=$res['mchid']; 
		$out_trade_no=$refund_order['out_trade_no'];
		$fee = $_GPC['total_cost'] * 100;
		$input->SetAppid($appid);
		$input->SetMch_id($mchid);
		$input->SetOp_user_id($mchid);
		$input->SetRefund_fee($fee);
		$input->SetTotal_fee($fee);
	           // $input->SetTransaction_id($refundid);
		$input->SetOut_refund_no($refund_order['order_no']);
		$input->SetOut_trade_no($out_trade_no);
		$result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);
	    if ($result['result_code'] == 'SUCCESS') {//退款成功
	        //更改订单操作
	        pdo_update('zh_jdgjb_order',array('status'=>7),array('id'=>$_GPC['order_id']));           
	        echo '1';
        }else{
          echo $result['err_code_des'];
        }
    }


//余额退款
    public function doPageYeRefund(){
    	global $_W, $_GPC;
    	$orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']));
    	$data['user_id']=$orderInfo['user_id'];
    	$data['cz_money']=$orderInfo['total_cost'];
    	$data['note']='订单退款';
    	$data['state']=2;
    	$data['time']=time();
    	$data['uniacid']=$_W['uniacid'];
    	$res=pdo_insert('zh_jdgjb_recharge',$data);
    	if($res){
    		pdo_update('zh_jdgjb_order',array('status'=>7),array('id'=>$_GPC['order_id']));
    		pdo_update('zh_jdgjb_user',array('balance +='=>$orderInfo['total_cost']),array('id'=>$orderInfo['user_id']));
    		echo '1';
    	}
    }



//订房成功模板消息
    public function doPageMessage(){
    	global $_W, $_GPC;
    	function getaccess_token($_W){
    		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    		$appid=$res['appid'];
    		$secret=$res['appsecret'];
    		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
    		$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL,$url);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    		$data = curl_exec($ch);
    		curl_close($ch);
    		$data = json_decode($data,true);
    		return $data['access_token'];
    	}

	 //设置与发送模板信息
    	function set_msg($_W){
    		$access_token = getaccess_token($_W);
    		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    		$sql="select * from " . tablename("zh_jdgjb_order")." WHERE id=:order_id  ";
    		$list=pdo_fetch($sql,array(':order_id'=>$_GET['order_id']));
    		$time=date('Y-m-d H:i',$list['time']);
    		$time1=date("Y年m月d日",strtotime($list['arrival_time']));
    		$time2=date("Y年m月d日",strtotime($list['departure_time']));

        //下面是要填充模板的信息
    		$formwork = [
                'touser' => $_GET["openid"],
                'template_id' => $res["tid1"],
                'data' => [
                    'thing1' => [
                        'value' => $list['seller_name'],
                        'color' => '#173177',
                    ],
                    'character_string7' => [
                        'value' => $list['order_no'],
                        'color' => '#173177',
                    ],
                     'amount4' => [
                        'value' => $list['dis_cost'],
                        'color' => '#173177',
                    ],
                    'date2' => [
                        'value' => $time1,
                        'color' => '#173177',
                    ],
                    'name5' => [
                        'value' => $list['name'],
                        'color' => '#173177',
                    ],
                   
                ],
            ];
    	/*	echo "<pre>";
    		print_r($formwork);die;*/
    		$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=".$access_token."";
    		$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL,$url);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    		curl_setopt($ch, CURLOPT_POST,1);
    		$formwork = json_encode($formwork);
    		curl_setopt($ch, CURLOPT_POSTFIELDS,$formwork);
    		$data = curl_exec($ch);
    		curl_close($ch);
    	      
    	   $res=pdo_delete('zh_jdgjb_dingyue',array('user_id'=>$list['user_id'],'tpl_id'=>$res["tid1"]));
    		return $data;

    	}
    	echo set_msg($_W);
    }




////////////////////以下积分商城///////////////////////////


//分类列表
    public function doPageJfTypeList(){
    	global $_W, $_GPC;
    	$res=pdo_getall('zh_jdgjb_jftype',array('uniacid'=>$_W['uniacid']),array(),'','num asc');
    	echo json_encode($res);
    }


	//商品列表
    public  function  doPageJfGoodsList(){
    	global $_GPC, $_W;
    	$pageindex = max(1, intval($_GPC['page']));
    	$pagesize=10;
    	$data[':uniacid']=$_W['uniacid'];
    	$where=" where uniacid=:uniacid ";
    	if($_GPC['type_id']){
		$where.=" and type_id=:type_id ";  
		$data[':type_id']=$_GPC['type_id'];
		}
    	$sql="select *  from " . tablename("zh_jdgjb_jfgoods") .$where." order by num asc ";
    	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
    	$list=pdo_fetchall($select_sql,$data);
    	echo json_encode($list);

    }

	//商品详情
    public function doPageGoodsDetails(){
    	global $_W, $_GPC;
    	$res=pdo_get('zh_jdgjb_jfgoods',array('id'=>$_GPC['id']));
    	echo json_encode($res);
    }

    //兑换商品
    public function doPageExchange(){
    	global $_W, $_GPC;
      	$data['user_id']=$_GPC['user_id'];//用户id
      	$data['good_id']=$_GPC['good_id'];//商品id
     	$data['user_name']=$_GPC['user_name'];//用户名称
     	$data['user_tel']=$_GPC['user_tel'];//用户电话
      	$data['address']=$_GPC['address'];//地址
     	$data['integral']=$_GPC['integral'];//积分
     	$data['good_name']=$_GPC['good_name'];//商品名称
      	$data['good_img']=$_GPC['good_img'];//商品图片
        $data['time']=date("Y-m-d H:i:s");
        if($_GPC['type']==1){
        	$data['state']=2;
        }else{
        	$data['state']=1;
        }
        $res=pdo_insert('zh_jdgjb_jfrecord',$data);
      if($res){
      	pdo_update('zh_jdgjb_jfgoods',array('number -='=>1),array('id'=>$_GPC['good_id']));
          if($_GPC['type']==1){//虚拟红包
          	$data2['money']=$_GPC['hb_money'];
          	$data2['user_id']=$_GPC['user_id'];
          	$data2['goods_id']=$_GPC['good_id'];;
          	$data2['time']=date('Y-m-d H:i:s');
          	$data2['uniacid']=$_W['uniacid'];
          	pdo_insert('zh_jdgjb_jfhb',$data2);
          }
          $data3['user_id']=$_GPC['user_id'];
          $data3['goods_id']=$_GPC['good_id'];
          $data3['score']=$_GPC['integral'];
          $data3['note']='兑换商品';
          $data3['type']=2;
          $data3['time']=time();
          $data3['uniacid']=$_W['uniacid'];
          pdo_insert('zh_jdgjb_score',$data3); 
          pdo_update('zh_jdgjb_user',array('score -='=>$_GPC['integral']),array('id'=>$_GPC['user_id']));
          echo '1';
      }else{
      	echo '2';
      }
  }


 //兑换明细
  public function doPageDhmx(){
  	global $_W, $_GPC;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=10;
  	$data[':user_id']=$_GPC['user_id'];
  	$where=" where user_id=:user_id ";
  	$sql="select *  from " . tablename("zh_jdgjb_jfrecord") .$where." order by id desc ";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
  	$list=pdo_fetchall($select_sql,$data);
  	echo json_encode($list);
  	
  }

  //我的积分明细
  public function doPageMyScoreDetails(){
  	global $_GPC, $_W;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=20;
  	$data[':uniacid']=$_W['uniacid'];
  	$data[':user_id']=$_GPC['user_id'];
  	$where=" where uniacid=:uniacid and user_id=:user_id ";
  	$sql="select *  from " . tablename("zh_jdgjb_score") .$where." order by id desc ";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
  	$list=pdo_fetchall($select_sql,$data);
  	echo json_encode($list);
  }


//我的可用红包
  public function doPageMyHb(){
  	global $_GPC, $_W;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=10;
  	$data[':uniacid']=$_W['uniacid'];
  	$data[':user_id']=$_GPC['user_id'];
  	$where=" where uniacid=:uniacid and user_id=:user_id and state=1";
  	$sql="select *  from " . tablename("zh_jdgjb_jfhb") .$where." order by id desc ";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
  	$list=pdo_fetchall($select_sql,$data);
  	echo json_encode($list);  	

  }



//获取实时房间数量
public function doPageGetRoomNum(){
global $_W, $_GPC;
	$rid=$_GPC['room_id'];
	$dt_start = strtotime($_GPC['start']);  
	$dt_end = strtotime($_GPC['end']);
	$pricelist=array();
	$i=0;
	while ($dt_start<$dt_end){ 
		$dateday=$dt_start;
		$res1=pdo_get('zh_jdgjb_roomnum',array('rid'=>$rid,'dateday'=>$dateday));
		$pricelist[$i]['dateday']=date('m月d日',$dateday);
		if($res1){
			$pricelist[$i]['nums']=$res1['nums'];
		}else{
			$mprice=pdo_getcolumn('zh_jdgjb_room',array('id'=>$rid),'total_num');
			$pricelist[$i]['nums']=$mprice;
		}
		$dt_start = strtotime('+1 day',$dt_start);
		$i++;
	}
	echo json_encode($pricelist);

}


//会员等级列表
public function doPageMemberList(){
	global $_W, $_GPC;
	$res=pdo_getall('zh_jdgjb_level',array('uniacid'=>$_W['uniacid']),array(),'','value asc');
	echo json_encode($res);
}


/////////////////////////以下后台操作
///

public function doPageHtLogin(){
	global $_GPC, $_W;
	load()->model('user');
	$time=strtotime(date("Y-m-d"));
	$mttime=strtotime(date("Y-m-d",strtotime("+1 day")));
	$zttime=strtotime(date("Y-m-d",strtotime("-1 day")));
	$month=strtotime(date("Y-m"));
	$member = array();
	$summary=array();
	$member['username'] =$_GPC['username'];
	$member['password'] = $_GPC['password'];
	$record = user_single($member);
	if(!empty($record)) {
		$account = pdo_fetch("SELECT * FROM " . tablename("zh_jdgjb_account") . " WHERE status=2 AND uid=:uid ORDER BY id DESC LIMIT 1", array(':uid' => $record['uid']));
		if (!empty($account)) {
			$storeid = $account['storeid'];
			$data[':uniacid']=$_W['uniacid'];
			$data[':seller_id']=$storeid;
			//获取酒店信息
			$sellerInfo=pdo_get('zh_jdgjb_seller',array('id'=>$storeid),array('name','ewm_logo','ll_num'));
			//今日订单
			$order=" select count(id) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid and seller_id=:seller_id and  time>=".$time." and time<".$mttime."";
			$total=pdo_fetch($order,$data);
			//今日销售额
			$moneysql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$time." and time<".$mttime."";
			$jrmoney=pdo_fetch($moneysql,$data);
			//本月销售额
			$bysql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$month;
			$bymoney=pdo_fetch($bysql,$data);
			//订单统计
			$sql2="select count( case when status=2 then 1 end) as dzf, count( case when status=4 then 1 end) as ywc, count( case when status=6 then 1 end) as ytk from  ".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id ";
			$tjorder=pdo_fetch($sql2,$data);
			//昨日营业额
			$zrsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$zttime." and time<".$time."";
			$zrmoney=pdo_fetch($zrsql,$data);
			//总营业额
			$totalsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8) ";
			$totalmoney=pdo_fetch($totalsql,$data);
			//var_dump($totalmoney['yj_money']);die;
			$summary['seller_id']=$storeid;
			$summary['seller_name']=$sellerInfo['name'];
			$summary['seller_logo']=$sellerInfo['ewm_logo'];
			$summary['ll_num']=$sellerInfo['ll_num'];
			$summary['jrdd']=$total['total'];
			$summary['jrxse']=$jrmoney['total_money']-$jrmoney['yj_money'];
			$summary['byxse']=$bymoney['total_money']-$bymoney['yj_money'];
			$summary['dzf']=$tjorder['dzf'];
			$summary['ywc']=$tjorder['ywc'];
			$summary['ytk']=$tjorder['ytk'];
			$summary['zrxse']=$zrmoney['total_money']-$zrmoney['yj_money'];
			$summary['zxse']=$totalmoney['total_money']-$totalmoney['yj_money'];
			echo  json_encode($summary);
		} else {
			echo '您的账号正在审核或是已经被系统禁止，请联系网站管理员解决！!!';
		}

	}else{
		echo '账号或密码错误';
	}
}

//商家微信登录
public function doPageStoreWxLogin(){
	global $_GPC, $_W;
	$res=pdo_get('zh_jdgjb_seller',array('user_id'=>$_GPC['user_id'],'state'=>2));
	if($res){
		$storeid=$res['id'];
		$time=strtotime(date("Y-m-d"));
		$mttime=strtotime(date("Y-m-d",strtotime("+1 day")));
		$zttime=strtotime(date("Y-m-d",strtotime("-1 day")));
		$month=strtotime(date("Y-m"));
		$summary=array();
		$data[':uniacid']=$_W['uniacid'];
		$data[':seller_id']=$storeid;
			//获取酒店信息
		$sellerInfo=pdo_get('zh_jdgjb_seller',array('id'=>$storeid),array('name','ewm_logo','ll_num'));
			//今日订单
		$order=" select count(id) as total from".tablename('zh_jdgjb_order')." where uniacid=:uniacid and seller_id=:seller_id and  time>=".$time." and time<".$mttime."";
		$total=pdo_fetch($order,$data);
			//今日销售额
		$moneysql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$time." and time<".$mttime."";
		$jrmoney=pdo_fetch($moneysql,$data);
			//本月销售额
		$bysql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$month;
		$bymoney=pdo_fetch($bysql,$data);
			//订单统计
		$sql2="select count( case when status=2 then 1 end) as dzf, count( case when status=4 then 1 end) as ywc, count( case when status=6 then 1 end) as ytk from  ".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id ";
		$tjorder=pdo_fetch($sql2,$data);
			//昨日营业额
		$zrsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8)  and time>=".$zttime." and time<".$time."";
		$zrmoney=pdo_fetch($zrsql,$data);
			//总营业额
		$totalsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (2,4,5,6,8) ";
		$totalmoney=pdo_fetch($totalsql,$data);
			//var_dump($totalmoney['yj_money']);die;
		$summary['seller_id']=$storeid;
		$summary['seller_name']=$sellerInfo['name'];
		$summary['seller_logo']=$sellerInfo['ewm_logo'];
		$summary['ll_num']=$sellerInfo['ll_num'];
		$summary['jrdd']=$total['total'];
		$summary['jrxse']=$jrmoney['total_money']-$jrmoney['yj_money'];
		$summary['byxse']=$bymoney['total_money']-$bymoney['yj_money'];
		$summary['dzf']=$tjorder['dzf'];
		$summary['ywc']=$tjorder['ywc'];
		$summary['ytk']=$tjorder['ytk'];
		$summary['zrxse']=$zrmoney['total_money']-$zrmoney['yj_money'];
		$summary['zxse']=$totalmoney['total_money']-$totalmoney['yj_money'];
		echo  json_encode($summary);
	}else{
		echo '您还不是管理员或在审核中';
	}	
}


//订单列表
public function doPageSellerOrderList(){
	global $_GPC, $_W;
	$pageindex = max(1, intval($_GPC['page']));
	$pagesize=10;
	$data[':uniacid']=$_W['uniacid'];
	$data[':seller_id']=$_GPC['seller_id'];
	$where=" where uniacid=:uniacid and seller_id=:seller_id ";
	if($_GPC['status']){
		$where.=" and status=:status ";  
		$data[':status']=$_GPC['status'];
	}
	if($_GPC['keywords']){
		$where.=" and order_no LIKE  concat('%', :order_no,'%') ";  
		$data[':order_no']=$_GPC['keywords'];
	}
	$sql="select *  from " . tablename("zh_jdgjb_order") .$where." order by id desc ";
	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
	$list=pdo_fetchall($select_sql,$data);
	foreach($list as $key=>$val){
	$list[$key]['count']=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_jdgjb_order') .$where.' and id<='.$val['id'].' and user_id='.$val['user_id'] ,$data)?:0;	
}
	echo json_encode($list); 
}

//确认入住,拒绝退款
public function doPageChangeOrder(){
	global $_W, $_GPC;
	$res=pdo_update('zh_jdgjb_order',array('status'=>$_GPC['status']),array('id'=>$_GPC['order_id']));
	if($res){
		if($_GPC['status']==5){
		$rst=file_get_contents("".$_W['siteroot']."/app/index.php?i=".$_W['uniacid']."&c=entry&a=wxapp&do=UpdRz&m=zh_jdgjb&id=".$_GPC['order_id']);
		}
		echo '1';
	}else{
		echo'2';
	}
}


//编辑房间
public function doPageEditRoom(){
	global $_GPC, $_W;
	$data['name']=$_GPC['name'];
	$data['price']=$_GPC['price'];
	$data['img']=$_GPC['img'];		
	$data['floor']=$_GPC['floor'];
	$data['people']=$_GPC['people'];
	$data['logo']=$_GPC['logo'];
	$data['yj_cost']=$_GPC['yj_cost'];
	$data['state']=$_GPC['state'];
	//var_dump($data);die;
	$res = pdo_update('zh_jdgjb_room', $data, array('id' =>$_GPC['room_id']));
	if($res){
		echo '1';
	}else{
		echo '2';
	}
}


//获取15天放价
public function doPageGetMonthCost(){
	global $_W, $_GPC;
	$rid=$_GPC['room_id'];
	$dt_start = strtotime(date('Y-m-d'));  
	$dt_end = strtotime(date("Y-m-d",strtotime("+15 day")));
	$pricelist=array();
	$i=0;
	while ($dt_start<$dt_end){ 
		$dateday=$dt_start;
		$res1=pdo_get('zh_jdgjb_roomprice',array('rid'=>$rid,'dateday'=>$dateday));
		$pricelist[$i]['dateday']=date('m月d日',$dateday);
		if($res1['mprice']){
			$pricelist[$i]['mprice']=$res1['mprice'];
		}else{
			$mprice=pdo_getcolumn('zh_jdgjb_room',array('id'=>$rid),'price');
			$pricelist[$i]['mprice']=$mprice;
		}
		$dt_start = strtotime('+1 day',$dt_start);
		$i++;
	}
	echo json_encode($pricelist);
}

//获取15天房量
public function doPageGetMonthNum(){
global $_W, $_GPC;
	$rid=$_GPC['room_id'];
	$dt_start = strtotime(date('Y-m-d'));  
	$dt_end = strtotime(date("Y-m-d",strtotime("+15 day")));
	$numlist=array();
	$i=0;
	while ($dt_start<$dt_end){ 
		$dateday=$dt_start;
		$res1=pdo_get('zh_jdgjb_roomnum',array('rid'=>$rid,'dateday'=>$dateday));
		$numlist[$i]['dateday']=date('m月d日',$dateday);
		if($res1){
			$numlist[$i]['nums']=$res1['nums'];
		}else{
			$mprice=pdo_getcolumn('zh_jdgjb_room',array('id'=>$rid),'total_num');
			$numlist[$i]['nums']=$mprice;
		}
		$dt_start = strtotime('+1 day',$dt_start);
		$i++;
	}
	echo json_encode($numlist);

}

//删除房间
public function doPageDeleteRoom(){	
	global $_W, $_GPC;
	$res=pdo_delete('zh_jdgjb_room',array('id'=>$_GPC['room_id']));
	if($res){
		echo '1';
	}else{
		echo'2';
	}
}


//房间上下架
public function doPageChangeRoom(){
	global $_W, $_GPC;
	$res=pdo_update('zh_jdgjb_room',array('state'=>$_GPC['state']),array('id'=>$_GPC['room_id']));
	if($res){
		echo '1';
	}else{
		echo'2';
	}
}


//修改价格
public function doPageEditRoomPrice(){
	global $_W, $_GPC;
	$data['dateday']=strtotime(trim($_GPC['dateday']));
	$data['mprice']=trim($_GPC['price']);
	$data['rid']=trim($_GPC['room_id']);
	$res=pdo_get('zh_jdgjb_roomprice',array('rid'=>$data['rid'],'dateday'=>$data['dateday']));
	if(!$res['id']){
		$rst=pdo_insert('zh_jdgjb_roomprice',$data);
	}else{
		$rst=pdo_update('zh_jdgjb_roomprice',array('mprice'=>$data['mprice']),array('id'=>$res['id']));
	}
	if($rst){
		echo '1';
	}else{
		echo '2';
	}
}

//修改数量
public function doPageEditRoomNum(){
	global $_W, $_GPC;
	$data['dateday']=strtotime(trim($_GPC['dateday']));
	$data['nums']=trim($_GPC['nums']);
	$data['rid']=trim($_GPC['room_id']);
	$res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$data['rid'],'dateday'=>$data['dateday']));
	if(!$res['id']){
		$rst=pdo_insert('zh_jdgjb_roomnum',$data);
	}else{
		$rst=pdo_update('zh_jdgjb_roomnum',array('nums'=>$data['nums']),array('id'=>$res['id']));
	}
	if($rst){
		echo '1';
	}else{
		echo '2';
	}
}

//可提现金额
public function doPageTxMoney(){
	global $_W, $_GPC;
	$data2[':seller_id']=$_GPC['seller_id'];
	$data2[':uniacid']=$_W['uniacid'];
	  //总营业额
	$totalsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (4,5,8) and type !=3 ";
	$totalmoney=pdo_fetch($totalsql,$data2);
	$sql2 = "select sum(tx_cost) as total from " . tablename("zh_jdgjb_withdrawal")." WHERE  seller_id=:seller_id and state in (1,2) and uniacid=:uniacid ";
	$total2 = pdo_fetch($sql2,$data2);//已提现金额
	$ktxcost=$totalmoney['total_money']-$totalmoney['yj_money']-$total2['total'];
	echo $ktxcost;
}

//保存提现申请
public function doPageSaveTxApply(){
	global $_W, $_GPC;
	$data2[':seller_id']=$_GPC['seller_id'];
	$data2[':uniacid']=$_W['uniacid'];
	  //总营业额
	$totalsql=" select sum(total_cost) as total_money, sum(ytyj_cost) as yj_money  from".tablename('zh_jdgjb_order')." where uniacid=:uniacid  and seller_id=:seller_id and status in (4,5,8) and type !=3 ";
	$totalmoney=pdo_fetch($totalsql,$data2);
	$sql2 = "select sum(tx_cost) as total from " . tablename("zh_jdgjb_withdrawal")." WHERE  seller_id=:seller_id and state in (1,2) and uniacid=:uniacid ";
	$total2 = pdo_fetch($sql2,$data2);//已提现金额
	$ktxcost=$totalmoney['total_money']-$totalmoney['yj_money']-$total2['total'];
	if($_GPC['tx_cost']>$ktxcost){
		echo 2;exit();
	}
	$data['sj_cost']=$_GPC['sj_cost'];
	$data['seller_id']=$_GPC['seller_id'];
	$data['name']=$_GPC['name'];
	$data['username']=$_GPC['username'];
	$data['state']=1;
	$data['tx_cost']=$_GPC['tx_cost'];
	$data['uniacid']=$_W['uniacid'];
	$data['time']=date("Y-m-d H:i:s");
	$res=pdo_insert('zh_jdgjb_withdrawal',$data);
	if($res){
		echo '1';
	}else{
		echo '2';
	}
}

//商家提现记录
public function doPageSellerTxList(){
	global $_GPC, $_W;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=10;
  	$data[':uniacid']=$_W['uniacid'];
  	$data[':seller_id']=$_GPC['seller_id'];
  	$where=' WHERE  uniacid=:uniacid and seller_id=:seller_id and is_delete=1';
    $sql="SELECT * FROM ".tablename('zh_jdgjb_withdrawal') .  $where." ORDER BY time DESC";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
  	$list=pdo_fetchall($select_sql,$data);
  	echo json_encode($list);
}


//回复评价
public function doPageReplyAssess(){
	global $_W, $_GPC;
	$data['reply']=$_GPC['reply'];
	$data['status']=2;
	$data['reply_time']=time();
	$res=pdo_update('zh_jdgjb_assess',$data,array('id'=>$_GPC['assess_id']));
	if($res){
		echo '1';
	}else{
		echo '2';
	}
}

///////////////////以下分销


//分销设置
public  function doPageGetFxSet(){
	 global $_W, $_GPC;
	 $res=pdo_get('zh_jdgjb_fxset',array('uniacid'=>$_W['uniacid']));
	 echo json_encode($res);
}

//申请分销商
  public function doPageDistribution(){
    global $_W, $_GPC;
    pdo_delete('zh_jdgjb_distribution',array('user_id'=>$_GPC['user_id']));
    $set=pdo_get('zh_jdgjb_fxset',array('uniacid'=>$_W['uniacid']));
    $data['user_id']=$_GPC['user_id'];
    $data['user_name']=$_GPC['user_name'];
    $data['user_tel']=$_GPC['user_tel'];
    $data['time']=time();
    if($set['is_fx']==1){
       $data['state']=1;
     }else{
       $data['state']=2;
     }
    $data['uniacid']=$_W['uniacid'];
    $res=pdo_insert('zh_jdgjb_distribution',$data);
    $sq_id=pdo_insertid();
    if($res){
      $fx=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$_GPC['user_id']));
       if($set['is_fx']==1 and !$fx){
        pdo_insert("zh_jdgjb_fxuser",array('user_id'=>0,'fx_user'=>$_GPC['user_id'],'time'=>time()));
       }
     echo  $sq_id;
    }else{
      echo '申请失败!';
    }
  }

   //查看我的上线
  public function doPageMySx(){
      global $_W, $_GPC;
     $sql="select a.* ,b.name from " . tablename("zh_jdgjb_fxuser") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id   WHERE a.fx_user=:fx_user ";
        $res=pdo_fetch($sql,array(':fx_user'=>$_GPC['user_id']));
      echo json_encode($res);
  } 


  //查看我的申请
  public function doPageMyDistribution(){
      global $_W, $_GPC;
      $res=pdo_get('zh_jdgjb_distribution',array('user_id'=>$_GPC['user_id']));
      echo json_encode($res);
  }


//绑定分销商
  public function doPageBinding(){
      global $_W, $_GPC;
      $res=pdo_get('zh_jdgjb_fxuser',array('fx_user'=>$_GPC['fx_user']));//已绑定
      $res2=pdo_get('zh_jdgjb_fxuser',array('user_id'=>$_GPC['fx_user'],'fx_user'=>$_GPC['user_id']));//已绑定成下线
      if($_GPC['user_id']==$_GPC['fx_user']){
        echo '自己不能绑定自己';
      }elseif($res || $res2){
        echo '不能重复绑定';
      }else{
        $res3=pdo_insert('zh_jdgjb_fxuser',array('user_id'=>$_GPC['user_id'],'fx_user'=>$_GPC['fx_user'],'time'=>time()));
        if($res3){
          echo  '1';
        }else{
          echo  '2';
        }
      }

  }



//我的二维码
  public function doPageMyCode(){
  	global $_W, $_GPC;
  	function  getCoade($user_id){
  		function getaccess_token(){
  			global $_W, $_GPC;
  			$res=pdo_get('zh_jdgjb_system',array('uniacid' => $_W['uniacid']));
  			$appid=$res['appid'];
  			$secret=$res['appsecret'];
          //  $appid="wx80fa1d36c435231a";
          // $secret="9bb4735bd092f092477049bfd7e183f8";
  			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
  			$ch = curl_init();
  			curl_setopt($ch, CURLOPT_URL,$url);
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
  			$data = curl_exec($ch);
  			curl_close($ch);
  			$data = json_decode($data,true);
  			return $data['access_token'];
  		}
  		function set_msg($user_id){
  			$access_token = getaccess_token();
  			$data2=array(
  				"scene"=>$user_id,
          // /"page"=>"zh_dianc/pages/info/info",
  				"width"=>100
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
  		$img=set_msg($user_id);
  		$img=base64_encode($img);
  		return $img;
  	}
  	$base64_image_content = "data:image/jpeg;base64," . getCoade($_GPC['user_id']);
  	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
  		$type = $result[2];
  		$new_file = IA_ROOT . "/addons/zh_jdgjb/img/";
  		if (!file_exists($new_file)) {
                    //检查是否有该文件夹，如果没有就创建，并给予最高权限
  			mkdir($new_file, 0777);
  		}
  		$wname = "{$_GPC['user_id']}" . ".{$type}";
                //$wname="1511.jpeg";
  		$new_file = $new_file . $wname;
  		file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)));
  	}
  	echo $_W['siteroot'] . "addons/zh_jdgjb/img/" . $wname;

  }


//查看我的团队
public function doPageMyTeam(){
    global $_W, $_GPC;
    $sql="select a.* ,b.name ,b.img from " . tablename("zh_jdgjb_fxuser") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.fx_user   WHERE a.user_id=:user_id order by id DESC";
    $res=pdo_fetchall($sql,array(':user_id'=>$_GPC['user_id']));
    $res2=array();
    for($i=0;$i<count($res);$i++){
        $sql2="select a.* ,b.name ,b.img from " . tablename("zh_jdgjb_fxuser") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.fx_user   WHERE a.user_id=:user_id order by id DESC";
        $res3=pdo_fetchall($sql2,array(':user_id'=>$res[$i]['fx_user']));
        $res2[]=$res3;
      
    }     
      $res4=array();
      for($k=0;$k<count($res2);$k++){
          for($j=0;$j<count($res2[$k]);$j++){
            $res4[]=$res2[$k][$j]; 
          }
        
      }
    $data['one']=$res;
    $data['two']=$res4;
    echo json_encode($data);
}

//佣金统计
public function doPageCountCommission(){
	global $_W, $_GPC;
	$sql2="select sum(case when state=1 then money else 0 end ) as dj ,sum( case when state=2 then money else 0 end ) as yx from  ".tablename('zh_jdgjb_earnings')." where uniacid=:uniacid  and user_id=:user_id ";
	$money=pdo_fetch($sql2,array('uniacid'=>$_W['uniacid'],':user_id'=>$_GPC['user_id']));

	$sql3=" select ifnull(sum(tx_cost),0) as tx_money from ".tablename('zh_jdgjb_commission_withdrawal')." where  user_id=:user_id and state in (1,2)";
	$ytx_money=pdo_fetch($sql3,array(':user_id'=>$_GPC['user_id']));
	$commission['ktx']= number_format($money['yx']-$ytx_money['tx_money'],2);
	$commission['dj']= number_format($money['dj'],2);
	$commission['ytx']= number_format($ytx_money['tx_money'],2);
	$commission['lj']= number_format($money['yx']+$commission['dj'],2);
	echo json_encode($commission);
}

//佣金明细
public function doPageYjlist(){
	global $_GPC, $_W;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=30;
  	$data[':user_id']=$_GPC['user_id'];
  	$sql="  select id,money,note,time from ".tablename('zh_jdgjb_earnings')." where user_id=:user_id and state=2  union all select id,tx_cost as money ,note,time from".tablename('zh_jdgjb_commission_withdrawal')." where user_id=:user_id order by time desc";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;	
  	$list=pdo_fetchall($sql,$data);
  	echo json_encode($list);  	


}

//佣金提现设置
public function doPageGetYjTxSet(){
	global $_GPC, $_W;
	$res=pdo_get('zh_jdgjb_fxtxset',array('uniacid'=>$_W['uniacid']));
	echo json_encode($res);
}

//佣金提现
public function doPageYjtx(){
	global $_W, $_GPC;
	$data['tx_cost']=$_GPC['tx_cost'];
	$data['sj_cost']=$_GPC['sj_cost'];
	$data['account']=$_GPC['account'];
	$data['user_name']=$_GPC['user_name'];
	$data['state']=1;
	$data['time']=time();
	$data['uniacid']=$_W['uniacid'];
	$data['user_id']=$_GPC['user_id']; 
	$data['note']='提现';     
	$res=pdo_insert('zh_jdgjb_commission_withdrawal',$data);
	if($res){
		echo '1';
	}else{
		echo '2';	
	}
} 


//完善信息
public function doPageRenewUser(){
	global $_W, $_GPC;
	$data['tel']=$_GPC['tel'];
	$data['zs_name']=$_GPC['zs_name'];  
	$data['type']=2;
	$data['number']=substr("00000000".$_GPC['user_id'], -8);  
	$res=pdo_update('zh_jdgjb_user',$data,array('id'=>$_GPC['user_id']));
	if($res){
		echo '1';
	}else{
		echo '2';
	}
}

//累计消费
public function doPageMyCost(){
	global $_W, $_GPC;
	$total=pdo_get('zh_jdgjb_order', array('user_id'=>$_GPC['user_id'],'status '=>array(4,5,8)), array('sum(total_cost) as total_money','sum(ytyj_cost) as yt_money'));	
	echo json_encode($total['total_money']-$total['yt_money']);
}


//订单二维码
  public function doPageOrderCode(){
       global $_W, $_GPC;
      function  getCoade($order_id){
        function getaccess_token(){
          global $_W, $_GPC;
          $res=pdo_get('zh_jdgjb_system',array('uniacid' => $_W['uniacid']));
           $appid=$res['appid'];
           $secret=$res['appsecret'];
          //  $appid="wx80fa1d36c435231a";
          // $secret="9bb4735bd092f092477049bfd7e183f8";
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,$url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
          $data = curl_exec($ch);
          curl_close($ch);
          $data = json_decode($data,true);
          return $data['access_token'];
        }
        function set_msg($order_id){
         $access_token = getaccess_token();
         $data2=array(
          "scene"=>$order_id,
          "page"=>"zh_jdgjb/pages/logs/Workbench",
          "width"=>100
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
       $img=set_msg($order_id);
       $img=base64_encode($img);
       return $img;
     }
     echo getCoade($_GPC['order_id']);

  }


//二维码确认入住
  public function doPageSmRz(){
  	global $_W, $_GPC;
  	$orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['order_id']),'seller_id');
  	if($orderInfo['seller_id']==$_GPC['seller_id']){
  		$res=pdo_update('zh_jdgjb_order',array('status'=>5),array('id'=>$_GPC['order_id']));
  		if($res){
  			echo '1';
  		}else{
  			echo'2';
  		}

  	}else{
  		echo '没有核销权限';
  	}
  }



//押金退款
  public function doPageYjRefund(){
  	global $_W, $_GPC;
		$money=$_GPC['money']*100;//退款金额
		$order_id=$_GPC['order_id'];
		include_once IA_ROOT . '/addons/zh_jdgjb/cert/WxPay.Api.php';
		load()->model('account');
		load()->func('communication');
		$refund_order =pdo_get('zh_jdgjb_order',array('id'=>$order_id));  
		$WxPayApi = new WxPayApi();
		$input = new WxPayRefund();
		$path_cert = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_cert_' .$_W['uniacid'] . '.pem';
		$path_key = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
		$account_info = $_W['account'];   
		$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		$appid=$res['appid'];
		$key=$res['wxkey'];
		$mchid=$res['mchid']; 
		$out_trade_no=$refund_order['out_trade_no'];
		$fee = $refund_order['total_cost'] * 100;
		$input->SetAppid($appid);
		$input->SetMch_id($mchid);
		$input->SetOp_user_id($mchid);
		$input->SetRefund_fee($money);
		$input->SetTotal_fee($fee);
           // $input->SetTransaction_id($refundid);
		$input->SetOut_refund_no($refund_order['order_no']);
		$input->SetOut_trade_no($out_trade_no);
		$result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);
		 if ($result['result_code'] == 'SUCCESS') {//退款成功
        //更改订单操作
		 	pdo_update('zh_jdgjb_order',array('ytyj_cost +='=>($money/100)),array('id'=>$order_id));           
		 	return '1';
		 }else{
		 	return '2';
		 }
		 
		}

//充值活动
      public function doPageCzhd(){
       global $_W, $_GPC;
       $res=pdo_getall('zh_jdgjb_czhd',array('uniacid'=>$_W['uniacid']),array(),'','full DESC');
       echo json_encode($res);
     }

     //充值支付
public function doPagePay2(){
	global $_W, $_GPC;
	include IA_ROOT.'/addons/zh_jdgjb/wxpay.php';
	$res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
	$order=pdo_get('zh_jdgjb_recharge',array('id'=>$_GPC['cz_id']));
	$appid=$res['appid'];
	$openid=$_GPC['openid'];//oQKgL0ZKHwzAY-KhiyEEAsakW5Zg
	$mch_id=$res['mchid'];
	$key=$res['wxkey'];
	$out_trade_no = $order['out_trade_no'];
	$root=$_W['siteroot'];
	//pdo_update('zh_jdgjb_recharge',array('out_trade_no'=>$out_trade_no),array('id'=>$_GPC['cz_id']));  
	$total_fee =$order['cz_money'];
	if(empty($total_fee)) 
	{
		$body = "订单付款";
		$total_fee = floatval(99*100);
	}else{
		$body = "订单付款";
		$total_fee = floatval($total_fee*100);
	}
	$weixinpay = new WeixinPay($appid,$openid,$mch_id,$key,$out_trade_no,$body,$total_fee,$root);
	$return=$weixinpay->pay();
	echo json_encode($return);
}

//充值
public function doPageSaveRecharge(){
	global $_W, $_GPC; 
	$data['cz_money']=$_GPC['cz_money'];
	$data['zs_money']=$_GPC['zs_money'];
	$data['out_trade_no']=time().rand(1000,9999).$_GPC['user_id'];
	$data['user_id']=$_GPC['user_id'];
	$data['state']=1;
	$data['note']='在线充值';
	$data['time']=time();
	$data['uniacid']=$_W['uniacid'];
	$res2=pdo_insert('zh_jdgjb_recharge',$data); 
	$cz_id=pdo_insertid();
	if($res2){
		echo  $cz_id;
	}else{
		echo '2';
	}

}

//余额明细
public function doPageYelist(){
	global $_GPC, $_W;
  	$pageindex = max(1, intval($_GPC['page']));
  	$pagesize=30;
  	$data[':user_id']=$_GPC['user_id'];
  	$sql="  select id,cz_money,zs_money,note,time from ".tablename('zh_jdgjb_recharge')." where user_id=:user_id and state=2 ";
  	$select_sql=$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;	
  	$list=pdo_fetchall($sql,$data);
  	echo json_encode($list);  	


}


//入住改变
public function doPageUpdRz(){
	global $_GPC, $_W;
	function getLevel($members,$count){
		for($i=0;$i<count($members);$i++){
			if($count['count']>=$members[$i]['value']){
				return  $members[$i]['id'];

			}
			if($count['count']<$members[$i]['value']&&$count['count']>$members[$i+1]['value']){
				return $members[$i+1]['id'];

			}

		}
	}
	function getScore($order_id){   
		global $_W, $_GPC;
		$orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$order_id));
		$scoreInfo=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		$score= floor($orderInfo['dis_cost']*$scoreInfo['xf_score']);
		return $score;

	}
	function saveScore($order_id,$user_id,$score){   
		global $_W, $_GPC;
		$data['user_id']=$user_id;
		$data['order_id']=$order_id;
		$data['score']=$score;
		$data['note']='购物所得';
		$data['time']=time();
		$data['uniacid']=$_W['uniacid'];
		$rst=pdo_insert('zh_jdgjb_score',$data);
		return $rst;

	}
 function roomNum($order_id){
		global $_W, $_GPC;
		$order=pdo_get('zh_jdgjb_order',array('id'=>$order_id));
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
	}
	$type=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']),'open_member');
	$order=pdo_get('zh_jdgjb_order',array('id'=>$_GPC['id']));
	if($type['open_member']==1){
	//获取用户消费金额
		$count=pdo_get('zh_jdgjb_order', array('user_id'=>$order['user_id'],'status'=>5), array('sum(dis_cost) as count'));	 
		$members=pdo_getall('zh_jdgjb_level',array('uniacid'=>$_W['uniacid']),array() , '' , 'value DESC');
		$level_id= getLevel($members,$count);
	}
	$score=getScore($_GPC['id']);
	$rst=saveScore($_GPC['id'],$order['user_id'],$score);
	if($rst){
		pdo_update('zh_jdgjb_user',array('score +='=>$score),array('id'=>$order['user_id']));
	}
	if($level_id){
	//更改会员等级
		pdo_update('zh_jdgjb_user',array('level_id'=>$level_id,'type'=>2),array('id'=>$order['user_id']));
	//echo $level_id;
	}
	if($order['type']==3){
		roomNum($_GPC['id']);
	}
	//更改拥金
	pdo_update('zh_jdgjb_earnings',array('state'=>2),array('order_id'=>$_GPC['id']));
}



    public function doPageAliyun($phone,$code,$tpl_id) {
        global $_W, $_GPC;
        require_once dirname(__DIR__) . "/zh_jdgjb/SignatureHelper.php";
        $sms=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
      // echo $code;die;
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = $sms['aliyun_appkey'];
        $accessKeySecret = $sms['aliyun_appsecret'];
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] =  $phone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = $sms['aliyun_sign'];
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] =$tpl_id;
  
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "code" => $code,
        );

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            )),
            $security
        );

        return $content;
}

public function doPageAliyun2($tel,$aliyun_appkey,$aliyun_appsecret,$aliyun_sign,$tpl_id) {
        global $_W, $_GPC;
        require_once dirname(__DIR__) . "/zh_jdgjb/SignatureHelper.php";
      // echo $code;die;
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = $aliyun_appkey;
        $accessKeySecret = $aliyun_appsecret;
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] =  $tel;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] =$aliyun_sign;
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $tpl_id;
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            )),
            $security
        );

        return $content;
}

function base64EncodeImage ($image_file) {
    $base64_image = '';
    $image_info = getimagesize($image_file);
    $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
    $base64_image =  chunk_split(base64_encode($image_data));
    return $base64_image;
}

public function doPageTest2(){
		global $_GPC, $_W;
		 require_once dirname(__DIR__) . "/zh_jdgjb/baiduSdk/AipFace.php";
		 $appId='16809002';
		 $apiKey='NkQDRqjKs7oH01rrqTuQez25';
		 $secretKey='B6lqYgOiew485z6kT7YctVggHRGHiePF';
		 $image=$this->base64EncodeImage(dirname(__DIR__) . "/zh_jdgjb/img/7.jpg");
		 $imageType='BASE64';
		 $data=[
		 	[
		 	'image'=>'7020ad3c0fc764b00a760fcf91c6ce7b',
		 	'image_type'=>'FACE_TOKEN'
		 	],
		 	[
		 	'image'=>$image,
		 	'image_type'=>$imageType
		 	]
		 ];
		 $client= new AipFace($appId,$apiKey,$secretKey);
		  $arr=$client->match($data);
		 return json_encode($arr);
		$errno = 5;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}

public function doPageTest3(){
		global $_GPC, $_W;
	 require_once dirname(__DIR__) . "/zh_jdgjb/distance/distance.php";

$circle =['center'=>['lng'=>'117.26714358070373','lat'=>'31.933753273109424'],'radius'=>'5'*1000];
	 $arr=[
	 	['category'=>1,
	 	'radius'=>2.00,
	 	'fee'=>5,
	 	'vertexes'=>[
	 	'lat'=>'31.934336',
	 	'lng'=>'117.26503'
	 	]

	 	],
	 	['category'=>1,
	 	'radius'=>15.00,
	 	'fee'=>10,
	 	'vertexes'=>[
	 	'lat'=>'31.934336',
	 	'lng'=>'117.26503'
	 	]

	 	],
	 	['category'=>2,
	 	'radius'=>0.00,
	 	'fee'=>20,
	 	'vertexes'=>[
	 	[
	 	'lat'=>'31.901419208343',
	 	'lng'=>'117.26503'
	 	],
	 	[
	 	'lat'=>'31.95502',
	 	'lng'=>'117.283'
	 	],
	 	[
	 	'lat'=>'31.95502',
	 	'lng'=>'117.24706'
	 	],
	 	[
	 	'lat'=>'31.99448561994',
	 	'lng'=>'117.18766516358'
	 	],
	 	[
	 	'lat'=>'32.008318599485',
	 	'lng'=>'117.10080450684'
	 	],
	 	[
	 	'lat'=>'31.891508803575',
	 	'lng'=>'117.23195379883'
	 	],
	 	]

	 	],

	 ];
	  $convert= new Convert();

	foreach ($arr as $key => $value) {
		if($value['category']==1){
			$rst=$convert -> is_point_in_circle($value['vertexes'], $circle);
			if($rst){
				echo  $value['fee'];die;
			}
			continue;
		}
		if($value['category']==2){
		$rst=$convert -> is_point_in_polygon($circle['center'], $value['vertexes']);
		if($rst){
				echo  $value['fee'];die;
			}
			continue;
		}
		echo  '不在配送范围';die;
	}
echo 6789;die;
	/* $pts = [
    ['lng'=>117.29673291016, 'lat'=>31.901419208343],
    ['lng'=>117.283, 'lat'=>31.95502],
    ['lng'=>117.24706, 'lat'=>31.95502],
	['lng'=>117.10080450684, 'lat'=>32.008318599485],
	['lng'=>117.23195379883, 'lat'=>31.891508803575],
	
];*/
 
 	
$point = ['lng'=>117.18766516358,'lat'=>31.99448561994];
$bool = $convert -> is_point_in_polygon($point,$pts);
var_dump($bool);die;


	}

    public function doPageDlist(){
 
    	global $_GPC, $_W;
		$info = pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
		$model['tid1'] =$info['tid1'];
		$model['rz_tid'] = $info['rz_tid'];
		$model['jjrz_tid'] = $info['jjrz_tid'];


		$arr = ['tid1' => '酒店预定成功通知', 'rz_tid' => '办理入住登记通知', 'jjrz_tid' => '酒店预订结果通知'];
		$new_list = [];
		foreach ($model as $k => $val) {
		$new_arr['title'] = $arr[$k];
		$new_arr['tpl_name'] = $k;
		$new_arr['tpl_id'] = $val;
		$new_list[] = $new_arr;
		}
		foreach ($new_list as $key => $value) {
            $new_list[$key]['rec'] = pdo_get('zh_jdgjb_dingyue',array('uniacid'=>$_W['uniacid'],'user_id'=>$_GPC['user_id'],'tpl_id'=>$value['tpl_id'],'tpl_name'=>$value['tpl_name']));
              if ($new_list[$key]['rec']) {
              $new_list[$key]['is_dy'] = 1;
              } 
              
        }
		echo  json_encode($new_list);

    }
    
    public function doPageSubscribe(){ 
    	global $_GPC, $_W;
        $detail=array(
            'uniacid'=>$_W['uniacid'],
            'addtime'=>time(),
            'user_id'=>$_GPC['user_id'],
            'state'=>1,
            'tpl_id'=>$_GPC['tpl_id'],
            'tpl_name'=>$_GPC['tpl_name'],
            
        );
       // echo "<pre>";print_r($detail);die;
         $res=pdo_insert('zh_jdgjb_dingyue',$detail);
         success_withimg_json($res);
    }



}
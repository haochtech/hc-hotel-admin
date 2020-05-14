<?php
/**
 * 酒店营销版模块微站定义
 *
 * @author 智享工场
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
require 'inc/func/core.php';

class Zh_jdgjbModuleSite extends Core {





	public function doMobileYjRefund(){
		global $_W, $_GPC;
		$money=$_GPC['money']*100;//退款金额
        $order_id=$_GPC['id'];
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

	public function doMobileSelectJd(){
		global $_W, $_GPC;
		$sql =" select id,name from ".tablename('zh_jdgjb_seller')." where uniacid={$_W['uniacid']} and state=2 and  name like '%{$_GPC['keywords']}%'";    
		echo json_encode(pdo_fetchall($sql));
	}


	public function doMobileSelectUser(){
		global $_W, $_GPC;
		$sql =" select id,name from ".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}  and  openid like '%{$_GPC['keywords']}%'";    
		echo json_encode(pdo_fetchall($sql));
	}


	public function doMobileNewOrder(){
		global $_W, $_GPC;
		$time=time();
		$time2=$time-10;
		if($_GPC['role']=='operator'){
    //查找商家ID;
			$seller=pdo_get('zh_jdgjb_account',array('weid'=>$_W['uniacid'],'uid'=>$_GPC['uid']));
			$seller_id=$seller['storeid'];
			$sql="SELECT * FROM ".tablename('zh_jdgjb_order')." WHERE  uniacid=:uniacid and status=2 and seller_id=:seller_id and voice=1 union all SELECT * FROM ".tablename('zh_jdgjb_order')." WHERE  status=1 and type=3 and seller_id=:seller_id and uniacid=:uniacid and voice=1";
			$res=pdo_fetch($sql,array(':uniacid'=>$_GPC['uniacid'],':seller_id'=>$seller_id));
			if($res){
				echo '1';
			}else{
				echo '2';
			}
		}else {
			$sql="SELECT * FROM ".tablename('zh_jdgjb_order')." WHERE  status=2 and uniacid=:uniacid and voice=1 union all SELECT * FROM ".tablename('zh_jdgjb_order')." WHERE  status=1 and type=3 and uniacid=:uniacid and voice=1";
			$res=pdo_fetch($sql,array(':uniacid'=>$_GPC['uniacid']));

			if($res){
				echo '1';
			}else{
				echo '2';
			}
		}

	}

   //删除充值活动
    public function doMobileDelCz(){
		global $_W,$_GPC;
		$res=pdo_delete('zh_jdgjb_czhd',array('id'=>$_GPC['id']));
		if($res){
			echo '1';
		}else{
			echo '2';
		}
    }
    //添加充值活动
    public function doMobileAddCz(){
    	global $_W,$_GPC;
    	for($i=0;$i<count($_GPC['list']);$i++){
    		$data['full']=$_GPC['list'][$i]['full'];
    		$data['reduction']=$_GPC['list'][$i]['reduction'];
    		$data['uniacid']=$_W['uniacid'];
    		pdo_insert('zh_jdgjb_czhd',$data);
    	}
    }



	public function doMobileSelectUser2(){
		global $_W, $_GPC;
		$sql =" select id,name from ".tablename('zh_jdgjb_user')." where uniacid={$_W['uniacid']}  and  openid like '%{$_GPC['keywords']}%' and id not in (select user_id from".tablename('zh_jdgjb_seller')." where  uniacid={$_W['uniacid']})";    
		echo json_encode(pdo_fetchall($sql));
	}

	//获取一级
   public function doMobileGetYj(){
        global $_W,$_GPC;
        $user_id=$_GPC['user_id'];
        $sql=" select b.name as yj_name,c.name as fx_name,a.time from".tablename('zh_jdgjb_fxuser')." a left join ".tablename('zh_jdgjb_user')." b on a.fx_user=b.id left join ".tablename('zh_jdgjb_user')." c on a.user_id=c.id where a.user_id={$user_id}";
        $res=pdo_fetchall($sql);
        if($res){
        	  foreach ($res as  &$value) {
            $value['time']=date("Y-m-d H:i:s",$value['time']);
            }
        }
        //$res=pdo_getall('cjdc_fxuser',array('user_id'=>$user_id));
        echo json_encode($res);     
}
//获取二级
   public function doMobileGetEj(){
        global $_W,$_GPC;
        $user_id=$_GPC['user_id'];
        $fx=pdo_get('zh_jdgjb_user',array('id'=> $user_id),'name');
        $res=pdo_getall('zh_jdgjb_fxuser',array('user_id'=>$user_id),'fx_user');
      
        foreach ($res as $key => $value) {
              $sql=" select b.name as yj_name,a.time from".tablename('zh_jdgjb_fxuser')." a left join ".tablename('zh_jdgjb_user')." b on a.fx_user=b.id  where a.user_id={$value['fx_user']}";
        $res2=pdo_fetchall($sql);        
        if($res2){
            foreach ($res2 as $key2 => $value2) {
            $rst[$key2]['fx_name']=$fx['name'];
            $rst[$key2]['yj_name']=$value2['yj_name'];
            $rst[$key2]['time']=date("Y-m-d H:i:s",$value2['time']);
            }
          
        }     
        }
        echo json_encode($rst);
 
      
}

}
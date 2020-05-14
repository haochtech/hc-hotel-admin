<?php
//门店列表
global $_GPC, $_W;
$seller_id=$_COOKIE["storeid"];
$uid=$_COOKIE["uid"];
$GLOBALS['frames'] = $this->getNaveMenu($seller_id, $action='start',$uid);
$cur_store = $this->getStoreById($seller_id);
$uniacid=$_W['uniacid'];
$version=$_W['current_module']['version'];
if($_GPC['ac']=='getDate'){
	$start = $_GPC['start'];
	$end = $_GPC['end'];
	$btime = strtotime($start);
	$etime = strtotime($end);
	       	//print_r($_GPC);
	$days = ceil(($etime - $btime) / 86400);
	$pagesize = 9;
	$totalpage = ceil($days / $pagesize);
	$page = intval($_GPC['page']);

	if ($page > $totalpage) {
		$page = $totalpage;
	} else if ($page <= 1) {
		$page = 1;
	}
	$currentindex = ($page - 1) * $pagesize;
	$start = date('Y-m-d', strtotime(date('Y-m-d') . "+$currentindex day"));
	$btime = strtotime($start);
	$etime = strtotime(date('Y-m-d', strtotime("$start +$pagesize day")));
	$date_array = array();
	$date_array[0]['date'] = $start;
	$date_array[0]['day'] = date('j', $btime);
	$date_array[0]['time'] = $btime;
	$date_array[0]['month'] = date('m', $btime);

	for ($i = 1; $i <= $pagesize; $i++) {
		$date_array[$i]['time'] = $date_array[$i - 1]['time'] + 86400;
		$date_array[$i]['date'] = date('Y-m-d', $date_array[$i]['time']);
		$date_array[$i]['day'] = date('j', $date_array[$i]['time']);
		$date_array[$i]['month'] = date('m', $date_array[$i]['time']);
	}

	$list=pdo_fetchall("select * from ".tablename('zh_jdgjb_room')." where `uniacid`='$uniacid'  and seller_id='$seller_id' order by id desc");

	foreach ($list as $key => $value) {
		$rid=$value['id'];
		$pricearr=array();
		for($i = 0; $i <= $pagesize; $i++){
			$dateday1=$date_array[$i]['time'];
			$rplist=pdo_get('zh_jdgjb_roomnum',array('dateday'=>$dateday1,'rid'=>$rid));
        			//print_r($rplist);
			if($rplist['id']){
				$pricearr[$i]['nums']=$rplist['nums'];
				$pricearr[$i]['rid']=$value['id'];
				$pricearr[$i]['pid']=$rplist['id'];
				$pricearr[$i]['dateday']=date('Y-m-d', $date_array[$i]['time']);
			}else{
				$pricearr[$i]['nums']=$value['total_num'];
				$pricearr[$i]['dateday']=date('Y-m-d', $date_array[$i]['time']);
				$pricearr[$i]['rid']=$value['id'];
			}

		}
		$list[$key]['pricearr']=$pricearr;

	}

	$data = array();
	$data['result'] = 1;
	ob_start();
	include $this->template('web/roomnumlist');
	$data['code'] = ob_get_contents();
	ob_clean();
	die(json_encode($data));
}

$startime = time();
$firstday = date('Y-m-01', time());

$endtime = strtotime(date('Y-m-d', strtotime("$firstday +1 month +10 day")));	   
include $this->template('web/dlnumber');
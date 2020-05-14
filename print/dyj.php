<?php



include_once "print.class.php";

include_once "HttpClient.class.php";



class Dyj

{





//365打印机

	public  static function dy($deviceNo,$content,$key){

		$selfMessage = array(

			'deviceNo'=>$deviceNo,  

			'printContent'=>$content,

			'key'=>$key,

			'times'=>'1'

			);        

		$url = "http://open.printcenter.cn:8080/addOrder";
		$options = array(

			'http' => array(

				'header' => "Content-type: application/x-www-form-urlencoded ",

				'method'  => 'POST',

				'content' => http_build_query($selfMessage),

				),

			);

		$context  = stream_context_create($options);

		$result = file_get_contents($url, false, $context);



		return $result;



	}





//易联云打印机

	public  static function ylydy($api,$token,$yy_id,$mid,$content){

		$print = new Yprint();

		$apiKey = $api;

		$msign = $token;

		$partner=$yy_id;

		$machine_code=$mid;

		$result =$print->action_print( $partner,$machine_code,$content,$apiKey,$msign);

		return $result;



	}



//飞蛾打印机

	public  static function fedy($fezh,$fe_ukey,$fe_dycode,$content){

		header("Content-type: text/html; charset=utf-8");

		define('USER', $fezh); //*必填*：飞鹅云后台注册账号

		define('UKEY', $fe_ukey); //*必填*: 飞鹅云注册账号后生成的UKEY

		define('SN', $fe_dycode);    //*必填*：打印机编号，必须要在管理后台里添加打印机或调用API接口添加之后，才能调用API

		//以下参数不需要修改

		define('IP','api.feieyun.cn');      //接口IP或域名

		define('PORT',80);            //接口IP端口

		define('PATH','/Api/Open/');    //接口路径

		define('STIME', time());          //公共参数，请求时间

		define('SIG', sha1(USER.UKEY.STIME));

		function wp_print($printer_sn,$orderInfo,$times){

			$content = array(     

				'user'=>USER,

				'stime'=>STIME,

				'sig'=>SIG,

				'apiname'=>'Open_printMsg',

				'sn'=>$printer_sn,

				'content'=>$orderInfo,

        		'times'=>$times//打印次数

        );

			$client = new HttpClient(IP,PORT);

			if(!$client->post(PATH,$content)){

				echo 'error';

			}

			else{

   		 //服务器返回的JSON字符串，建议要当做日志记录起来

				echo $client->getContent();

			}



		}

		wp_print(SN,$content,1);



}















}












































































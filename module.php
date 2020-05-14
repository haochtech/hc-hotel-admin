<?php
/**
 * 酒店版模块定义
 *
 * @author 智享工场
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Zh_jdgjbModule extends WeModule {

	public function welcomeDisplay()

    {   
    	global $_GPC, $_W;
        $url = $this->createWebUrl('ptdata');
        if ($_W['role'] == 'operator') {
        	$url = $this->createWebUrl('hotel');
        }

        Header("Location: " . $url);

    }

}
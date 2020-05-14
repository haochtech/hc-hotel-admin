<?php
/**
 * 
 */
global $_GPC, $_W;
load()->func('tpl');
$action = 'settings';
$GLOBALS['frames'] = $this->getMainMenu($storeid,$action);
$title = $this->actions_titles[$action];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$stores=pdo_getall('zh_jdgjb_seller',array('uniacid'=>$_W['uniacid'],'state'=>2));
if ($operation == 'display') {
    $item = pdo_fetch("SELECT * FROM ". tablename('zh_jdgjb_system') . " WHERE uniacid = :weid", array('weid' => $_W['uniacid']));
  
   if($_GPC['color']){
        $color=$_GPC['color'];
    }else{
         $color="#182E8F";
    }
    if (checksubmit()) {   
        $data = array(     
            'pt_name' => $_GPC['pt_name'],
            'tel' => trim($_GPC['tel']),
            'is_sjrz' => $_GPC['is_sjrz'],
            'type' => $_GPC['type'],
            'uniacid' => $_W['uniacid'],
            'hy_rule'=>html_entity_decode($_GPC['hy_rule']),
            'jf_rule'=>html_entity_decode($_GPC['jf_rule']),
             'hy_img'=>$_GPC['hy_img'],
             'seller_id'=>$_GPC['seller_id'], 
            'bj_logo'=>$_GPC['bj_logo'],
            'color'=>$color,
            'open_member'=>$_GPC['open_member'],
            'is_sfz'=>$_GPC['is_sfz'],
            'is_order'=>$_GPC['is_order'],
            'is_score'=>$_GPC['is_score'],
            'jd_custom'=>$_GPC['jd_custom'],
            'openCity'=>$_GPC['openCity']
                  
        );

        if($_GPC['type']==1){
            if(empty($_GPC['seller_id'])){
                message('请选择所属酒店','','error');
        }
    }
        if (empty($item)) {
            pdo_insert('zh_jdgjb_system', $data, $replace = false);
            message('操作成功!', $this->createWebUrl('settings', array('op' => 'display', 'storeid' => $storeid)), 'success');
        } else {
            pdo_update('zh_jdgjb_system', $data, array('id' => $item['id']));
            message('操作成功!', $this->createWebUrl('settings', array('op' => 'display', 'storeid' => $storeid)), 'success');
        }
    }
}
include $this->template('web/settings');
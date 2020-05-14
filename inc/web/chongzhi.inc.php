<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$list=pdo_getall('zh_jdgjb_czhd',array('uniacid'=>$_W['uniacid']));
include $this->template('web/chongzhi');
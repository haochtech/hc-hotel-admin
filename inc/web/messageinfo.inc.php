<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();

		$sql="select a.* ,b.name,c.title,c.content as zxcontent from " . tablename("zh_gjhdbm_assess") ." a" . " left join " . tablename("zh_gjhdbm_user") . "b on b.id=a.user_id"  . " left join " . tablename("zh_gjhdbm_activity") . " c on c.id=a.activity_id where a.uniacid=:uniacid and a.id=:id";
		$list=pdo_fetch($sql, array(':uniacid'=>$_W['uniacid'],':id'=>$_GPC['id']));
		include $this->template('web/messageinfo');
	


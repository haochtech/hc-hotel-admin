<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();

$pageindex = max(1, intval($_GPC['page']));
$pagesize=15;
$sql="select a.* ,b.name,b.img from " . tablename("zh_jdgjb_recharge") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id"." where  b.uniacid = :uniacid and a.state=2 and ( a.note='在线充值' or a.note='后台充值' ) order by a.id asc";
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list = pdo_fetchall($select_sql,array(':uniacid'=>$_W['uniacid']));	   
$total=pdo_fetchcolumn("select count(*) from " . tablename("zh_jdgjb_recharge") . " a"  . " left join " . tablename("zh_jdgjb_user") . " b on b.id=a.user_id where  b.uniacid = :uniacid and a.state=2 and ( a.note='在线充值' or a.note='后台充值') ",array(':uniacid'=>$_W['uniacid']));
$pager = pagination($total, $pageindex, $pagesize);
include $this->template('web/czjl');

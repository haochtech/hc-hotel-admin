<?php
global $_GPC, $_W;

$GLOBALS['frames'] = $this->getMainMenu();
 $pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$where=" where activity_id=:activity_id and user_id=:user_id and status=1";
$data[':activity_id']=$_GPC['activity_id'];
$data[':user_id']=$_GPC['user_id'];
$sql="SELECT * FROM ".tablename('zh_gjhdbm_bmlist') . $where." ORDER BY id DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('zh_gjhdbm_bmlist') . $where,$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);
include $this->template('web/pjlist');
<?php
#require_once 'spider.php';
session_start();
$_SESSION = array();
require_once 'lib/common.php';

$smarty = new Smarty();
if ($admin_info) {
  $smarty -> assign('company', $admin_info['company']);
  $smarty -> assign('tel', $admin_info['tel']);
  $smarty -> assign('address', $admin_info['address']);
  $smarty -> display('index.tpl');
}
?>

<?php
session_start();
$_SESSION = array();
require_once 'lib/common.php';

$smarty = new Smarty();
if ($admin_info) {
  $smarty -> assign('company', $admin_info['company']);
  $smarty -> display('admin-index.tpl');
}
?>
<?php
require 'lib/common.php';
sess_load('admin_login');
sess_load("loginLogFactory");

if ($admin_login === "true") {
  $smarty = new Smarty();
  smarty_load_header($smarty);
  smarty_load_login_log($smarty);
  $smarty -> display('admin-login-list.tpl');
}
?>
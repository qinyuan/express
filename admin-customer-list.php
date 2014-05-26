<?php
require 'lib/common.php';
sess_load('admin_login');
sess_load("customerFactory");

if ($admin_login === "true") {
  $smarty = new Smarty();
  smarty_load_header($smarty);
  smarty_load_customers($smarty);
  $smarty -> display('admin-customer-list.tpl');
}
?>
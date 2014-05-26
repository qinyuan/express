<?php
require 'lib/common.php';
sess_load('admin_login');
sess_load("orderFactory");

if ($admin_login === "true") {
  $smarty = new Smarty();
  smarty_load_header($smarty);
  smarty_load_customer_select($smarty, $orderFactory -> getCusId(), true);
  smarty_load_orders($smarty);
  $smarty -> display('admin-order-list.tpl');
}
?>
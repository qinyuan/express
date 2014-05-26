<?php
require_once 'lib/common.php';

sess_load("customer");
sess_load("orderFactory");

if ($admin_info) {
  $smarty = new Smarty();
  $smarty -> assign('cus_name', $customer['cus_name']);
  smarty_load_orders($smarty);
  $smarty -> display('order-list.tpl');
}
?>

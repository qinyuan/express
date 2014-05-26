<?php
require 'lib/common.php';
sess_load('admin_login');
$smarty = new Smarty();

if (isset($_POST['addOrderSubmit'])) {
  $order = create_order_by_post($_POST);
  add_order($order);
  $smarty -> assign("added_order_no", $order['order_no']);
} else {
  $order = get_empty_order();
}

smarty_load_header($smarty);
smarty_load_customer_select($smarty, $order['cus_id'], false, true);
foreach ($order as $key => $value) {
  $smarty -> assign($key, $value);
}
$smarty -> display('admin-order-add.tpl');
?>
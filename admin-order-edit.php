<?php
require 'lib/common.php';
sess_load('admin_login');

if (isset($_POST['mdfOrder'])) {
  $order = create_order_by_post($_POST);
  update_order($order, $admin_info['id']);
  header('Location:admin-order-list.php');
  die();
}

if (isset($_GET['orderId'])) {
  $order_id = $_GET['orderId'];
  if (preg_match("/^\d+$/", $order_id)) {
    $order_id = intval($order_id);
    $order = select_order_by_id($order_id, $admin_info['id']);
    if ($order) {
      $smarty = new Smarty();
      smarty_load_header($smarty);
      smarty_load_customer_select($smarty, $order['cus_id']);
      foreach ($order as $key => $value) {
        $smarty -> assign($key, $value);
      }
      $smarty -> display('admin-order-edit.tpl');
    }
  }
}
?>
<?php
require 'lib/common.php';
sess_load('admin_login');

if (isset($_POST['orderId'])) {
  $order_id = $_POST['orderId'];
  if (preg_match("/^\d+$/", $order_id)) {
    if (delete_order_by_id(intval($order_id), $admin_info['id'])) {
      echo 'success';
    } else {
      echo 'error:Êý¾Ý¿â²Ù×÷Ê§°Ü';
    }
  }
}
?>
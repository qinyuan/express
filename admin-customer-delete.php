<?php
require 'lib/common.php';
sess_load('admin_login');

if (isset($_POST['cusId'])) {
  $cus_id = $_POST['cusId'];
  if (preg_match("/^\d+$/", $cus_id)) {
    if (delete_customer_by_id(intval($cus_id))) {
      echo 'success';
    } else {
      echo 'error:Êý¾Ý¿â²Ù×÷Ê§°Ü';
    }
  }
}
?>
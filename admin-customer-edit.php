<?php
require 'lib/common.php';
sess_load('admin_login');

if (isset($_POST['editCustomerSubmit'])) {
  $customer = create_customer_by_post($_POST);
  update_customer($customer);
  header('Location:admin-customer-list.php');
  die();
}

if (isset($_GET['cusId'])) {
  $cus_id = $_GET['cusId'];
  if (preg_match("/^\d+$/", $cus_id)) {
    $cus_id = intval($cus_id);
    $customer = select_customer_by_id($cus_id);
    if ($customer) {
      $smarty = new Smarty();
      smarty_load_header($smarty);
      foreach ($customer as $key => $value) {
        $smarty -> assign($key, $value);
      }
      $smarty -> display('admin-customer-edit.tpl');
    }
  }
}
?>
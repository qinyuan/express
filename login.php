<?php
require_once 'lib/common.php';

if (!(isset($_POST['username']) && isset($_POST['password']))) {
  header('Location:index.php');
  die();
}

$username = ch_filter($_POST['username']);
$password = en_filter($_POST['password']);

$customer = select_customer_by_ident($username, $password);
if ($customer) {
  sess_persist('customer');
  insert_login_log($username);

  $orderFactory = new OrderFactory();
  $orderFactory -> setCusId($customer['cus_id']);
  sess_persist('orderFactory');

  header('Location:order-list.php');
  die();
}

$smarty = new Smarty();
$smarty -> display('login-error.tpl');
?>
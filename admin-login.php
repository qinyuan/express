<?php
require 'lib/common.php';

if (!(isset($_POST['username']) && isset($_POST['password']))) {
  header('Location:admin-index.php');
  die();
}

$username = ch_filter($_POST['username']);
$password = en_filter($_POST['password']);

if ($username === $admin_info['username'] && $password === $admin_info['password']) {
  $admin_login = "true";
  sess_persist("admin_login");

  $orderFactory = new OrderFactory();
  $orderFactory -> setAdminMode(true);
  sess_persist('orderFactory');
  
  $customerFactory = new CustomerFactory();
  sess_persist('customerFactory');
  
  $loginLogFactory = new LoginLogFactory();
  sess_persist('loginLogFactory');

  header('Location:admin-order-list.php');
  die();
}

$smarty = new Smarty();
$smarty -> display('login-error.tpl');
?>
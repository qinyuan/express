<?php
require_once 'lib/common.php';
sess_load('admin_login');
require_once 'order-list-change-common.php';

if (isset($_GET['cusId'])) {
  $cus_id = $_GET['cusId'];
  $orderFactory -> setCusId($cus_id);
}

sess_persist("orderFactory");
header('Location:admin-order-list.php');
?>
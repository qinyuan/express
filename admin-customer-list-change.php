<?php
require_once 'lib/common.php';
sess_load('admin_login');
sess_load('customerFactory');

if (isset($_GET['pageNum'])) {
  $pageNum = intval($_GET['pageNum']);
  $customerFactory -> setPageNum($pageNum);
}

sess_persist("customerFactory");
header('Location:admin-customer-list.php');
?>
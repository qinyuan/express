<?php
require_once 'lib/common.php';
sess_load('admin_login');
sess_load('loginLogFactory');

if (isset($_GET['pageNum'])) {
  $pageNum = intval($_GET['pageNum']);
  $loginLogFactory -> setPageNum($pageNum);
}

sess_persist("loginLogFactory");
header('Location:admin-login-list.php');
?>
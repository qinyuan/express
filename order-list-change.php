<?php
require_once 'lib/common.php';
sess_load("customer");
require_once 'order-list-change-common.php';
sess_persist("orderFactory");
header('Location:order-list.php');
?>
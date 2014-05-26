<?php
sess_load("orderFactory");
if (isset($_GET['endDate'])) {
  $endDate = $_GET['endDate'];
  if ($endDate == "null") {
    $orderFactory -> setEndDate(null);
  } else {
    $orderFactory -> setEndDate($endDate);
  }
}

if (isset($_GET['startDate'])) {
  $startDate = $_GET['startDate'];
  if ($startDate == "null") {
    $orderFactory -> setStartDate(null);
  } else {
    $orderFactory -> setStartDate($startDate);
  }
}

if (isset($_GET['pageNum'])) {
  $pageNum = intval($_GET['pageNum']);
  $orderFactory -> setPageNum($pageNum);
}

if (isset($_GET['searchStr'])) {
  $searchStr = $_GET['searchStr'];
  $orderFactory -> setSearchStr($searchStr);
}
?>
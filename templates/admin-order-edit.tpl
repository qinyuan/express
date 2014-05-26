<!DOCTYPE html>
<html>
<head>
  {include file="meta_charset.tpl"}
  <title>ÐÞ¸Ä¶©µ¥</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-form.css" type="text/css" />
</head>
<body>
<div class="body">
  {include file="admin-header.tpl"}
  <div class="content">
    <form action="{$smarty.server.PHP_SELF}" method="post">
      <input type="hidden" name="orderId" value="{$order_id}" />
      {include file="admin-order-table.tpl"}
      <input type="submit" id="mdfOrder" name="mdfOrder" value="ÐÞ    ¸Ä" />
    </form>
  </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/DatePicker/WdatePicker.js"></script>
<script src="js/common.js"></script>
<script src="js/admin-order-edit.js"></script>
</html>
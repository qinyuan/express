<!DOCTYPE html>
<html>
<head>
  {include file="meta_charset.tpl"}
  <title>��Ӷ���</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-form.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-order-add.css" type="text/css" />
</head>
<body>
<div class="body">
  {include file="admin-header.tpl"}
  <div class="content">
    <form action="{$smarty.server.PHP_SELF}" method="post">
      {include file="admin-order-table.tpl"}
      <input type="submit" name="addOrderSubmit" id="addOrderSubmit" value="��  ��" />
    </form>
  </div>
  {if isset($added_order_no)}
    <input type="hidden" id="addResult" value="����{$added_order_no}��ӳɹ�" />
  {/if}
  <div id="optionalInputDiv">
  </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/DatePicker/WdatePicker.js"></script>
<script src="js/common.js"></script>
<script src="js/json/json2.js"></script>
<script src="js/admin-order-add.js"></script>
</html>

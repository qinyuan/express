<!DOCTYPE html>
<html>
<head>
  {include file="meta_charset.tpl"}
  <title>�޸Ŀͻ���Ϣ</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-form.css" type="text/css" />
</head>
<body>
<div class="body">
  {include file="admin-header.tpl"}
  <div class="content">
    <form action="{$smarty.server.PHP_SELF}" method="post">
      <input type="hidden" name="cusId" value="{$cus_id}" />
      {include file="admin-customer-table.tpl"}
      <input type="submit" id="editCustomerSubmit" name="editCustomerSubmit" value="��    ��" />
    </form>
  </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/common.js"></script>
</html>
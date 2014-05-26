<!DOCTYPE html>
<html>
<head>
  {include file="meta_charset.tpl"}
  <title>修改客户信息</title>
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
      <input type="submit" id="editCustomerSubmit" name="editCustomerSubmit" value="修    改" />
    </form>
  </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/common.js"></script>
</html>
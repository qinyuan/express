<!DOCTYPE html>
<html>
<head>
  {include file="meta_charset.tpl"}
  <title>添加客户</title>
  <link rel="stylesheet" href="css/common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-common.css" type="text/css" />
  <link rel="stylesheet" href="css/admin-form.css" type="text/css" />
</head>
<body>
<div class="body">
  {include file="admin-header.tpl"}
  <div class="content">
    <form action="{$smarty.server.PHP_SELF}" method="post">
      {include file="admin-customer-table.tpl"}
      <input type="submit" name="addCustomerSubmit" id="addCustomerSubmit" value="添    加" />
    </form>
    {if isset($added_result)}
      <input type="hidden" id="addResult" value="{$added_result}" />
    {/if}
  </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/common.js"></script>
<script src="js/json/json2.js"></script>
<script src="js/admin-customer-add.js"></script>
</html>
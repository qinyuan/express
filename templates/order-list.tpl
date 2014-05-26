<!DOCTYPE html>
<html>
<head>
  {include file="order-list-head.tpl"}
</head>
<body>
<div class="body">
  <div id="background"><img src="css/img/background.jpg" /></div>
  <div class="header">
    <div>
      {include file="order-filter.tpl"}
      <div class="exit">
        {if isset($cus_name)}[{$cus_name}]&nbsp;&nbsp;&nbsp;{/if}
        <span><a id="editCusPassword" href="javascript:void(0)">ĞŞ¸ÄÃÜÂë</a></span>
        <span><a href="logout.php">ÍË³ö</a></span>
      </div>
    </div>
  </div>
  <div class="contentBack"></div>
  {include file="pagination-table.tpl"}
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/easyui/jquery.easyui.min.js"></script>
<script src="js/DatePicker/WdatePicker.js"></script>
<script src="js/common.js"></script>
<script src="js/order-list.js"></script>
</html>
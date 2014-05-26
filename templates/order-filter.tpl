<div class="filter">
  订单筛选>>&nbsp;&nbsp;
  {if isset($customers)}
    客户名称：
    {include file="customer-select.tpl"}
    &nbsp;&nbsp;
  {/if}
  {include file="period_form.tpl"}
 
  <div id="searchDiv">			
    <span id="searchSpan">查找：</span>
    <input id="searchReceiver" value="{$search_str}" />
  </div>
</div>
<div class="filter">
  ����ɸѡ>>&nbsp;&nbsp;
  {if isset($customers)}
    �ͻ����ƣ�
    {include file="customer-select.tpl"}
    &nbsp;&nbsp;
  {/if}
  {include file="period_form.tpl"}
 
  <div id="searchDiv">			
    <span id="searchSpan">���ң�</span>
    <input id="searchReceiver" value="{$search_str}" />
  </div>
</div>
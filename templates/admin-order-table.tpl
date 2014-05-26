<table class="formInput">
  <tr>
    <td>客户: </td>
    <td>{include file="customer-select.tpl"}</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>货运单号</td>
    <td><input type="text" id="orderNo" name="orderNo" value="{$order_no}" /></td>
    <td>发货人</td>
    <td><input type="text" id="consigner" name="consigner" value="{$consigner}" /></td>
  </tr>
  <tr>
    <td>收货人</td>
    <td><input type="text" id="receiver" name="receiver" value="{$receiver}" /></td>
    <td>义乌电话</td>
    <td><input type="text" id="yiwuTel" name="yiwuTel" value="{$yiwu_tel}" /></td>
  </tr>
  <tr>
    <td>收货地址</td>
    <td><input type="text" id="delivery" name="delivery" value="{$delivery}" /></td>
    <td>提货电话</td>
    <td><input type="text" id="deliveryTel" name="deliveryTel" value="{$delivery_tel}" /></td>
  </tr>
  <tr>
    <td>代收货款</td>
    <td><input type="text" id="payment" name="payment" value="{$payment}" /></td>
	<td>垫付运费</td>
	<td><input type="text" id="fare" name="fare" value="{$fare}" /></td>
  </tr>
  <tr>
    <td>件数</td>
    <td><input type="text" id="itemCount" name="itemCount" value="{$item_count}" /></td>
    <td>发货日期</td>
    <td><input type="text" class="dateInput" id="sendDate" name="sendDate" 
    	value="{$send_date}" readonly="readonly" /></td>
  </tr>
</table>
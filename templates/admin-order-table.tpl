<table class="formInput">
  <tr>
    <td>�ͻ�: </td>
    <td>{include file="customer-select.tpl"}</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>���˵���</td>
    <td><input type="text" id="orderNo" name="orderNo" value="{$order_no}" /></td>
    <td>������</td>
    <td><input type="text" id="consigner" name="consigner" value="{$consigner}" /></td>
  </tr>
  <tr>
    <td>�ջ���</td>
    <td><input type="text" id="receiver" name="receiver" value="{$receiver}" /></td>
    <td>���ڵ绰</td>
    <td><input type="text" id="yiwuTel" name="yiwuTel" value="{$yiwu_tel}" /></td>
  </tr>
  <tr>
    <td>�ջ���ַ</td>
    <td><input type="text" id="delivery" name="delivery" value="{$delivery}" /></td>
    <td>����绰</td>
    <td><input type="text" id="deliveryTel" name="deliveryTel" value="{$delivery_tel}" /></td>
  </tr>
  <tr>
    <td>���ջ���</td>
    <td><input type="text" id="payment" name="payment" value="{$payment}" /></td>
	<td>�渶�˷�</td>
	<td><input type="text" id="fare" name="fare" value="{$fare}" /></td>
  </tr>
  <tr>
    <td>����</td>
    <td><input type="text" id="itemCount" name="itemCount" value="{$item_count}" /></td>
    <td>��������</td>
    <td><input type="text" class="dateInput" id="sendDate" name="sendDate" 
    	value="{$send_date}" readonly="readonly" /></td>
  </tr>
</table>
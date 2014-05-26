<?php
require 'lib/common.php';
sess_load('admin_login');

$smarty = new Smarty();
if (isset($_POST['addCustomerSubmit'])) {
  $customer = create_customer_by_post($_POST);
  if (exists_customer($customer['cus_name'])){
    $smarty -> assign("added_result", "客户 {$customer['cus_name']} 已存在，添加失败！");  } else {
    add_customer($customer);
    $smarty -> assign("added_result", "客户 {$customer['cus_name']} 添加成功");  }
} else {
  $customer = get_empty_customer();
}

smarty_load_header($smarty);
foreach ($customer as $key => $value) {
  $smarty -> assign($key, $value);
}
$smarty -> display('admin-customer-add.tpl');
?>
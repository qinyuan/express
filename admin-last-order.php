<?php
require 'lib/common.php';
sess_load('admin_login');

if ($admin_login === "true") {
    $group_fields = array('cus_id','consigner','receiver');
    $value_fields = array('delivery','yiwu_tel','delivery_tel');
    print_r(select_last_orders($group_fields, $value_fields));
}
?>
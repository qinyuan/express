<?php
header("Content-type: text/html; charset=gbk");
require 'lib/common.php';
sess_load('admin_login');

if ($admin_login === "true") {
    $group_fields = array('cus_id','consigner','receiver');
    $value_fields = array('delivery','yiwu_tel','delivery_tel');
    $debug = (isset($_GET['debug']) && $_GET['debug'] > 0);
    $json = create_latest_orders_json($group_fields, $value_fields, $debug);
    if ($debug) {
        print_r($json);
    } else {
        echo urldecode($json);
    }
}
?>

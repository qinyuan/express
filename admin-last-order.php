<?php
require 'lib/common.php';
sess_load('admin_login');

if ($admin_login === "true") {
    print_r(select_last_orders());
}
?>
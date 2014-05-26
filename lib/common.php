<?php
require_once 'lib/functions.php';
require_once 'lib/config.php';
require_once 'lib/MyPdo.class.php';
require_once 'sql/TableRowFactory.class.php';
require_once 'sql/CustomerFactory.class.php';
require_once 'sql/LoginLogFactory.class.php';
require_once 'sql/OrderFactory.class.php';
require_once 'sql/sql.php';
require_once 'Smarty/Smarty.class.php';

date_default_timezone_set('Asia/Shanghai');
if (!session_id()) {
  session_start();
}

load_admin_info();
?>
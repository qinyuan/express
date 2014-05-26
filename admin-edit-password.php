<?php
require_once 'lib/common.php';
sess_load("admin_login");

if ($admin_login === "true" && isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
  $old_password = $_POST['oldPassword'];
  if ($old_password !== $admin_info['password']) {
    echo '0';
  } else {
    update_admin_password($_POST['newPassword']);
    echo '1';
  }
}
?>

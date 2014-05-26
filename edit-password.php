<?php
require_once 'lib/common.php';

sess_load("customer");
if (isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
  $old_password = $_POST['oldPassword'];
  if ($old_password !== $customer['password']) {
    echo '0';
  } else {
    update_cus_password($_POST['newPassword']);
    echo '1';
  }
}
?>

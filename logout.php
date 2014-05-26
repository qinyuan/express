<?php
if (isset($_GET['isAdmin'])) {
  header('Location:admin-index.php');
} else {
  header('Location:index.php');
}
?>
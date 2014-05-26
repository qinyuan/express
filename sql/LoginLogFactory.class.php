<?php
class LoginLogFactory implements TableRowFactory{
  private $pageSize = 15;
  private $pageNum = 1;
  private $pagination;
	
  function getRows() {
  	if ($this -> pageNum <=0) {
      return array();
  	}
  	$admin_id = get_admin_id();
  	$startRow = ($this -> pageNum - 1) * $this -> pageSize;
  	$query="SELECT * FROM login_record WHERE admin_id=$admin_id "
  	  . "ORDER BY login_time DESC LIMIT $startRow,{$this -> pageSize}";
  	$pdo = new MyPdo();
  	$pdo -> query($query);
  	$rows = array();
  	$keys = array('cus_name', 'login_time');
  	while ($row = $pdo -> fetch()) {
  	  $rows[] = array(
  	    'id' => $row['id'],
  	    'texts' => array_key_slice($row, $keys)
      );
    }
    return $rows;
  }
	
  function setPageNum($pageNum) {
  	$this -> pageNum = $pageNum;
  }
  
  function getPageSize() {
  	return $this -> pageSize;
  }

  function getPageNum() {
  	return $this -> pageNum;
  }
  
  function getTableHeads() {
  	$ths = array();
    $ths[] = array('class' => 'widest', 'text' => '客户名称');
    $ths[] = array('class' => 'widest', 'text' => '访问时间');
    return $ths;
  }
  
  function getRowCount() {
  	$admin_id = get_admin_id();
  	$cnn = new MyPdo();
  	$query = "SELECT COUNT(*) FROM login_record WHERE admin_id=$admin_id";
  	$cnn -> query($query);
  	$row = $cnn -> fetch();
  	return $row[0];
  }
  
  function getChangePageHref() {
  	return 'admin-login-list-change.php';
  }
}
?>
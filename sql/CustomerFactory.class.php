<?php
class CustomerFactory implements TableRowFactory{
  private $pageSize = 15;
  private $pageNum = 1;
	
  function getPageSize() {
  	return $this -> pageSize;
  }
	
  function getPageNum() {
  	return $this -> pageNum;
  }
	
  function getTableHeads() {
  	$ths = array();
    $ths[] = array('class' => 'widest', 'text' => '客户名称');
    $ths[] = array('class' => 'widest', 'text' => '密码');
    $ths[] = array('class' => 'widest', 'text' => '联系方式');
    $ths[] = array('class' => 'widest', 'text' => '总订单数');
    $ths[] = array('class' => 'nar', 'text' => '操作');
    return $ths;
  }
	
  function getRows() {
  	if ($this -> pageNum <=0) {
      return array();
  	}
  	$admin_id = get_admin_id();
    $startRow = ($this -> pageNum - 1) * $this -> getPageSize();
    $subQuery="SELECT COUNT(order_id) AS order_count,cus_id "
	  . "FROM orderitem WHERE admin_id=$admin_id GROUP BY cus_id";
    $query = "SELECT * FROM customer AS c LEFT JOIN ($subQuery) AS o"
      . " USING(cus_id) WHERE admin_id=$admin_id"
      . " ORDER BY c.cus_id LIMIT $startRow,{$this -> getPageSize()}";
    $pdo = new MyPdo();
    $pdo -> query($query);
    $rows = array();
	$keys = array('cus_name', 'password', 'tel', 'order_count');
    while ($row = $pdo -> fetch()) {
      $r = array(
        'id' => $row['cus_id'],
        'texts' => array_key_slice($row, $keys),
        'with_handle' => true
	  );
	  if ($r['texts']['order_count'] > 0) {
	    $r['no_delete'] = true;	
	  }
	  $rows[] = $r;
	}
    return $rows;
  }
	
  function setPageNum($pageNum) {
    $this -> pageNum = $pageNum;
  }

  function getRowCount() {
  	$admin_id = get_admin_id();
    $cnn = new MyPdo();
    $query = "SELECT COUNT(*) FROM customer WHERE admin_id=$admin_id";
    $cnn -> query($query);
    $row = $cnn -> fetch();
    return $row[0];
  }
  
  function getChangePageHref() {
  	return 'admin-customer-list-change.php';
  }
}
?>
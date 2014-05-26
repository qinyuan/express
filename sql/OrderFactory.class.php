<?php
class OrderFactory implements TableRowFactory {
  private $pageSize = 15;
  private $cusId = null;
  private $pageNum = 1;
  private $startDate = null;
  private $endDate = null;
  private $searchStr = null;
  private $adminMode = false;

  function getCusId() {
    return $this -> cusId;
  }
  
  function getChangePageHref() {
  	return $this -> adminMode ? 'admin-order-list-change.php' : 'order-list-change.php';
  }

  function getEndDate() {
    return $this -> endDate;
  }

  function getPageNum() {
    return $this -> pageNum;
  }
  
  function getPageSize() {
    return $this -> pageSize;	
  }

  function getRows() {
  	if ($this -> pageNum <=0) {
      return array();
  	}
    $query = "SELECT * FROM orderitem AS oi ";
    if ($this -> adminMode) {
      $query .= "LEFT JOIN customer AS c ON oi.cus_id=c.cus_id ";
    }
	$start_row = ($this -> pageNum - 1) * $this -> pageSize;
    $query .= "{$this -> getWhereClause()} ORDER BY order_id DESC LIMIT " 
      . "$start_row,{$this -> pageSize}";
	
    $keys = array('order_no', 'consigner', 'receiver', 
      'yiwu_tel', 'delivery', 'delivery_tel', 'payment', 
      'fare', 'item_count', 'send_date');
	if($this -> adminMode){
	  array_unshift($keys, 'cus_name');
	}

    $cnn = new MyPdo();
    $cnn -> query($query);
	$rows = array();
    while ($row = $cnn -> fetch()) {
      $rows[] = array(
        'id' => $row['order_id'],
        'texts' => array_key_slice($row, $keys),
        'with_handle' => $this->adminMode
	  );
    }
    return $rows;
  }

  function getRowCount() {
    $cnn = new MyPdo();
	$query = "SELECT COUNT(*) FROM orderitem ";
	if ($this -> adminMode) {
		$query .= "AS oi LEFT JOIN customer AS c ON oi.cus_id=c.cus_id";
	}
    $query .= $this -> getWhereClause();
    $cnn -> query($query);
    $row = $cnn -> fetch();
    return $row[0];
  }

  function getSearchStr() {
    return $this -> searchStr;
  }

  function getStartDate() {
    return $this -> startDate;
  }
  
  function getTableHeads() {
  	$ths = array();
  	if ($this -> adminMode) {
  	  $ths[] = array('class' => 'wider', 'text' => '客户名称');
  	}
	$ths[] = array('class' => 'wide', 'text' => '货运单号');
	$ths[] = array('class' => 'wide', 'text' => '发货人');
	$ths[] = array('class' => 'wider', 'text' => '收货人');
	$ths[] = array('class' => 'wider', 'text' => '义乌电话');
	$ths[] = array('class' => 'wide', 'text' => '收货地址');
	$ths[] = array('class' => 'wider', 'text' => '提货电话');
	$ths[] = array('class' => 'mid', 'text' => '代收货款');
	$ths[] = array('class' => 'mid', 'text' => '垫付货款');
	$ths[] = array('class' => 'nar', 'text' => '件数');
	$ths[] = array('class' => 'wide', 'text' => '发货日期');
	if ($this -> adminMode) {
      $ths[] = array('class' => 'nar', 'text' => '操作');
	}
	return $ths;
  }
  
  function setAdminMode($adminMode){
  	$this -> adminMode = $adminMode;
  }

  function setCusId($cusId) {
    $this -> cusId = $cusId;
    $this -> updateFilter();
  }

  function setEndDate($endDate) {
    $this -> endDate = $endDate;
    $this -> updateFilter();
  }

  function setPageNum($pageNum) {
    $this -> pageNum = $pageNum;
  }

  function setSearchStr($searchStr) {
    $this -> searchStr = $searchStr;
    $this -> updateFilter();
  }

  function setStartDate($startDate) {
    $this -> startDate = $startDate;
    $this -> updateFilter();
  }

  private function updateFilter() {
    $this -> pageNum = 1;
  }

  private function getWhereClause() {
  	$admin_id = get_admin_id();
	$order_table = ($this -> adminMode ? "oi." : "");
    $o = " WHERE {$order_table}admin_id=$admin_id ";

    if (!empty($this -> cusId)) {
      $o .= " AND {$order_table}cus_id=$this->cusId";
    }
    if (!empty($this -> startDate)) {
      $o .= " AND send_date>='$this->startDate'";
    }
    if (!empty($this -> endDate)) {
      $o .= " AND send_date<='$this->endDate'";
    }
    if (!empty($this -> searchStr)) {
      $o .= ' AND (FALSE ';
      $charFields = array('order_no', 'consigner', 'receiver', 
        'delivery', 'yiwu_tel', 'delivery_tel', 
        'payment', 'fare', 'item_count');
	  if ($this -> adminMode) {
	  	$charFields[] = 'c.cus_name';
	  }
      $searchStrs = preg_split("/\s+/", $this -> searchStr);
      foreach ($searchStrs as $ss) {
        foreach ($charFields as $field) {
          $o .= " OR $field LIKE '%$ss%'";
        }
      }
      $o .= ')';
    }
    return $o;
  }
}
?>
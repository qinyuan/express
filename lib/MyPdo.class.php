<?php
class MyPdo {
  private $mysqli;
  private $result;

  function __construct() {
    global $conf;
	if(!$conf){
		die('缺少数据库配置参数');
	}
    $ds = $conf['datasource'];
    $this -> mysqli = new mysqli($ds['url'], $ds['user'], $ds['password'], $ds['dbname']);
    if (!$this -> mysqli) {
      die('数据库连接失败！');
    }
    $this -> mysqli -> query("SET NAMES 'gbk'");
  }

  function fetch() {
    return $this -> result -> fetch_array(MYSQLI_BOTH);
  }

  function query($query) {
    $this -> result = $this -> mysqli -> query($query);
    if (!$this -> result) {
      die("数据库操作/查询失败" . $this -> mysqli -> error);
    }
  }
}
?>
<?php
class MyPdo {
  private $mysqli;
  private $result;

  function __construct() {
    global $conf;
	if(!$conf){
		die('ȱ�����ݿ����ò���');
	}
    $ds = $conf['datasource'];
    $this -> mysqli = new mysqli($ds['url'], $ds['user'], $ds['password'], $ds['dbname']);
    if (!$this -> mysqli) {
      die('���ݿ�����ʧ�ܣ�');
    }
    $this -> mysqli -> query("SET NAMES 'gbk'");
  }

  function fetch() {
    return $this -> result -> fetch_array(MYSQLI_BOTH);
  }

  function query($query) {
    $this -> result = $this -> mysqli -> query($query);
    if (!$this -> result) {
      die("���ݿ����/��ѯʧ��" . $this -> mysqli -> error);
    }
  }
}
?>
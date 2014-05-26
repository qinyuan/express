<?php
function get_host_name() {
  if (isset($_SERVER['HTTP_HOST'])) {
    return $_SERVER['HTTP_HOST'];
  } else if (isset($_SERVER['SERVER_NAME'])) {
    return $_SERVER['SERVER_NAME'];
  } else {
    return null;
  }
}

function ch_filter($input) {
  return preg_replace("/[<>&%]/", "", $input);
}

function en_filter($input) {
  return preg_replace("/[^a-zA-Z0-9]/", "", $input);
}

function get_files_by_dir($path) {
  $arr = array();

  if (!is_dir($path)) {
    return $arr;
  }

  $dir = dir($path);
  while ($file = $dir -> read()) {
    if ($file != "." && $file != ".." && is_file("$path/$file")) {
      $arr[] = $path . '/' . $file;
    }
  }
  $dir -> close();

  return $arr;
}

function array_key_slice($arr, $keys) {
  $result = array();
  foreach ($keys as $from => $to) {
  	if (gettype($from) === 'string'){
  	  $result[$to] = $arr[$from];
  	} else {
      $result[$to] = $arr[$to];
  	}
  }
  return $result;
}

function sess_persist($var_name){
  global ${$var_name};
  $_SESSION[$var_name] = serialize(${$var_name});
}

function sess_load($var_name) {
  global ${$var_name};
  if (!isset($_SESSION[$var_name])) {
  	$request_file = basename($_SERVER['PHP_SELF']);
  	$location = preg_match("/^admin-.*$/", $request_file) ? "admin-index.php" : "index.php";
    header("Location:$location");
    die();
  } else {
    ${$var_name} = unserialize($_SESSION[$var_name]);
  }
  return ${$var_name};
}

function load_admin_info(){
  global $admin_info;
  $host_name = get_host_name();
  if(isset($_SESSION['admin_info'])){
  	sess_load('admin_info');
	if($admin_info['host_name'] === $host_name){
	  return;
	}
  }
  $admin_info = select_admin_by_host($host_name);
  sess_persist('admin_info');
}

function get_navigation_array(){
  global $conf;
  $request_file = basename($_SERVER['PHP_SELF']);
  $navigation = $conf['navigation']; 
  $navigation_array = array();
  foreach($navigation as $text => $href){
  	$current = ($href === $request_file) ? true : false;
	$navigation_array[] = array(
	  'text' => $text,
	  'href' => $href,
	  'current' => $current
	);
  }
  return $navigation_array;
}

function smarty_load_pagination_table(&$smarty, TableRowFactory $fc) {
  $row_count = $fc -> getRowCount();
  $page_size = $fc -> getPageSize();
  $page_count = ceil($row_count / $page_size);
  
  if ($page_count === 0) {
  	$page_num = 0;
  } else {
  	$page_num = $fc -> getPageNum();
	if ($page_num > $page_count) {
	  $page_num = $page_count;
	  $fc -> setPageNum($page_num);
	} else if ($page_num <= 0) {
	  $page_num = 1;
	  $fc ->setPageNum($page_num);
	}
  }
  
  $smarty -> assign('row_count', $row_count);
  $smarty -> assign('page_size', $page_size);
  $smarty -> assign('page_count', $page_count);
  $smarty -> assign('page_num', $page_num);
  
  $smarty -> assign('rows', $fc -> getRows());
  $smarty -> assign('ths', $fc -> getTableHeads());
  $smarty -> assign('change_page_href', $fc -> getChangePageHref());
}

function smarty_load_login_log(&$smarty) {
  global $loginLogFactory;
  smarty_load_pagination_table($smarty, $loginLogFactory);
  return $smarty;
}

function smarty_load_orders(&$smarty) {
  global $orderFactory;
  
  smarty_load_pagination_table($smarty, $orderFactory);
  $smarty -> assign('start_date', $orderFactory -> getStartDate());
  $smarty -> assign('end_date', $orderFactory -> getEndDate());
  $smarty -> assign('search_str', $orderFactory -> getSearchStr());

  return $smarty;
}

function smarty_load_customers(&$smarty) {
  global $customerFactory;
  smarty_load_pagination_table($smarty, $customerFactory);
  return $smarty;
}


function smarty_load_header(&$smarty){
  global $admin_info;
  $smarty -> assign('admin_name', $admin_info['username']);
  $smarty -> assign('navigation_array', get_navigation_array());
  return $smarty;
}

function smarty_load_customer_select(&$smarty,$def_cus_id=0,$with_total=false,$with_empty=false){
  $smarty -> assign('customers', select_simple_customers());
  $smarty -> assign('def_cus_id', $def_cus_id);
  $smarty -> assign('with_total', $with_total);
  $smarty -> assign('with_empty', $with_empty);
  return $smarty;
}

function create_customer_by_post($post) {
  $customer = array();
  if (isset($post['cusId'])) {
    $customer['cus_id'] = $_POST['cusId'];
  }
  $customer['cus_name'] = $_POST['cusName'];
  $customer['password'] = $_POST['password'];
  $customer['tel'] = $_POST['tel'];
  return $customer;
}

function create_order_by_post($post){
  $convert = array();
  if (isset($post['orderId'])) {
    $convert['orderId'] = 'order_id';
  }
  $convert['cusId'] = 'cus_id';
  $convert['orderNo'] = 'order_no';
  $convert[] = 'consigner';
  $convert[] = 'receiver';
  $convert['yiwuTel'] = 'yiwu_tel';
  $convert[] = 'delivery';
  $convert['deliveryTel'] = 'delivery_tel';
  $convert[] = 'payment';
  $convert[] = 'fare';
  $convert['itemCount'] = 'item_count';
  $convert['sendDate'] = 'send_date';
  
  return array_key_slice($post, $convert);
}

function get_empty_customer() {
  $customer_template = array();
  $customer_template['cus_name'] = '';
  $customer_template['password'] = '';
  $customer_template['tel'] = '';
  return $customer_template;
}

function get_empty_order(){
  $order_template = array();
  $order_template['cus_id'] = '';
  $order_template['order_no'] = '';
  $order_template['consigner'] = ''; 
  $order_template['receiver'] = '';
  $order_template['yiwu_tel'] = '';
  $order_template['delivery'] = '';
  $order_template['delivery_tel'] = '';
  $order_template['payment'] = '';
  $order_template['fare'] = '';
  $order_template['item_count'] = '';
  $order_template['send_date'] = '';
  return $order_template;
}

function get_admin_id() {
  global $admin_info;	
  return $admin_info['id'];
}
?>
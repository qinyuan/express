<?php
function select_last_orders() {
    $admin_id = get_admin_id();
    $pdo = new MyPdo();
    $query = "select 
       cus_id,receiver,delivery,delivery_tel,consigner,yiwu_tel 
       from (
           select max(order_id) as order_id from orderitem 
           where admin_id=$admin_id
           group by cus_id,receiver
           ) as lo 
       inner join orderitem using(order_id)
       where admin_id=$admin_id
       order by cus_id,receiver";
    $pdo -> query($query);
    $last_orders = array();
    while ($row = $pdo -> fetch()) {
        $cus_id = $row['cus_id'];
        if (!isset($last_orders[$cus_id])) {
            $last_orders[$cus_id] = array();
          }
        $last_orders[$cus_id][$row['receiver']] = array(
            'delivery' => $row['delivery'],
            'delivery_tel' => $row['delivery_tel'],
            'consigner' => $row['consigner'],
            'yiwu_tel' => $row['yiwu_tel'],
          );
     }
    return $last_orders;
}

function select_simple_customers() {
  $admin_id = get_admin_id();
  $pdo = new MyPdo();
  $query = "SELECT * FROM customer WHERE admin_id=$admin_id";
  $pdo -> query($query);
  $customers = array();
  while($row = $pdo -> fetch()){
    $customers[] = array_key_slice($row, array('cus_id', 'cus_name'));
  }
  return $customers;
}

function select_customer_by_id($id) {
  $admin_id = get_admin_id();
  
  $pdo = new MyPdo();
  $query = "SELECT * FROM customer WHERE cus_id=$id "
    . "AND admin_id=$admin_id";
  $pdo -> query($query);
  $keys = array('cus_id', 'cus_name', 'password', 'tel');
  if($row = $pdo -> fetch()){
  	return array_key_slice($row, $keys);
  } else {
  	return null;
  }
}

function update_customer($customer) {
  $admin_id = get_admin_id();
  
  $query = "UPDATE customer SET ";
  foreach ($customer as $key => $value) {
  	if ($key != 'cus_id'){
      $query .= "$key='$value',";
  	}
  }
  $query = preg_replace("/,$/", ' ', $query);
  $query .= "WHERE cus_id={$customer['cus_id']} "
    . "AND admin_id=$admin_id";
  
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function update_cus_password($password)	{
  global $customer;	
  $cus_id = $customer['cus_id'];
  $query = "UPDATE customer SET password='$password' WHERE cus_id=$cus_id";
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function update_admin_password($password) {
  $admin_id = get_admin_id();
  $query = "UPDATE admin SET password='$password' WHERE id=$admin_id";
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function update_order($order){
  $admin_id = get_admin_id();
  $query = "UPDATE orderitem SET ";
  foreach($order as $key => $value){
  	if ($key != 'order_id') {
      $query .= "$key='$value',";
    }
  }
  $query = preg_replace("/,$/", ' ', $query);
  $query .= "WHERE order_id={$order['order_id']} "
    . "AND admin_id=$admin_id";
  
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function select_customer_by_ident($username, $password){
  $admin_id = get_admin_id();
  $pdo = new MyPdo();
  $query = "SELECT * FROM customer WHERE cus_name='$username' "
  		. "AND password='$password' AND admin_id=$admin_id";
  $pdo -> query($query);
  if($row = $pdo -> fetch()){
  	return array_key_slice($row, array('cus_id', 'password', 'cus_name', 'tel'));
  } else {
  	return null;
  }
}

function select_admin_by_host($host_name){
  $pdo = new MyPdo();
  $query = "SELECT a.id,a.username,a.password,"
  		."a.company,a.address,a.tel,h.name AS host_name "
  		. "FROM admin AS a INNER JOIN host AS h ON "
  		. "a.id=h.admin_id WHERE h.name='$host_name'";
  $pdo -> query($query);
  $keys = array('id', 'username', 'password',
    'company', 'address', 'tel', 'host_name');
  if($row = $pdo -> fetch()){
  	return array_key_slice($row, $keys);
  } else {
    return null;
  }
}

function select_order_by_id($order_id) {
  $admin_id = get_admin_id();
  $query = "SELECT * FROM orderitem WHERE order_id=$order_id "
    . "AND admin_id=$admin_id";
  $keys = array('order_id', 'cus_id', 'order_no', 'consigner', 
    'receiver', 'yiwu_tel', 'delivery', 'delivery_tel', 
    'payment', 'fare', 'item_count', 'send_date');
  $pdo = new MyPdo();
  $pdo -> query($query);
  if ($row = $pdo -> fetch()) {
    return array_key_slice($row, $keys);
  } else {
  	return null;
  }
}

function insert_login_log($username) {
  $admin_id = get_admin_id();
  $pdo = new MyPdo();
  $query = "INSERT INTO login_record(cus_name,login_time,admin_id)"
    . " VALUES('$username',NOW(),$admin_id)";
  $pdo -> query($query);
}

function delete_row($table, $key_name, $key_value) {
  $admin_id = get_admin_id();
  $query = "DELETE FROM $table WHERE $key_name=$key_value "
    . "AND admin_id=$admin_id";
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function delete_order_by_id($order_id) {
  delete_row('orderitem', 'order_id', $order_id);
  return true;
}

function delete_customer_by_id($cus_id) {
  delete_row('customer', 'cus_id', $cus_id);
  return true;
}

function add_row($primary_key, $field_value_pairs,$table_name) {
  $admin_id = get_admin_id();
  
  $fields = $primary_key;
  $values = 'NULL';
  foreach ($field_value_pairs as $key => $value) {
  	$fields .= ",$key";
	$values .= ",'$value'";
  }
  $fields .= ",admin_id";
  $values .= ",$admin_id";
  
  $query = "INSERT INTO $table_name($fields) VALUES($values)";
  $pdo = new MyPdo();
  $pdo -> query($query);
}

function add_customer($customer) {
  add_row('cus_id', $customer, 'customer');
}

function add_order($order){
  add_row('order_id', $order, 'orderitem');
}

function exists_customer($cus_name) {
  $admin_id = get_admin_id();
  $query = "SELECT COUNT(*) FROM customer WHERE cus_name='$cus_name'"
    . " AND admin_id=$admin_id";
  $pdo = new MyPdo();
  $pdo -> query($query);
  $row = $pdo -> fetch(); 
  return ($row[0] ==1);
}
?>
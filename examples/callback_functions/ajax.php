<?php 
require_once('../../Datatables.php');
$datatables = new Datatables();

// MYSQL configuration
$config = array(
'username' => 'root',
'password' => 'root',
'database' => 'sakila',
'hostname' => 'localhost');

$datatables->connect($config);

$datatables
->select('customer_id, first_name, last_name, email')
->from('customer')
->add('edit', '<a href="#$1">Edit</a>', 'customer_id')
->add('delete', '<a href="#$1">Delete</a>', 'customer_id')
->edit('email', '$1', 'strtolower(email)') // php functions
->edit('email', '$1', 'custom_email(email)')  // custom functions
->edit('first_name', '$1', 'fix_first_name(first_name)');

echo $datatables->generate();

// Callback Functions
function custom_email($val)
{
  return substr($val, 0, 3) . '..' . strstr($val, "@");
}
function fix_first_name($val)
{
  return ucwords(strtolower($val));
}
?>
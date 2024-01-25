<?php
session_start();

require 'auth.php';
include 'dbconnection.php';
$table = 'users';
$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'name', 'dt' => 1 ),
array('db' => 'email', 'dt' => 2 ),
array('db' => 'phone', 'dt'=> 3),
array('db' => 'created_at', 'dt'=> 4),
);

include 'dataconfig.php';

require( 'ssp.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

}
echo json_encode(
$output
);

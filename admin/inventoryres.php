<?php
session_start();

require 'auth.php';
include 'dbconnection.php';
$table = 'inventory';
$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'supplier_id', 'dt' => 1 ),
array('db' => 'name', 'dt' => 2 ),
array('db' => 'image', 'dt'=> 3),
array('db' => 'qty', 'dt'=> 4),
array('db' => 'price', 'dt'=> 5),
array('db' => 'size', 'dt'=> 6),
array('db' => 'date_time', 'dt'=> 7),
array('db' => 'type', 'dt'=> 8),
);

include 'dataconfig.php';

require( 'ssp.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$sid = $output['data'][$i][1];
	$image = $output['data'][$i][3];

    $result = $mysqli->query("select * from supplier where id='$sid'");
    $row = mysqli_fetch_assoc($result);
    $output['data'][$i][1] = strtoupper($row['cname']);

    $output['data'][$i][3]='<img src="uploads/'.$image.'" height="60px" width="60px" />';
    $output['data'][$i][9]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="update('.$id.')">UPDATE</button>';

} 
echo json_encode(
$output
);

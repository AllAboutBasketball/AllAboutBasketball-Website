<?php
session_start();

require 'auth.php';
include 'dbconnection.php';
$table = 'supplier';
$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'cname', 'dt' => 1 ),
array('db' => 'image', 'dt' => 2 ),
array('db' => 'phone', 'dt'=> 3),
array('db' => 'email', 'dt'=> 4),
array('db' => 'status', 'dt'=> 5),
array('db' => 'date_time', 'dt'=> 6),
);

include 'dataconfig.php';

require( 'ssp.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$image = $output['data'][$i][2];
    $output['data'][$i][2]='<img src="uploads/'.$image.'" height="60px" width="60px" />';
    $output['data'][$i][7]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="update('.$id.')">UPDATE</button>';

}
echo json_encode(
$output
);

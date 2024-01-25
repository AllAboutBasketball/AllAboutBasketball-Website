<?php
session_start();

require 'auth.php';
include 'dbconnection.php';
$table = 'products';
$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'name', 'dt' => 1 ),
array('db' => 'image', 'dt' => 2 ),
array('db' => 'status', 'dt'=> 3),
array('db' => 'qty', 'dt'=> 4),
array('db' => 'original_price', 'dt'=> 5),
array('db' => 'selling_price', 'dt'=> 6),
array('db' => 'description', 'dt'=> 7),
array('db' => 'size', 'dt'=> 8),
);

include 'dataconfig.php';

require( 'ssp.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$statid = $output['data'][$i][3];
	$image = $output['data'][$i][2];
    if($statid == '0'){
        $output['data'][$i][3] = 'VISIBLE';
    }else{
        $output['data'][$i][3] = 'HIDDEN';
    }
    $output['data'][$i][2]='<img src="uploads/'.$image.'" height="60px" width="60px" />';
    $output['data'][$i][9]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="update('.$id.')">UPDATE</button>';

}
echo json_encode(
$output
);

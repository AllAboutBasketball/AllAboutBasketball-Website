<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.name as name, 
    T0.tracking_no as tracking_no, 
    T0.total_price as total_price, 
    T0.created_at as created_at,
    T0.status as status
    FROM orders T0
    WHERE T0.status = '8' or  T0.status = '-1'
 ) temp
EOT;

$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'name', 'dt' => 1 ),
array('db' => 'tracking_no', 'dt' => 2 ),
array('db' => 'total_price', 'dt'=> 3),
array('db' => 'created_at', 'dt'=> 4),
);

include 'dataconfig.php';

require( 'ssp1.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

    $output['data'][$i][5]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="update('.$id.')">VIEW DETAILS</button>';

}
echo json_encode(
$output
);

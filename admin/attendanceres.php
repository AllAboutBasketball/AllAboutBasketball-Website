<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.emp_id as employee_id, 
    T0.name as fname, 
    T0.date as date, 
    T0.time as time, 
    T0.place as place, 
    T0.status as status,
    T1.emp_id as emp_id
    FROM attendance T0
    LEFT JOIN employee T1 on T0.emp_id = T1.id 
 ) temp
EOT;
 
$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'emp_id', 'dt' => 1 ),
	array('db' => 'fname', 'dt' => 2 ),
	array('db' => 'date', 'dt' => 3 ),
	array('db' => 'time', 'dt' => 4 ),
	array('db' => 'status', 'dt' => 5 ),
	array('db' => 'place', 'dt' => 6 )
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

    //$output['data'][$i][8]='';

}
echo json_encode(
	$output
);
?>

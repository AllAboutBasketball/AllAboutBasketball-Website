<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.emp_id as employee_id, 
    T0.emp_name as fname, 
    T0.days as days, 
    T0.start_date as start_date, 
    T0.end_date as end_date, 
    T0.leave_type as leave_type,
    T0.remarks as remarks,
    T0.status as status,
    T1.emp_id as emp_id
    FROM app_leave T0
    LEFT JOIN employee T1 on T0.emp_id = T1.id 
 ) temp
EOT;
 
$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'emp_id', 'dt' => 1 ),
	array('db' => 'fname', 'dt' => 2 ),
	array('db' => 'leave_type', 'dt' => 3 ),
	array('db' => 'start_date', 'dt' => 4 ),
	array('db' => 'end_date', 'dt' => 5 ),
	array('db' => 'days', 'dt' => 6 ),
	array('db' => 'remarks', 'dt' => 7 ),
	array('db' => 'status', 'dt' => 8 )
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

    $output['data'][$i][9]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="updatefilingstatus('.$id.')">UPDATE STATUS</button>';

}
echo json_encode(
	$output
);
?>

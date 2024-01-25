<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.cutoffid as cutoffid, 
    T0.empid as empid, 
    T0.total_no_lates_hrs as total_no_lates_hrs, 
    T0.total_no_days_work as total_no_of_days_work, 
    T0.total_no_hrs_work as total_no_of_hrs_work, 
    T0.pay_per_day as pay_per_day, 
    T0.net_pay as net_pay, 
    T0.total_deduction as total_deduction,
    T1.name as name,
    T1.emp_id as employee_id
    FROM tbl_payroll T0
    LEFT JOIN employee T1 ON T1.id = T0.empid
 ) temp
EOT;

$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'employee_id', 'dt' => 1 ),
	array('db' => 'name', 'dt' => 2 ),
	array('db' => 'total_no_of_days_work', 'dt' => 3 ),
	array('db' => 'total_no_of_hrs_work', 'dt' => 4 ),
	array('db' => 'pay_per_day', 'dt' => 5 ),
	array('db' => 'total_deduction', 'dt' => 6 ),
	array('db' => 'net_pay', 'dt' => 7 ),
	array('db' => 'total_no_lates_hrs', 'dt' => 8 ),
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

}
echo json_encode(
	$output
);
?>

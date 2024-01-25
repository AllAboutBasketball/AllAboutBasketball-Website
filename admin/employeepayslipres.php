<?php
session_start();
include 'dbconnection.php';
$userid = $_SESSION['login_id'];

$table = <<<EOT
 ( SELECT 
    T0.id as id, 
    T0.start_date as start_date,
    T0.end_date as end_date
    FROM tbl_payroll_cutoff T0
 ) temp
EOT;
 
$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'start_date', 'dt' => 1 ),
	array('db' => 'end_date', 'dt' => 2 )
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];

	$output['data'][$i][0]='<button type="button" class="btn btn-alert btn-sm" title="View" onclick="printpayslip('.$id.','.$userid.')"><i class="fal fa-2x fa-arrow-alt-right"></i></button> '.$output['data'][$i][0];

}
echo json_encode(
	$output
);
?>

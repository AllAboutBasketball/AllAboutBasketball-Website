<?php
session_start();

require 'auth.php';
include 'dbconnection.php';
$table = 'tbl_payroll_cutoff';
$primaryKey = 'id';
$columns = array(
array('db' => 'id', 'dt' => 0 ),
array('db' => 'start_date', 'dt' => 1 ),
array('db' => 'end_date', 'dt' => 2 ),
);

include 'dataconfig.php';

require( 'ssp.class.php' );

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$output['data'][$i][0]='<button type="button" class="btn btn-alert btn-sm" title="View" onclick="viewcutoff('.$id.')"><i class="fal fa-2x fa-arrow-alt-right"></i></button> '.$output['data'][$i][0];

}
echo json_encode(
$output
);

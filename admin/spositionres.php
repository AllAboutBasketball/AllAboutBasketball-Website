<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT T0.id as id,
	T0.position as position
 	FROM tbl_position T0
 ) temp
EOT;

$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'position', 'dt' => 1 ),
);

// SQL server connection information

include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$output['data'][$i][2]='<button type="button" class="btn btn-alert btn-sm" title="Update " onclick="update('.$id.')"><i class="fal fa-2x fa-pencil"></i></button>';

}
echo json_encode(
	$output
);
?>

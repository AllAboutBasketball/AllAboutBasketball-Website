<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.emp_id as employee_id, 
    T0.name as fname, 
    T0.date_hiring as datehired, 
    T0.image as image, 
    T0.contact as contact, 
    T0.position as position, 
    T0.email as email
    FROM employee T0
 ) temp
EOT;

$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'employee_id', 'dt' => 1 ),
	array('db' => 'fname', 'dt' => 2 ),
	array('db' => 'position', 'dt' => 3 ),
	array('db' => 'image', 'dt' => 4 ),
	array('db' => 'contact', 'dt' => 5 ),
	array('db' => 'email', 'dt' => 6 ),
	array('db' => 'datehired', 'dt' => 7 ),
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$output['data'][$i][1]='<button type="button" class="btn btn-alert btn-sm" title="View" onclick="viewprofile('.$id.')"><i class="fal fa-2x fa-arrow-alt-right"></i></button> '.$output['data'][$i][1];

    //$output['data'][$i][8]='';

}
echo json_encode(
	$output
);
?>

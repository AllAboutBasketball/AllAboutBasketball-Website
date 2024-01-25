<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
$role = $_SESSION['login_userlevel'];
$result = $mysqli -> query("select * from tbl_role where id='$role'");
$row = mysqli_fetch_assoc($result);
$delete = $row['fdelete'];
$table = 'tbl_employee_loan';
$primaryKey = 'id';
$columns = array(
    array('db' => 'id', 'dt' => 0 ),
	array('db' => 'loanbenefits_id', 'dt' => 1 ),
	array('db' => 'loanaccountno', 'dt'=> 2),
	array('db' => 'amount', 'dt'=> 3),
	array('db' => 'monthly_amortization', 'dt'=> 4),
	array('db' => 'start_amortization', 'dt'=> 5),
	array('db' => 'end_amortization', 'dt'=> 6),
);

// SQL server connection information

include 'dataconfig.php';
require( 'ssp.class.php' );
 	//for no buttons only
// echo json_encode(
   // SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)

    //For custom where queries
    //SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"id='3' " )
// );
	$empid=strtoupper(mysqli_real_escape_string($mysqli,$_GET['empid']));
	$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"empid='$empid' and statid='1'" );

	foreach ($output['data'] as $i => $d) {
    $id = $output['data'][$i][0];
    $benefits = $output['data'][$i][1];
    $ctype = $output['data'][$i][2];
	$result = $mysqli->query("select * from tbl_loan where id ='$benefits'");
	$row = mysqli_fetch_assoc($result);
	$output['data'][$i][1] = $row['loan_benefits'];

    if($delete == '1'){
		$output['data'][$i][1] = '<a title="Delete" onclick="deleteitem8('.$id.')"><i class="fal fa-times-circle"></i></a> '.$output['data'][$i][1];
    }else{
        $output['data'][$i][1] = $output['data'][$i][1];
    }
	}
echo json_encode(
	$output
);
?>

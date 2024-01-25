<?php
session_start();
include 'dbconnection.php';

$table = <<<EOT
 ( SELECT 
    T0.id as id,
    T0.name as name, 
    T0.slug as slug, 
    T0.description as description, 
    T0.status as status, 
    T0.popular as popular, 
    T0.image as image,
    T0.meta_keywords as meta_keywords
    FROM categories T0
 ) temp
EOT;
 
$primaryKey = 'id';
$columns = array(
	array('db' => 'id', 'dt' => 0 ),
	array('db' => 'slug', 'dt' => 1 ),
	array('db' => 'name', 'dt' => 2 ),
	array('db' => 'image', 'dt' => 3 ),
	array('db' => 'status', 'dt' => 4 ),
	array('db' => 'meta_keywords', 'dt' => 5 )
);


include 'dataconfig.php';
require( 'ssp1.class.php' );
 	//for no buttons only

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$statid = $output['data'][$i][4];
	$image = $output['data'][$i][3];
    if($statid == '0'){
        $output['data'][$i][4] = 'VISIBLE';
    }else{
        $output['data'][$i][4] = 'HIDDEN';
    }
    $output['data'][$i][3]='<img src="uploads/'.$image.'" height="60px" width="60px" />';
    $output['data'][$i][6]='<button type="button" class="btn btn-success btn-sm" title="View" onclick="update('.$id.')">UPDATE</button>';

}
echo json_encode(
	$output
);
?>

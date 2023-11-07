<?php	
    $con = mysqli_connect("localhost", "root", "", "db_aab");
	if (isset($_POST['reject'])){
		$appid = $_POST['appid'];
		$sql = "UPDATE upload SET status='2' WHERE id = '$appid'";
		$run = mysqli_query($con,$sql);
		if($run == true){

			redirect("collab.php?t=$track_no", "Collab Status Update Successful");
			}
	}
	
 ?>
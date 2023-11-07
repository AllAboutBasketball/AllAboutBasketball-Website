<?php	
    $con = mysqli_connect("localhost", "root", "", "db_aab");
	if (isset($_POST['approve'])){
		$appid = $_POST['appid'];
		$sql = "UPDATE upload SET status='1' WHERE id = '$appid'";
		$run = mysqli_query($con,$sql);
		if($run == true){

			redirect("collab.php?t=$track_no", "Collab Status Update Successful");
			}
	}
	
 ?>
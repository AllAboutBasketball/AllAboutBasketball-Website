<?php
	if(isset($_SESSION['login_id'])){
		if($_SESSION['login_userlevel']=='1'){
			header("location:admin/index.php");
		}
	}
?>
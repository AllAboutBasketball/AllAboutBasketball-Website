<?php
session_start();
include 'dbconnection.php';

$role = $_SESSION['login_userlevel'];
$roleresult = $mysqli->query("select * from tbl_role where id = '$role'");
$rolerow = mysqli_fetch_assoc($roleresult);

$id=$_GET['id'];
//EMPLOYEE
$result=$mysqli->query("select * from employee where id='$id'");
$row=mysqli_fetch_assoc($result);
$eid = $row['id'];
$employeeid = $row['emp_id'];
$fname = $row['name'];
$address = strtoupper($row['address']);
$password = $row['password'];
$userlevel = $row['userlevel'];
$date_birth = $row['date_birth'];
$date_hiring = $row['date_hiring'];
$gender = $row['gender'];
$salary = $row['salary'];
$email = $row['email'];
$position = $row['position'];
$contact = $row['contact'];
$image = $row['image'];

?>
<div class="modal fade" id="profile_modal" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true"><i class="fal fa-times"></i></span>
            	</button>
          </div>
          <div class="modal-body">
                <div class="">
                    <div id="panel-10" class="panel">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#js_change_pill_justified-1">Personal Details</a></li>
                                </ul>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="js_change_pill_justified-1" role="tabpanel"><br/>
                                        <form id="addprofile">
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-row" align="center">
                                                        <div class="col-md-12 mb-3">
                                                            <div class="alert alert-primary">
                                                                <div class="d-flex flex-start w-100">
                                                                    <div class="d-flex flex-fill">
                                                                        <div class="flex-fill">
                                                                            <span class="h4">EMPLOYEE INFORMATION</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-2 mb-3">
                                                    <?php
                                                        if($image == ''){
                                                            ?>
                                                            <img src="image/noimage.png" height="170px" width="170px" class=" shadow-2 " alt="">
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <img src="uploads/<?php echo $image ?>" height="170px" width="170px" class=" shadow-2 " alt="">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="col-md-10 mb-3">
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Employee ID<span class="text-danger"></span> </label>
                                                            <input type="hidden"  class="form-control"  autocomplete="off" name="eid" id="eid" value="<?php echo $eid ?>" required>
                                                            <input type="text"  class="form-control" maxlength = "6"  autocomplete="off" name="empid" id="empid" placeholder="Employee ID" value="<?php echo $employeeid ?>" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Employee Password<span class="text-danger"></span> </label>
                                                            <input type="password" class="form-control"  autocomplete="off" name="pword" id="pword" placeholder="Password" value="<?php echo $password ?>" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Userlevel<span class="text-danger"></span> </label>
                                                            <select name="userlvl" id="userlvl" class="form-control" required>
                                                                <?php
                                                                $result = $mysqli->query("select * from tbl_role");
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                ?>
                                                                <option <?php if($userlevel == $row['id']){ echo 'selected=""'; } ?> value="<?php echo $row['id'] ?>"><?php echo $row['rolename'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Position<span class="text-danger"></span> </label>
                                                            <select name="position" id="position" class="form-control" required>
                                                                <?php
                                                                $result = $mysqli->query("select * from tbl_position");
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                ?>
                                                                <option <?php if($position == $row['position']){ echo 'selected=""'; } ?> value="<?php echo $row['position'] ?>"><?php echo $row['position'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Salary<span class="text-danger"></span> </label>
                                                            <input type="number" class="form-control"  autocomplete="off" name="salary" id="salary" placeholder="Salary" value="<?php echo $salary ?>" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Date Hired<span class="text-danger"></span> </label>
                                                            <input type="date" class="form-control"  autocomplete="off" name="dhired" id="dhired" placeholder="Date Hired" value="<?php echo $date_hiring ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label"><h3>Personal Information</h3><span class="text-danger"></span> </label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Employee Name<span class="text-danger"></span> </label>
                                                    <input type="text" class="form-control"  autocomplete="off" name="fname" id="fname" placeholder="First Name" value="<?php echo $fname ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Address<span class="text-danger"></span> </label>
                                                    <textarea name="address" id="address" class="form-control" required><?php echo $address ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Contact Number<span class="text-danger"></span> </label>
                                                    <input type="text" class="form-control"  autocomplete="off" name="cnum" id="cnum" placeholder="Contact Number" value="<?php echo $contact ?>">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Email<span class="text-danger"></span> </label>
                                                    <input type="email" class="form-control"  autocomplete="off" name="email" id="email" placeholder="Email" value="<?php echo $email ?>">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Gender<span class="text-danger"></span> </label>
                                                    <select name="sex" id="sex" class="form-control" required>
                                                        <option <?php if($gender == 'MALE'){ echo 'selected=""'; } ?> value="Male">Male</option>
                                                        <option <?php if($gender == 'FEMALE'){ echo 'selected=""'; } ?> value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Birth Date<span class="text-danger"></span> </label>
                                                    <input type="date" class="form-control"  autocomplete="off" name="bday" id="bday" placeholder="Birth Date"  value="<?php echo $date_birth ?>">
                                                </div>
                                            </div>
                                            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
			                                    <button class="btn btn-outline-primary ml-auto" type="submit">Update Employee Profile</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>   

<link rel="stylesheet" href="js/a/jquery-ui.css" />
<script src="js/a/jquery-ui.min.js"></script>
<script src="js/formplugins/select2/select2.bundle.js"></script>
<script>
 	$("#addprofile").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addprofile')[0]);
		Swal.fire({
			title: "Are you sure?",
			html: "Do you want to continue update this employee?",
			type: "warning",
			showCancelButton: true,
  			confirmButtonColor: '#3fbbc0',
			confirmButtonText: "Yes, proceed!"
		}).then(function(result){
			if (result.value){
				swal.fire({
					html: '<h4>Loading please wait...</h4>',
					allowOutsideClick: false,
					onBeforeOpen: function onBeforeOpen()
						{ swal.showLoading(); }
				});	
				$.ajax({
					type: 'POST',
					url: 'employeeprofileprocess.php',
					data: data,
					contentType: false,
					cache: false,
					processData:false,
					success: function(response){
						var result = response;
						var check = response.includes("Error");
						if(response.includes("Error")){
							Swal.fire({
								type: "error",
								title: ""+response,
								showConfirmButton: false,
								timer: 3500
							});
						}else{
							Swal.fire({
								type: "success",
								title: "Employee information update.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#setup_modal').modal('hide');
							$("#dt-basic-example").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
    
 	$("#addpform").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addpform')[0]);
		Swal.fire({
			title: "Are you sure?",
			html: "Do you want to continue update this employee?",
			type: "warning",
			showCancelButton: true,
  			confirmButtonColor: '#3fbbc0',
			confirmButtonText: "Yes, proceed!"
		}).then(function(result){
			if (result.value){
				swal.fire({
					html: '<h4>Loading please wait...</h4>',
					allowOutsideClick: false,
					onBeforeOpen: function onBeforeOpen()
						{ swal.showLoading(); }
				});	
				$.ajax({
					type: 'POST',
					url: 'employeeportalprocess.php',
					data: data,
					contentType: false,
					cache: false,
					processData:false,
					success: function(response){
						var result = response;
						var check = response.includes("Error");
						if(response.includes("Error")){
							Swal.fire({
								type: "error",
								title: ""+response,
								showConfirmButton: false,
								timer: 3500
							});
						}else{
							Swal.fire({
								type: "success",
								title: "Employee information update.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#setup_modal').modal('hide');
							$("#dt-basic-example").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});					    
	
</script>
	
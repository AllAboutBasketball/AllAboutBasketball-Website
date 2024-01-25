<?php
include 'template/header.php';
?>
<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo $title; ?></a></li>
		<li class="breadcrumb-item active">ATTENDANCE</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block">
			<span class="js-get-date"></span></li>
	</ol>
	<div class="row">
		<div class="col-xl-12">
			<div id="panel-1" class="panel">
				<div class="panel-container show">
					<div class="panel-content">
						<!-- datatable start -->
						<table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
							<thead class="bg-primary-600">
								<tr>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div> 
		</div>
	</div>
</main>
<div class="modal fade" id="addmodal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h4"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						<i class="fal fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<div id="panel-2" class="panel">
					<div class="panel-container show">
						<div class="panel-content p-0">
							<form class="needs-validation" id="addvform">
								<div class="panel-content">
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label"><h3>Employment Information</h3><span class="text-danger"></span> </label>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-4 mb-3">
											<label class="form-label">Employee ID<span class="text-danger"></span> </label>
											<input type="text" class="form-control" maxlength = "6"  autocomplete="off" name="empid" id="empid" placeholder="Employee ID" required>
										</div>
										<div class="col-md-4 mb-3">
											<label class="form-label">Employee Password<span class="text-danger"></span> </label>
											<input type="password" class="form-control"  autocomplete="off" name="password" id="password" placeholder="Password" required>
										</div>
										<div class="col-md-4 mb-3">
                                            <label class="form-label">Userlevel<span class="text-danger"></span> </label>
                                            <select name="userlvl" id="userlvl" class="form-control" required>
												<?php
												$result = $mysqli->query("select * from tbl_role");
												while($row = mysqli_fetch_assoc($result)){
												?>
												<option value="<?php echo $row['id'] ?>"><?php echo $row['rolename'] ?></option>
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
												<option value="<?php echo $row['position'] ?>"><?php echo $row['position'] ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-4 mb-3">
											<label class="form-label">Salary<span class="text-danger"></span> </label>
											<input type="number" class="form-control"  autocomplete="off" name="salary" id="salary" placeholder="Salary" required>
										</div>
										<div class="col-md-4 mb-3">
											<label class="form-label">Date Hired<span class="text-danger"></span> </label>
											<input type="date" class="form-control"  autocomplete="off" name="dhired" id="dhired" placeholder="Date Hired" required>
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
											<input type="text" class="form-control"  autocomplete="off" name="fname" id="fname" placeholder="First Name" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Address<span class="text-danger"></span> </label>
                                            <textarea name="address" id="address" class="form-control" required></textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-3 mb-3">
											<label class="form-label">Contact Number<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="cnum" id="cnum" placeholder="Contact Number">
										</div>
										<div class="col-md-3 mb-3">
											<label class="form-label">Email<span class="text-danger"></span> </label>
											<input type="email" class="form-control"  autocomplete="off" name="email" id="email" placeholder="Email">
										</div>
										<div class="col-md-3 mb-3">
                                            <label class="form-label">Gender<span class="text-danger"></span> </label>
                                            <select name="sex" id="sex" class="form-control" required>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
										<div class="col-md-3 mb-3">
											<label class="form-label">Birth Date<span class="text-danger"></span> </label>
											<input type="date" class="form-control"  autocomplete="off" name="bday" id="bday" placeholder="Birth Date">
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Image<span class="text-danger"></span> </label>
											<input type="file" class="form-control"  autocomplete="off" name="image" id="image" placeholder="Birth Date">
										</div>
									</div>
								</div>
								<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
									<button class="btn btn-primary ml-auto" type="submit">Submit Form</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<?php
include 'template/footer.php';
?>

<div id="profilediv"><div>
<script>
	$(document).ready(function() {
		// initialize datatable
		$('#dt-basic-example').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "attendanceres.php",
			columns: [
				{ title: 'ID', data:0, visible:false },
				{ title: 'EMPLOYEE ID', data:1 },
				{ title: 'EMPLOYEE NAME', data:2 },
				{ title: 'ATTENDANCE DATE', data:3 },
				{ title: 'ATTENDANCE TIME', data:4 },
				{ title: 'STATUS', data:5 },
				{ title: 'PLACE', data:6 },
			],
			dom:

			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: 'pdfHtml5',
					text: 'PDF',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm mr-1'
				},
				{
					extend: 'print',
					text: 'Print',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm'
				}
			]
		});
	}); 

	$("#addvform").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addvform')[0]);
		Swal.fire({
			title: "Are you sure?",
			html: "Do you want to continue?",
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
					url: 'employeeadd.php',
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
								title: "Employee information save.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#addmodal').modal('hide');
							document.getElementById("addvform").reset();
							$("#dt-basic-example").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
								    
	function update(id){
		$.ajax({
			url:'employeeupdate.php?id='+id,
			type:'post',
			success  : function(data) {
				$("#updatediv").html(data);
				$('#setup_modal').modal('show');
			}
		});
	}    

    						    
	function viewprofile(id){
		$.ajax({
			url:'employeeprofile.php?id='+id,
			type:'post',
			success  : function(data) {
				$("#profilediv").html(data);
				$('#profile_modal').modal('show');
			}
		});
	}    

</script>

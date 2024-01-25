<?php
include 'dbconnection.php';
$id = $_GET['id'];
$result = $mysqli->query("select * from supplier where id = '$id'");
$row = mysqli_fetch_assoc($result);
$cnum = $row['phone'];
$cname = $row['cname'];
$phone = $row['phone'];
$cperson = $row['cperson'];
$email = $row['email'];
$product = $row['product'];
$cost = $row['cost'];
$image = $row['image'];
$date_time = $row['date_time'];
$status = $row['status'];
?>
<div class="modal fade" id="update_modal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
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
                            <form id="addcform">
								<div class="panel-content">
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Supplier Name<span class="text-danger"></span> </label>
											<input type="hidden" class="form-control"  autocomplete="off" name="eid" id="eid" value="<?php echo $id ?>" required>
											<input type="text" class="form-control"  autocomplete="off" name="cname" id="cname" value="<?php echo $cname ?>" required>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Supplier Contact No.<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="cnum" id="cnum"  value="<?php echo $cnum ?>"required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Contact Person<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="cperson" id="cperson"  value="<?php echo $cperson?>"required>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Supplier Email<span class="text-danger"></span> </label>
											<input type="email" class="form-control"  autocomplete="off" name="cemail" id="cemail"  value="<?php echo $email?>" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Product<span class="text-danger"></span> </label>
                                            <select name="product" id="product" class="form-control" required>
												<option <?php if($product=='TSHIRT'){ echo 'selected=""'; } ?> value="TSHIRT">TSHIRT</option>
												<option <?php if($product=='SHORT'){ echo 'selected=""'; } ?> value="SHORT">SHORT</option>
												<option <?php if($product=='ACCESSORIES'){ echo 'selected=""'; } ?> value="ACCESSORIES">ACCESSORIES</option>
											</select>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Cost<span class="text-danger"></span> </label>
											<input type="number" class="form-control"  autocomplete="off" name="cost" id="cost"  value="<?php echo $cost ?>"required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Status<span class="text-danger"></span> </label>
                                            <select name="status" id="status" class="form-control" required>
												<option <?php if($status=='ACTIVE'){ echo 'selected=""'; } ?> value="ACTIVE">ACTIVE</option>
												<option <?php if($status=='INACTIVE'){ echo 'selected=""'; } ?> value="INACTIVE">INACTIVE</option>
											</select>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Product Supplied Date<span class="text-danger"></span> </label>
											<input type="datetime-local" class="form-control"  autocomplete="off" name="supplydate" id="supplydate"  value="<?php echo $date_time ?>"required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Attachment<span class="text-danger"></span> </label>
											<input type="file" class="form-control"  autocomplete="off" name="image" id="image" >
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
<script>
	
	$("#addcform").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addcform')[0]);
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
					url: 'supplierupdateprocess.php',
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
								title: "Supplier information save.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#update_modal').modal('hide');
							document.getElementById("addcform").reset();
							$("#dt-basic-example").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
</script>
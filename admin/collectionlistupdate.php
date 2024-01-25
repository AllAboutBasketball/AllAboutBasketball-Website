<?php
include 'dbconnection.php';
$id = $_GET['id'];
$result = $mysqli->query("select * from categories where id = '$id'");
$row = mysqli_fetch_assoc($result);
$slug = $row['slug'];
$name = $row['name'];
$description = $row['description'];
$status = $row['status'];
$popular = $row['popular'];
$meta = $row['meta_keywords'];
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
                                            <label class="form-label">Product Sales<span class="text-danger"></span> </label>
											<input type="hidden" class="form-control" autocomplete="off" name="eid" id="eid" value="<?php echo $id ?>">
                                            <select name="psales" id="psales" class="form-control" required>
                                                
												<option <?php if($slug == 'LIMITED OFFER'){ echo 'selected=""'; } ?> value="LIMITED OFFER">LIMITED OFFER</option>
												<option <?php if($slug == 'HOT SALES'){ echo 'selected=""'; } ?> value="HOT SALES">HOT SALES</option>
											</select>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Collection<span class="text-danger"></span> </label>
                                            <select name="collection" id="collection" class="form-control" required>
												<option <?php if($name == 'TSHIRT'){ echo 'selected=""'; } ?> value="TSHIRT">TSHIRT</option>
												<option <?php if($name == 'SHORT'){ echo 'selected=""'; } ?> value="SHORT">SHORT</option>
												<option <?php if($name == 'ACCESSORIES'){ echo 'selected=""'; } ?> value="ACCESSORIES">ACCESSORIES</option>
												<option <?php if($name == 'LIMITED RANDOM DESIGN'){ echo 'selected=""'; } ?> value="LIMITED RANDOM DESIGN">LIMITED RANDOM DESIGN</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Description<span class="text-danger"></span> </label>
                                            <textarea name="description" id="description" class="form-control" required><?php echo $description ?></textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Attachment<span class="text-danger"></span> </label>
											<input type="file" class="form-control"  autocomplete="off" name="image" id="image" >
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Tagging<span class="text-danger"></span> </label>
                                            <textarea name="tagging" id="tagging" class="form-control" required><?php echo $meta ?></textarea>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <select name="status" id="status" class="form-control" required>
												<option <?php if($status == '0'){ echo 'selected=""'; } ?> value="0">VISIBLE</option>
												<option <?php if($status == '1'){ echo 'selected=""'; } ?> value="1">HIDDEN</option>
											</select>
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
					url: 'collectionlistupdateprocess.php',
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
								title: "Collection information save.",
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
<?php
include 'template/header.php';
?> 
<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo $title; ?></a></li>
		<li class="breadcrumb-item active">Inventory</li>
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
                            <form id="addvform">
								<div class="panel-content">
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Select Supplier<span class="text-danger"></span> </label>
                                            <select name="supplier" id="supplier" class="form-control" required>
												<?php
												$result = $mysqli->query("select * from supplier where status = 'ACTIVE'");
												while($row = mysqli_fetch_assoc($result)){
													?>
													<option value="<?php echo $row['id'] ?>"><?php echo strtoupper($row['cname']) ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Name<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="name" id="name" required>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Product Date<span class="text-danger"></span> </label>
											<input type="datetime-local" class="form-control"  autocomplete="off" name="pdate" id="pdate" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Category<span class="text-danger"></span> </label>
                                            <select name="category" id="category" class="form-control" required>
												<option value="TSHIRT">TSHIRT</option>
												<option value="SHORT">SHORT</option>
												<option value="ACCESSORIES">ACCESSORIES</option>
											</select>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Size<span class="text-danger"></span> </label>
                                            <select name="size" id="size" class="form-control" required>
												<option value="SMALL">SMALL</option>
												<option value="MEDIUM">MEDIUM</option>
												<option value="LARGE">LARGE</option>
												<option value="XL">XL</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">quantity<span class="text-danger"></span> </label>
											<input type="number" class="form-control"  autocomplete="off" name="quantity" id="quantity" required>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Price<span class="text-danger"></span> </label>
											<input type="number" class="form-control"  autocomplete="off" name="price" id="price" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Status<span class="text-danger"></span> </label>
                                            <select name="status" id="status" class="form-control" required>
												<option value="ACTIVE">ACTIVE</option>
												<option value="INACTIVE">INACTIVE</option>
											</select>
										</div>
										<div class="col-md-6 mb-3">
                                            <label class="form-label">Remarks<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="remarks" id="remarks" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Attachment<span class="text-danger"></span> </label>
											<input type="file" class="form-control"  autocomplete="off" name="image" id="image" required>
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

<div id="updatediv"><div>

<script>
	$(document).ready(function() {
		// initialize datatable
		$('#dt-basic-example').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "inventoryres.php",
			columns: [
				{ title: 'No.', data:0 },
				{ title: 'SUPPLIER NAME', data:1 },
				{ title: 'PRODUCT NAME', data:2 },
				{ title: 'IMAGE', data:3 },
				{ title: 'PRODUCT TYPE', data:8 },
				{ title: 'SIZE', data:6 },
				{ title: 'QTY', data:4 },
				{ title: 'PRODUCT PRICE', data:5 },
				{ title: 'DATE TIME', data:7 },
				{ title: 'ACTION', data:9 },
			],
			dom:

			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: '',
					text: 'ADD INVENTORY',
					titleAttr: 'Add Document',
					className: 'btn-outline-primary btn-sm mr-1',
					action: function ( e, dt, node, config ) {
						$('#addmodal').modal('show');
					}

				},
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
					url: 'inventoryprocess.php',
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
								title: "Inventory added successfully.",
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
			url:'inventoryupdate.php?id='+id,
			type:'post',
			success  : function(data) {
				$("#updatediv").html(data);
				$('#update_modal').modal('show');
			}
		});
	}    
</script>

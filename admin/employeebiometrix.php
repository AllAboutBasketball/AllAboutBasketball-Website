<?php
$eid = $_GET['id'];
?>
<div class="modal fade" id="biometrixmodal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
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
							<div class="panel-content">
                                <table id="dt-basic-example-biometrix" class="table table-bordered table-hover table-striped w-100">
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
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addmodalbiotime" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
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
                            <form id="addbioform">
								<div class="panel-content">
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Place<span class="text-danger"></span> </label>
											<input type="hidden" class="form-control" autocomplete="off" name="empid" id="empid" value="<?php echo $eid ?>">
                                            <select name="place" id="place" class="form-control" required>
												<option value="WFH">WFH</option>
												<option value="SHOP">SHOP</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Status<span class="text-danger"></span> </label>
                                            <select name="status" id="status" class="form-control" required>
												<option value="TIME IN">TIME IN</option>
												<option value="TIME OUT">TIME OUT</option>
											</select>
										</div>
									</div>
                                </div>
								<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
									<button class="btn btn-primary ml-auto" type="submit">Proceed Biometrix</button>
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
    
	$(document).ready(function() {
		// initialize datatable
		$('#dt-basic-example-biometrix').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "employeebiometrixres.php",
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
					extend: '',
					text: 'BIOMETRIX',
					titleAttr: 'Add Document',
					className: 'btn-outline-primary btn-sm mr-1',
					action: function ( e, dt, node, config ) {
						$('#addmodalbiotime').modal('show');
					}

				}
			]
		});
	}); 
    $("#addbioform").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addbioform')[0]);
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
					url: 'employeebiometrixprocess.php',
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
								title: "You are now "+response+".",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#addmodalbiotime').modal('hide');
							document.getElementById("addbioform").reset();
							$("#dt-basic-example-biometrix").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
 </script>
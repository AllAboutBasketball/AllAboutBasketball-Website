<?php
$eid = $_GET['id'];
?>
<div class="modal fade" id="leavemodal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
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
                                <table id="dt-basic-example-leave" class="table table-bordered table-hover table-striped w-100">
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
<div class="modal fade" id="addmodalleavedate" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
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
                            <form id="addleaveform">
								<div class="panel-content">
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Leave Type<span class="text-danger"></span> </label>
											<input type="hidden" class="form-control" autocomplete="off" name="empid" id="empid" value="<?php echo $eid ?>">
                                            <select name="ltype" id="ltype" class="form-control" required>
												<option value="SICK LEAVE W/ PAY">SICK LEAVE W/ PAY</option>
												<option value="LEAVE W/ PAY">LEAVE W/ PAY</option>
												<option value="SICK LEAVE">SICK LEAVE W/O PAY</option>
												<option value="LEAVE W/O PAY">LEAVE W/O PAY</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
											<label class="form-label">Start Date<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="ldates" id="ldates" placeholder="Leave Date" required>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 mb-3">
                                            <label class="form-label">Reason<span class="text-danger"></span> </label>
                                            <textarea name="reason" id="reason" class="form-control" required></textarea>
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
									<button class="btn btn-primary ml-auto" type="submit">Submit Application</button>
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
    
	$(function() {
    	$('input[name="ldates"]').daterangepicker();
	});
	$(document).ready(function() {
		// initialize datatable
		$('#dt-basic-example-leave').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "employeeleaveres.php",
			columns: [
				{ title: 'ID', data:0, visible:false },
				{ title: 'EMPLOYEE ID', data:1 },
				{ title: 'EMPLOYEE NAME', data:2 },
				{ title: 'LEAVE TYPE', data:3 },
				{ title: 'START DATE', data:4 },
				{ title: 'END DATE', data:5 },
				{ title: 'NO. DAY(s)', data:6 },
				{ title: 'REASON', data:7 },
				{ title: 'STATUS', data:8 },
			],
			dom:

			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: '',
					text: 'ADD LEAVE APPLICATION',
					titleAttr: 'Add Document',
					className: 'btn-outline-primary btn-sm mr-1',
					action: function ( e, dt, node, config ) {
						$('#addmodalleavedate').modal('show');
					}

				}
			]
		});
	}); 
    $("#addleaveform").on('submit', function(e){
		e.preventDefault();
		var data = new FormData($('#addleaveform')[0]);
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
					url: 'employeeleaveprocess.php',
					data: data,
					contentType: false,
					cache: false,
					processData:false,
					success: function(response){
						var result = response;
						var check = response.includes("Error description");
						if(response.includes("Error description")){
							Swal.fire({
								type: "error",
								title: ""+response,
								showConfirmButton: false,
								timer: 3500
							});
						}else{
							Swal.fire({
								type: "success",
								title: "Application successfully submit.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#addmodalleavedate').modal('hide');
							document.getElementById("addleaveform").reset();
							$("#dt-basic-example-leave").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
 </script>
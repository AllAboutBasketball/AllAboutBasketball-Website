<?php
include 'template/header.php';
?>
<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">
			<a href="javascript:void(0);"><?php echo $title; ?></a></li>
		<li class="breadcrumb-item">SETTINGS</li>
		<li class="breadcrumb-item active">POSITION LIST</li>
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h4">Add Position Information</h5>
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
											<label class="form-label" for="validationCustom01">Position<span class="text-danger"></span> </label>
											<input type="text" class="form-control"  autocomplete="off" name="position" id="position" placeholder="Position" required>
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

<div id="updatediv"></div>

<?php
include 'template/footer.php';
?>

<script>
	$(document).ready(function() {
		// initialize datatable
		$('#dt-basic-example').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "spositionres.php",
			columns: [
				{ title: 'ID', data:0, visible:false },
				{ title: 'POSITION', data:1 },
				{ title: 'ACTION', data:2 },
			],
			dom:

			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [

				{
					extend: '',
					text: 'ADD POSITION INFO',
					titleAttr: 'Add Document',
					className: 'btn-outline-primary btn-sm mr-1',
					action: function ( e, dt, node, config ) {
						$('#addmodal').modal('show');
					}

				}
				<?php
				if ($_SESSION['login_userlevel']=='ADMINISTRATOR') {
					?>,
					{
						extend: 'pdfHtml5',
						text: 'PDF',
						titleAttr: 'Generate PDF',
						className: 'btn-outline-danger btn-sm mr-1'
					},
					{
						extend: 'copyHtml5',
						text: 'Copy',
						titleAttr: 'Copy to clipboard',
						className: 'btn-outline-primary btn-sm mr-1'
					}<?php } ?>,
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
				$.ajax({
					type: 'POST',
					url: 'spositionadd.php',
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
								title: "Position information save.",
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
			url:'spositionupdate.php?id='+id,
			type:'post',
			success  : function(data) {
				$("#updatediv").html(data);
				$('#setup_modal').modal('show');
			}
		});
	}    

</script>

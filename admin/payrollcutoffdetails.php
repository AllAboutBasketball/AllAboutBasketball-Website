<?php
$eid = $_GET['id'];
?>
<div class="modal fade" id="view_modal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
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
                                <table id="dt-basic-example-payroll" class="table table-bordered table-hover table-striped w-100">
                                    <thead class="bg-primary-600">
                                        <tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <input type="hidden" name="cid" id="cid" value="<?php echo $eid ?>" />
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

<script>
    
	$(document).ready(function() {
		// initialize datatable
		var cid = document.getElementById("cid").value;
		$('#dt-basic-example-payroll').dataTable(
		{
			responsive: true,
			lengthChange: false,
			serverSide: true,
			order: [[ 0, "asc" ]],
			ajax: "payrollcutoffdetailsres.php",
			columns: [
				{ title: 'ID', data:0, visible:false },
				{ title: 'EMPLOYEE ID', data:1 },
				{ title: 'EMPLOYEE NAME', data:2 },
				{ title: 'TOTAL NO. OF DAY(S) WORK', data:3 },
				{ title: 'TOTAL NO. OF HR(S) WORK', data:4 },
				{ title: 'OTAL NO. OF HR(S) LATE', data:8 },
				{ title: 'PAY PER DAY', data:5 },
				{ title: 'TOTAL DEDUCTION', data:6 },
				{ title: 'NET PAY', data:7 },
			],
			dom:

			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: '',
					text: 'GENERATE PAYROLL',
					titleAttr: 'Add Document',
					className: 'btn-outline-primary btn-sm mr-1',
					action: function ( e, dt, node, config ) {
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
                                    html: '<h4>Generating please wait...</h4>',
                                    allowOutsideClick: false,
                                    onBeforeOpen: function onBeforeOpen()
                                        { swal.showLoading(); }
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: 'payrollprocess.php?cid='+cid,
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
                                                title: "Payroll generate success.",
                                                showConfirmButton: true,
                                                allowOutsideClick: false
                                            });
                                            $("#dt-basic-example-payroll").DataTable().ajax.reload();
                                        }
                                    }
                                });
                            }
                        });
					}

				}
			]
		});
	}); 
 </script>
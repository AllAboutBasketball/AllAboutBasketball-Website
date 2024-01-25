<?php
session_start();
include 'dbconnection.php';
$id=$_GET['id'];
$result=$mysqli->query("select * from tbl_position where id='$id'");
$row=mysqli_fetch_assoc($result);
?>
 <div class="modal fade" id="setup_modal" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title h4">Update Position information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true"><i class="fal fa-times"></i></span>
            	</button>
          </div>
          <div class="modal-body">
            	<div id="panel-2" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content p-0">
                            <form id="addcform" >
                                <div class="panel-content">
									<div class="form-row">
										<div class="col-md-12 mb-12">
											<label class="form-label" for="validationCustom01">Position
												<span class="text-danger"></span> </label>
											<input type="text"  autocomplete="off" class="form-control" name="position" id="position" placeholder="Position" required value="<?php echo $row['position'] ?>">
											<input type="hidden"  autocomplete="off" class="form-control" name="id" id="id" value="<?php echo $row['id'] ?>">	
										</div>
									</div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <button class="btn btn-primary ml-auto" type="submit">Submit form</button>
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

<link rel="stylesheet" href="js/a/jquery-ui.css" />
<script src="js/a/jquery-ui.min.js"></script>
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
				$.ajax({
					type: 'POST',
					url: 'spositionupdateprocess.php',
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
								title: "Position information update.",
								showConfirmButton: true,
								allowOutsideClick: false
							});
							$('#setup_modal').modal('hide');
							document.getElementById("addcform").reset();
							$("#dt-basic-example").DataTable().ajax.reload();
						}
					}
				});
			}
		});
	});
</script>
	
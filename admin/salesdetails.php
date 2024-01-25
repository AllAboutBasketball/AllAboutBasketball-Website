<?php
include 'dbconnection.php';
$id = $_GET['id'];
$result = $mysqli->query("select * from orders where id = '$id'");
$row = mysqli_fetch_assoc($result);
$oid = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$tracking_no = $row['tracking_no'];
$address = $row['address'];
$zip_code = $row['zip_code'];
$totalprice = $row['total_price'];
$payment_mode = $row['payment_mode'];
$status = $row['status'];
?>
<div class="modal fade  modal-fullscreen" id="update_modal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-hidden="true">
	<div class="modal-dialog">
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
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<div class="form-row" align="center">
														<div class="col-md-12 mb-3">
															<div class="alert alert-primary">
																<div class="d-flex flex-start w-100">
																	<div class="d-flex flex-fill">
																		<div class="flex-fill">
																			<span class="h4">DELIVERY INFORMATION</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Customer Name<span class="text-danger"></span> </label>
													<input type="hidden" class="form-control"  autocomplete="off" name="eid" id="eid" value="<?php echo $id ?>" required>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $name ?>" required>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Email<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $email ?>" required>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Phone No.<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $phone ?>" required>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Tracking No.<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $tracking_no ?>" required>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Address<span class="text-danger"></span> </label>
													<textarea disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" required><?php echo $address ?></textarea>
												</div>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Zip Code.<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $zip_code ?>" required>
												</div>
											</div>
										</div>
										<div class="col-md-6 mb-3">
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<div class="form-row" align="center">
														<div class="col-md-12 mb-3">
															<div class="alert alert-primary">
																<div class="d-flex flex-start w-100">
																	<div class="d-flex flex-fill">
																		<div class="flex-fill">
																			<span class="h4">ORDER DETAILS</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-row">
												<table class="table table-bordered table-hover table-striped w-100">
													<thead class="bg-primary-600">
														<tr>
															<th>Product</th>
															<th>Quantity</th>
															<th>Price</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$result = $mysqli->query("select * from order_items where order_id='$oid'");
														while($row=mysqli_fetch_assoc($result)){
															$pid = $row['prod_id'];
															$qty = $row['qty'];
															$price = $row['price'];
															$productres = $mysqli->query("select * from products where id ='$pid'");
															$productrow = mysqli_fetch_assoc($productres);
															$pname = $productrow['name'];
															$pimage = $productrow['image'];
													?>
														<tr>
															<td><img src="uploads/<?php echo $pimage ?>" height="50px" width="50px"/> <?php echo $pname ?></td>
															<td>X <?php echo $qty ?></td>
															<td><?php echo $price ?></td>
														</tr>
													<?php } ?>
													</tbody>
													<tfoot  class="bg-primary-600">
														<tr>
															<th>Total Price:</th>
															<th></th>
															<th><?php echo $totalprice ?></th>
														</tr>
													</tfoot>	
												</table>
											</div>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Mode of payment<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $payment_mode ?>" required>
												</div>
											</div>
											<?php
                                                if($status == 8){ $statusname = 'Delivered'; } 
											?>
											<div class="form-row">
												<div class="col-md-12 mb-3">
													<label class="form-label">Status<span class="text-danger"></span> </label>
													<input type="text" disabled class="form-control"  autocomplete="off" name="oprice" id="oprice" value="<?php echo $statusname ?>" required>
												</div>
											</div>
										</div>
									</div>
                                </div>
								<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
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

                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        
        <div id="biometrixdiv"><div>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script src="js/dependency/moment/moment.js"></script>
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <script src="js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="js/formplugins/inputmask/inputmask.bundle.js"> </script>
		<link href="js/x-editable/bootstrap-editable.css" rel="stylesheet"/>
		<script src="js/x-editable/bootstrap-editable.min.js"></script>
        <script src="js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
		<script src="js/datagrid/datatables/datatables.bundle.js"></script>
        <script src="js/formplugins/dropzone/dropzone.js"></script>

		<script>
			$(document).ready(function() {
				$(":input").inputmask();
			});
					    
            function biometrix(id){
                $.ajax({
                    url:'employeebiometrix.php?id='+id,
                    type:'post',
                    success  : function(data) {
                        $("#biometrixdiv").html(data);
                        $('#biometrixmodal').modal('show');
                    }
                });
            }      
            function leavefiling(id){
                $.ajax({
                    url:'employeeleavefiling.php?id='+id,
                    type:'post',
                    success  : function(data) {
                        console.log(data);
                        $("#biometrixdiv").html(data);
                        $('#leavemodal').modal('show');
                    }
                });
            }     
            function payslip(id){
                $.ajax({
                    url:'employeepayslip.php?id='+id,
                    type:'post',
                    success  : function(data) {
                        console.log(data);
                        $("#biometrixdiv").html(data);
                        $('#payslipmodal').modal('show');
                    }
                });
            }  

            function printpayslip(cutoff, id) {
                window.open('employeeprintpayslip.php?id=' + id + '&cutoff=' + cutoff, '_blank');
            }  
		</script>
    </body>
</html>

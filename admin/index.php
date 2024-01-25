<?php
include 'template/header.php';
include('includes/adminFunctions.php');
$new_count = getNewOrdersCount();
$completed_count = getCompletedOrdersCount();
$user_count = getUserCount();
$employee_count = getEmployeeCount();
$product_count = getProductsCount();
$supplier_count = getSupplierCount();
$collection_count = getCollectionCount();
?>
<link rel="stylesheet" type="text/css" href="js/chart/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="js/chart/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="js/chart/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="js/chart/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" language="javascript" src="js/chart/highcharts.js"></script>
	<script type="text/javascript" class="init">
		$(document).ready(function() {
		    var table = $("#example").DataTable({
                    responsive: true,
                    order: [[ 0, "desc" ]],
			        processing:true,
                    bLengthChange: false
			});
		    var salary = getSalaries(table);
		 
		    var axis = {
		        id: "salary",
		        min: 0,
		        title: {
		            text: "Sales"
		        }
		    };
		 
		    var series = {
		        name: "Transaction Date",
		        data: Object.values(salary)
		    };
		 
		    var myChart = Highcharts.chart("demo-output", {
		        chart: {
		            type: "line"
		        },
		        title: {
		            text: "Sales"
		        },
		        xAxis: {
		            categories: Object.keys(salary)
		        },
		        yAxis: axis,
		        series: [series]
		    });
		 
		    table.on("draw", function() {
		        salary = getSalaries(table);
		        myChart.axes[0].categories = Object.keys(salary);
		        myChart.series[0].setData(Object.values(salary));
		    });
		});
		 
		function getSalaries(table) {
		    var salaryCounts = {};
		    var salary = {};
		     
		    var indexes = table
		        .rows({ search: "applied" })
		        .indexes()
		        .toArray();
		     
		    for (var i = 0; i < indexes.length; i++) {
		        var office = table.cell(indexes[i], 0).data();
		        if (salaryCounts[office] === undefined) {
		            salaryCounts[office] = [+table.cell(indexes[i], 1).data().replace(/[^0-9.]/g, "")];
		        }
		        else {
		            salaryCounts[office].push(+table.cell(indexes[i], 1).data().replace(/[^0-9.]/g, ""));
		        }
		    }
		     
		    var keys = Object.keys(salaryCounts);
		     
		    for (var i = 0; i < keys.length; i++) {
		        var length = salaryCounts[keys[i]].length;
		        var total = salaryCounts[keys[i]].reduce((a, b) => a + b, 0);
		        salary[keys[i]] = total / length;
		    }
		 
		    return salary;
		};

	</script>

                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo $title; ?></a></li>
                            <li class="breadcrumb-item">DASHBOARD</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="row">
                                            <div class="col-sm-12 col-xl-6">
		                                        <?php
                                                    if(isset($_POST['from']) && isset($_POST['to']) ){
                                                        $from=date("Y-m-d",strtotime($_POST['from']));
                                                        $to=date("Y-m-d",strtotime($_POST['to']));
                                                        $query = "select DATE_FORMAT(created_at, '%m - %M %d %Y') as TDATE,DATE_FORMAT(created_at, '%Y-%m-%d') as TRDATE, status from orders where created_at >= '$from' and created_at <= '$to' and status='8' GROUP BY TDATE ORDER BY id desc";
                                                    }else{
                                                        $from=date("Y-m-d");
                                                        $to=date("Y-m-d");
                                                        $query = "select DATE_FORMAT(created_at, '%m - %M %d %Y') as TDATE,DATE_FORMAT(created_at, '%Y-%m-%d') as TRDATE, status from orders where created_at >= '$from' and created_at <= '$to' and status='8' GROUP BY TDATE ORDER BY id desc";
                                                    }
                                                    $statement = $connect->prepare($query);
                                                    $statement->execute();
                                                    $result = $statement->fetchAll();
                                                ?>
                                                <form method="post" action="index.php" >
                                                    <div class="form-row">
                                                        <label class="col-form-label form-label text-lg-right">from : </label>
                                                        <div class="col-md-12  col-lg-4  col-xl-2">
                                                            <input type="date" name="from" required class="form-control" value="<?php echo $from; ?>">
                                                            <input type="hidden" id="fdate" name="fdate" required class="form-control" value="<?php echo $from; ?>">
                                                        </div>
                                                        <label class="col-form-label form-label text-lg-right">to : </label>
                                                        <div class="col-md-12  col-lg-4  col-xl-2">
                                                            <input type="date" name="to" required class="form-control" value="<?php echo $to; ?>">
                                                            <input type="hidden" id="tdate1" name="tdate1" required class="form-control" value="<?php echo $to; ?>">
                                                        </div>
                                                        <div class="col-md-12  col-lg-2  col-xl-2">
                                                            <button class="btn btn-primary ml-auto" type="submit">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <br/><br/>
                                                <div class="card">
                                                    <div class="card-header">Graph</div>
                                                    <div class="card-body">
                                                        <div id="demo-output" style="margin-bottom: 1em;" class="chart-display"></div>
                                                        <table id="example" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Transaction Date</th>
                                                                    <th>Total Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $result = $mysqli->query("SELECT SUM(total_price) AS total, DATE_FORMAT(created_at, '%Y-%m-%d') AS transdate FROM orders where created_at >='$from' and created_at <= '$to' GROUP BY DATE_FORMAT(created_at, '%Y-%m-%d');")or die("Error description: " . $mysqli -> error);
                                                            while($row = mysqli_fetch_assoc($result)){
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $row['transdate'] ?></td>
                                                                    <td><?php echo $row['total'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Transaction Date</th>
                                                                    <th>Total Price</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-sm-12 col-xl-6"><br/><br/><br/><br/>
                                                <div class="row">
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                                                    <?php echo $new_count; ?>
                                                                    <small class="m-0 l-h-n">New Orders</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-warehouse position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                                                    <?php echo $completed_count; ?>
                                                                    <small class="m-0 l-h-n">Completed Orders</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-warehouse position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $user_count; ?>
                                                                    <small class="m-0 l-h-n">Today's Users</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-user-plus position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $user_count; ?>
                                                                    <small class="m-0 l-h-n">Followers</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-chart-bar position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $employee_count; ?>
                                                                    <small class="m-0 l-h-n">Employees</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $supplier_count; ?>
                                                                    <small class="m-0 l-h-n">Supplier</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $product_count; ?>
                                                                    <small class="m-0 l-h-n">Products</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-boxes position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xl-4">
                                                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                                            <div class="">
                                                                <h3 class="display-4 d-block l-h-n m-0 fw-500"><?php echo $collection_count; ?>
                                                                    <small class="m-0 l-h-n">Collections</small>
                                                                </h3>
                                                            </div>
                                                            <i class="fal fa-images position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>


<?php
include 'template/footer.php';
?>
<script src="js/formplugins/select2/select2.bundle.js"></script>

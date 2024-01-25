<style>
        body {
        background: #f0f0f0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        padding: 20px;
        height: 100%;
    }

    @import url('https://fonts.googleapis.com/css?family=Roboto:200,300,400,600,700');

    * {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        color: #444;
    }

    #payslip {
        width: calc( 8.5in - 80px );
        height: calc( 11in - 60px );
        background: #fff;
        padding: 30px 40px;
    }

    #title {
        margin-bottom: 20px;
        font-size: 38px;
        font-weight: 600;
    }

    #scope {
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        padding: 7px 0 4px 0;
        display: flex;
        justify-content: space-around;
    }

    #scope > .scope-entry {
        text-align: center;
    }

    #scope > .scope-entry > .value {
        font-size: 14px;
        font-weight: 700;
    }

    .content {
        display: flex;
        border-bottom: 1px solid #ccc;
        height: 880px;
    }

    .content .left-panel {
        border-right: 1px solid #ccc;
        min-width: 200px;
        padding: 20px 16px 0 0;
    }

    .content .right-panel {
        width: 100%;
        padding: 10px 0  0 16px;
    }

    #employee {
        text-align: center;
        margin-bottom: 20px;
    }
    #employee #name {
        font-size: 15px;
        font-weight: 700;
    }

    #employee #email {
        font-size: 11px;
        font-weight: 300;
    }

    .details, .contributions, .ytd, .gross {
        margin-bottom: 20px;
    }

    .details .entry, .contributions .entry, .ytd .entry {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .details .entry .value, .contributions .entry .value, .ytd .entry .value {
        font-weight: 700;
        max-width: 130px;
        text-align: right;
    }

    .gross .entry .value {
        font-weight: 700;
        text-align: right;
        font-size: 16px;
    }

    .contributions .title, .ytd .title, .gross .title {
        font-size: 15px;
        font-weight: 700;
        border-bottom: 1px solid #ccc;
        padding-bottom: 4px;
        margin-bottom: 6px;
    }

    .content .right-panel .details {
        width: 100%;
    }

    .content .right-panel .details .entry {
        display: flex;
        padding: 0 10px;
        margin: 6px 0;
    }

    .content .right-panel .details .label {
        font-weight: 700;
        width: 120px;
    }

    .content .right-panel .details .detail {
        font-weight: 600;
        width: 130px;
    }

    .content .right-panel .details .rate {
        font-weight: 400;
        width: 80px;
        font-style: italic;
        letter-spacing: 1px;
    }

    .content .right-panel .details .amount {
        text-align: right;
        font-weight: 700;
        width: 90px;
    }

    .content .right-panel .details .net_pay div, .content .right-panel .details .nti div {
        font-weight: 600;
        font-size: 12px;
    }

    .content .right-panel .details .net_pay, .content .right-panel .details .nti {
        padding: 3px 0 2px 0;
        margin-bottom: 10px;
        background: rgba(0, 0, 0, 0.04);
    }

</style>
<?php
include 'dbconnection.php';
$cutoffid = $_GET['cutoff'];
$id = $_GET['id'];
$cutoffresult = $mysqli->query("select * from tbl_payroll_cutoff where id='$cutoffid'");
$cutoffrow = mysqli_fetch_assoc($cutoffresult);
$startdate = $cutoffrow['start_date'];
$enddate = $cutoffrow['end_date'];

$empresult = $mysqli->query("select * from employee where id='$id'");
$emprow = mysqli_fetch_assoc($empresult);
$name = $emprow['name'];
$email = $emprow['email'];
$empid = $emprow['emp_id'];
$salary = $emprow['salary'];
$hrrate = $salary / 8;
$datehired = $emprow['date_hiring'];

$result = $mysqli->query("select * from tbl_payroll where cutoffid = '$cutoffid' and empid = '$id'");
$row = mysqli_fetch_assoc($result);
$noworkdays = $row['total_no_days_work'];
$noworkhrs = $row['total_no_hrs_work'];
$grosspay = $salary * $noworkdays;
$lates = $row['total_no_lates_hrs'];
$latededuction = $row['total_deduction'];
$netpay = $row['net_pay'];
?>
<div id="payslip">
	<div id="title">Payslip</div>
	<div id="scope">
		<div class="scope-entry">
			<div class="title"></div>
			<div class="value"></div>
		</div>
		<div class="scope-entry">
			<div class="title">PAY PERIOD</div>
			<div class="value"><?php echo $startdate ?> - <?php echo $enddate ?></div>
		</div>
	</div>
	<div class="content">
		<div class="left-panel">
			<div id="employee">
				<div id="name">
					<?php echo $name ?>
				</div>
				<div id="email">
					<?php echo $email?>
				</div>
			</div>
			<div class="details">
				<div class="entry">
					<div class="label">Employee ID</div>
					<div class="value"><?php echo $empid ?></div>
				</div>
				<div class="entry">
					<div class="label">Daily Rate</div>
					<div class="value"><?php echo $salary ?></div>
				</div>
				<div class="entry">
					<div class="label">Hourly Rate</div>
					<div class="value"><?php echo $hrrate ?></div>
				</div>
				<div class="entry">
					<div class="label">Date Hired</div>
					<div class="value"><?php echo $datehired ?></div>
				</div>
				<div class="entry">
					<div class="label">Payroll Cycle</div>
					<div class="value">Daily</div>
				</div>
				<div class="entry">
					<div class="label">Day(s) work</div>
					<div class="value"><?php echo $noworkdays ?></div>
				</div>
				<div class="entry">
					<div class="label">Hr(s) work</div>
					<div class="value"><?php echo $noworkhrs ?></div>
				</div>
			</div>
			<div class="gross">
				<div class="title">Gross Income</div>
				<div class="entry">
					<div class="label"></div>
					<div class="value"><?php echo $grosspay ?></div>
				</div>
			</div>
		</div>
		<div class="right-panel">
			<div class="details">
				<div class="basic-pay">
					<div class="entry">
						<div class="label">Basic Pay</div>
						<div class="detail"></div>
						<div class="rate"><?php echo $salary ?>/Day</div>
						<div class="amount"><?php echo $salary ?></div>
					</div>
				</div>
				<div class="salary">
					<div class="entry">
						<div class="label">Salary</div>
						<div class="detail"></div>
						<div class="rate"></div>
						<div class="amount"></div>
					</div>
					<div class="entry">
						<div class="label"></div>
						<div class="detail">Day(s) Work</div>
						<div class="rate"><?php echo $grosspay ?></div>
						<div class="amount"><?php echo $grosspay ?></div>
					</div>
					<div class="entry">
						<div class="label"></div>
						<div class="detail">Late(s)</div>
						<div class="rate"><?php echo $lates ?></div>
						<div class="amount">(<?php echo $latededuction ?>)</div>
					</div>
				</div>
				<div class="net_pay">
					<div class="entry">
						<div class="label">NET PAY</div>
						<div class="detail"></div>
						<div class="rate"></div>
						<div class="amount"><?php echo $netpay ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
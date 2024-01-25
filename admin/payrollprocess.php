<?php
include 'dbconnection.php';
$cid = $_GET['cid'];
$cutoffres = $mysqli->query("select * from tbl_payroll_cutoff where id='$cid'");
$cutoffrow = mysqli_fetch_assoc($cutoffres);
$cutoffstart = $cutoffrow['start_date'];
$cutoffend = $cutoffrow['end_date'];

$result = $mysqli->query("select * from employee");
while($row = mysqli_fetch_assoc($result)){
    $salary = $row['salary'];
    $workdays = 0;
    $leavedays = 0;
    $worktime = 0;
    $empid = $row['id'];

    $attendancedaysres = $mysqli->query("SELECT COUNT(id) as count, date as date, emp_id FROM  attendance WHERE (date >='$cutoffstart' and date <='$cutoffend') and emp_id='$empid' GROUP BY  emp_id, DATE(date);
    ");
    while($attendancedaysrow = mysqli_fetch_assoc($attendancedaysres)){
        $workdays = $workdays +1;
    }

    $attendanceres = $mysqli->query("SELECT emp_id, DATE(date) AS date, TIME_FORMAT(SEC_TO_TIME(SUM(CASE WHEN status = 'TIME IN' THEN TIME_TO_SEC(time) ELSE 0 END)), '%H:%i') AS biotimein, TIME_FORMAT(SEC_TO_TIME(SUM(CASE WHEN status = 'TIME OUT' THEN TIME_TO_SEC(time) ELSE 0 END)), '%H:%i') AS biotimeout FROM  attendance WHERE (date >='$cutoffstart' and date <='$cutoffend') and emp_id='$empid' GROUP BY  emp_id, DATE(date);
    ");
    while($attendancerow = mysqli_fetch_assoc($attendanceres)){
        $bioempid = $attendancerow['emp_id'];
        $biodate = $attendancerow['date'];
        $biotimein = $attendancerow['biotimein'];
        $biotimeout = $attendancerow['biotimeout'];
        $timeIn = new DateTime($biotimein);
        $timeOut = new DateTime($biotimeout);
        $timeDiff = $timeIn->diff($timeOut);
        $totalHours = $timeDiff->h + ($timeDiff->i / 60);
        $worktime = $totalHours + $worktime;
    }

    $leaveres = $mysqli->query("SELECT SUM(days) as count, start_date, end_date, emp_id, status FROM  app_leave WHERE (start_date >='$cutoffstart' and end_date <='$cutoffend') and emp_id='$empid' and status = 'APPROVED' and (leave_type = 'LEAVE W/ PAY' or leave_type = 'SICK LEAVE W/ PAY');
    ");
    while($leaverow = mysqli_fetch_assoc($leaveres)){
       $leavedays = $leaverow['count'];
    }
    echo $leavedays;
    echo $workdays;
    echo $workdays = $leavedays + $workdays;
    $worktime = ($leavedays * 8) + $worktime ;
    $paypermin = ($salary / 8)/60;
    $totalworkhrs = $workdays * 8;
    $totallates = $totalworkhrs - $worktime;
    $workmin = $worktime * 60;
    $totalpay = $salary * $workdays;
    $netpay = $paypermin * $workmin;
    $deduction = $totalpay - $netpay;
    
    $checkres = $mysqli->query("select * from tbl_payroll where cutoffid = '$cid' and empid = '$empid'")or die("Error description: " . $mysqli -> error);
    if(mysqli_num_rows($checkres) > 0){
        $mysqli->query("UPDATE tbl_payroll set total_no_days_work = '$workdays', total_no_hrs_work='$worktime', total_no_lates_hrs='$totallates', pay_per_day='$salary', net_pay='$netpay', total_deduction='$deduction' where  cutoffid = '$cid' and empid = '$empid'")or die("Error description: " . $mysqli -> error);
    }else{
        $mysqli->query("INSERT INTO tbl_payroll(cutoffid, empid,  total_no_days_work, total_no_hrs_work, total_no_lates_hrs, pay_per_day, net_pay, total_deduction) values ('$cid','$empid','$workdays','$worktime','$totallates','$salary','$netpay','$deduction')")or die("Error description: " . $mysqli -> error);
    }
}


?>
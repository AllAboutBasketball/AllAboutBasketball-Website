<?php
session_start();
require 'auth.php';
$title1='All About Basketball';
include 'dbconnection.php';
$userid = $_SESSION['login_id'];
$role = $_SESSION['login_userlevel'];
$roleresult = $mysqli->query("select * from tbl_role where id = '$role'");
$rolerow = mysqli_fetch_assoc($roleresult);
$username = $_SESSION['user_name'];
$title = 'ALL ABOUT BASKETBALL';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $title1; ?>
        </title>
        <meta name="description" content="Export">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/themes/cust-theme-3.css">
        <!--<link rel="icon" type="image/png" sizes="32x32" href="img/qems.ico">-->
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/dropzone/dropzone.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/select2/select2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartjs/chartjs.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        
    </head>
		<style>
		.loader 
		{
		 position: fixed;
		 left: 0px;
		 top: 0px;
		 width: 100%;
		 height: 100%;
		 z-index: 9999;
		 background: url('img/loading.gif') 50% 50% no-repeat rgb(249,249,249);
		}
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		    -webkit-appearance: none;
		    -moz-appearance: none;
		    appearance: none; 
		}
		</style>
    <body class="mod-bg-1 nav-function-top">
    
<div class="loader">
</div>
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <style>
        .swal2-container {
            z-index: 10000;
        }

        </style>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li><a href="index.php" title="Dashboard" ><i class="fal fa-chart-pie"></i><span class="nav-link-text" >Dashboard</span></a></li>
                            
                            <?php
                                if($role =='2' || $role =='1'){
							?>
                            <li>
                                <a href="#" title="Human Resource" ><i class="fal fa-users"></i><span class="nav-link-text" >Human Resource</span></a>
                                <ul>
                                    <li><a href="employee.php" title="Employee List"  ><span class="nav-link-text" >Employee List</span></a></li>
                                    <li><a href="attendance.php" title="Attendance"  ><span class="nav-link-text" >Attendance</span></a></li>
                                    <li><a href="leave-application.php" title="Leave Info"  ><span class="nav-link-text" >Leave Info</span></a></li>
                                    <li><a href="payroll.php" title="Payroll"  ><span class="nav-link-text" >Payroll</span></a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php
                                if($role =='3' || $role =='4' || $role =='1'){
							?>
                            <li><a href="sales.php" title="Sales" ><i class="fal fa-money-bill"></i><span class="nav-link-text" >Sales</span></a></li>
                            <li>
                                <a href="#" title="Supply Chain" ><i class="fal fa-box"></i><span class="nav-link-text" >Supply Chain</span></a>
                                <ul>
                                    <li><a href="collectionlist.php" title="All collection"  ><span class="nav-link-text" >All collection</span></a></li>
                                    <li><a href="productlist.php" title="All Products"  ><span class="nav-link-text" >All Products</span></a></li>
                                    <li>
                                        <a href="#" title="Ordersn" ><i class="fal fa-box"></i><span class="nav-link-text" >Orders</span></a>
                                        <ul>
                                            <li><a href="orders.php" title="Pending Orders"  ><span class="nav-link-text" >Pending Orders</span></a></li>
                                            <li><a href="ordershist.php" title="Complete / Canceled Order"  ><span class="nav-link-text" >Complete / Canceled Order</span></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="confirmedorders.php" title="Confirmed Orders"  ><span class="nav-link-text" >Confirmed Orders</span></a></li>
                                    <li><a href="supplierlist.php" title="Supplier List"  ><span class="nav-link-text" >Supplier List</span></a></li>
                                    <li><a href="Courier.php" title="Courier"  ><span class="nav-link-text" >Courier</span></a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php
                                if($role =='4' || $role =='1'){
							?>
                            <li>
                                <a href="#" title="Warehouse" ><i class="fal fa-building"></i><span class="nav-link-text" >Warehouse</span></a>
                                <ul>
                                    <li><a href="inventory.php" title="Inventory"  ><span class="nav-link-text" >Inventory</span></a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php
                                if($role =='2' || $role =='1'){
							?>
                            <li>
                                <a href="#" title="Warehouse" ><i class="fal fa-building"></i><span class="nav-link-text" >Customer Relation</span></a>
                                <ul>
                                    <li><a href="customerlist.php" title="Customer List"  ><span class="nav-link-text" >Customer List</span></a></li>
                                    <li><a href="collab.php" title="Users Design"  ><span class="nav-link-text" >Users Design</span></a></li>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php
                            if($role =='1'){
								?>
                            <li>
                                <a href="#" title="Report" ><i class="fal fa-cog"></i><span class="nav-link-text" >Settings</span></a>
                                <ul>
                                    <li><a href="sposition.php" title="Position List"><span class="nav-link-text">Position</span></a></li>
                                </ul>
                            </li>
							<?php
							}
                            ?> 
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="img/logo1remove.png" aria-roledescription="logo" style="height: 50px">
                            </a>
                        </div>
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <div>
                                <a href="#" data-toggle="dropdown" title="" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="img/golf.png" class="profile-image rounded-circle" alt="Administrator">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">

                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" onclick="biometrix(<?php echo $userid ?>)">
                                        <span >Biometrix</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" onclick="leavefiling(<?php echo $userid ?>)">
                                        <span>Leave Filing</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" onclick="payslip(<?php echo $userid ?>)">
                                        <span>Payslip</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="logout.php">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>
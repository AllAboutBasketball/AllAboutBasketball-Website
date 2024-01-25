<?php
session_start();
require 'auth.php';
include 'admin/dbconnection.php';
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
        All About Basketball
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="admin/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/app.bundle.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/themes/cust-theme-4.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="admin/img/favicon/apple-touch-icon.png">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="admin/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/notifications/sweetalert2/sweetalert2.bundle.css">
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    
                    <div class="flex-1" style="background: url(admin/img/backgrounds/bg-1.png) ; background-size: cover;background-position: center; background-repeat: no-repeat;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4 hidden-sm-down">
                                    
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4"><br/><br/><br/><br/>
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                        All About Basketball login
                                    </h1>
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <form id="login" >
                                            <div class="form-group">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" id="username" name="u" class="form-control form-control-lg" autocomplete="off" placeholder="enter username" required>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <div class="help-block">Your username</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" id="password" name="p" class="form-control form-control-lg"  autocomplete="off"  placeholder="enter password"  required>
                                                <div class="invalid-feedback">Sorry, you missed this one.</div>
                                                <div class="help-block">Your password</div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-5 pl-lg-1 my-2">
                                                    <button  type="submit" id="button-addon5" class="btn btn-default btn-block btn-lg">Login</button>
                                                </div>
                                                <div class="offset-lg-2 col-lg-5 pr-lg-1 my-2">
                                                    <button type="reset" class="btn btn-danger btn-block btn-lg">Clear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
        <script src="admin/js/vendors.bundle.js"></script>
        <script src="admin/js/app.bundle.js"></script>
        <script src="admin/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <script>
            $(document).ready(function(e){
				$("#login").on('submit', function(e){
					e.preventDefault();
					var form = $("#login")
					if (form[0].checkValidity() === false){
					    event.preventDefault()
					    event.stopPropagation()
					}
					var data = new FormData($('#login')[0]);
					$.ajax({
						type: 'POST',
						url: 'login.php',
						data: data,
						contentType: false,
						cache: false,
						processData:false,
						success: function(response){ //console.log(response);
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
									title: "Login success.. Redirect after 4 seconds",
									showConfirmButton: false,
									timer: 3500
								}).then(function() {
									window.location="admin/"; 
								})


                            }
						}
					});         
				});	    
			});
        </script>
    </body>
</html>

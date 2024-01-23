<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php');
include('includes/adminFunctions.php');

$new_count = getRecentOrdersCount();
$completed_count = getCompletedOrdersCount();
$user_count = getTodaysUsersCount();
$employee_count = getEmployeeCount();
$product_count = getAllProductsCount();
$supplier_count = getSupplierCount();
$collection_count = getCollectionCount();
?>

<div class="container">
    <div class="row md-4">
        <div class="col-md-12">
            <div class="row mt-4">
                <div class="col-lg-6 col-sm-5">
                    <div class="card  mb-4">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">storefront</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">New Orders</p>
                                <h4 class="mb-0"><?php echo $new_count; ?></h4>
                            </div>
                        </div>

                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person_add</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                                <h4 class="mb-0"><?php echo $user_count; ?></h4>
                            </div>
                        </div>

                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-sm-5 mt-sm-0 mt-4">
                    <div class="card  mb-4">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">store</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Completed Orders</p>
                                <h4 class="mb-0 "><?php echo $completed_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p> -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">leaderboard</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Followers</p>
                                <h4 class="mb-0 "><?php echo $user_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 ">Just updated</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-5 mt-sm-0 mt-4">
                    <div class="card  mb-4">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">groups</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Employees</p>
                                <h4 class="mb-0 "><?php echo $employee_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p> -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">people_alt</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Supplier</p>
                                <h4 class="mb-0 "><?php echo $supplier_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 ">Just updated</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-5 mt-sm-0 mt-4">
                    <div class="card  mb-4">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Products</p>
                                <h4 class="mb-0 "><?php echo $product_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p> -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header p-3 pt-2 bg-transparent">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">collections</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize ">Collections</p>
                                <h4 class="mb-0 "><?php echo $collection_count; ?></h4>
                            </div>
                        </div>

                        <hr class="horizontal my-0 dark">
                        <div class="card-footer p-3">
                            <!-- <p class="mb-0 ">Just updated</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include('includes/footer.php'); ?>
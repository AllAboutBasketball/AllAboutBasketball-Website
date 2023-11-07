<?php 
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark sticky-top" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-6 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php">
        <img src="../assets/images/logo1remove.png" alt="">
        <span class="ms-1 font-weight-bold text-info">All About Basketball</span>
      </a>
    </div>
    <ul class="navbar-nav">
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "index.php"? 'active bg-gradient-info':''; ?>" href="../admin/index.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
          <hr class="horizontal light mt-0 mb-2">
          <!--------------------------------------------------------------------------------->
          <a class="nav-link text-white dropdown-toggle <?= $page == ""? 'active bg-gradient-info':''; ?>" href="#" data-bs-toggle="dropdown">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-0">Human Resource</span>
          </a>
          <ul class="dropdown-menu bg-gradient-dark p-0 m-0">
            <!-- Dropdown menu content -->
            <li class="nav-item">
            <a class="nav-link text-white <?= $page == "employee.php"? 'active bg-gradient-info':''; ?>" href="../admin/employee.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">supervised_user_circle</i>
              </div>
              <span class="nav-link-text ms-1">Employee</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add-employee.php"? 'active bg-gradient-info':''; ?>" href="../admin/add-employee.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person_add</i>
              </div>
              <span class="nav-link-text ms-1">Add Employee</span>
            </a>
          </li> -->
          <hr class="horizontal light mt-0 mb-2"> 
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "attendance.php"? 'active bg-gradient-info':''; ?>" href="../admin/attendance.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">check_circle</i>
              </div>
              <span class="nav-link-text ms-1">Attendance</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add-attendance.php"? 'active bg-gradient-info':''; ?>" href="../admin/add-attendance.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">event_available</i>
              </div>
              <span class="nav-link-text ms-1">Add Attendance</span>
            </a>
          </li> -->
          <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "leave.php"? 'active bg-gradient-info':''; ?>" href="../admin/leave.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">event_note</i>
              </div>
              <span class="nav-link-text ms-1">Leave Info</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add-leave-application.php"? 'active bg-gradient-info':''; ?>" href="../admin/add-leave-application.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">date_range</i>
              </div>
              <span class="nav-link-text ms-1">Leave Application</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "earned-leave.php"? 'active bg-gradient-info':''; ?>" href="../admin/earned-leave.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">event_available</i>
              </div>
              <span class="nav-link-text ms-1">Earned Leave</span>
            </a>
          </li> -->
          <!-- <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "payroll.php"? 'active bg-gradient-info':''; ?>" href="../admin/payroll.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">description</i>
              </div>
              <span class="nav-link-text ms-1">Payroll</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "benefits.php"? 'active bg-gradient-info':''; ?>" href="../admin/benefits.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">attach_money</i>
              </div>
              <span class="nav-link-text ms-1">Benefits</span>
            </a>
          </li> -->
          </ul>
          <hr class="horizontal light mt-0 mb-2"> 
          <!--------------------------------------------------------------------------------->
          <!-- <a class="nav-link text-white dropdown-toggle <?= $page == ""? 'active bg-gradient-info':''; ?>" href="#" data-bs-toggle="dropdown">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">data_usage</i> 
                </div>
                <span class="nav-link-text ms-0">Finance Resource</span>
              </a>
              <ul class="dropdown-menu bg-gradient-dark p-0 m-0"> 
                <li class="nav-item">
                <a class="nav-link text-white <?= $page == "sales-report.php"? 'active bg-gradient-info':''; ?> " href="../admin/sales-report.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">bar_chart</i>
                  </div>
                  <span class="nav-link-text ms-1">Sales Report</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white <?= $page == "all-users.php"? 'active bg-gradient-info':''; ?> " href="../admin/all-users.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">analytics</i>
                  </div>
                  <span class="nav-link-text ms-1"> Product Sale </span>
                </a>
              </li>
              </ul>
              <hr class="horizontal light mt-0 mb-2">  -->
          <!-------------------------------------------------------------------------------------->
          <a class="nav-link text-white dropdown-toggle <?= $page == ""? 'active bg-gradient-info':''; ?>" href="#" data-bs-toggle="dropdown">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">compare_arrows</i>
            </div>
            <span class="nav-link-text ms-0">Supply Chain</span>
          </a>
          <ul class="dropdown-menu bg-gradient-dark p-0 m-0">
            <!-- Dropdown menu content -->
            <li class="nav-item">
            <a class="nav-link text-white <?= $page == "category.php"? 'active bg-gradient-info':''; ?>" href="../admin/category.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">collections</i>
              </div>
              <span class="nav-link-text ms-1">All Collection</span>
            </a>
          </li>
          <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "products.php"? 'active bg-gradient-info':''; ?> " href="../admin/products.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">inventory</i>
              </div>
              <span class="nav-link-text ms-1">All Products</span>
            </a>
          </li>
            <hr class="horizontal light mt-0 mb-2">
            <li class="nav-item">
            <a class="nav-link text-white <?= $page == "orders.php"? 'active bg-gradient-info':''; ?> " href="../admin/orders.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt</i>
              </div>
              <span class="nav-link-text ms-1">Orders</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link text-white <?= $page == "confirmed-orders.php"? 'active bg-gradient-info':''; ?> " href="../admin/confirmed-orders.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">done_all</i>
              </div>
              <span class="nav-link-text ms-1">Confirmed Orders</span>
            </a>
          </li>
          <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "supplier.php"? 'active bg-gradient-info':''; ?> " href="../admin/supplier.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_list</i>
              </div>
              <span class="nav-link-text ms-1">Supplier List</span>
            </a>
          </li>
          <!-- <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "supplier-order.php"? 'active bg-gradient-info':''; ?>" href="../admin/supplier-order.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">storage</i>
              </div>
              <span class="nav-link-text ms-1"> Supplier Order</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "purchase-order.php"? 'active bg-gradient-info':''; ?>" href="../admin/purchase-order.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">storage</i>
              </div>
              <span class="nav-link-text ms-1"> Purchase Order</span>
            </a>
          </li> -->
          <hr class="horizontal light mt-0 mb-2">
          <li class="nav-item">
            <a class="nav-link text-white <?= $page == "delivery.php"? 'active bg-gradient-info':''; ?> " href="../admin/delivery.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10"> moped</i>
              </div>
              <span class="nav-link-text ms-1">Courier</span>
            </a>
          </li>
            <!-- <li class="nav-item">
            <a class="nav-link text-white <?= $page == "delivery.php"? 'active bg-gradient-info':''; ?> " href="../admin/delivery.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">pending</i>
              </div>
              <span class="nav-link-text ms-1">Delivery Status</span>
            </a>
          </li> -->
          <hr class="horizontal light mt-0 mb-2">
          </ul>
      <!--------------------------------------------------------------------------------------------------------->
      <!------------------------------------------------------------------------------------->
      <a class="nav-link text-white dropdown-toggle <?= $page == ""? 'active bg-gradient-info':''; ?>" href="#" data-bs-toggle="dropdown">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">business</i>
            </div>
            <span class="nav-link-text ms-0">Warehouse</span>
          </a>
          <ul class="dropdown-menu bg-gradient-dark p-0 m-0">
            <li class="nav-item">
            <a class="nav-link text-white <?= $page == "inventory.php"? 'active bg-gradient-info':''; ?>" href="../admin/inventory.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">view_module</i>
              </div>
              <span class="nav-link-text ms-1"> Inventory</span>
            </a>
          </li>
          <hr class="horizontal light mt-0 mb-2">
          
          </ul>
          <hr class="horizontal light mt-0 mb-2">
      <!------------------------------------------------------------------------------------------------------------->
      <!-------------------------------------------------------------------------------------->
          <a class="nav-link text-white dropdown-toggle <?= $page == ""? 'active bg-gradient-info':''; ?>" href="#" data-bs-toggle="dropdown">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">help</i>
                </div>
                <span class="nav-link-text ms-0">Customer Relation</span>
              </a>
              <ul class="dropdown-menu bg-gradient-dark p-0 m-0">
              <li class="nav-item">
                <a class="nav-link text-white <?= $page == "collab.php"? 'active bg-gradient-info':''; ?> " href="../admin/collab.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">image</i>
                  </div>
                  <span class="nav-link-text ms-1">User's Design</span>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link text-white <?= $page == "all-users.php"? 'active bg-gradient-info':''; ?> " href="../admin/all-users.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">chat</i>
                  </div>
                  <span class="nav-link-text ms-1">Inquiry</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white <?= $page == "all-users.php"? 'active bg-gradient-info':''; ?> " href="../admin/all-users.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">star</i>
                  </div>
                  <span class="nav-link-text ms-1">Feedback</span>
                </a>
              </li> -->
              <hr class="horizontal light mt-0 mb-2">
              </ul>
                    <!------------------------------------------------------------------------------------------------------------->
      <!-------------------------------------------------------------------------------------->
              <li class="nav-item">
                <a class="nav-link text-white <?= $page == "all-users.php"? 'active bg-gradient-info':''; ?> " href="../admin/all-users.php">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">people</i>
                  </div>
                  <span class="nav-link-text ms-1">Users List</span>
                </a>
              </li>
        </div> 
    </ul>
</aside>

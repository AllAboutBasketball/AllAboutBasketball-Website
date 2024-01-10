<?php 
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark shadow">
    <div class="container">
        <img src="assets/images/logo1remove.png" alt="" height="30px" width="30px">
        <a class="navbar-brand text-primary ms-2" href="index.php">All About Basketball</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" role="search" action="search.php" method="POST">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit" name="search_btn">Search</button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                    <a class="nav-link <?= $page == "add.php"? 'active text-primary':''; ?>" href="add.php">AAB Collab</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == "index.php"? 'active text-primary':''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == "help.php"? 'active text-primary':''; ?>" href="help.php">Help</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= $page == "categories.php"? 'active text-primary':''; ?>" href="categories.php">Collections</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link <?= $page == "cart.php"? 'active text-primary':''; ?>" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == "my-orders.php"? 'active text-primary':''; ?>" href="my-orders.php">Track Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == "reviews.php"? 'active text-primary':''; ?>" href="reviews.php">Order Reviews</a>
                </li>
     
                <?php 
                    if(isset($_SESSION['auth']))
                    {
                        $userId = getCurrentUserID();
                        $img = getUserImage($userId);
                 ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- profile circle image, not that the navbar.php is in a folder named includes and the folder where the image contains is outside the includes folder named userimage -->
                        <img src="userimage/<?php echo $img; ?>" alt="profile" class="rounded-circle" height="30px" width="30px">

                        <?php echo $_SESSION['auth_user']['name']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="admin/index.php">Admin Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php 
                            
                            $collab = getCollabDataByUserID($userId);

                            if(mysqli_num_rows($collab) > 0){
                        ?>
                            <li><a class="dropdown-item" href="collab-history.php">Collab Upload History</a></li>
                            <li><hr class="dropdown-divider"></li>
                        <?php 
                            }
                        ?>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>

                <?php
                }
                else{
                ?>
                    <li class="nav-item">
                    <a class="nav-link <?= $page == "auth-form.php"? 'active text-primary':''; ?>" href="auth-form.php">Login</a>
                    </li>
               <?php
               }
               ?>

            </ul>

        </div>
    </div>
</nav>
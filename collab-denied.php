<?php 
    include('functions/userfunctions.php');
    include('includes/header.php');
    include('authenticate.php');
    
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Profile / 
            </a>
            <a href="collab-history.php" class = "text-white">
            COLLAB HISTORY PAGE
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <?php 
                $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
            ?>
            <nav class="navbar navbar-expand-lg navbar-secondary sticky-top bg-info shadow">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="text-white">   
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="collab-history.php">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="collab-approved.php">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark active text-white" href="collab-denied.php">Denied</a>
                            </li>

                        </ul>
                        </div> 
                    </div>
                </div>
            </nav>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-success fw-bold">ID</th>
                                <th class="text-success fw-bold">Cloth Size</th>
                                <th class="text-success fw-bold">Color</th>
                                <th class="text-success fw-bold">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $userId = getCurrentUserID();
                                $collab = getCollabDataByUserID($userId);
    
                                if(mysqli_num_rows($collab) > 0){
                                    foreach ($collab as $items) {
                                        if($items['status'] == 2){
                            ?>
                                        <tr>
                                            <td><?= $items['id']; ?></td>
                                            <td><?= $items['cloth_size']; ?></td>
                                            <td><?= $items['color']; ?></td>
                                            <td>
                                                <a href="collab-view.php?t=<?= $items['id']; ?>" class="btn btn-outline-success">View Details</a>
                                            </td>
                                        </tr>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('./includes/footer.php')
?>

<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Home / 
            </a>
            <a href="add.php" class = "text-white">
            My Own Design
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
<nav class="navbar navbar-expand-lg navbar-secondary sticky-top bg-info shadow" style="z-index: 100;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="text-white">   
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                    <a class="nav-link text-dark<?= $page == "add.php"? 'active text-white':''; ?>" href="add.php">Collaboration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="data.php">Upload History</a>
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
                                <th class="text-success fw-bold">Description</th>
                                <th class="text-success fw-bold">Image</th>
                                <th class="text-success fw-bold">Size</th>
                                <th class="text-success fw-bold">Color</th>
                                <th class="text-success fw-bold">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getCollab("upload");
                                $userId = getCurrentUserID();
                                if(mysqli_num_rows($orders) > 0)
                                {
                                    foreach ($orders as $items) {
                                        if($items['user_id'] == $userId){
                                        ?>
                                            <tr>
                                                <td><?= $items['id']; ?></td>
                                                <td><?= $items['name']; ?></td>
                                                <td> <img src="userdesign/<?php echo $items["image"]; ?>" width = "50px" height = "50px" title="<?php echo $items['image']; ?>"> </td>
                                                <td><?php echo $items['cloth_size']; ?> </td>
                                                <td><?php echo $items['color']; ?> </td>
                                                <td>
                                                    <a href="collab-view.php?id=<?= $items['id']; ?>" class="btn btn-outline-primary">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="6">No Records Yet</td>
                                        </tr>
                                    <?php   
                                }
                            ?>
                           
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

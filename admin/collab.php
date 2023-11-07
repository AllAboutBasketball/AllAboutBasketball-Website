
<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');


?>

<div class="container">
    <div class="row">
        <div class="colmd-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">User's Design
                        <a href="collab-history.php" class="btn btn-danger float-end"><i class="fa fa-history me-1"></i>History</a>
                   </h4>
               </div>
               <div class="card-body" id="">
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
                                $orders = getAllCollab();

                                if(mysqli_num_rows($orders) > 0)
                                {
                                    foreach ($orders as $items) {
                                        ?>
                                            <tr>
                                                <td><?= $items['id']; ?></td>
                                                <td><?= $items['name']; ?></td>
                                                <td class="text-center">
                                                <img src="../userdesign/<?= $items['image']; ?>" width = "50px" height = "50px" alt="<?= $items['name']; ?>">
                                            </td>
                                                <td><?php echo $items['cloth_size']; ?> </td>
                                                <td><?php echo $items['color']; ?> </td>
                                                <td>
                                                    <a href="view-collab.php?t=<?= $items['name']; ?>" class="btn btn-outline-primary">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
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

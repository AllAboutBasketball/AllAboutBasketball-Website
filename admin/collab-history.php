<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
include("includes/adminFunctions.php");


?>

<div class="container">
    <div class="card card-body shadow">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-success fw-bold">ID</th>
                            <th class="text-success fw-bold">Cloth Size</th>
                            <th class="text-success fw-bold">Image</th>
                            <th class="text-success fw-bold">Color</th>
                            <th class="text-success fw-bold">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $collab = getAllUploadData();

                            if(mysqli_num_rows($collab) > 0){
                                foreach ($collab as $items) {
                                    if($items['status'] != 0){
                        ?>
                                    <tr>
                                        <td><?= $items['id']; ?></td>
                                        <td><?= $items['cloth_size']; ?></td>
                                        <td class="text-center">
                                            <img src="../userdesign/<?= $items['image']; ?>" width = "50px" height = "50px" alt="<?= $items['name']; ?>">
                                        </td>
                                        <td><?= $items['color']; ?></td>
                                        <td>
                                            <a href="view-collab.php?id=<?= $items['id']; ?>" class="btn btn-outline-success">View Details</a>
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
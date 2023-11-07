<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');


?>

<div class="container">
    <div class="row">
        <div class="colmd-12">
           <div class="card">
               <div class="card-header bg-info">
                   <h4 class="text-white">Users
                        <a href="index.php" class="btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                   </h4>
               </div>
               <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-success fw-bold text-center">ID</th>
                                <th class="text-success fw-bold text-center">Name</th>
                                <th class="text-success fw-bold text-center">Email</th>
                                <th class="text-success fw-bold text-center">Phone</th>
                                <th class="text-success fw-bold text-center">Date Created</th>
                                <th class="text-success fw-bold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $info = getAllInfos('users');

                                if(mysqli_num_rows($info) > 0)
                                {
                                    foreach ($info as $items) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $items['id']; ?></td>
                                                <td class="text-center"><?= $items['name']; ?></td>
                                                <td class="text-center"><?= $items['email']; ?></td>
                                                <td class="text-center"><?= $items['phone']; ?></td>
                                                <td class="text-center"><?= $items['created_at']; ?></td>
                                                <td class="text-center">
                                                    <a href="view-user.php?id=<?= $items['id']; ?>" class="btn btn-success">View Details</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="5">No Users Yet</td>
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
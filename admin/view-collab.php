<?php

include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
include("includes/adminFunctions.php");

if (isset($_GET['id'])) {
    $uploadID = intval($_GET['id']);
    $result = getUploadData($uploadID);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        die("Error fetching data.");
    }
} else {
    die("ID not set.");
}
?>


<div class="container">
    <div class="row">
        <div class="colmd-12">
            <div class="card">
                <div class="card-header bg-info">
                    <span class="fs-4 fw-bold text-white">View User Collab Upload Details</span>                          
                    <a href="collab.php" class="btn btn-warning float-end"><i class="fa fa-reply me-1"></i>Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Collab Image</h4>
                            <hr>
                            <img src="./../userdesign/<?php echo $data['image']?>" width="400px" height="50px" class="float-start img-fluid"/> 
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    Details
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['name']; ?></h5>
                                    <p class="card-text">
                                        <strong>Cloth Size:</strong> <?php echo $data['cloth_size']; ?><br>
                                        <strong>Color:</strong> <?php echo $data['color']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <label class="fw-bold">Status: </label>
                                <?php 
                                    if ($data['status'] == 0) {
                                ?>

                                        <span style='color: blue;'>Pending</span>
                                <?php 
                                    }
                                    if ($data['status'] == 1){
                                ?>
                                        <span style='color: green;'> Approved</span>
                                <?php
                                    }
                                    if ($data['status'] == 2){
                                ?>
                                        <span cstyle='color: red;'> Rejected</span>
                                <?php 
                                    } 
                                ?>
                                <hr>    
                                <?php if($data['status'] == 0) { ?>
                                    <form action="collab-approved.php?id=<?php echo $data['id']; ?>" method="POST">
                                        <input type="hidden" name="appid" value="<?php echo $data['id']; ?>">
                                        <input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
                                    </form>
                                    <form action="collab-reject.php?id=<?php echo $data['id']; ?>" method="POST">
                                        <input type="hidden" name="appid" value="<?php echo $data['id']; ?>">
                                        <input type="submit" class="btn btn-sm btn-danger" name="reject" value="Reject">
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
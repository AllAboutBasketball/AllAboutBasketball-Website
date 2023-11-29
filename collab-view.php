<?php 
    include('functions/userfunctions.php');
    include('includes/header.php');
    include('authenticate.php');

    if (isset($_GET['id'])) {
        $uploadID = intval($_GET['id']);
        $result = getCollabData($uploadID);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
        } else {
            die("Error fetching data.");
        }
    } else {
        die("ID not set.");
    }
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white">
            <a href="index.php" class = "text-white">
            Profile / 
            </a>
            <a href="collab-history.php" class = "text-white">
            COLLAB HISTORY PAGE /
            </a> 
            <a href="#" class = "text-white">
            View Details
            </a> 
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                   <div class="card">
                       <div class="card-header bg-primary">
                           <span class="text-white fs-4">View Upload</i></span>                          
                           <a href="collab-history.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                       </div>
                       <div class="card-body">
                           <div class="row">
                                <div class="col-md-6">
                                    <img src="./userdesign/<?php echo $data['image']?>" width="400px" height="50px" class="float-start img-fluid"/> 
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
                                </div>
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('./includes/footer.php')
?>
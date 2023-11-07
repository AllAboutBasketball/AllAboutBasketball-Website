<?php
include('functions/userfunctions.php');
include('includes/header.php');



?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class = "text-white"><a class = "text-white" href="index.php">
                        Home / 
                    </a>
                    <a class = "text-white" href="categories.php">
                        Collections  
                    </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               
                <h1 class="text-dark">AAB Collections</h1>
                <hr>
                <div class="row">
                    <?php 
                        $categories = getAllActive("categories");

                        if(mysqli_num_rows($categories) > 0)
                        {
                            foreach($categories as $item)
                            {
                                ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="products.php?category=<?= $item['slug']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <img src="uploads/<?= $item['image']; ?>"  width="350px" height="250px" alt="Category Image" class = "w-100">
                                                    <h4 class = "text-center text-danger"> <strong> <?= $item['slug']; ?> </strong></h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>    
                                <?php
                            }
                        }
                        else
                        {
                            echo "Sorry No Available!";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
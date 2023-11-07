<?php
include('functions/userfunctions.php');
include('includes/header.php');

$searchs = false;
if(isset($_POST['search_btn']))
{
    ?>
    <div class="py-3 bg-primary">
            <div class="container">
                <h6 class = "text-white">
                    <a class = "text-white" href="index.php">
                        Home / 
                    </a>
                    <a class = "text-white" href="categories.php">
                        Products / 
                    </a>
                 
            </div>
        </div>
    <?php
    if($_POST['search'] != "")
    {
        $search = $_POST['search'];
        $searchs = true;
        $query = "SELECT * FROM products WHERE name LIKE '%$search%' OR meta_keywords LIKE '%$search%'";
        $query_run = mysqli_query($con, $query);
        if(mysqli_num_rows($query_run) > 0)
        {
            
            ?>

            <div class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">                                           
                            <hr>
                            <div class="row">   
            <?php
            foreach($query_run as $item)
            {

        

            ?>
                        
                                                <div class="col-md-3 mb-2">
                                                    <a href="product-view.php?product=<?= $item['slug']; ?>">
                                                        <div class="card shadow">
                                                            <div class="card-body">
                                                                <img src="uploads/<?= $item['image']; ?>"  width="340px" height="280px" alt="Product Image" class = "w-100">
                                                                <h5 class = "text-center text-dark"> <strong> <?= $item['name']; ?> </strong></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>    
            <?php
                                            }
                                    
              ?>          
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            
        }
        else
        {
            echo "No Data Found";
        }
    }
    else
    {
        
        header('Location: index.php');
    }

}
else
{
    echo "Something Went Wrong";
}
 include('includes/footer.php'); ?>
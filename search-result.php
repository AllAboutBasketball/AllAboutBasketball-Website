<?php
include('functions/userfunctions.php');
include('includes/header.php');

// it will have ?search=keyword
if(isset($_GET['search']))
{
    $keyword = $_GET['search'];
    $products = searchProducts($keyword);
    $count = mysqli_num_rows($products);
}
else
{
    redirect('index.php');
}

if($count > 0){
?>
        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class = "text-white">
                    <a class = "text-white" href="index.php">
                        Home / 
                    </a>
                    <a class = "text-white" href="search-result.php?search=<?= $keyword; ?>">
                        Search / 
                    </a>
                    <?= $keyword; ?></h6>
            </div>
        </div>

        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    
                        <h2 class="text-danger"> <strong> Search Results for <?= $keyword; ?> </strong></h2>
                        <hr>
                        <div class="row">
                            <?php 
                                if(mysqli_num_rows($products) > 0)
                                {
                                    foreach($products as $item)
                                    {
                                        ?>
                                            <div class="col-md-3 mb-2">
                                            <a href="product-view.php?product=<?= str_replace('%20', '+', $item['slug']); ?>">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                                                            <img src="uploads/<?= $item['image']; ?>"  width="340px" height="280px" alt="Product Image" class = "w-100">
                                                            <h5 class="text-center text-dark"> <strong> <?= $item['name']; ?> </strong></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>    
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "NO data available";
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
    echo "<h1>No Products Found</h1>";
}
?>
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
            My Upload Design
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
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">


                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Send your own design</h4>
                    </div>
                    <div class="card-body">

                        <form action="addprocess.php" method="POST" enctype="multipart/form-data">
                            <div class="from-group mb-3">
                                <label for="">Description: </label>
                                <textarea id="textarea" name="name" class="form-control" length="300" maxlength="300" ></textarea> <br>

                                <label>Select Image File:</label>
                                <input type="file" name="image">
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Size: </label>
                                <select name="cloth_size" class="form-control" id="size_select" onchange="toggleImage   ()">
                                    <option value="0" disabled selected hidden > Select Size</option>
                                    <option value="Small">Small</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Large">Large</option>
                                    <option value="Xlarge">XLarge</option>
                                </select>
                               <br>
                               <div id="myDiv">
  <img id="myImage" src="" style="display: none;" alt="Image" width ="400" height="300"></div>

                                
                                <script>
                                    function toggleImage() {
  var select = document.getElementById("size_select");
  var selectedValue = select.value;

  var image = document.getElementById("myImage");

image.style.display = "none";

if (selectedValue === "Small") {
  image.src = "data:image/png;base64,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";
  image.style.display = "block";
} else if (selectedValue === "Medium") {
  image.src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0yP_Sq_QFa7nYlItODoYqpAUxvuvLVYqMytzwj-v8x-bt6h313ti96FXkJkncvs8K_cM&usqp=CAU";
  image.style.display = "block";
} else if (selectedValue === "Large") {
  image.src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfFynaHEpnVt2C0ra5vCsINlyTjjMCviTEeT_obku2C77x7B9s4TKa5Ul96cFOZ0i0okw&usqp=CAU";
  image.style.display = "block";
} else if (selectedValue === "Xlarge") {
  image.src = "https://uxwing.com/wp-content/themes/uxwing/download/clothes-and-accessories/xl-size-polo-t-shirt-icon.png";
  image.style.display = "block";
}
}
                                  </script>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">Color: </label>
                                <select name="color" class="form-control">
                                    <option disabled selected hidden> Select Color</option>
                                    <option value="White">White</option>
                                    <option value="Black">Black</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <button type="submit" name="save_select" class="btn btn-primary">Upload</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

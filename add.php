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
  image.src = "sizes/small.png";
  image.style.display = "block";
} else if (selectedValue === "Medium") {
  image.src = "sizes/medium.png";
  image.style.display = "block";
} else if (selectedValue === "Large") {
  image.src = "sizes/large.png";
  image.style.display = "block";
} else if (selectedValue === "Xlarge") {
  image.src = "sizes/xlarge.png";
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

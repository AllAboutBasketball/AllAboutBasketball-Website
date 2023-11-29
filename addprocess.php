<?php
require("functions/userfunctions.php");
$conn = mysqli_connect("localhost", "root", "", "db_aab");

if(isset($_POST['save_select'])){

    $name = $_POST['name'];
    $cloth_size = $_POST['cloth_size'];
    $color = $_POST['color'];
    $tmpName = $_FILES["image"]["tmp_name"];
    $userId = getCurrentUserID();

    $image = $_FILES['image']['name'];

    $path = "userdesign/";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

    uploadCollabData($userId, $name, $filename, $cloth_size, $color);

    redirect('index.php', "Successfully Uploaded, Please Wait for Approval :)"); 
}
  
    ?>



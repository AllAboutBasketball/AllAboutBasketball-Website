<?php
$conn = mysqli_connect("localhost", "root", "", "db_aab");

if(isset($_POST['save_select'])){

    $name = $_POST['name'];
    $cloth_size = $_POST['cloth_size'];
    $color = $_POST['color'];
    $tmpName = $_FILES["image"]["tmp_name"];

    $image = $_FILES['image']['name'];

    $path = "userdesign/";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

    $test_query = "INSERT INTO upload (name, cloth_size, color, image)
    VALUES ( '$name', '$cloth_size', '$color', '$filename')";
    $test_query_run = mysqli_query($conn, $test_query);
    echo
    "
    <script>
      alert('Successfully Added');
      document.location.href = 'add.php';
    </script>
    "; 
    
}
  
    ?>



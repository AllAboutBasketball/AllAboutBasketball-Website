<?php
include('../config/dbcon.php');
include('../functions/myfunctions.php');
if(isset($_POST['get_inventory_btn']))
{ 
    $inventory_id=$_POST['id'];
    $response = "You entered: " . $inventory_id;

// Send the response back to the client
// echo $response;
    $query = "SELECT * FROM inventory WHERE id='$inventory_id'";
     $query_run = mysqli_query($con, $query);
    foreach($query_run as $item){
       echo json_encode($item);
    }
}

if(isset($_POST['add_cate_btn']))
{ 
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    // Check if the category name and slug are not empty
    if (!empty($name) && !empty($slug)) {
        // Check if the category with the same name or slug already exists in the database
        $check_query = "SELECT * FROM categories WHERE name = '$name' OR slug = '$slug'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            $test_query = "INSERT INTO categories (name, slug, description, meta_keywords, status, popular, image)
            VALUES ('$name', '$slug', '$description', '$meta_keywords', '$status', '$popular', '$filename')";
    
            $test_query_run = mysqli_query($con, $test_query);
    
            if($test_query_run)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
                
                redirect("add-category.php", "Category Added Successfully");
            }
            else
            {
                redirect("add-category.php", "Something Went Wrong");
            }
        } else {
            redirect("add-category.php", "Category with the same name or collection already exists");
        }
    } else {
        redirect("add-category.php", "Category name and collection are required");
    }
}

else if(isset($_POST['update_cate_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = '../uploads';

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description',
    meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Update Successful");
    }
    else
    {
        redirect("edit-category.php?id=$category_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_cate_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id = '$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("category.php", "Deleted Successfully");
        echo 200;
        
    }
    else
    {
        //redirect("category.php", "Something Went Wrong");
        echo 500;

    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if(isset($_POST['add_prod_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $size = $_POST['size'];
    $qty = $_POST['qty'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';
    $meta_keywords = $_POST['meta_keywords'];

    $image = $_FILES['image']['name'];

    $path = '../uploads';

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    // Check if the product name and slug are not empty
    if (!empty($name) && !empty($slug)) {
        // Check if the product with the same name or slug already exists in the same category
        $check_query = "SELECT * FROM products WHERE (name = '$name' OR slug = '$slug') AND category_id = '$category_id'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            $product_query = "INSERT INTO products (category_id, name, slug, size, qty, original_price,
            selling_price, description, status, trending, meta_keywords, image) VALUES 
            ('$category_id', '$name', '$slug', '$size', '$qty', '$original_price', '$selling_price', '$description', '$status',
            '$trending', '$meta_keywords', '$filename')";

            $product_query_run = mysqli_query($con, $product_query);

            if($product_query_run)
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
                redirect("add-products.php?id=$category_id", "Product Added Successfully");
            }
            else
            {
                redirect("add-products.php?id=$category_id", "Something went wrong");
            }
        } else {
            redirect("add-products.php?id=$category_id", "Product with the same name or product sales already exists");
        }
    } else {
        redirect("add-products.php?id=$category_id", "Product name and product sales are required");
    }
}

else if(isset($_POST['update_prod_btn']))
{
    $product_id = $_POST['product_id'];

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';
    $meta_keywords = $_POST['meta_keywords'];
    

    $image = $_FILES['image']['name'];

    $path = '../uploads';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', size='$size', description='$description',
    original_price='$original_price', selling_price='$selling_price', qty='$qty', status='$status',
    trending='$trending', meta_keywords='$meta_keywords', image='$update_filename' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($con, $update_product_query);



    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-products.php?id=$product_id", "Update Successful");
    }
    else    
    {
        redirect("edit-products.php?id=$product_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_prod_btn']))
{
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id = '$product_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", " Product Deleted Successfully");
        echo 200;
        
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;

    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if(isset($_POST['update_order_btn']))
{
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    // $remarks_status = $_POST['remarks_status'];
    if($_POST['order_status']==2){
        $getOrderId = "SELECT * FROM order_items WHERE order_id ='".$order_id."'";
        $getOrderIdeEsult = mysqli_query($con, $getOrderId);
        foreach ($getOrderIdeEsult as $getOrderIdeResult) {
                //get product details
            $product_id =  $getOrderIdeResult['prod_id'];
            $getProduct = "SELECT * FROM products WHERE id ='".$product_id."'";
            $getProductResult = mysqli_query($con, $getProduct);
            foreach ($getProductResult as $getProductResults) {
                $current_qty=$getProductResults['qty'];
            }
            $new_qty=$current_qty - $getOrderIdeResult['qty'];
            $updateProductQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$product_id' ";
            $updateInventoryQty_query = "UPDATE inventory SET qty='$new_qty' WHERE id='$product_id' ";
            mysqli_query($con, $updateProductQty_query);
            mysqli_query($con, $updateInventoryQty_query);
        }
    }
    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    redirect("view-order.php?t=$track_no", "Order Status Update Successful");


}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

// else if(isset($_POST['sub_courier_btn']))
// {
//     $track_no = $_POST['tracking_no'];
//     $order_status = $_POST['order_status'];
//     $remarks_status = $_POST['remarks_status'];

//     $updateOrder_query = "UPDATE courier SET status='$order_status' WHERE tracking_no='$track_no' ";
//     $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

//     redirect("delivery-view.php?t=$track_no", "Order Status Update Successful");


// }



//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

// else if (isset($_POST['update_collab_btn'])){
//     $appid = $_POST['appid'];
//     $sql = "UPDATE upload SET status='1' WHERE id = '$appid'";
//     $run = mysqli_query($con,$sql);
//     if($run == true){

//     redirect("view-collab.php?t=$track_no", "Collab Status Update Successful");
//     }

// }

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if(isset($_POST['update_profile_btn']))
{

    $userId = $_SESSION['auth_user']['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $check_email_query = "SELECT email FROM users WHERE email = '$email'";
    $check_email_query_run = mysqli_query($con,$check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        //redirect("../register.php", "Email Already Used");
        $_SESSION['message'] = "Email Already Used";
        header('Location: ../edit-profile.php');
    }

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = 'userimage';

    $update_query = "UPDATE users SET name='$name', email='$email', phone='$phone', image='$update_filename' WHERE id='$userId'";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("userimage/".$old_image))
            {
                unlink("userimage/".$old_image);
            }
        }
        redirect("edit-profile.php", "Update Successful");
    }
    else
    {
        redirect("edit-profile.php", "Something Went Wrong");
    }
}

else if(isset($_POST['change_pass_btn']))
{
    $userId = $_SESSION['auth_user']['user_id'];
    $password = $_POST['password'];
    $npassword = $_POST['npassword'];
    $cnpassword = $_POST['cnpassword'];

    $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);

    $check_password = "SELECT * FROM users WHERE id='$userId'";
    $check_password_run = mysqli_query($con, $check_password);
    $row = mysqli_fetch_assoc($check_password_run);

    if(mysqli_num_rows($check_password_run) > 0)
    {
                 
        
            if(password_verify($password, $row['password']))
            {
        
                if($npassword != $cnpassword)
                {
                    redirect("changepass.php", "New Password Does Not Match");
                }
                else
                {
                    $update_password = "UPDATE users SET password='$hashed_password' WHERE id='$userId'";
                    mysqli_query($con, $update_password);
                    redirect("changepass.php", "Changed Password Successfully");

                }
            }
            else
            {
                redirect("changepass.php", "Incorect Password");
            }
        
        
        
    
    }
    else
    {
        redirect("changepass.php", "Incorect Password");

    }

}

else if(isset($_POST['update_user_btn']))
{
    $id = $_POST['id'];
    $role_as = $_POST['role_as'];

    $query = "UPDATE users SET role_as='$role_as' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        redirect("all-users.php", "Updated Successfully");
        exit(0);

    }

}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if(isset($_POST['add_supp_btn'])) {
    $cname = $_POST['cname'];
    $phone = $_POST['phone'];
    $cperson = $_POST['cperson'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];
    $date_time_local = $_POST['date_time_local'];

    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Check if the supplier name and product are not empty
    if (!empty($cname) && !empty($product)) {
        // Check if the supplier with the same name and product already exists in the database
        $check_query = "SELECT * FROM supplier WHERE cname = '$cname' AND product = '$product'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            $supplier_query = "INSERT INTO supplier (cname, phone, cperson, email, product, cost, description, image, date_time, status)
            VALUES ('$cname', '$phone', '$cperson', '$email', '$product', '$cost', '$description', '$filename', '$date_time', '$status')";

            $supplier_query_run = mysqli_query($con, $supplier_query);

            if ($supplier_query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

                redirect("add-supplier.php", "Supplier Added Successfully");
            } else {
                redirect("add-supplier.php", "Something Went Wrong");
            }
        } else {
            redirect("add-supplier.php", "Supplier with the same name and product already exists");
        }
    } else {
        redirect("add-supplier.php", "Supplier name and product are required");
    }
}



else if(isset($_POST['update_supp_btn']))
{
    $supplier_id = $_POST['supplier_id'];
    $cname = $_POST['cname'];
    $phone = $_POST['phone'];
    $cperson =  $_POST['cperson'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $cost = $_POST['cost'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];
    $date_time_local = $_POST['date_time_local'];
    
    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));

    $image = $_FILES['image']['name'];

    $path = '../uploads';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_supplier_query = "UPDATE supplier SET cname='$cname', phone='$phone', cperson='$cperson', email='$email', product='$product', cost='$cost',
    image='$update_filename', date_time='$date_time' WHERE id='$supplier_id'";


    $update_supplier_query_run = mysqli_query($con, $update_supplier_query);

    if($update_supplier_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-supplier.php?id=$supplier_id", "Update Successful");
    }
    else    
    {
        redirect("edit-supplier.php?id=$supplier_id", "Something Went Wrong");
    }
}

else if(isset($_POST['delete_supp_btn']))
{
    $supplier_id = mysqli_real_escape_string($con, $_POST['supplier_id']);

    $supplier_query = "SELECT * FROM supplier WHERE id='$supplier_id'";
    $supplier_query_run = mysqli_query($con, $supplier_query);
    $supplier_data = mysqli_fetch_array($supplier_query_run);
    $image = $supplier_data['image'];

    $delete_query = "DELETE FROM supplier WHERE id= '$supplier_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//
else if(isset($_POST['add_emp_btn']))
{
    $e_emp_id = $_POST['e_emp_id'];
    $e_name = $_POST['e_name'];
    $e_age = $_POST['e_age'];
    $e_date = $_POST['e_date'];
    $e_date_hiring_local = $_POST['e_date_hiring_local'];
    $e_gender = $_POST['e_gender'];
    $e_contact = $_POST['e_contact'];
    $e_salary = $_POST['e_salary'];
    $e_email = $_POST['e_email'];
    $e_position = $_POST['e_position'];
    $image = $_FILES['image']['name'];
    $e_address = $_POST['e_address'];

    $date_birth = date('Y-m-d', strtotime($e_date));
    $date_hiring = date('Y-m-d H:i:s', strtotime($e_date_hiring_local));

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Check if an employee with the same ID, email, or fullname already exists
    $existing_employee_query = "SELECT * FROM employee WHERE emp_id = '$e_emp_id' OR email = '$e_email' OR name = '$e_name'";
    $existing_employee_result = mysqli_query($con, $existing_employee_query);

    if (mysqli_num_rows($existing_employee_result) > 0) {
        redirect("add-employee.php", "Employee with the same ID, email, or fullname already exists.");
    } else {
        $employee_query = "INSERT INTO employee (emp_id, name, age, date_birth, date_hiring, gender, contact, salary, email, position, image, address)
        VALUES ('$e_emp_id', '$e_name', '$e_age', '$date_birth', '$date_hiring', '$e_gender', '$e_contact', '$e_salary','$e_email','$e_position', '$filename', '$e_address')";

        $employee_query_run = mysqli_query($con, $employee_query);

        if($employee_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

            redirect("add-employee.php", "Employee Added Successfully");
        }
        else
        {
            redirect("add-employee.php", "Something Went Wrong");
        }
    }
}



else if(isset($_POST['update_emp_btn']))
{
    $employee_id = $_POST['employee_id'];
    $e_emp_id = $_POST['e_emp_id'];
    $e_name = $_POST['e_name'];
    $e_age = $_POST['e_age'];
    $e_date = $_POST['e_date'];
    $e_date_hiring_local = $_POST['e_date_hiring_local'];
    $e_gender = $_POST['e_gender'];
    $e_contact = $_POST['e_contact'];
    $e_salary = $_POST['e_salary'];
    $e_email = $_POST['e_email'];
    $e_position = $_POST['e_position'];
    $image = $_FILES['image']['name'];
    $e_address = $_POST['e_address'];

    
    $date_birth = date('Y-m-d', strtotime($e_date));
    $date_hiring = date('Y-m-d H:i:s', strtotime($e_date_hiring_local));
    
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_employee_query = "UPDATE employee SET name='$e_name', age='$e_age', date_birth='$date_birth', date_hiring='$date_hiring', gender='$e_gender',
    contact='$e_contact', salary='$e_salary', email='$e_email', position='$e_position', address='$e_address', image='$update_filename' WHERE id='$employee_id'";


    $update_employee_query_run = mysqli_query($con, $update_employee_query);

    if($update_employee_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-employee.php?id=$employee_id", "Update Successful");
    }
    else    
    {
        redirect("edit-employee.php?id=$employee_id", "Something Went Wrong");
    }
}

else if(isset($_POST['delete_emp_btn']))
{
    $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);

    $employee_query = "SELECT * FROM employee WHERE id='$employee_id'";
    $employee_query_run = mysqli_query($con, $employee_query);
    $employee_data = mysqli_fetch_array($employee_query_run);
    $image = $employee_data['image'];

    $delete_query = "DELETE FROM employee WHERE id= '$employee_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if (isset($_POST['add_attendance_btn'])) {
    $name = $_POST['name'];
    $date = date('Y-m-d'); // Get the current date
    $sign_in = date('H:i:s', strtotime($_POST['sign_in'])); // Get the sign-in time
    $sign_out = date('H:i:s', strtotime($_POST['sign_out'])); // Get the sign-out time
    $place = $_POST['place'];
    $status = $_POST['status'];

    // Check if the attendance ID is selected
    if (!empty($name)) {
        // Check if the attendance already exists for the selected employee and current date
        $existing_attendance_query = "SELECT * FROM attendance WHERE name = '$name' AND date = '$date'";
        $existing_attendance_result = mysqli_query($con, $existing_attendance_query);

        if (mysqli_num_rows($existing_attendance_result) > 0) {
            redirect("add-attendance.php", "Attendance Employee already exists.");
        } else {
            $attendance_query = "INSERT INTO attendance (name, date, sign_in, sign_out, place, status)
            VALUES ('$name', '$date', '$sign_in', '$sign_out', '$place', '$status')";

            $attendance_query_run = mysqli_query($con, $attendance_query);

            if ($attendance_query_run) {
                redirect("add-attendance.php", "Attendance Added Successfully");
            } else {
                redirect("add-attendance.php", "Something Went Wrong");
            }
        }
    } else {
        redirect("add-attendance.php", "Please select an employee from the list.");
    }
}

else if(isset($_POST['update_attend_btn']))
{
    $attendance_id = $_POST['attendance_id'];
    
    $name = $_POST['name'];
    $date = date('Y-m-d'); // Get the current date
    $sign_in = date('H:i:s', strtotime($_POST['sign_in'])); // Get the sign-in time
    $sign_out = date('H:i:s', strtotime($_POST['sign_out'])); // Get the sign-out time
    $place = $_POST['place'];
    $status = $_POST['status'];

    $update_attend_query = "UPDATE attendance SET name='$name', date='$date', sign_in='$sign_in', sign_out='$sign_out', place='$place',
    status='$status' WHERE id='$attendance_id'";

    $update_attend_query_run = mysqli_query($con, $update_attend_query);

    if($update_attend_query_run)
    {
        redirect("edit-attendance.php?id=$attendance_id", "Update Successful");
    }
    else    
    {
        redirect("edit-attendance.php?id=$attendance_id", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_attend_btn']))
{
    $attendance_id = mysqli_real_escape_string($con, $_POST['attendance_id']);

    $attendance_query = "SELECT * FROM attendance WHERE id='$attendance_id'";
    $attendance_query_run = mysqli_query($con, $attendance_query);
    $attendance_data = mysqli_fetch_array($attendance_query_run);
    $image = $attendance_data['image'];

    $delete_query = "DELETE FROM attendance WHERE id= '$attendance_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}


//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if (isset($_POST['add_leave_btn'])) {
    $employee_name = $_POST['employee_name'];
    $days = $_POST['days'];
    $select_date = $_POST['select_date'];
    $leave_type = $_POST['leave_type'];
    $status = $_POST['leave_status'];
    $remarks = $_POST['leave_remarks'];
    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // Calculate the end date based on the start date and days
    $start_date = strtotime($select_date);
    $end_date = date('Y-m-d', strtotime("+$days days", $start_date));

    // Check if the employee name and leave type are not empty
    if (!empty($employee_name) && !empty($leave_type)) {
        // Check if the employee name is not already present in the database
        $check_query = "SELECT emp_name FROM app_leave WHERE emp_name = '$employee_name'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            $leave_query = "INSERT INTO app_leave (emp_name, days, start_date, end_date, leave_type, status, image, remarks)
            VALUES ('$employee_name', '$days', '$select_date', '$end_date', '$leave_type', '$status', '$filename', '$remarks')";

            $leave_query_run = mysqli_query($con, $leave_query);

            if ($leave_query_run) {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

                redirect("add-leave-application.php", "Leave Application Successfully");
            } else {
                redirect("add-leave-application.php", "Something Went Wrong");
            }
        } else {
            redirect("add-leave-application.php", "Employee name already exists");
        }
    } else {
        redirect("add-leave-application.php", "Employee name and leave type are required");
    }
}


else if (isset($_POST['update_leave_btn'])) {
    $leave_id = $_POST['leave_id'];
    $days = $_POST['days'];
    $select_date = $_POST['select_date'];
    $leave_type = $_POST['leave_type'];
    $status = $_POST['leave_status'];
    $image = $_FILES['image']['name'];

    // Calculate the end date based on the start date and days
    $start_date = $select_date;
    $end_date = date('Y-m-d', strtotime("+$days days", strtotime($select_date)));

    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_leave_query = "UPDATE app_leave SET days='$days', start_date='$start_date', end_date='$end_date', leave_type='$leave_type',
    status='$status', image='$update_filename' WHERE id='$leave_id'";

    $update_leave_query_run = mysqli_query($con, $update_leave_query);

    if ($update_leave_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-leave.php?id=$leave_id", "Update Successful");
    } else {
        redirect("edit-leave.php?id=$leave_id", "Something Went Wrong");
    }
}

else if(isset($_POST['delete_leave_btn']))
{
    $leave_id = mysqli_real_escape_string($con, $_POST['leave_id']);

    $leave_query = "SELECT * FROM app_leave WHERE id='$leave_id'";
    $leave_query_run = mysqli_query($con, $leave_query);
    $leave_data = mysqli_fetch_array($leave_query_run);
    $image = $leave_data['image'];

    $delete_query = "DELETE FROM app_leave WHERE id= '$leave_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//
else if(isset($_POST['add_inv_btn']))
{ 
    $supplier_id = $_POST['supplier_id'];
    $name = $_POST['name'];
    $date_time_local = $_POST['date_time_local'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $inventory_query = "INSERT INTO inventory (supplier_id, name, date_time, qty, price, size, type, status, remarks, image)
    VALUES ('$supplier_id', '$name', '$date_time', '$qty', '$price', '$size', '$type', '$status', '$remarks', '$filename')";

    $inventory_query_run = mysqli_query($con, $inventory_query);

    if($inventory_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        
        redirect("add-inventory.php", "Inventory Added Suucessfully");
    }
    else
    {
        redirect("add-inventory.php", "Something Went Wrong");
    }
}
else if(isset($_POST['update_inv_btn']))
{

    $inv_id = $_POST['inv_id'];
    
    $supplier_id = $_POST['supplier_id'];
    $name = $_POST['name'];
    $date_time_local = $_POST['date_time_local'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $image = $_FILES['image']['name'];

    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));
    
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_inventory_query = "UPDATE inventory SET supplier_id='$supplier_id', name='$name', date_time='$date_time', qty='$qty', price='$price', size='$size',
    type='$type', status='$status', remarks='$remarks', image='$update_filename' WHERE id='$inv_id'";


    $update_inventory_query_run = mysqli_query($con, $update_inventory_query);

    if($update_inventory_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-inventory.php?id=$inv_id", "Update Successful");
    }
    else    
    {
        redirect("edit-inventory.php?id=$inv_id", "Something Went Wrong");
    }
}

else if(isset($_POST['delete_inv_btn']))
{
    $inventory_id = mysqli_real_escape_string($con, $_POST['inventory_id']);

    $inventory_query = "SELECT * FROM inventory WHERE id='$inventory_id'";
    $inventory_query_run = mysqli_query($con, $inventory_query);
    $inventory_data = mysqli_fetch_array($inventory_query_run);
    $image = $inventory_data['image'];

    $delete_query = "DELETE FROM inventory WHERE id= '$inventory_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}

//-----------------------------------------------------------------------------------------------// 
//------------------------------------------------------------------------------------------------//

else if(isset($_POST['add_stock_btn']))
{ 
    $inv_id = $_POST['inv_id'];
    $date_time_local = $_POST['date_time_local'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $stock_query = "INSERT INTO stock (inv_id, date_time, qty, price, size, type, status, remarks, image)
    VALUES ('$inv_id', '$date_time', '$qty', '$price', '$size', '$type', '$status', '$remarks', '$filename')";

    $stock_query_run = mysqli_query($con, $stock_query);

    if($stock_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        
        redirect("add-stock.php", "Stock Added Suucessfully");
    }
    else
    {
        redirect("add-stock.php", "Something Went Wrong");
    }
}
else if(isset($_POST['update_stock_btn']))
{
    $stock_id = $_POST['stock_id'];
    
    $inv_id = $_POST['inv_id'];
    $date_time_local = $_POST['date_time_local'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $image = $_FILES['image']['name'];

    $date_time = date('Y-m-d H:i:s', strtotime($date_time_local));
    
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_stock_query = "UPDATE stock SET inv_id='$inv_id', date_time='$date_time', qty='$qty', price='$price', size='$size',
    type='$type', status='$status', remarks='$remarks', image='$update_filename' WHERE id='$stock_id'";


    $update_stock_query_run = mysqli_query($con, $update_stock_query);

    if($update_stock_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-stock.php?id=$stock_id", "Update Successful");
    }
    else    
    {
        redirect("edit-stock.php?id=$stock_id", "Something Went Wrong");
    }
}

else if(isset($_POST['delete_stock_btn']))
{
    $stock_id = mysqli_real_escape_string($con, $_POST['stock_id']);

    $stock_query = "SELECT * FROM stock WHERE id='$stock_id'";
    $stock_query_run = mysqli_query($con, $stock_query);
    $stock_data = mysqli_fetch_array($stock_query_run);
    $image = $inventory_data['image'];

    $delete_query = "DELETE FROM stock WHERE id= '$stock_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        //redirect("products.php", "Supplier Deleted Successfully");
        echo 200;
    }
    else
    {
        //redirect("products.php", "Something Went Wrong");
        echo 500;
    }
}
?>
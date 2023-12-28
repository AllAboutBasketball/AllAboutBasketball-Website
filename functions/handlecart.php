<?php 
    session_start();
    include('../config/dbcon.php');

    if(isset($_SESSION['auth']))
    {
        if(isset($_POST['scope']))
        {
            $scope = $_POST['scope'];
            switch($scope)
            {
                case "add":
                    $prod_id = $_POST['prod_id'];
                    $prod_qty = $_POST['prod_qty'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                    if(mysqli_num_rows($chk_existing_cart_run) > 0)
                    {
                        $prod_id = $_POST['prod_id'];
                        $prod_qty = $_POST['prod_qty'];

                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                        $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                        if(mysqli_num_rows($chk_existing_cart_run) > 0)
                        {
                            $update_query = "UPDATE carts SET prod_qty= prod_qty + '$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                            $update_query_run = mysqli_query($con, $update_query);

                            if($update_query_run)
                            {
                                echo "existing";
                            }
                            else
                            {
                                echo 500;
                            }
                        }
                        else
                        {                   
                            echo "Something Went Wrong";
                        }
                    }
                    else
                    {                   
                        $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                        $insert_query_run = mysqli_query($con, $insert_query);

                        if($insert_query_run)
                        {
                            echo 201;
                        }
                        else
                        {
                            echo 500;
                        }
                    }

                break;
                case "update":
                    $prod_id = $_POST['prod_id'];
                    $prod_qty = $_POST['prod_qty'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                    if(mysqli_num_rows($chk_existing_cart_run) > 0)
                    {
                        $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                        $update_query_run = mysqli_query($con, $update_query);

                        if($update_query_run) {
                            $get_total_price_query = "SELECT SUM(p.selling_price * c.prod_qty) AS total_price 
                                                        FROM carts c 
                                                        JOIN products p ON c.prod_id = p.id 
                                                        WHERE c.user_id='$user_id'";
                            $get_total_price_result = mysqli_query($con, $get_total_price_query);

                            if ($get_total_price_result && mysqli_num_rows($get_total_price_result) > 0) {
                                $row = mysqli_fetch_assoc($get_total_price_result);
                                $totalPrice = $row['total_price'];
                                echo $totalPrice; 
                            } else {
                                echo -1; 
                            }
                        } else {
                            echo 500; 
                        }
                    }
                    else
                    {                   
                        echo "Something Went Wrong";
                    }
                    break;
                case "delete":
                    $cart_id = $_POST['cart_id'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_cart = "SELECT * FROM carts WHERE id = '$cart_id' AND user_id = '$user_id'";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                    if(mysqli_num_rows($chk_existing_cart_run) > 0)
                    {
                        $delete_query = "DELETE FROM carts WHERE id='$cart_id' ";
                        $delete_query_run = mysqli_query($con, $delete_query);

                        if($delete_query_run)
                        {
                            echo 200;
                        }
                        else
                        {
                            echo "Something Went Wrong";
                        }
                    }
                    else
                    {                   
                        echo "Something Went Wrong";
                    }
                break;

                case "increment":
                    $prod_id = $_POST['prod_id'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                    if(mysqli_num_rows($chk_existing_cart_run) > 0)
                    {
                        $update_query = "UPDATE carts SET prod_qty=prod_qty + 1 WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                        $update_query_run = mysqli_query($con, $update_query);

                        if($update_query_run) {
                            $get_total_price_query = "SELECT SUM(p.selling_price * c.prod_qty) AS total_price 
                                                        FROM carts c 
                                                        JOIN products p ON c.prod_id = p.id 
                                                        WHERE c.user_id='$user_id'";
                            $get_total_price_result = mysqli_query($con, $get_total_price_query);

                            if ($get_total_price_result && mysqli_num_rows($get_total_price_result) > 0) {
                                $row = mysqli_fetch_assoc($get_total_price_result);
                                $totalPrice = $row['total_price'];
                                echo $totalPrice; 
                            } else {
                                echo -1; 
                            }
                        } else {
                            echo 500; 
                        }
                    }
                    else
                    {                   
                        echo "Something Went Wrong";
                    }
                    break;


                case "decrement":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prod_id'])) {
                        $prod_id = $_POST['prod_id'];
                        $user_id = $_SESSION['auth_user']['user_id'];
    
                        $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = ? AND user_id = ?";
                        $stmt = $con->prepare($chk_existing_cart);
                        $stmt->bind_param("ii", $prod_id, $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
    
                        if ($result->num_rows > 0) {
                            $update_query = "UPDATE carts SET prod_qty = prod_qty - 1 WHERE prod_id = ? AND user_id = ?";
                            $stmt_update = $con->prepare($update_query);
                            $stmt_update->bind_param("ii", $prod_id, $user_id);
                            $stmt_update->execute();
    
                            if ($stmt_update->affected_rows > 0) {
                                $get_total_price_query = "SELECT SUM(p.selling_price * c.prod_qty) AS total_price 
                                                            FROM carts c 
                                                            JOIN products p ON c.prod_id = p.id 
                                                            WHERE c.user_id = ?";
                                $stmt_total_price = $con->prepare($get_total_price_query);
                                $stmt_total_price->bind_param("i", $user_id);
                                $stmt_total_price->execute();
                                $result_total_price = $stmt_total_price->get_result();
    
                                if ($result_total_price->num_rows > 0) {
                                    $row = $result_total_price->fetch_assoc();
                                    $totalPrice = $row['total_price'];
                                    echo 200;
                                } else {
                                    echo 500; 
                                }
                            } else {
                                echo 500; 
                            }
                        } else {
                            echo "Product not found in the cart";
                        }
                    } else {
                        echo "Error: Invalid POST request or prod_id not received";
                    }
                    break;
                
                case "check":
                    $prod_id = $_POST['prod_id'];
                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                    if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                        $cart_item = mysqli_fetch_assoc($chk_existing_cart_run);
                        $selected = $cart_item['selected'];
                        $selected = ($selected == 0) ? 1 : 0;
                
                        $update_selected = "UPDATE carts SET selected = '$selected' WHERE prod_id = '$prod_id' AND user_id = '$user_id'";
                        $update_selected_run = mysqli_query($con, $update_selected);
                
                        if ($update_selected_run) {
                            echo 200;
                        } else {
                            echo 500;
                        }
                    } else {
                        echo 500;
                    }
                    break;
                default:
                    echo 500;   

            }
        }
    }
    else
    {
        echo 401;
    }
?>
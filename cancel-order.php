<?php
include('functions/userfunctions.php');
include('authenticate.php');

if(isset($_GET['t'])){
    cancelOrder($_GET['t']);
    redirect('canceled-orders.php', "Order Cancelled!");
}
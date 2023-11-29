<?php
include('../config/dbcon.php');
include('./includes/adminFunctions.php');
include('./../functions/userfunctions.php');

if (isset($_GET['id'])) {
    $uploadID = intval($_GET['id']);
    $result = getCollabData($uploadID);

    if ($result) {
        approveUploadData($uploadID);
        redirectAdmin("collab.php", "User Upload Data Approved!");
    } else {
        die("Error fetching data.");
    }
} else {
    die("ID not set.");
}
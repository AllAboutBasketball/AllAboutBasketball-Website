<?php
include('../config/dbcon.php');
include('./includes/adminFunctions.php');

if (isset($_GET['id'])) {
    $uploadID = intval($_GET['id']);
    $result = getCollabData($uploadID);

    if ($result) {
        rejectUploadData($uploadID);
        redirectAdmin("collab.php", "User Upload Data Rejected!");
    } else {
        die("Error fetching data.");
    }
} else {
    die("ID not set.");
}
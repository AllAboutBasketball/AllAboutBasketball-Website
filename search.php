<?php
include('functions/userfunctions.php');

$searchs = false;
if(isset($_POST['search_btn']))
{
    $search = $_POST['search'];
    // check if the search is empty and if its empty redirect it back to the index page saying that the search input cannot be empty
    if(!empty($search))
    {
        header("Location: search-result.php?search=$search");
    }
    else
    {
        redirect('index.php', "Search input cannot be empty");
    }
    
}
else
{
    redirect('index.php', "Search input cannot be empty");
}

?>

<?php include('includes/footer.php'); ?>
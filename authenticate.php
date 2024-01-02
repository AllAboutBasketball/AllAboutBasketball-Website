<?php

if(!isset($_SESSION['auth']))
{
    redirect("auth-form.php", "Login to Continue");
}


?>
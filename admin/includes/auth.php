<?php

if (!isset($_SESSION['LoggedInUserId']))
{
    header('Location: ' . urlOf('admin/login.php'));
    exit();
}

?>
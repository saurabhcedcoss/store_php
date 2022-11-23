<?php
session_start();
/**
 * getsession to check that whether user is logged in
 */
if(empty($_SESSION['username'])){
    header('Location:../../View/login.php');
}else{
    $email = $_SESSION['username'];
    $role = $_SESSION['user_role'];
    $name = $_SESSION['userName'];
    $contact = $_SESSION['userContact'];
}
?>
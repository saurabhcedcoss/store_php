<?php
session_start();
/**
 * login functions
 */
/**
 * config file
 */
include "../../config/config.php";
/**
 * admin login -> view/admin/dashboard
 * user login -> view/account
 */
/**
 * registration
 */
if (isset($_POST['register'])) {
    /**
     * get values
     */
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    /**
     * check for existing values
     */
    $get_data = "SELECT * FROM `user_datas` WHERE `user_email`='$email'";
    $do_get_data = mysqli_query($connect, $get_data);
    if (mysqli_num_rows($do_get_data) > 0) {
        /**
         * if account already exist
         */
        $_SESSION['msg'] = "ACCOUNT ALREADY EXISTS. LOGIN";
    } else {
        /**
         * insert record to user data
         */
        $set_data = "INSERT INTO `user_datas`(`user_name`, `user_contact`, `user_email`) VALUES ('" . $username . "','" . $contact . "','" . $email . "')";
        $do_set_data = mysqli_query($connect, $set_data);
    }
    /**
     * insert record to login table
     */
    $login_data = "INSERT INTO `login_datas`(`user_email`, `user_password`, `user_role`) VALUES ('" . $email . "','" . $password . "','" . $role . "')";
    $do_login_data = mysqli_query($connect, $login_data);
    /**
     * get user details in session for further pages
     */
    $_SESSION['username'] = $email;
    $_SESSION['user_role'] = $role;
    $_SESSION['userName'] = $username;
    $_SESSION['userContact'] = $contact;
    header("Location:../../View/account.php");
}
/**
 * login part
 */
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $get_user = "SELECT * FROM `login_datas` WHERE `user_email` = '" . $username . "' AND `user_password` = '" . $password . "'";
    $do_get_user = mysqli_query($connect, $get_user);
    if(mysqli_num_rows($do_get_user)==1){
    while ($user = mysqli_fetch_assoc($do_get_data)) {
        $user_id = $user['user_id'];
        $user_role = $user['user_role'];
    }
    /**
     * get data from user data table using user id
     */
    $get_user_data = "SELECT * FROM `user_datas` WHERE `user_id` = '" . $user_id . "'";
    $do_get_user_data = mysqli_query($connect, $get_user_data);
    while ($user_details = mysqli_fetch_assoc($do_get_user_data)) {
        $userName = $user_details['user_name'];
        $userContact = $user_details['user_contact'];
    }
    /**
     * get user details in session for further pages
     */
    $_SESSION['username'] = $username;
    $_SESSION['user_role'] = $user_role;
    $_SESSION['userName'] = $userName;
    $_SESSION['userContact'] = $userContact;
    header("Location:../../View/account.php");   
 }else{
    $_SESSION['msg'] = "NO RECORD FOUND.";
 }

}

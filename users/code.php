<?php
session_start();
require '../db_conn.php';

// delete ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['delete_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

// update ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    if($_POST['password'] != ''){
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET full_name='$full_name', email='$email', password='$hashed_password' WHERE id='$user_id' ";
    } else {
        $password = mysqli_real_escape_string($con, $_POST['old_password']);
        $query = "UPDATE users SET full_name='$full_name', email='$email', password='$password' WHERE id='$user_id' ";
    }
    

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Updated";
        header("Location: index.php");
        exit(0);
    }

}

// create ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['save_user']))
{
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (full_name,email,password) VALUES ('$full_name','$email','$hashed_password')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "User Created Successfully";
        header("Location: user-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Created";
        header("Location: user-create.php");
        exit(0);
    }
}

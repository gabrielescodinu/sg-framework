<?php
session_start();
require '../db_conn.php';

//delete
if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

// update
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    // image upload
    if ($img_size != 0) {
        if ($error === 0) {
            if ($img_size > 1250000) {
                $_SESSION['message'] = "Image size is too large";
                header("Location: student-create.php");
                exit(0);
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database with image
                    $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', image_url='$new_img_name' WHERE id='$student_id' ";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "Student Created Successfully";
                        header("Location: student-create.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Student Not Created";
                        header("Location: student-create.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: student-create.php");
                    exit(0);
                }
            }
        }
    } else {
        // UPDATE into Database without image
        $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course', image_url='$old_image' WHERE id='$student_id' ";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Student Created Successfully";
            header("Location: student-create.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Student Not Created";
            header("Location: student-create.php");
            exit(0);
        }
    }

    // $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course' WHERE id='$student_id' ";
    // $query_run = mysqli_query($con, $query);

    // if ($query_run) {
    //     $_SESSION['message'] = "Student Updated Successfully";
    //     header("Location: index.php");
    //     exit(0);
    // } else {
    //     $_SESSION['message'] = "Student Not Updated";
    //     header("Location: index.php");
    //     exit(0);
    // }
}

// create
if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    // image upload
    if ($img_size != 0) {
        if ($error === 0) {
            if ($img_size > 1250000) {
                $_SESSION['message'] = "Image size is too large";
                header("Location: student-create.php");
                exit(0);
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database with image
                    $query = "INSERT INTO students (name,email,phone,course,image_url) VALUES ('$name','$email','$phone','$course','$new_img_name')";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "Student Created Successfully";
                        header("Location: student-create.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Student Not Created";
                        header("Location: student-create.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: student-create.php");
                    exit(0);
                }
            }
        }
    } else {
        // Insert into Database without image
        $query = "INSERT INTO students (name,email,phone,course,image_url) VALUES ('$name','$email','$phone','$course','')";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Student Created Successfully";
            header("Location: student-create.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Student Not Created";
            header("Location: student-create.php");
            exit(0);
        }
    }
}

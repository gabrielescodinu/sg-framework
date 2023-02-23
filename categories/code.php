<?php
session_start();
require '../db_conn.php';

//delete ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['delete_category'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['delete_category']);

    // delete old image
    $query = "SELECT image_url FROM categories WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);
    $category = mysqli_fetch_array($query_run);
    $old_image = $category['image_url'];
    $deleteOldImage = unlink('uploads/'.$old_image);

    $query = "DELETE FROM categories WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Category Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Category Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

// update ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['update_category'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
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
                header("Location: category-edit.php");
                exit(0);
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // delete old image
                    $deleteOldImage = unlink('uploads/'.$old_image);
                    // update into databes with new image
                    $query = "UPDATE categories SET name='$name', image_url='$new_img_name' WHERE id='$category_id' ";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "Category Updated Successfully";
                        header("Location: category-edit.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Category Not Updated";
                        header("Location: category-edit.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: category-edit.php");
                    exit(0);
                }
            }
        }
    } else {
        // update into Database without change image
        $query = "UPDATE categories SET name='$name', image_url='$old_image' WHERE id='$category_id' ";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Category Updated Successfully";
            header("Location: category-edit.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Category Not Updated";
            header("Location: category-edit.php");
            exit(0);
        }
    }

}

// create ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['save_category'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    // image upload
    if ($img_size != 0) {
        if ($error === 0) {
            if ($img_size > 1250000) {
                $_SESSION['message'] = "Image size is too large";
                header("Location: category-create.php");
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
                    $query = "INSERT INTO categories (name,image_url) VALUES ('$name','$new_img_name')";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "Category Created Successfully";
                        header("Location: category-create.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Category Not Created";
                        header("Location: category-create.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: category-create.php");
                    exit(0);
                }
            }
        }
    } else {
        // Insert into Database without image
        $query = "INSERT INTO categories (name,image_url) VALUES ('$name','')";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Category Created Successfully";
            header("Location: category-create.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Category Not Created";
            header("Location: category-create.php");
            exit(0);
        }
    }
}

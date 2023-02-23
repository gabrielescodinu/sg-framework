<?php
session_start();
require '../db_conn.php';

//delete ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['delete_product']);

    // delete old image
    $query = "SELECT image_url FROM products WHERE id='$product_id' ";
    $query_run = mysqli_query($con, $query);
    $product = mysqli_fetch_array($query_run);
    $old_image = $product['image_url'];
    $deleteOldImage = unlink('uploads/'.$old_image);

    $query = "DELETE FROM products WHERE id='$product_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "product Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "product Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

// update ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['update_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

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
                header("Location: product-edit.php");
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
                    $query = "UPDATE products SET name='$name', image_url='$new_img_name' WHERE id='$product_id' ";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "product Updated Successfully";
                        header("Location: product-edit.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "product Not Updated";
                        header("Location: product-edit.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: product-edit.php");
                    exit(0);
                }
            }
        }
    } else {
        // update into Database without change image
        $query = "UPDATE products SET name='$name', image_url='$old_image' WHERE id='$product_id' ";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "product Updated Successfully";
            header("Location: product-edit.php");
            exit(0);
        } else {
            $_SESSION['message'] = "product Not Updated";
            header("Location: product-edit.php");
            exit(0);
        }
    }

}

// create ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['save_product'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    // get category id from select option
    $category_id = mysqli_real_escape_string($con, $_POST['category']);

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    // image upload
    if ($img_size != 0) {
        if ($error === 0) {
            if ($img_size > 1250000) {
                $_SESSION['message'] = "Image size is too large";
                header("Location: product-create.php");
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
                    $query = "INSERT INTO products (name,image_url,category) VALUES ('$name','$new_img_name','$category_id')";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        $_SESSION['message'] = "product Created Successfully";
                        header("Location: product-create.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "product Not Created";
                        header("Location: product-create.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "You can't upload files of this type";
                    header("Location: product-create.php");
                    exit(0);
                }
            }
        }
    } else {
        // Insert into Database without image
        $query = "INSERT INTO products (name,image_url,category) VALUES ('$name','','$category_id')";

        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "product Created Successfully";
            header("Location: product-create.php");
            exit(0);
        } else {
            $_SESSION['message'] = "product Not Created";
            header("Location: product-create.php");
            exit(0);
        }
    }
}

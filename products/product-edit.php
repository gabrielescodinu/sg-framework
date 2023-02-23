<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && $_SESSION['user_is_admin'] == '1') {
?>

    <?php
    require '../db_conn.php';
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>product Edit</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>

            <h4>product Edit<a href="index.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $product_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM products WHERE id='$product_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $product = mysqli_fetch_array($query_run);
                ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

                            <div>
                                <label>product Name</label>
                                <input type="text" name="name" value="<?= $product['name']; ?>">
                            </div>
                            <input type="file" name="my_image">
                            <input type="text" name="old_image" value="<?= $product['image_url']; ?>">
                            <div>
                                <label for="">Select Product Category</label>
                                <select name="category" id="category">
                                    <option value=""></option>
                                    <?php
                                    // give me all categories from the database and show them in the select box as options, if there is a category_id in the product, then select that option
                                    $query = "SELECT * FROM categories";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $category) {
                                    ?>
                                            <option value="<?= $category['id']; ?>" <?= $product['category'] == $category['id'] ? 'selected' : ''; ?>><?= $category['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "<option value=''>No Category Found</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <div>
                                <button type="submit" name="update_product">
                                    Update product
                                </button>
                            </div>



                        </form>
                <?php
                    } else {
                        echo "<h4>No Such Id Found</h4>";
                    }
                }
                ?>
            </div>
        </div>

    </body>

    </html>

<?php
} else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
}
?>
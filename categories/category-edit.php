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
        <title>Category Edit</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>

            <h4>Category Edit<a href="index.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $category_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM categories WHERE id='$category_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $category = mysqli_fetch_array($query_run);
                ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="category_id" value="<?= $category['id']; ?>">

                            <div>
                                <label>Category Name</label>
                                <input type="text" name="name" value="<?= $category['name']; ?>">
                            </div>
                            <input type="file" name="my_image">
                            <input type="text" name="old_image" value="<?= $category['image_url']; ?>">
                            <div>
                                <button type="submit" name="update_category">
                                    Update Category
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
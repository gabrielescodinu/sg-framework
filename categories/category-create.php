<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && $_SESSION['user_is_admin'] == '1') {
?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Category Create</title>
    </head>

    <body>

        <div>
            <?php include('message.php'); ?>

            <h4>Category Add <a href="index.php">BACK</a></h4>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div>
                    <label>Category Name</label>
                    <input type="text" name="name">
                </div>

                <input type="file" name="my_image">
                <div>
                    <button type="submit" name="save_category">Save Category</button>
                </div>

            </form>
        </div>
    </body>

    </html>

<?php
} else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
}
?>
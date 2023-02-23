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
        <title>product Create</title>
    </head>

    <body>

        <div>
            <?php include('message.php'); ?>

            <h4>product Add <a href="index.php">BACK</a></h4>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div>
                    <label>product Name</label>
                    <input type="text" name="name">
                </div>

                <div>
                    <label for="">Select Product Category</label>
                    <select name="category" id="category">
                        <option value=""></option>
                        <?php
                        // give me all categories from db
                        require '../db_conn.php';
                        $query = "SELECT * FROM categories";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                        <?php
                            }
                        } else {
                            echo "No categories found";
                        }
                        ?>
                    </select>
                </div>

                <input type="file" name="my_image">
                <div>
                    <button type="submit" name="save_product">Save product</button>
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
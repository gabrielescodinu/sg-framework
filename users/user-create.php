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
        <title>User Create</title>
    </head>

    <body>

        <div>
            <?php include('message.php'); ?>

            <h4>User Add <a href="index.php">BACK</a></h4>

            <form action="code.php" method="POST">

                <div>
                    <label>User Name</label>
                    <input type="text" name="full_name">
                </div>
                <div>
                    <label>User Email</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label>User Password</label>
                    <input type="text" name="password">
                </div>
                <div>
                    <button type="submit" name="save_user">Save User</button>
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
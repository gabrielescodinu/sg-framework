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
        <title>user Edit</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>

            <h4>user Edit<a href="index.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $user_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM users WHERE id='$user_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $user = mysqli_fetch_array($query_run);
                ?>
                        <form action="code.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user['id']; ?>">

                            <div>
                                <label>user Name</label>
                                <input type="text" name="full_name" value="<?= $user['full_name']; ?>">
                            </div>
                            <div>
                                <label>user Email</label>
                                <input type="email" name="email" value="<?= $user['email']; ?>">
                            </div>
                            <div>
                                <label>User Password</label>
                                <input type="text" name="password">
                                <input type="text" name="old_password" value="<?= $user['password']; ?>">
                            </div>
                            <div>
                                <button type="submit" name="update_user">
                                    Update user
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
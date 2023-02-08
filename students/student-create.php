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
        <title>Student Create</title>
    </head>

    <body>

        <div>
            <?php include('message.php'); ?>

            <h4>Student Add <a href="index.php">BACK</a></h4>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div>
                    <label>Student Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Student Email</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label>Student Phone</label>
                    <input type="text" name="phone">
                </div>
                <div>
                    <label>Student Course</label>
                    <input type="text" name="course">
                </div>

                <input type="file" name="my_image">
                <div>
                    <button type="submit" name="save_student">Save Student</button>
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
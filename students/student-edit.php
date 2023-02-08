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
        <title>Student Edit</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>

            <h4>Student Edit<a href="index.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $student_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM students WHERE id='$student_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $student = mysqli_fetch_array($query_run);
                ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                            <div>
                                <label>Student Name</label>
                                <input type="text" name="name" value="<?= $student['name']; ?>">
                            </div>
                            <div>
                                <label>Student Email</label>
                                <input type="email" name="email" value="<?= $student['email']; ?>">
                            </div>
                            <div>
                                <label>Student Phone</label>
                                <input type="text" name="phone" value="<?= $student['phone']; ?>">
                            </div>
                            <div>
                                <label>Student Course</label>
                                <input type="text" name="course" value="<?= $student['course']; ?>">
                            </div>
                            <input type="file" name="my_image">
                            <div>
                                <button type="submit" name="update_student">
                                    Update Student
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
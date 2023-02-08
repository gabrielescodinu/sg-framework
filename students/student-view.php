    <?php
    require '../db_conn.php';
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student View</title>
    </head>

    <body>

        <div>
            <h4>Student View Details<a href="list.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $student_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM students WHERE id='$student_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $student = mysqli_fetch_array($query_run);
                ?>

                        <div>
                            <label>Student Name</label>
                            <p> <?= $student['name']; ?> </p>
                        </div>
                        <div>
                            <label>Student Email</label>
                            <p> <?= $student['email']; ?> </p>
                        </div>
                        <div>
                            <label>Student Phone</label>
                            <p> <?= $student['phone']; ?> </p>
                        </div>
                        <div>
                            <label>Student Course</label>
                            <p> <?= $student['course']; ?> </p>
                        </div>
                        <img src="uploads/<?= $student['image_url']; ?>" alt="">

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
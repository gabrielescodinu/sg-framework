<?php
session_start();
require '../db_conn.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student CRUD</title>
</head>

<body>

    <div>

        <?php include('message.php'); ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM students";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                ?>
                        <tr>
                            <td><?= $student['id']; ?></td>
                            <td><?= $student['name']; ?></td>
                            <td><?= $student['email']; ?></td>
                            <td><?= $student['phone']; ?></td>
                            <td><?= $student['course']; ?></td>
                            <td>
                                <a href="student-view.php?id=<?= $student['id']; ?>">View</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<h5> No Record Found </h5>";
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>
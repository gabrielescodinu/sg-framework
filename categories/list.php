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
    <title>Category CRUD</title>
</head>

<body>

    <div>

        <?php include('message.php'); ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM categories";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $category) {
                ?>
                        <tr>
                            <td><?= $category['id']; ?></td>
                            <td><?= $category['name']; ?></td>
                            <td><?= $category['email']; ?></td>
                            <td><?= $category['phone']; ?></td>
                            <td><?= $category['course']; ?></td>
                            <td>
                                <a href="category-view.php?id=<?= $category['id']; ?>">View</a>
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
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
        <title>user CRUD</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>
            <a href="../index.php">back</a>
            <a href="user-create.php">Add users</a>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>user Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM users";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $user) {
                    ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['full_name']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <a href="user-edit.php?id=<?= $user['id']; ?>">Edit</a>
                                    <form action="code.php" method="POST">
                                        <button type="submit" name="delete_user" value="<?= $user['id']; ?>">Delete</button>
                                    </form>
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

<?php
} else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
}
?>
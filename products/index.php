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
        <title>product CRUD</title>
    </head>

    <body>

        <div>

            <?php include('message.php'); ?>
            <a href="../index.php">back</a>
            <a href="product-create.php">Add products</a>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>product Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM products";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $product) {
                    ?>
                            <tr>
                                <td><?= $product['id']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><img style="width: 100px" src="uploads/<?= $product['image_url']; ?>" alt="">
                                    <input type="hidden" name="old_image" value="<?= $product['image_url']; ?>">
                                </td>
                                <td><?= $product['category']; ?></td>
                                <td>
                                    <a href="product-edit.php?id=<?= $product['id']; ?>">Edit</a>
                                    <form action="code.php" method="POST">
                                        <button type="submit" name="delete_product" value="<?= $product['id']; ?>">Delete</button>
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
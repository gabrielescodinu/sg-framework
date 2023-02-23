    <?php
    require '../db_conn.php';
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Category View</title>
    </head>

    <body>

        <div>
            <h4>Category View Details<a href="list.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $category_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM categories WHERE id='$category_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $category = mysqli_fetch_array($query_run);
                ?>

                        <div>
                            <label>Category Name</label>
                            <p> <?= $category['name']; ?> </p>
                        </div>
                        <div>
                            <label>Category Email</label>
                            <p> <?= $category['email']; ?> </p>
                        </div>
                        <div>
                            <label>Category Phone</label>
                            <p> <?= $category['phone']; ?> </p>
                        </div>
                        <div>
                            <label>Category Course</label>
                            <p> <?= $category['course']; ?> </p>
                        </div>
                        <img src="uploads/<?= $category['image_url']; ?>" alt="">

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
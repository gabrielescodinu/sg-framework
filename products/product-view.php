    <?php
    require '../db_conn.php';
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>product View</title>
    </head>

    <body>

        <div>
            <h4>product View Details<a href="list.php">BACK</a></h4>

            <div>

                <?php
                if (isset($_GET['id'])) {
                    $product_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM products WHERE id='$product_id' ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $product = mysqli_fetch_array($query_run);
                ?>

                        <div>
                            <label>product Name</label>
                            <p> <?= $product['name']; ?> </p>
                        </div>
                        <div>
                            <label>product Category</label>
                            <?php
                            //give me the category name from the category table where the id is equal to the category id in the product table 
                            $category_id = $product['category'];
                            $query = "SELECT * FROM categories WHERE id='$category_id' ";
                            $query_run = mysqli_query($con, $query);
                            $category = mysqli_fetch_array($query_run);
                            ?>
                            <p> <?= $category['name']; ?> </p>
                        </div>

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
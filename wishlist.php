<?php

session_start();

if (isset($_SESSION["user"])) {

    require "connection.php";

    $wish_is_empty = false;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SimplyTek | Cart</title>

        <link rel="icon" href="./resources/icon.svg">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>

        <?php

        require "header.php";

        ?>

        <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="margin-top: 100px; margin-bottom: 100px;">
                <div class="col-8">
                    <div class="row">
                        <?php

                        $result = Database::search("SELECT p.`id` AS `id`, p.`name`, p.`price`, i.`path`, cl.`name` AS `color`, w.`id` AS `wid`, pc.`id` AS `pcid` FROM `wish` w INNER JOIN `product_color` pc ON w.`product_color_id` = pc.`id` INNER JOIN `color` cl ON pc.`color_id` = cl.`id` INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `img` i ON p.`id` = i.`product_id` WHERE w.`register_email` = '" . $email . "' AND i.`main` = 1 ORDER BY `wdate` ASC");
                        $n = $result->num_rows;

                        if ($n != 0) {

                            for ($i = 0; $i < $n; $i++) {

                                $data = $result->fetch_assoc();

                        ?>

                                <div class="col-6 mt-3">
                                    <div class="card shadow-sm">
                                        <div class="card-header fw-bold fs-5 text-dark">
                                            <span class="text-dark"><?php echo $data["name"] ?></span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <a href="productView.php?id=<?php echo $data["id"] ?>"><img src="<?php echo $data["path"] ?>" class="img-fluid"></a>
                                                </div>
                                                <div class="col-6">
                                                    <span class="badge bg-warning"><?php echo $data["color"] ?></span><br>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <span class="text-dark fw-bold">රු. <?php echo number_format($data["price"]) ?> .00</span>
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-6">
                                                    <?php

                                                    $resultQty = Database::search("SELECT * FROM `product_color` WHERE `id` = " . $data["pcid"] . "");
                                                    $dataQty = $resultQty->fetch_assoc();

                                                    if ($dataQty["qty"] == 0) {

                                                    ?>

                                                        <span class="text-danger">Out of Stock</span>

                                                    <?php

                                                    } else {

                                                    ?>

                                                        <span>Available Qty : <?php echo $dataQty["qty"] ?></span>

                                                    <?php

                                                    }

                                                    ?>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button class="btn btn-danger btn-sm text-uppercase" onclick="removeWishProduct(<?php echo $data['wid'] ?>);"><i class="bi bi-trash"></i> Remove</button>
                                                </div>
                                            </div>

                                            <hr class="col-12 text-dark">
                                        </div>
                                    </div>
                                </div>

                        <?php

                            }
                        } else {

                            $wish_is_empty = true;
                        }

                        ?>

                        <div class="col-12 text-center <?php $d_none = $wish_is_empty ? "d-block" : "d-none";
                                                        echo $d_none ?>">
                            <img src="resources/fav.svg" style="height: 300px;">
                            <h1 class="mt-3">Your Wish List is Empty</h1>
                            <a href="index.php" class="btn btn-primary text-uppercase mt-3"><i class="bi bi-cart4"></i> Continue Shopping</a>
                            <a href="index.php" class="btn btn-primary text-uppercase mt-3"><i class="bi bi-clock-history"></i> View Purchased History</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php

        require "footer.php"

        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
        <script src="script.js "></script>
    </body>

    </html>

<?php

} else {
    header("Location: index.php");
}

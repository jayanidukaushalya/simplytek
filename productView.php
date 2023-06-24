<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>

    <link rel="icon" href="./resources/icon.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body style="overflow-x: hidden;">

    <?php

    require "header.php";

    $pid = $_GET["id"];

    $query = ("SELECT * FROM `product` p INNER JOIN `img` i ON p.`id` = i.`product_id` WHERE p.`id` = " . $pid . " ");

    ?>

    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row">
                        <div class="col-6 mb-5">
                            <div class="row">
                                <div class="col-12 text-center">

                                    <?php

                                    $resultMainI = Database::search($query . "AND i.`main` = 1");
                                    $dataMainI = $resultMainI->fetch_assoc();

                                    ?>

                                    <img src="<?php echo $dataMainI["path"] ?>" id="main-image" alt="Image To Zoom" class="block__pic">

                                    <?php

                                    ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row justify-content-center">

                                        <?php

                                        $resultI = Database::search($query . "AND i.`main` = 0 LIMIT 8");
                                        $nI = $resultI->num_rows;

                                        for ($i = 0; $i < $nI; $i++) {

                                            $dataI = $resultI->fetch_assoc();

                                        ?>
                                            <div class="col-3">
                                                <img src="<?php echo $dataI["path"] ?>" id="image-<?php echo $i ?>" onclick="changeImage('image-<?php echo $i ?>');" class="img-fluid poiner">
                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-1"></div>

                        <?php

                        $result = Database::search("SELECT p.`name` AS `name`, c.`name` AS `cname`, `price`, `description` FROM `product` p INNER JOIN `condition` c ON p.`condition_id` = c.`id` WHERE p.`id` = " . $pid . "");
                        $data = $result->fetch_assoc();

                        ?>

                        <div class="col-5 mb-3">
                            <span class="fs-5 fw-bold text-dark"><?php echo $data["name"] ?></span><br />

                            <?php

                            $resultRatings = Database::search("SELECT * FROM `product` p INNER JOIN `rate` r ON p.`id` = r.`product_id` WHERE r.`product_id` = " . $pid . "");
                            $nRatings = $resultRatings->num_rows;

                            if ($nRatings != 0) {

                                $rate = 0;

                                for ($i = 0; $i < $nRatings; $i++) {

                                    $dataRatings = $resultRatings->fetch_assoc();

                                    $rate += $dataRatings["value"];
                                }

                                $rateAvg = round($rate / $nRatings);

                                for ($i = 0; $i < $rateAvg; $i++) {

                            ?>

                                    <i class="bi bi-star-fill text-warning"></i>

                                <?php

                                }

                                if ($rateAvg == 1) {

                                ?>

                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>

                                <?php

                                } else if ($rateAvg == 2) {

                                ?>

                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>

                                <?php

                                } else if ($rateAvg == 3) {

                                ?>

                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>

                                <?php

                                } else if ($rateAvg == 4) {

                                ?>

                                    <i class="bi bi-star text-warning"></i>

                                <?php

                                }

                                ?>

                                <span class="text-danger"><?php echo $nRatings ?> Product Rating<?php $s = $nRatings > 1 ? "s" : "";
                                                                                                echo $s ?></span>

                            <?php

                            } else {

                            ?>

                                <span>Product ratings not yet available</span>

                            <?php

                            }

                            ?>

                            <hr class="text-dark">

                            <span class="text-dark">Condition : <?php echo $data["cname"] ?></span>

                            <hr class="text-dark">

                            <span>Colour :</span>
                            <input type="hidden" id="color-id">

                            <?php

                            $resultColor = Database::search("SELECT color_id, cc.`name` AS `name` FROM `product` p INNER JOIN `product_color` c ON p.`id` = c.`product_id` INNER JOIN `color` cc ON c.`color_id` = cc.`id` WHERE c.`product_id` = " . $pid . "");
                            $nColor = $resultColor->num_rows;

                            for ($i = 0; $i < $nColor; $i++) {

                                $dataColor = $resultColor->fetch_assoc();

                            ?>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="color" onchange="setColor3(<?php echo $dataColor['color_id'] ?>);">
                                    <label class="form-check-label" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                                </div>

                            <?php

                            }

                            ?>


                            <hr class="text-dark">

                            <span class="text-secondary"><?php echo $data["description"] ?></span>

                            <hr class="text-dark">

                            <span class="text-dark fw-bold">Price : රු <?php echo number_format($data["price"]) ?> . 00</span>

                            <div class="mt-3">

                                <?php

                                if (isset($_SESSION["user"])) {

                                ?>

                                    <button type="button" class="btn btn-sm btn-danger text-uppercase" onclick="addToWishList3(<?php echo $pid ?>)"><i class="bi bi-heart-fill"></i> Wish List</button>
                                    <button type="button" class="btn btn-sm btn-primary text-white text-uppercase" onclick="addToCart3(<?php echo $pid ?>)"><i class="bi bi-cart4"></i> Add to Cart</button>

                                <?php

                                } else {

                                ?>

                                    <button type="button" class="btn btn-sm btn-danger text-uppercase" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-heart-fill"></i> Wish List</button>
                                    <button type="button" class="btn btn-sm btn-primary text-white text-uppercase" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-cart4"></i> Add to Cart</button>

                                <?php

                                }


                                ?>


                            </div>

                            <hr class="text-dark">

                            <span class="text-success"><i class="bi bi-truck text-success"></i> Islandwide Delivery</span><br />
                            <span class="text-dark">> Delivery Duration 2-3 Working Days.</span><br />
                            <span class="text-dark">> Depend on the location, Delivery charges will apply.</span><br />
                            <span class="text-dark">> We deliver products as Sensitive Package, It will add more protection for your packages.</span>

                            <?php

                            $resultRatings2 = Database::search("SELECT p.`id`, r.`value`, `register_email`, `review`, `fname`, `lname` FROM `product` p 
                            INNER JOIN `rate` r ON p.`id` = r.`product_id` INNER JOIN `register` re ON r.`register_email` = re.`email` WHERE r.`product_id` = " . $pid . " ORDER BY `value` DESC");
                            $nRatings2 = $resultRatings2->num_rows;

                            if ($nRatings != 0) {

                            ?>

                                <hr>

                                <div class="row">
                                    <div class="col-12" style="height: 150px; overflow-y: scroll; overflow-x: hidden;">

                                        <?php

                                        for ($i = 0; $i < $nRatings2; $i++) {

                                            $dataRatings2 = $resultRatings2->fetch_assoc();

                                        ?>

                                            <div class="row bg-light mb-3 p-3">
                                                <div class="col-12">

                                                    <?php

                                                    $rate = $dataRatings2["value"];

                                                    if ($rate == 1) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    <?php

                                                    } else if ($rate == 2) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    <?php

                                                    } else if ($rate == 3) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    <?php

                                                    } else if ($rate == 4) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star text-warning"></i>

                                                    <?php

                                                    } else if ($rate == 5) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>

                                                    <?php

                                                    }

                                                    ?>

                                                    <br>

                                                    <span class="text-success" style="font-size: 14px;">

                                                        by

                                                        <?php

                                                        $fname = $dataRatings2["fname"];
                                                        $lname = $dataRatings2["lname"];

                                                        if (empty($fname) && empty($lname)) {
                                                            echo $dataRatings2["register_email"];
                                                        } else {
                                                            echo $fname . " " . $lname;
                                                        }

                                                        ?>

                                                    </span>

                                                    <br><br>

                                                    <p><?php echo $dataRatings2["review"] ?></p>

                                                    <?php

                                                    ?>

                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php

    require "footer.php";

    ?>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6" crossorigin="anonymous"></script>
    <script src="zoomsl.js"></script>

    <script>
        $(document).ready(function() {
            $(".block__pic").imagezoomsl({
                zoomrange: [3, 3]
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
    <script src="script.js "></script>
</body>

</html>
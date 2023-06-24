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
    <title>SimplyTek | Home</title>

    <link rel="icon" href="./resources/icon.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

    <?php

    require "header.php";

    ?>

    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 col-lg-8 col-xl-5">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/emi-plans.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="resources/Apple-Banner-1-scaled.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="resources/realme-t100.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </section>

    <?php

    $result = Database::search("SELECT * FROM `category` WHERE `status` = 1");
    $n = $result->num_rows;

    for ($i = 0; $i < $n; $i++) {

        $data = $result->fetch_assoc();

    ?>

        <section>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="row mt-3">
                            <h3 class="text-uppercase">-<?php echo $data["name"] ?>-</h3>
                        </div>

                        <div class="row mt-3">

                            <?php

                            $resultP = Database::search("SELECT * FROM `product` WHERE `status` = 1 AND `category_id` = " . $data["id"] . "");
                            $nP = $resultP->num_rows;

                            for ($j = 0; $j < $nP; $j++) {

                                $dataP = $resultP->fetch_assoc();

                            ?>

                                <div class="col-md-4 col-lg-3 mb-3">
                                    <div class="border shadow-sm border-1 p-2 text-center">

                                        <?php

                                        $resultImageMain = Database::search("SELECT * FROM `img` WHERE `product_id` = " . $dataP["id"] . " AND `main` = 1");
                                        $dataImageMain = $resultImageMain->fetch_assoc();

                                        ?>

                                        <div class="p-3">

                                            <a href="productView.php?id=<?php echo $dataP["id"] ?>"><img src="<?php echo $dataImageMain["path"] ?>" class="img-fluid scaleplus" alt=""></a>

                                        </div>

                                        <span class="fw-bold"><?php echo $dataP["name"] ?></span> <br>
                                        <span class="fw-bold text-primary">රු <?php echo number_format($dataP["price"]) ?> . 00</span> <br>

                                        <?php

                                        $resultColor = Database::search("SELECT * FROM `product_color` pc INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `color` c ON pc.`color_id` = c.`id` WHERE pc.`product_id` = " . $dataP["id"] . "");
                                        $nColor = $resultColor->num_rows;

                                        $color_id = 0;

                                        if ($nColor > 1) {

                                        ?>

                                            <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>-<?php echo $j ?>">

                                            <?php

                                            for ($k = 0; $k < $nColor; $k++) {

                                                $dataColor = $resultColor->fetch_assoc();

                                            ?>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input poiner" type="radio" name="color" onchange="setColor(<?php echo $dataColor['color_id'] ?>, <?php echo $i ?>, <?php echo $j ?>);">
                                                    <label class="form-check-label" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                                                </div>

                                            <?php

                                            }
                                        } else {

                                            $dataColor = $resultColor->fetch_assoc();

                                            ?>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>-<?php echo $j ?>" value="<?php echo $dataColor["id"] ?>">
                                                <label class="form-check-label badge bg-warning" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                                            </div>

                                        <?php

                                        }


                                        ?>

                                        <div class="mt-2 mb-5">

                                            <?php

                                            if (isset($_SESSION["user"])) {

                                            ?>

                                                <button type="button" class="btn btn-sm btn-danger" onclick="addToWishList(<?php echo $dataP['id'] ?>, <?php echo $i ?>, <?php echo $j ?>);"><i class="bi bi-heart-fill"></i></button>
                                                <button type="button" class="btn btn-sm btn-primary text-white" onclick="addToCart(<?php echo $dataP['id'] ?>, <?php echo $i ?>, <?php echo $j ?>);"><i class="bi bi-cart4"></i></button>

                                            <?php

                                            } else {

                                            ?>

                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-danger"><i class="bi bi-heart-fill"></i></button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary text-white"><i class="bi bi-cart4"></i></button>

                                            <?php

                                            }

                                            ?>

                                        </div>
                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                            <div class="col-12">
                                <a href="" class="text-decoration-none">See more -></a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            </div>
        </section>

    <?php

    }

    require "footer.php";

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
    <script src="script.js "></script>
</body>

</html>
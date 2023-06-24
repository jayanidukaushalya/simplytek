<?php

session_start();

require "connection.php";

$brand = $_GET["b"];
$color = $_GET["c"];
$input = $_GET["i"];

if (!empty($brand) && !empty($color)) {

    $result = Database::search("SELECT p.`name` AS `name`, `price`, p.`id` AS `id` FROM `product` p INNER JOIN `brand` b ON p.`brand_id` = b.`id` INNER JOIN `product_color` c ON p.`id` = c.`product_id` WHERE p.`status` = 1 AND p.`name` LIKE '%" . $input . "%' AND b.`id` = " . $brand . " AND c.`color_id` = " . $color . "");
    $n = $result->num_rows;

    if ($n != 0) {

        for ($i = 0; $i < $n; $i++) {

            $data = $result->fetch_assoc();

?>

            <div class="col-md-4 col-lg-3 mb-3">
                <div class="border border-1 p-3 text-center">

                    <?php

                    $resultImageMain = Database::search("SELECT * FROM `img` WHERE `product_id` = " . $data["id"] . " AND `main` = 1");
                    $dataImageMain = $resultImageMain->fetch_assoc();

                    ?>

                    <a href="productView.php?id=<?php echo $data["id"] ?>"><img src="<?php echo $dataImageMain["path"] ?>" class="img-fluid scaleplus" alt=""></a>

                    <span class="fw-bold"><?php echo $data["name"] ?></span> <br>
                    <span class="fw-bold text-primary">රු <?php echo number_format($data["price"]) ?> . 00</span> <br>

                    <?php

                    $resultColor = Database::search("SELECT * FROM `product_color` pc INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `color` c ON pc.`color_id` = c.`id` WHERE pc.`product_id` = " . $data["id"] . "");
                    $nColor = $resultColor->num_rows;

                    $color_id = 0;

                    if ($nColor > 1) {

                    ?>

                        <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>">

                        <?php

                        for ($k = 0; $k < $nColor; $k++) {

                            $dataColor = $resultColor->fetch_assoc();

                        ?>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input poiner" type="radio" name="color" onchange="setColor2(<?php echo $dataColor['color_id'] ?>, <?php echo $i ?>);">
                                <label class="form-check-label" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                            </div>

                        <?php

                        }
                    } else {

                        $dataColor = $resultColor->fetch_assoc();

                        ?>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>" value="<?php echo $dataColor["id"] ?>">
                            <label class="form-check-label badge bg-warning" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                        </div>

                    <?php

                    }


                    ?>

                    <div class="mt-2 mb-5">

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <button type="button" class="btn btn-sm btn-danger" onclick="addToWishList2(<?php echo $data['id'] ?>, <?php echo $i ?>);"><i class="bi bi-heart-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-primary text-white" onclick="addToCart2(<?php echo $data['id'] ?>, <?php echo $i ?>);"><i class="bi bi-cart4"></i></button>

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
    } else {

        ?>

        <div class="mt-5 mb-5 p-5 text-center">
            <img src="resources/no.svg" height="200px" />
            <h1 class="mt-5">There are no items matching with your search <br></h1>
        </div>

        <?php

    }
} else if (!empty($brand)) {

    $result = Database::search("SELECT p.`name` AS `name`, `price`, p.`id` AS `id` FROM `product` p INNER JOIN `brand` b ON p.`brand_id` = b.`id` WHERE p.`status` = 1 AND p.`name` LIKE '%" . $input . "%' AND b.`id` = " . $brand . "");
    $n = $result->num_rows;

    if ($n != 0) {

        for ($i = 0; $i < $n; $i++) {

            $data = $result->fetch_assoc();

        ?>

            <div class="col-md-4 col-lg-3 mb-3">
                <div class="border border-1 p-3 text-center">

                    <?php

                    $resultImageMain = Database::search("SELECT * FROM `img` WHERE `product_id` = " . $data["id"] . " AND `main` = 1");
                    $dataImageMain = $resultImageMain->fetch_assoc();

                    ?>

                    <a href="productView.php?id=<?php echo $data["id"] ?>"><img src="<?php echo $dataImageMain["path"] ?>" class="img-fluid scaleplus" alt=""></a>

                    <span class="fw-bold"><?php echo $data["name"] ?></span> <br>
                    <span class="fw-bold text-primary">රු <?php echo number_format($data["price"]) ?> . 00</span> <br>

                    <?php

                    $resultColor = Database::search("SELECT * FROM `product_color` pc INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `color` c ON pc.`color_id` = c.`id` WHERE pc.`product_id` = " . $data["id"] . "");
                    $nColor = $resultColor->num_rows;

                    $color_id = 0;

                    if ($nColor > 1) {

                    ?>

                        <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>">

                        <?php

                        for ($k = 0; $k < $nColor; $k++) {

                            $dataColor = $resultColor->fetch_assoc();

                        ?>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input poiner" type="radio" name="color" onchange="setColor2(<?php echo $dataColor['color_id'] ?>, <?php echo $i ?>);">
                                <label class="form-check-label" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                            </div>

                        <?php

                        }
                    } else {

                        $dataColor = $resultColor->fetch_assoc();

                        ?>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="hidden" id="color-id-<?php echo $i ?>" value="<?php echo $dataColor["id"] ?>">
                            <label class="form-check-label badge bg-warning" for="inlineRadio1"><?php echo $dataColor["name"] ?></label>
                        </div>

                    <?php

                    }


                    ?>

                    <div class="mt-2 mb-5">

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-heart-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-primary text-white" onclick="addToCart2(<?php echo $data['id'] ?>, <?php echo $i ?>);"><i class="bi bi-cart4"></i></button>

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
    } else {

        ?>

        <div class="mt-5 mb-5 p-5 text-center">
            <img src="resources/no.svg" height="200px" />
            <h1 class="mt-5">There are no items matching with your search <br></h1>
        </div>

<?php

    }
} else {
    echo "no";
}

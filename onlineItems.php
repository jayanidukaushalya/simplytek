<?php

session_start();

require "connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SimplyTek | Dashboard</title>

        <link rel="icon" href="./resources/icon.svg">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>



        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">

                        <?php

                        require "adminSlider.php";

                        ?>

                        <div class="col-10 pt-3 pe-5 ps-5 pb-3 border shadow-sm">
                            <div class="row g-3" id="div">
                                <div class="col-12">
                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Online Items</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <?php

                                        $resultC = Database::search("SELECT * FROM `category`");
                                        $nC = $resultC->num_rows;

                                        for ($i = 0; $i < $nC; $i++) {

                                            $dataC = $resultC->fetch_assoc();

                                        ?>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-<?php echo $i ?>">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $i ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo $i ?>">
                                                        <?php echo $dataC["name"] ?>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse-<?php echo $i ?>" class="accordion-collapse collapse show" aria-labelledby="flush-<?php echo $i ?>">
                                                    <div class="accordion-body">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Product Details</th>
                                                                    <th scope="col">List Date</th>
                                                                    <th scope="col">Qty (Avb)</th>
                                                                    <th scope="col">Qty (Sold)</th>
                                                                    <th scope="col">Visibility</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                $resultP = Database::search("SELECT p.`id` AS `pid`, p.`name` AS `pname`, p.`price` AS `price`, p.`rdate` AS `pdate`, p.`description` AS `description`, p.`status` AS `stat`, b.`name` AS `bname`, co.`name` AS `coname`, i.`path` AS `path`, col.`name` AS `color`, pc.`id` AS `pcid` FROM `product` p INNER JOIN `category` c ON p.`category_id` = c.`id` INNER JOIN `brand` b ON p.`brand_id` = b.`id` INNER JOIN `condition` co ON p.`condition_id` = co.`id` INNER JOIN `img` i ON p.`id` = i.`product_id` INNER JOIN `product_color` pc ON p.`id` = pc.`product_id` INNER JOIN `color` col ON pc.`color_id` = col.`id` WHERE c.`status` = 1 AND b.`status` = 1 AND c.`id` = '" . $dataC['id'] . "' AND i.`main` = 1");
                                                                $nP = $resultP->num_rows;

                                                                for ($j = 0; $j < $nP; $j++) {

                                                                    $dataP = $resultP->fetch_assoc();

                                                                ?>

                                                                    <tr>
                                                                        <th scope="row"><?php echo $j + 1 ?></th>
                                                                        <td>
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-12">
                                                                                    <div class="row justify-content-center align-items-center">
                                                                                        <div class="col">
                                                                                            <img src="<?php echo $dataP["path"] ?>" style="height: 200px;">
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <span class="fs-6"><?php echo $dataP["pname"] ?></span><br />
                                                                                            <span>Price : රු. <?php echo number_format($dataP["price"]) ?> .00</span><br />
                                                                                            <span>Colour : <?php echo $dataP["color"] ?></span><br />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $dataP["pdate"] ?></td>

                                                                        <?php
                                                                        
                                                                        $resultQ = Database::search("SELECT COUNT(*) AS count FROM `invoice_item` it INNER JOIN `cart` c ON it.`cart_id` = c.`id` WHERE c.`product_color_id` = '".$dataP["pcid"]."' AND c.`status` = 0");
                                                                        $dataQ = $resultQ->fetch_assoc();

                                                                        $resultS = Database::search("SELECT qty FROM `product_color` WHERE `id` = '".$dataP["pcid"]."'");
                                                                        $dataS = $resultS->fetch_assoc();

                                                                        
                                                                        

                                                                        ?>

                                                                        <td><?php echo $dataS["qty"]; ?></td>
                                                                        <td><?php echo $dataQ["count"]; ?></td>
                                                                        <td><?php echo $dataP["pdate"] ?></td>
                                                                    </tr>

                                                                <?php
                                                                }

                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
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
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
        <script src="script.js "></script>
    </body>

    </html>

<?php

} else {

    header("Location: adminLogin.php");
}

?>
<?php

session_start();

if (isset($_SESSION["user"])) {

    require "connection.php";

    $cart_is_empty = false;

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
            <div class="row justify-content-center align-items-center mt-3 mb-3">
                <div class="col-10">
                    <div class="row">
                        <div class="col-8">

                            <?php

                            $total = 0;
                            $delivery = 0;
                            $discount = 0;
                            $qty = 0;

                            $result = Database::search("SELECT p.`id` AS `id`, p.`name`, p.`price`, p.`discount`, i.`path`, cl.`name` AS `color`, c.`qty`, c.`id` AS `cid`, pc.`id` AS `pcid` FROM `cart` c INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` INNER JOIN `color` cl ON pc.`color_id` = cl.`id` INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `img` i ON p.`id` = i.`product_id` WHERE c.`register_email` = '" . $email . "' AND c.`status` = 1 AND i.`main` = 1 ORDER BY `cdate` ASC");
                            $n = $result->num_rows;

                            if ($n != 0) {

                                for ($i = 0; $i < $n; $i++) {

                                    $data = $result->fetch_assoc();

                                    $qty += $data["qty"];
                                    $discount += $data["discount"];
                                    $total += $data["price"] * $data["qty"];

                            ?>

                                    <div class="card shadow-sm <?php $mt = $i > 0 ? "mt-3" : "";
                                                                echo $mt ?>">
                                        <div class="card-header fw-bold fs-5 text-dark">
                                            Pickup or delivery from store, as soon as today
                                        </div>
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <a href="productView.php?id=<?php echo $data["id"] ?>"><img src="<?php echo $data["path"] ?>" class="img-fluid"></a>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-dark"><?php echo $data["name"] ?></span> <br>
                                                    <span class="badge bg-warning"><?php echo $data["color"] ?></span>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <span class="text-dark fw-bold">රු. <?php echo number_format($data["price"]) ?> .00</span>
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-8 align-items-center text-center">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">

                                                            <?php

                                                            $resultQty = Database::search("SELECT * FROM `product_color` WHERE `qty` = 0 AND `id` = " . $data["pcid"] . "");
                                                            $nQty = $resultQty->num_rows;

                                                            if ($nQty == 0) {

                                                            ?>

                                                                <div class="input-group">
                                                                    <button class="btn btn-sm poiner btn-secondary" onclick="minus('qty-<?php echo $i ?>', <?php echo $data['cid'] ?>);">-</button>
                                                                    <input type="text" id="qty-<?php echo $i ?>" class="text-center form-control form-control-sm w-25" readonly onkeypress="return numbersOnly(event);" value="<?php echo $data["qty"] ?>">
                                                                    <button class="btn btn-sm poiner btn-secondary" onclick="plus('qty-<?php echo $i ?>', <?php echo $data['cid'] ?>);">+</button>
                                                                </div>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <span class="text-danger">Out of Stock</span>

                                                            <?php

                                                            }

                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 text-end">
                                                    <button class="btn btn-danger btn-sm text-uppercase" onclick="removeProduct(<?php echo $data['cid'] ?>);"><i class="bi bi-trash"></i> Remove</button>
                                                </div>
                                            </div>

                                            <hr class="col-12 text-dark">
                                        </div>
                                    </div>

                            <?php

                                }
                            } else {

                                $cart_is_empty = true;
                            }

                            ?>

                        </div>

                        <div class="col-4 <?php $d_none = $cart_is_empty ? "d-none" : "d-block";
                                            echo $d_none ?>">
                            <div class="row">

                                <!-- Delivery -->

                                <div class="col-12 bg-light shadow-sm border border-1 rounded p-3 card-body">

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="text-decoration-underline">This will be your billing and shopping address</label>
                                                </div>

                                                <?php

                                                $delivery_address_is_empty = 0;

                                                $resultDeliverAddress = Database::search("SELECT d.`id`, d.`fname`, d.`lname`, d.`mobile`, d.`address`, c.`name`, t.`id` AS `cid` FROM `delivery_address` d INNER JOIN `register` r ON d.`register_email` = r.`email` INNER JOIN `city` c ON d.`city_id` = c.`id` INNER JOIN `district` t ON c.`district_id` = t.`id` WHERE d.`register_email` = '" . $_SESSION["user"]["email"] . "'");
                                                $nDeliverAddress = $resultDeliverAddress->num_rows;

                                                if ($nDeliverAddress == 1) {

                                                    $dataDeliverAddress = $resultDeliverAddress->fetch_assoc();

                                                    if ($dataDeliverAddress["cid"] == 1) {

                                                        $delivery = 500;
                                                    } else {
                                                        $delivery = 1000;
                                                    }

                                                ?>

                                                    <div class="col-12 mt-3">
                                                        <input type="hidden" value="<?php echo $dataDeliverAddress["id"] ?>" id="delivery-id">
                                                        <input class="form-check-input" checked type="radio" name="active-address" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="active-address"><?php echo $dataDeliverAddress["fname"] ?> <?php echo $dataDeliverAddress["lname"] ?><br><?php echo $dataDeliverAddress["address"] ?><br>City : <?php echo $dataDeliverAddress["name"] ?><br>Mobile : <?php echo $dataDeliverAddress["mobile"] ?></label>
                                                    </div>

                                                <?php

                                                } else {
                                                    $delivery_address_is_empty = 1;
                                                }

                                                ?>

                                                <div class="col-12 mt-3">
                                                    <a class="poiner mt-3 link-danger text-decoration-none" onclick="viewAddNewAddress();">+ Add new address</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3 d-none" id="new-address">
                                            <div class="col-12">
                                                <label for="fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control form-control-sm" id="fname" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control form-control-sm" id="lname" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="shopping-address" class="form-label">Shopping address</label>
                                                <input type="text" class="form-control form-control-sm" id="shopping-address" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="city" class="form-label">City</label>
                                                <select class="form-select form-select-sm" id="city" required>
                                                    <option value="0" selected>Select a City</option>

                                                    <?php

                                                    $resultCity = Database::search("SELECT * FROM `city` ORDER BY `name` ASC");
                                                    $nCity = $resultCity->num_rows;

                                                    for ($i = 0; $i < $nCity; $i++) {

                                                        $dataCity = $resultCity->fetch_assoc();

                                                    ?>

                                                        <option value="<?php echo $dataCity["id"] ?>"><?php echo $dataCity["name"] ?></option>

                                                    <?php

                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="mobile" class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control form-control-sm" id="mobile" required>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="updateDeliveryAddress(<?php echo $delivery_address_is_empty ?>);">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pay Now -->
                                <div class="col-12 mt-3 bg-light shadow-sm border border-1 rounded p-3 card-body">

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <span class="text-dark">Subtotal(<?php echo $qty ?> <?php $item = $qty > 1 ? "items" : "item";
                                                                                                echo $item; ?>)</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="text-dark">රු. <?php echo number_format($total) ?> .00</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <span class="text-dark">Discount</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="text-dark">රු. <?php echo number_format($discount) ?> .00</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-dark">Delivery</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="text-dark">රු. <?php echo number_format($delivery) ?> .00</span>
                                        </div>
                                    </div>

                                    <hr class="text-dark">

                                    <?php

                                    $net_total = $total + $delivery - $discount;

                                    ?>

                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-dark fw-bold">Order Total</span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="text-dark fw-bold">රු. <?php echo number_format($net_total) ?> .00</span>
                                        </div>
                                    </div>

                                    <button class="btn btn-info w-100 mt-3 text-light fw-bold" onclick="payNow(<?php echo $total ?>, <?php echo $discount ?>, <?php echo $delivery ?>, <?php echo $net_total ?>)"><i class="bi bi-lock"></i> CONFIRM AND PAY</button>

                                    <div class="row mt-3 align-items-center">
                                        <div class="col text-start">
                                            <span>Accept Payment Methods</span>
                                        </div>
                                        <div class="col text-end">
                                            <img src="resources/payments/mastercard.svg" style="height: 50px;">
                                            <img src="resources/payments/visa.svg" style="height: 50px;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center <?php $d_none = $cart_is_empty ? "d-block" : "d-none";
                                                        echo $d_none ?>">
                            <img src="resources/emptycart.svg" style="height: 300px;">
                            <h1 class="mt-3">Your Shopping Cart is Empty</h1>
                            <a href="index.php" class="btn btn-primary text-uppercase mt-3"><i class="bi bi-cart4"></i> Continue Shopping</a>
                            <a href="purchasedHistory.php" class="btn btn-primary text-uppercase mt-3"><i class="bi bi-clock-history"></i> View Purchased History</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php

        require "footer.php"

        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
        <script src="script.js "></script>

        <script src="https://www.payhere.lk/lib/payhere.js"></script>

    </body>

    </html>

<?php

} else {
    header("Location: index.php");
}

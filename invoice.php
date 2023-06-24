<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $order_id = $_GET["id"];

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

    <body style="width: 1200px;">

        <!-- Invoice -->

        <div class="row justify-content-center">

            <div class="col-12 mt-3 mb-3 p-5 border" id="print-invoice">

                <div class="row align-items-center">
                    <div class="col-6 text-start">
                        <img src="resources/logo.webp" style="height: 100px; margin-left: -15px;">
                    </div>

                    <div class="col-6 text-end">
                        <span>No 129, Narammala Road, Alawwa</span><br />
                        <span>0372279236 / 0774445556</span><br />
                        <span>simplytek@email.com</span>
                    </div>
                </div>

                <hr>

                <?php

                $resultDeliverAddress = Database::search("SELECT d.`id`, d.`fname`, d.`lname`, d.`mobile`, d.`address`, c.`name`, t.`id` AS `cid` FROM `delivery_address` d INNER JOIN `register` r ON d.`register_email` = r.`email` INNER JOIN `city` c ON d.`city_id` = c.`id` INNER JOIN `district` t ON c.`district_id` = t.`id` WHERE d.`register_email` = '" . $_SESSION["user"]["email"] . "'");
                $nDeliverAddress = $resultDeliverAddress->num_rows;
                $dataDeliverAddress = $resultDeliverAddress->fetch_assoc();

                ?>

                <div class="row">
                    <div class="col-6 text-start">
                        <label class="form-check-label" for="active-address"><?php echo $dataDeliverAddress["fname"] ?> <?php echo $dataDeliverAddress["lname"] ?><br><?php echo $dataDeliverAddress["address"] ?><br>City : <?php echo $dataDeliverAddress["name"] ?><br>Mobile : <?php echo $dataDeliverAddress["mobile"] ?></label>
                    </div>

                    <?php

                    $resultInvoice = Database::search("SELECT * FROM `invoice` WHERE `id` = '" . $order_id . "'");
                    $dataInvoice = $resultInvoice->fetch_assoc();

                    ?>

                    <div class="col-6 text-end">
                        <span>Invoice No : <span class="text-danger"><?php echo $order_id ?></span></span><br>
                        <span>Date & Time: <?php echo $dataInvoice["idate"] ?></span>
                    </div>
                </div>

                <hr>

                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col" class="bg-warning">Colour</th>
                            <th scope="col">Unit Price (රු.)</th>
                            <th scope="col">Discount (රු.)</th>
                            <th scope="col">Product Qty</th>
                            <th scope="col">Total (රු.)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $resultProduct = Database::search("SELECT c.`qty` AS `qty`, l.`name` AS `color`, p.`price`, p.`discount`, p.`id` AS `id`, p.`name` AS `name` FROM `invoice_item` i INNER JOIN `cart` c ON i.`cart_id` = c.`id` INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `color` l ON pc.`color_id` = l.`id` WHERE i.`invoice_id` = '" . $order_id . "' ORDER BY p.`id` ASC");
                        $nProduct = $resultProduct->num_rows;

                        for ($i = 0; $i < $nProduct; $i++) {

                            $dataProduct = $resultProduct->fetch_assoc();

                            $qty = $dataProduct["qty"];
                            $price = $dataProduct["price"];
                            $discount = $dataProduct["discount"];
                            $total = $qty * ($price - $discount);

                        ?>

                            <tr>
                                <th scope="row"><?php echo $i + 1 ?></th>
                                <td><?php echo $dataProduct["id"] ?></td>
                                <td><?php echo $dataProduct["name"] ?></td>
                                <td class="bg-warning"><?php echo $dataProduct["color"] ?></td>
                                <td><?php echo number_format($price) ?></td>
                                <td><?php echo number_format($discount) ?></td>
                                <td><?php echo $qty ?></td>
                                <td><?php echo number_format($total) ?></td>
                            </tr>

                        <?php

                        }

                        ?>

                    </tbody>
                </table>

                <hr>

                <div class="row text-end">
                    <div class="col-8">
                        <span>SUBTOTAL :</span><br />
                        <span>DISCOUNT :</span><br />
                        <span>DELIVERY FEE :</span><br />
                        <span class="fs-5">GRANDTOTAL :</span>
                    </div>
                    <div class="col-4">
                        <span><?php echo number_format($dataInvoice["subtotal"]) ?> . 00</span><br />
                        <span><?php echo number_format($dataInvoice["discount"]) ?> . 00</span><br />
                        <span><?php echo number_format($dataInvoice["delivery"]) ?> . 00</span><br />
                        <span class="fs-5 text-danger"><?php echo number_format($dataInvoice["nettotal"]) ?> . 00</span>
                    </div>
                </div>

                <hr>

                <div class="callout">
                    Purchased items are returned before 7 days of delivery
                </div>

                <hr>

                <div class="text-center text-secondary">
                    Invoice on a created computer and is valid without the signature and seal
                </div>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location: index.php");
}

?>
<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"]["email"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SimplyTek | Purchased History</title>

        <link rel="icon" href="./resources/icon.svg">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="rate.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>

        <?php

        require "header.php";

        ?>

        <div class="container-fluid mb-3 mt-3">
            <div class="row justify-content-center">

                <?php

                $result = Database::search("SELECT it.`id` FROM `invoice` i INNER JOIN `invoice_item` it ON i.`id` = it.`invoice_id` WHERE i.`register_email` = '" . $email . "' AND it.`status` = 1");
                $n = $result->num_rows;

                if ($n != 0) {

                ?>

                    <div class="col-10">

                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order Details</th>
                                    <th scope="col">Purchased Date & Time</th>
                                    <th scope="col">Discount Per 1 (රු.)</th>
                                    <th scope="col">Product Qty</th>
                                    <th scope="col">Amount (රු.)</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $resultInvoice = Database::search("SELECT p.`id`, it.`id` AS `itId`, ii.`path`, p.`name` AS `pname`, l.`name` AS `color`, c.`qty`, i.`idate`, p.price, p.`discount` FROM `invoice` i INNER JOIN `invoice_item` it ON i.`id` = it.`invoice_id` INNER JOIN `cart` c ON it.`cart_id` = c.`id` INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` INNER JOIN `color` l ON pc.`color_id` = l.`id` INNER JOIN `product` p ON pc.`product_id` = p.`id` INNER JOIN `img` ii ON ii.`product_id` = p.`id` WHERE i.`register_email` = '" . $_SESSION["user"]["email"] . "' AND it.`status` = 1 AND c.`status` = 0 AND ii.`main` = 1 ORDER BY i.`idate` DESC");
                                $nInvoice = $resultInvoice->num_rows;

                                for ($i = 0; $i < $nInvoice; $i++) {

                                    $dataInvoice = $resultInvoice->fetch_assoc();

                                ?>

                                    <tr>
                                        <th scope="row"><?php echo $i + 1 ?></th>
                                        <td>
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="row justify-content-center align-items-center">
                                                        <div class="col-4">
                                                            <a href="productView.php?id=<?php echo $dataInvoice["id"] ?>"><img src="<?php echo $dataInvoice["path"] ?>" style="height: 200px;"></a>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="fs-6"><?php echo $dataInvoice["pname"] ?></span><br />
                                                            <span>Price : රු. <?php echo number_format($dataInvoice["price"]) ?> .00</span><br />
                                                            <span>Colour : <?php echo $dataInvoice["color"] ?></span><br />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $dataInvoice["idate"] ?></td>
                                        <td><?php echo number_format($dataInvoice["discount"]) ?> .00</td>
                                        <td><?php echo $dataInvoice["qty"] ?></td>
                                        <td><?php echo number_format(($dataInvoice["price"] * $dataInvoice["qty"]) - $dataInvoice["discount"]) ?> .00</td>
                                        <td><button onclick="openFeedback(<?php echo $dataInvoice['id'] ?>, <?php echo $dataInvoice['itId'] ?>);" class="btn btn-sm btn-secondary">Feedback <i class="bi bi-info-circle-fill"></i></button></td>
                                        <td><button class="btn btn-sm btn-danger" onclick="removePurchasedHistoryItem(<?php echo $dataInvoice['id'] ?>);">Delete <i class="bi bi-trash3-fill"></i></button></td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="feedback-modal" tabindex="-1" aria-labelledby="model-label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="model-label">Review an Item</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="rate">
                                                        <input type="radio" id="star5" name="rate" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rate" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rate" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rate" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rate" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                    <div class="mt-3">
                                                        <textarea class="form-control" placeholder="Enter Comment..." id="review-text" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="sendFeedback();">Send Feedback</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                            </tbody>
                        </table>

                        <hr>

                        <div class="text-end mb-3">
                            <button class="btn btn-sm btn-danger" onclick="clearAllRecords();">Clear All Records <i class="bi bi-trash3-fill"></i></button>
                        </div>
                    </div>

                <?php

                } else {

                ?>

                    <div class="col-10 text-center">
                        <img src="resources/records.svg" style="height: 300px;">
                        <h1 class="mt-3">There is no purchase history to show</h1>
                        <a href="index.php" class="btn btn-primary text-uppercase mt-3">Continue Shopping</a>
                    </div>

                <?php

                }

                ?>

            </div>
        </div>
        <!-- History -->




        <?php

        require "footer.php";

        ?>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
        <script src="script.js "></script>

    </body>

    </html>

<?php

} else {
    header("Location: index.php");
}

?>
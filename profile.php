<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SimplyTek | Profile</title>

        <link rel="icon" href="./resources/icon.svg">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>

        <?php

        require "header.php";

        ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-8 mb-5 mt-3">

                    <div class="row">
                        <div class="col-3 p-3 bg-light">
                            <h5>Hi, Jayanidu Kaushalya</h5>
                        </div>
                        <div class="col-8 p-3 ms-2 bg-light">
                            <h5>Profile Information</h5>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-3 p-3 bg-light">
                            <div class="row g-3">
                                <div class="col-12">
                                    <a href="purchasedHistory.php" class="text-decoration-none"><i class="bi bi-clock-history"></i> View Purchased History</a>
                                </div>
                                <div class="col-12">
                                    <a href="cart.php" class="text-decoration-none"><i class="bi bi-cart4"></i> View Cart</a>
                                </div>
                                <div class="col-12">
                                    <a href="wishlist.php" class="text-decoration-none"><i class="bi bi-heart"></i> View Wish List</a>
                                </div>
                            </div>
                        </div>

                        <?php
                        
                        $result = Database::search("SELECT * FROM `register` WHERE `email` = '".$_SESSION["user"]["email"]."'");
                        $data = $result->fetch_assoc();
                        
                        ?>

                        <div class="col-8 p-3 ms-2 bg-light">
                            <div class="row g-3">
                                <div class="col-12 mb-3">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" value="<?php echo $data["fname"] ?>" class="form-control" id="fname" placeholder="John">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" value="<?php echo $data["lname"] ?>" class="form-control" id="lname" placeholder="Doe">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" value="<?php echo $data["mobile"] ?>" class="form-control" id="mobile" placeholder="07X xxx xxxx">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" value="<?php echo $data["email"] ?>" disabled class="form-control" id="email" placeholder="johndoe@email.com">
                                </div>
                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Information</button>
                                    <button class="btn btn-danger">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php

        require "footer.php";

        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
        <script src="script.js "></script>
    </body>

    </html>

<?php

} else {
    header("Location: index.html");
}

?>
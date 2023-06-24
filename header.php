<section>
    <div class="container-fluid">
        <div class="row mt-1 justify-content-center">

            <div class="d-none d-lg-block col-lg-10 col-xl-8">
                <div class="row align-items-center">
                    <div class="col-3 p-1 text-start text-secondary">
                        <a href="" class="border-end p-1 link-secondary"><i class="bi bi-facebook"></i></a>
                        <a href="" class="border-end p-1 link-secondary"><i class="bi bi-twitter"></i></a>
                        <a href="" class="border-end p-1 link-secondary"><i class="bi bi-linkedin"></i></a>
                        <a href="" class="border-end p-1 link-secondary"><i class="bi bi-youtube"></i></a>
                        <a href="" class="border-end p-1 link-secondary"><i class="bi bi-envelope-fill"></i></a>
                        <a href="" class="p-1 link-secondary"><i class="bi bi-phone-fill"></i></a>
                    </div>
                    <div class="col-9 p-1 text-end">
                        <a href="" class="text-decoration-none link-secondary me-5">Help & Contact</a>
                        <a href="profile.php" class="text-decoration-none link-secondary me-5">

                            <?php

                            if (isset($_SESSION["user"])) {

                                $email = $_SESSION["user"]["email"];
                                $fname = $_SESSION["user"]["fname"];
                                $lname = $_SESSION["user"]["lname"];

                                if (empty($fname)) {
                                    echo $email;
                                } else {
                                    echo $fname . " " . $lname;
                                }
                            } else {
                            ?>
                                <a href="register.php" class="text-decoration-none">Login/Register</a>
                            <?php
                            }

                            ?>

                        </a>

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <a href="logout.php" class="text-decoration-none link-secondary me-5">
                                <i class="bi bi-box-arrow-right"></i>
                            </a>

                        <?php

                        }

                        ?>

                    </div>
                </div>
            </div>

            <hr class="d-none d-lg-block">

        </div>

        <!-- Mobile Header -->
        <div class="d-block d-lg-none col-12">
            <div class="row align-items-center">
                <div class="col-6">
                    <a href="index.php">
                        <img src="resources/logo.webp" style="height: 70px;" alt="">
                    </a>
                </div>
                <div class="col-6 p-3 text-end">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="text-decoration-none text-secondary">
                        <i class="bi bi-list fs-3"></i>
                    </a>
                </div>

                <hr>

            </div>
        </div>

        <div class="d-block d-lg-none col-12">
            <div class="row align-items-center  justify-content-center">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control w-25" id="search-mob" placeholder="Search for products..." aria-label="Recipient's username" aria-describedby="button-addon2">
                        <select id="select-search-mob" class="form-select text-center poiner" aria-label="Default select example">
                            <option value="" selected>SELECT CATEGORY</option>

                            <?php

                            $resultC = Database::search("SELECT * FROM `category` WHERE `status` = 1");
                            $nC = $resultC->num_rows;

                            for ($i = 0; $i < $nC; $i++) {

                                $dataC = $resultC->fetch_assoc();

                            ?>

                                <option value="<?php echo $dataC["id"] ?>"><?php echo $dataC["name"] ?></option>

                            <?php

                            }

                            ?>

                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-search" onclick="searchProductsMobile();"><i class="bi bi-search"></i></button>
                    </div>
                </div>

                <hr>

            </div>
        </div>

        <!-- offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div class="p-1 text-start text-secondary">
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-facebook"></i></a>
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-twitter"></i></a>
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-linkedin"></i></a>
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-youtube"></i></a>
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-envelope-fill"></i></a>
                    <a href="" class="border p-2 fs-5 link-secondary"><i class="bi bi-phone-fill"></i></a>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">
                    <div class="">
                        <hr>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="profile.php" class="text-decoration-none">

                            <?php

                            if (isset($_SESSION["user"])) {

                                $email = $_SESSION["user"]["email"];
                                $fname = $_SESSION["user"]["fname"];

                                if (empty($fname)) {
                            ?><i class="bi bi-person-circle"></i> <?php
                                                                    echo $email;
                                                                } else {
                                                                    ?><i class="bi bi-person-circle"></i> <?php
                                                                                                            echo $fname;
                                                                                                        }
                                                                                                    } else {
                                                                                                            ?>
                                <a href="register.php" class="text-decoration-none"><i class="bi bi-person-circle"></i> Login/Register</a>
                            <?php
                                                                                                    }

                            ?>

                        </a>
                    </div>

                    <?php

                    if (isset($_SESSION["user"])) {

                    ?>

                        <div class="col-12 mt-2">
                            <a href="cart.php" class="poiner text-decoration-none link-secondary"><i class="bi bi-heart"></i> Wish List</a><br>
                        </div>

                        <div class="col-12 mt-2">
                            <a href="cart.php" class="poiner text-decoration-none link-secondary"><i class="bi bi-cart4"></i> Cart</a><br>
                        </div>

                        <div class="col-12 mt-2">
                            <a href="purchasedHistory.php" class="poiner text-decoration-none link-secondary"><i class="bi bi-clock-history"></i> Purchased History</a>
                        </div>

                    <?php

                    } else {

                    ?>

                        <div class="col-12 mt-2">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="poiner text-decoration-none link-secondary"><i class="bi bi-heart"></i> Wish List</a><br>
                        </div>

                        <div class="col-12 mt-2">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="poiner text-decoration-none link-secondary"><i class="bi bi-cart4"></i> Cart</a><br>
                        </div>

                        <div class="col-12 mt-2">
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="poiner text-decoration-none link-secondary"><i class="bi bi-clock-history"></i> Purchased History</a>
                        </div>

                    <?php

                    }

                    ?>

                    <div class="mt-2">
                        <hr>
                    </div>

                    <div class="col-12 mt-2">
                        <a href="logout.php" class="poiner text-decoration-none link-secondary"><i class="bi bi-box-arrow-right"></i> Log Out</a><br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Header -->
        <div class="row justify-content-center">
            <div class="d-none d-lg-block col-xl-10">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="index.php">
                            <img src="resources/logo.webp" style="height: 100px;" alt="">
                        </a>
                    </div>
                    <div class="col-6 justify-content-center">
                        <div class="input-group mb-3">
                            <input type="text" id="search" class="form-control w-25" placeholder="Search for products..." aria-label="Recipient's username" aria-describedby="button-addon2">
                            <select id="select-search" class="form-select text-center poiner" aria-label="Default select example">
                                <option value="" selected>SELECT CATEGORY</option>

                                <?php

                                $resultC = Database::search("SELECT * FROM `category` WHERE `status` = 1");
                                $nC = $resultC->num_rows;

                                for ($i = 0; $i < $nC; $i++) {

                                    $dataC = $resultC->fetch_assoc();

                                ?>

                                    <option value="<?php echo $dataC["id"] ?>"><?php echo $dataC["name"] ?></option>

                                <?php

                                }

                                ?>

                            </select>
                            <button class="btn btn-outline-secondary" type="button" id="button-search" onclick="searchProducts();"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <div class="col-3 text-end" style="margin-top: -30px;">

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <a href="wishlist.php" type="button" class="link-secondary position-relative me-5">
                                <i class="bi bi-heart-fill fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">

                                    <?php

                                    $resultWish = Database::search("SELECT * FROM `wish` WHERE `register_email` = '" . $_SESSION["user"]["email"] . "'");
                                    $nWish = $resultWish->num_rows;

                                    echo $nWish;

                                    ?>

                                </span>
                            </a>

                        <?php

                        } else {

                        ?>

                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="link-secondary position-relative me-5">
                                <i class="bi bi-heart-fill fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    0
                                </span>
                            </a>

                        <?php

                        }

                        ?>

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <a href="cart.php" type="button" class="link-secondary position-relative">
                                <i class="bi bi-cart4 fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">

                                    <?php

                                    $resultCart = Database::search("SELECT * FROM `cart` WHERE `register_email` = '" . $_SESSION["user"]["email"] . "' AND `status` = 1");
                                    $nCart = $resultCart->num_rows;

                                    $qty = 0;

                                    for ($i = 0; $i < $nCart; $i++) {

                                        $dataCart = $resultCart->fetch_assoc();

                                        $qty += $dataCart["qty"];
                                    }

                                    echo $qty;

                                    ?>

                                </span>
                            </a>

                        <?php

                        } else {

                        ?>

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="link-secondary position-relative">
                                <span class="bi bi-cart4 fs-5"></span>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    0
                                </span>
                            </a>

                        <?php

                        }

                        ?>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-primary fw-bold text-uppercase" id="exampleModalLabel">Please Login First</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <a href="register.php" class="btn btn-primary btn-sm text-uppercase">Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="d-none d-lg-block">

        </div>
    </div>
</section>
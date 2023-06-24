<div class="row mt-3 mb-3 justify-content-center">
    <div class="col-2 shadow-sm border border-1 p-5">
        <div class="row">
            <div class="col-12">
                <h4><i class="bi bi-filter"></i> Filters</h4>
            </div>
            <div class="col-12 mt-3">
                <span class="text-decoration-underline">By Price Range</span>
                <div class="input-group mt-3">
                    <input type="number" id="lower-price" class="form-control form-control-sm" placeholder="200, 000">
                    <span class="input-group-text">to</span>
                    <input type="number" id="greater-price" class="form-control form-control-sm" placeholder="300, 000">
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <span class="text-decoration-underline">By Condition</span>
            <div class="col-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" checked type="radio" name="xyz" id="check-condition-1">
                    <label class="form-check-label" for="check-condition-1">
                        Brand New
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="xyz" id="check-condition-2">
                    <label class="form-check-label" for="check-condition-2">
                        Used
                    </label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <span class="text-decoration-underline">By Price</span>
            <div class="col-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="abc" id="check-price-1">
                    <label class="form-check-label" for="check-price-1">
                        Low to High
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="abc" id="check-price-2">
                    <label class="form-check-label" for="check-price-2">
                        High to Low
                    </label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <span class="text-decoration-underline">By Active Time</span>
            <div class="col-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="abc" id="check-active-time-1">
                    <label class="form-check-label" for="check-active-time-1">
                        Newest to Oldest
                    </label>
                </div>
            </div>
            <div class="col-12 mt-0">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="abc" id="check-active-time-2">
                    <label class="form-check-label" for="check-active-time-2">
                        Oldest to Newest
                    </label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <span class="text-decoration-underline">By Raiting</span>
            <div class="col-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="abc" id="check-rating">
                    <label class="form-check-label" for="check-rating">
                        Top to Bottom
                    </label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <button class="btn btn-sm btn-primary" onclick="applyFilters();">Apply</button>
        </div>
    </div>

    <!-- / Sidebar -->

    <div class="col-8 shadow-sm border-top border-bottom border-end">

        <?php
        
        $resultCategory = Database::search("SELECT * FROM `category` WHERE `id` = '".$select."'");
        $nCategory = $resultCategory->num_rows;

        if ($nCategory == 1) {

            $dataCategory = $resultCategory->fetch_assoc();

        }

        
        ?>

        <h1 class="p-3">Searching Results for <?php $search = empty($input) ? $dataCategory["name"] : $input; echo $search ?>...</h1>
        <input type="hidden" id="search-input" value="<?php echo $input ?>">

        <div class="row mt-3 p-3" id="add-filters">

            <?php

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
                        <span class="fw-bold text-primary">රු <?php echo number_format($data["price"] )?> . 00</span> <br>

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

            ?>

        </div>

    </div>
</div>
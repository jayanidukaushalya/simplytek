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
    <title>Advance Search</title>

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
            <div class="row mt-3 justify-content-center">
                <div class="col-10 shadow-sm border border-1 p-5">
                    <div class="row">
                        <div class="col-12">
                            <h4><i class="bi bi-gear-wide-connected"></i> Advance Search</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>SELECT BRAND</option>
                                <option value="1">Apple</option>
                                <option value="2">Asus</option>
                                <option value="3">Canon</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>SELECT MODEL</option>
                                <option value="1">iPhone 14</option>
                                <option value="2">iPhone 13 Pro</option>
                                <option value="3">Macbook 2022</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>SELECT COLOUR</option>
                                <option value="1">Gold</option>
                                <option value="2">Silver</option>
                                <option value="3">Black</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary w-100">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->

            <div class="row mt-3 mb-3 justify-content-center">
                <div class="col-2 shadow-sm border border-1 p-5">
                    <div class="row">
                        <div class="col-12">
                            <h4><i class="bi bi-filter"></i> Filters</h4>
                        </div>
                        <div class="col-12 mt-3">
                            <span class="text-decoration-underline">By Price</span>
                            <div class="slider" id="slider-price" style="color:royalblue;" data-min="25" data-max="75" data-range="100" onchange="m();"></div>
                            <span>Range : LKR 200,000 - 300,000</span>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <span class="text-decoration-underline">By Condition</span>
                        <div class="col-12 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Brand New
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Used
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <span class="text-decoration-underline">By Active Time</span>
                        <div class="col-12 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Newest to Oldest
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Oldest to Newest
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <span class="text-decoration-underline">By Raiting</span>
                        <div class="col-12 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Top to Bottom
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Sidebar -->

                <div class="col-8"></div>
            </div>
        </div>
    </section>

    <?php

    require "footer.php";

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js " integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3 " crossorigin="anonymous "></script>
    <script src="script.js "></script>
</body>

</html>
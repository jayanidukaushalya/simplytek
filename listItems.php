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
                                            <li class="breadcrumb-item active" aria-current="page">List An Item</li>
                                        </ol>
                                    </nav>
                                </div>
                                <div class="col-6">
                                    <label for="category" class="form-label">Select Category</label>
                                    <select id="category" class="form-select poiner">
                                        <option value="0" selected>Choose...</option>

                                        <?php

                                        $resultCategory = Database::search("SELECT * FROM `category` WHERE `status` = 1");
                                        $nCategory = $resultCategory->num_rows;

                                        for ($i = 0; $i < $nCategory; $i++) {

                                            $dataCategory = $resultCategory->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $dataCategory["id"] ?>"><?php echo $dataCategory["name"] ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="brand" class="form-label">Select Brand</label>
                                    <select id="brand" class="form-select poiner">
                                        <option value="0" selected>Choose...</option>

                                        <?php

                                        $resultBrand = Database::search("SELECT * FROM `brand` WHERE `status` = 1");
                                        $nBrand = $resultBrand->num_rows;

                                        for ($i = 0; $i < $nBrand; $i++) {

                                            $dataBrand = $resultBrand->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $dataBrand["id"] ?>"><?php echo $dataBrand["name"] ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="condition" class="form-label">Select Condition</label>
                                    <select id="condition" class="form-select poiner">
                                        <option value="0" selected>Choose...</option>

                                        <?php

                                        $resultCondition = Database::search("SELECT * FROM `condition`");
                                        $nCondition = $resultCondition->num_rows;

                                        for ($i = 0; $i < $nCondition; $i++) {

                                            $dataCondition = $resultCondition->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $dataCondition["id"] ?>"><?php echo $dataCondition["name"] ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" id="name" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="price" class="form-label">Product Price (Rs.)</label>
                                    <input type="number" id="price" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="discount" class="form-label">Product Discount (Rs.)</label>
                                    <input type="number" id="discount" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Add Images</label>
                                    <div class="row ps-5 pe-5">
                                        <div class="col-2 m-3 p-5 border rounded text-center position-relative div-main-image" id="div-main-image">
                                            <label for="main-image" onclick="changeMainImage();" class="poiner">
                                                <input class="d-none" type="file" id="main-image" class="poiner">
                                                <img id="main-img-tag" src="resources/img.png" class="img-fluid opacity-75 add-images-hover">
                                                <div class="position-absolute bg-warning p-1 rounded-bottom" style="bottom: 0%; left: 0%;">Main Image</div>
                                            </label>
                                            <div class="position-absolute bg-danger p-1 rounded-bottom" style="bottom: 0%; right: 0%;" onclick="removeImage1();">&nbsp;<i class="bi bi-trash text-white">&nbsp;</i></div>
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded position-relative" id="div-other-image0">
                                            <label for="other-image" onclick="changeOtherImage();" class="poiner">
                                                <input class="d-none" type="file" multiple="multiple" id="other-image" class="poiner">
                                                <img id="other-img-tag0" src="resources/img.png" class="img-fluid opacity-75 add-images-hover2">
                                                <div class="position-absolute bg-info p-1 rounded-bottom" style="bottom: 0%; left: 0%;">Other Images</div>
                                            </label>
                                            <div class="position-absolute bg-danger p-1 rounded-bottom" style="bottom: 0%; right: 0%;" onclick="removeImage2();">&nbsp;<i class="bi bi-trash text-white">&nbsp;</i></div>
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image1">
                                            <img id="other-img-tag1" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image2">
                                            <img id="other-img-tag2" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                    </div>
                                    <div class="row ps-5 pe-5">
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image3">
                                            <img id="other-img-tag3" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image4">
                                            <img id="other-img-tag4" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image5">
                                            <img id="other-img-tag5" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                        <div class="col-2 m-3 p-5 border rounded" id="div-other-image6">
                                            <img id="other-img-tag6" src="resources/img.png" class="img-fluid opacity-75">
                                        </div>
                                    </div>
                                    <p>You can add only 8 images</p>
                                </div>
                                <div class="col-12">
                                    <label for="name" class="form-label">Product Description</label>
                                    <textarea cols="30" rows="10" id="description" class="form-control"></textarea>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="id" value="0">
                                    <label for="color" class="form-label">Select Colour / </label> <a href="#" onclick="addVariations();" class="link-danger">Add Variation</a>
                                    <select id="color" class="form-select poiner">
                                        <option value="0" selected>Choose...</option>

                                        <?php

                                        $resultColor = Database::search("SELECT * FROM `color`");
                                        $nColor = $resultColor->num_rows;

                                        for ($i = 0; $i < $nColor; $i++) {

                                            $dataColor = $resultColor->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $dataColor["id"] ?>"><?php echo $dataColor["name"] ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="qty" class="form-label">Product Quantity</label>
                                    <input type="number" id="qty" class="form-control">
                                </div>
                                <div id="div-variation" class="col-12">
                                    <input type="hidden" value="0" id="v-count">
                                </div>
                                <div class="col mt-3">
                                    <button class="btn btn-primary" onclick="newItem();">Add Product</button>
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
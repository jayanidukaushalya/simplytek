<div class="col-10 shadow-sm border border-1 p-5">
    <div class="row">
        <div class="col-12">
            <h4><i class="bi bi-gear-wide-connected"></i> Advance Search</h4>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-3">
            <select onchange="a();" id="brand-select" class="form-select" aria-label="Default select example">
                <option value="" selected>SELECT BRAND</option>

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
        <div class="col-3">
            <select class="form-select" disabled id="color-select" aria-label="Default select example">
                <option value="" selected>SELECT COLOUR</option>

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
        <div class="col-1">
            <button class="btn btn-primary w-100" onclick="advanceSearch();">Apply</button>
        </div>
    </div>
</div>
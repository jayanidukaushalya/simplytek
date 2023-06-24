<?php

require("connection.php");

$id = $_GET["id"];
$id++;

?>

<div class="row <?php $mt = $id == 1 ? "" : "mt-3";
                echo $mt ?>">
    <div class="col-6" id="color-div-<?php echo $id ?>">
        <label for="color-<?php echo $id ?>" class="form-label">Select Colour / </label> <a href="#" onclick="removeVariations(<?php echo $id ?>);" class="link-danger">Remove Variation</a>
        <select id="color-<?php echo $id ?>" class="form-select">
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
    <div class="col-6" id="qty-div-<?php echo $id ?>">
        <label for="qty-<?php echo $id ?>" class="form-label">Product Quantity</label>
        <input type="number" id="qty-<?php echo $id ?>" class="form-control">
    </div>
</div>
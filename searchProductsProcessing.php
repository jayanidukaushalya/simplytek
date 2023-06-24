<?php

session_start();

require "connection.php";

require "header.php";

$input = $_GET["i"];
$select = $_GET["s"];

$query = "SELECT p.`name` AS `name`, `price`, p.`id` AS `id` FROM `product` p INNER JOIN `brand` b ON p.`brand_id` = b.`id` INNER JOIN `category` c ON p.`category_id` = c.`id` WHERE ";

if (!empty($select)) {

    $result = Database::search($query . "c.`id` = '" . $select . "' AND p.`status` = 1 AND p.`name` LIKE '%" . $input . "%' OR b.`name` LIKE '%" . $input . "%'");
    $n = $result->num_rows;

    if ($n != 0) {

?>

        <section>
            <div class="container-fluid">
                <div class="row mt-3 justify-content-center">

                    <?php

                    require "advanceSearchDiv.php";

                    ?>

                </div>

                <?php

                require "slider.php";

                ?>

            </div>
            </div>
        </section>

    <?php

    } else {

    ?>

        <div class="mt-5 mb-5 p-5 text-center">
            <img src="resources/no.svg" height="200px" />
            <h1 class="mt-5">There are no items matching with your search <br></h1>
        </div>

    <?php

    }
} else {

    $result = Database::search($query . "p.`status` = 1 AND p.`name` LIKE '%" . $input . "%' OR b.`name` LIKE '%" . $input . "%'");
    $n = $result->num_rows;

    if ($n != 0) {

    ?>

        <section>
            <div class="container-fluid">
                <div class="row mt-3 justify-content-center">

                    <?php

                    require "advanceSearchDiv.php";

                    ?>

                </div>

                <!-- Sidebar -->

                <?php

                require "slider.php";

                ?>

            </div>
        </section>

    <?php

    } else {

    ?>

        <div class="mt-5 mb-5 p-5 text-center">
            <img src="resources/no.svg" height="200px" />
            <h1 class="mt-5">There are no items matching with your search <br></h1>
        </div>

<?php

    }
}

require "footer.php";

?>
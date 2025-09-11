<?php

if (!class_exists("ShoesListTable")) {

    include_once SMS_PLUGIN_PATH . 'class/ShoesListTable.php';
}

$shoeListTableObject = new ShoesListTable();

echo "<h1>List Shoes</h1>";

// To run all logics
$shoeListTableObject->prepare_items();

?>

<form id="frm_serch" method="get">

    <input type="hidden" name="page" value="list-shoes">

    <?php

    // To add search box
    $shoeListTableObject->search_box("Search Shoes", "search_shoes");

    // To display table
    $shoeListTableObject->display();

    ?>

</form>
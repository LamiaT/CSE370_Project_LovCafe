<?php
$title = "Managing Dish Objects";

include './Controller/DishController.php';

$dishController = new DishController();

$content = $dishController->CreateOverviewTable();

if(isset($_GET["delete"]))
{
    $dishController->DeleteDish($_GET["delete"]);
}
        
include './Template.php';      
?>

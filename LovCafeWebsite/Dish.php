<?php

require 'Controller/DishController.php';
$dishController = new DishController();

if(isset($_POST['types']))
{
    //Fill page with dishes of the selected type
    $dishTables = $dishController->CreateDishTables($_POST['types']);
}
else 
{
    //When webpage is loaded for the first time, & so no type is selected -> Fetch all types
    $dishTables = $dishController->CreateDishTables('%');
}

//Outputing data of webpage
$title = 'Overview of the Dishes';
$content = $dishController->CreateDishDropdownList(). $dishTables;

include 'Template.php';

?>

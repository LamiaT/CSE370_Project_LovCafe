<?php

require './Controller/DishController.php';
$dishController = new DishController();

$title = "Add A New Dish";

if(isset($_GET["update"]))
{
    $dish = $dishController->GetDishById($_GET["update"]);
    
    $content ="<form action='' method='post'>
    <fieldset>
            <legend>Add A New Dish</legend>
            <label for='dish_name'>Name: </label>
            <input type='text' class='inputField' name='txtName' value='$dish->dish_name' /><br/>

            <label for='dish_type'>Type: </label>
            <select class='inputField' name='ddlType'>
                <option value='%'>All</option>"
                .$dishController->CreateOptionValues($dishController->GetDishTypes()).
            "</select><br/>

            <label for='dish_image'>Image: </label>
            <select class='inputField' name='ddlImage'>"
            .$dishController->GetImages().
        "</select></br>

        <label for='dish_description'>Description: </label>
        <textarea cols='70' rows='12' name='txtDescription'></textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}

else 
{
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Add A New Dish</legend>
        <label for='dish_name'>Name: </label>
        <input type='text' class='inputField' name='txtName' /><br/>

        <label for='dish_type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$dishController->CreateOptionValues($dishController->GetDishTypes()).
        "</select><br/>

        <label for='dish_image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$dishController->GetImages().
        "</select></br>

        <label for='dish_description'>Description: </label>
        <textarea cols='70' rows='12' name='txtDescription'></textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}

if(isset($_GET["update"])) {
    if(isset($_POST["txtName"]))
    {
        $dishController->UpdateDish($_GET["update"]);
    }
}
else {

    if(isset($_POST["txtName"]))
    {
        $dishController->InsertDish();
    }

    if(isset($_POST["ddlType"]))
    {
        $dishController->InsertDish();
    }

    if(isset($_POST["ddlImage"]))
    {
        $dishController->InsertDish();
    }

    if(isset($_POST["txtDescription"]))
    {
        $dishController->InsertDish();
    }

}

include './Template.php';
?>



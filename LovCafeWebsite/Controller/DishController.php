<script>
//Display a confirmation box when trying to delete an object
function showConfirm(dish_id)
{
    // build the confirmation box
    var c = confirm("Are you sure you want to delete this item?");
    
    // if true, delete item and refresh
    if(c)
        window.location = "DishOverview.php?delete=" + dish_id;
}
</script>

<?php

require ("Model/DishModel.php");

//Contains non-database related functions
class DishController {

    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                </tr>";

        $dishArray = $this->GetDishByType('%');

        foreach ($dishArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='DishAdd.php?update=$value->dish_id'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->dish_id)'>Delete</a></td>
                        <td>$value->dish_id</td>
                        <td>$value->dish_name</td>
                        <td>$value->dish_type</td>    
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }
    
    function CreateDishDropdownList() {
        $dishModel = new DishModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please Select the Dish Type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($this->GetDishTypes()) .
                    "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }

    function CreateDishTables($types) {
        $dishModel = new DishModel();
        $dishArray = $dishModel->GetDishByType($types);
        $result = "";

        //Generating a dishTable for each dishEntity in the array
        foreach ($dishArray as $key => $dish) {
            $result = $result .
                    "<table class = 'dishTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$dish->dish_image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$dish->dish_name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$dish->dish_type</td>
                        </tr>
                        
                         <tr>
                            <th>Type: </th>
                            <td>$dish->dish_image</td>
                        </tr>
                                               
                        <tr>
                            <td colspan='2' >$dish->dish_description</td>
                        </tr>                      
                     </table>";
        }
        return $result;
    }

    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Dish");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    //<editor-fold desc="Set Methods">
    function InsertDish() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $image = $_POST["ddlImage"];
        $description = $_POST["txtDescription"];

        $dish = new DishEntity(-1, $name, $type, $image, $description);
        $dishModel = new DishModel();
        $dishModel->InsertDish($dish);
    }

    function UpdateDish($id) {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $image = $_POST["ddlImage"];
        $description = $_POST["txtDescription"];

        $dish = new DishEntity($id, $name, $type, $image, $description);
        $dishModel = new DishModel();
        $dishModel->UpdateDish($id, $dish);
    }

    function DeleteDish($id) {
        $dishModel = new DishModel();
        $dishModel->DeleteDish($id);
    }
    
    //</editor-fold>
    
    //<editor-fold desc="Get Methods">
    function GetDishById($id) {
        $dishModel = new DishModel();
        return $dishModel->GetDishById($id);
    }

    function GetDishByType($type) {
        $dishModel = new DishModel();
        return $dishModel->GetDishByType($type);
    }

    function GetDishTypes() {
        $dishModel = new DishModel();
        return $dishModel->GetDishTypes();
    }
    //</editor-fold>
}

?>

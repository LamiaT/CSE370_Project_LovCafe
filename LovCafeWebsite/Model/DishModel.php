<?php

require ("Entities/DishEntity.php");

//Contains database-related-codes
class DishModel {

    //For fetching all dish types from db & return them in an array
    function GetDishTypes() {
        require ('Credentials.php');
        //Opening connection and choosing database   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT dish_type FROM dish") or die(mysql_error());
        $types = array();

        //Getting data from database
        while ($row = mysql_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Closing connection & returning desired result
        mysql_close();
        return $types;
    }

    
    //Getting DishEntity objects from database & return them in an array
    function GetDishByType($type) {
        require ('Credentials.php');
        //Opening connection and choosing database     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM dish WHERE dish_type LIKE '$type'";
        $result = mysql_query($query) or die(mysql_error());
        $dishArray = array();

        //Fetching data from database
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
            $name = $row[1];
            $type = $row[2];
            $image = $row[3];
            $description = $row[4];

            //Creating dish objects & storing them in an array
            $dish = new DishEntity($id, $name, $type, $image, $description);
            array_push($dishArray, $dish);
        }
        //Closing connection & returning desired result
        mysql_close();
        return $dishArray;
    }

    function GetDishById($id) {
        require ('Credentials.php');
        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM dish WHERE dish_id = $id";
        $result = mysql_query($query) or die(mysql_error());

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $name = $row[1];
            $type = $row[2];
            $image = $row[3];
            $description = $row[4];

            //Create dishes
            $dish = new DishEntity($id, $name, $type, $image, $description);
        }
        //Close connection and return result
        mysql_close();
        return $dish;
    }

    function InsertDish(DishEntity $dish) {
        $query = sprintf("INSERT INTO dish
                          (dish_name, dish_type, dish_image, dish_description)
                          VALUES
                          ('%s','%s','%s','%s')",
                mysql_real_escape_string($dish->dish_name),
                mysql_real_escape_string($dish->dish_type),
                mysql_real_escape_string("Images/Dish/" . $dish->dish_image),
                mysql_real_escape_string($dish->dish_description));
        $this->PerformQuery($query);
    }

    function UpdateDish($id, DishEntity $dish) {
        $query = sprintf("UPDATE dish
                            SET dish_name = '%s', dish_type = '%s', dish_image = '%s', dish_description = '%s'
                          WHERE dish_id = $id",
                mysql_real_escape_string($dish->dish_name),
                mysql_real_escape_string($dish->dish_type),
                mysql_real_escape_string("Images/Dish/" . $dish->dish_image),
                mysql_real_escape_string($dish->dish_description));
                          
        $this->PerformQuery($query);
    }

    function DeleteDish($id) {
        $query = "DELETE FROM dish WHERE dish_id = $id";
        $this->PerformQuery($query);
    }

    function PerformQuery($query) {
        require ('Credentials.php');
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);

        //Execute query and close connection
        mysql_query($query) or die(mysql_error());
        mysql_close();
    }

}

?>

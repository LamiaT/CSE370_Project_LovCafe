<?php
class DishEntity
{
    public $dish_id;
    public $dish_name;
    public $dish_type;
    public $dish_image;
    public $dish_description;
    
    function __construct($id, $name, $type, $image, $description) {
        $this->dish_id = $id;
        $this->dish_name = $name;
        $this->dish_type = $type;
        $this->dish_image = $image;
        $this->dish_description = $description;
    }
}
?>

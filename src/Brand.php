<?php

    class Brand
    {
        private $name;
        private $id;

        function __construct($name_input, $id = null)
        {
            $this->name = $name_input;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName()
        {
            $this->name = $name_input;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // function delete()

        // function update($new_brand)

        // static function deleteAll()

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = [];
            foreach($returned_brands as $brand)
            {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

    }

?>

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

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }

        // function addStore($new_store)

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN stores_brands ON (stores_brands.brand_id = brands.id)
            JOIN stores ON (stores.id = stores_brands.store_id)
            WHERE brands.id = {$this->getId()};");
            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $city = $store['city'];
                $state = $store['state'];
                $id = $store['id'];
                $new_store = new Store($name, $city, $state, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

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

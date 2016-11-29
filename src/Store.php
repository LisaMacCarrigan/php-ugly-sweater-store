<?php

    class Store
    {
        private $name;
        private $city;
        private $state;
        private $id;

        function __construct($name_input, $city_input, $state_input, $id = null)
        {
            $this->name = $name_input;
            $this->city = $city_input;
            $this->state= $state_input;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name_input)
        {
            $this->name = $name_input;
        }

        function getCity()
        {
            return $this->city;
        }

        function setCity($city_input)
        {
            $this->city = $city_input;
        }

        function getState()
        {
            return $this->state;
        }

        function setState($state_input)
        {
            $this->state = $state_input;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, city, state) VALUES ('{$this->getName()}', '{$this->getCity()}', '{$this->getState()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function addBrand($new_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$new_brand->getId()});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
            JOIN stores_brands ON (stores_brands.store_id = stores.id)
            JOIN brands ON (brands.id = stores_brands.brand_id)
            WHERE stores.id = {$this->getId()};");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        function deleteBrand($brand_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()} AND brand_id = $brand_id;");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = [];
            foreach($returned_stores as $store)
            {
                $name = $store['name'];
                $city = $store['city'];
                $state = $store['state'];
                $id = $store['id'];
                $new_store = new Store($name, $city, $state, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

    }

?>

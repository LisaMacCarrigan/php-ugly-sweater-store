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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach ($returned_stores as $store)
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

<?php

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=sweaters_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase {

        function testSave()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);

            // ACT //
            $test_store->save();

            // ASSERT //
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }
    }

?>

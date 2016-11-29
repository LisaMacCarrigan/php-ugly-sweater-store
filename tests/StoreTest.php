<?php

/**
   *@backupGlobals disabled
   *@backupStaticAttributes disabled
   */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=sweaters_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function testGetId()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = 1;
            $test_store = new Store($name, $city, $state, $id);

            // ACT //
            $result = $test_store->getId();

            // ASSERT //
            $this->assertEquals($id, $result);
        }

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
            $result = Store::getAll();

            // ASSERT //
            $this->assertEquals($test_store, $result[0]);
        }

        function testDeleteAll()
        {
            // ARRANGE //
            $name_1 = "Sweater Swag";
            $city_1 = "Brooklyn";
            $state_1 = "NY";
            $id = null;
            $test_store_1 = new Store($name_1, $city_1, $state_1, $id);
            $test_store_1->save();

            $name_2 = "The Sweat Factory";
            $city_2 = "San Francisco";
            $state_2 = "CA";
            $id = null;
            $test_store_2 = new Store($name_2, $city_2, $state_2, $id);
            $test_store_2->save();

            // ACT //
            Store::deleteAll();
            $result = Store::getAll();

            // ASSERT //
            $this->assertEquals([], $result);
        }

        function testGetAll()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name_2 = "The Sweat Factory";
            $city_2 = "San Francisco";
            $state_2 = "CA";
            $id = null;
            $test_store_2 = new Store($name_2, $city_2, $state_2, $id);
            $test_store_2->save();

            // ACT //
            $result = Store::getAll();

            // ASSERT //
            $this->assertEquals([$test_store, $test_store_2], $result);
        }

        function testDelete()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name_2 = "The Sweat Factory";
            $city_2 = "San Francisco";
            $state_2 = "CA";
            $id = null;
            $test_store_2 = new Store($name_2, $city_2, $state_2, $id);
            $test_store_2->save();

            // ACT //
            $test_store->delete();

            // ASSERT //
            $this->assertEquals([$test_store_2], Store::getAll());
        }

        function testUpdate()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $new_name = "Cool Sweater Co.";

            // ACT //
            $test_store->update($new_name);

            // ASSERT //
            $this->assertEquals($new_name, $test_store->getName());
        }

        function testAddBrand()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            // ACT //
            $test_store->addBrand($test_brand);

            // ASSERT //
            $this->assertEquals([$test_brand], $test_store->getBrands());
        }

        function testGetBrands()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();
            $test_store->addBrand($test_brand);

            $name_2 = "Yarn Amalgamations & Accessories";
            $id = null;
            $test_brand_2 = new Brand($name, $id);
            $test_brand_2->save();
            $test_store->addBrand($test_brand_2);

            // ACT //
            $result = $test_store->getBrands();

            // ASSERT //
            $this->assertEquals([$test_brand, $test_brand_2], $result);
        }

        function testDeleteBrand()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();
            $test_store->addBrand($test_brand);

            $test_store->addBrand($test_brand);

            // ACT //
            $test_store->deleteBrand($test_brand->getId());

            // ASSERT //
            $this->assertEquals([], $test_store->getBrands());
        }

        function testFind()
        {
            // ARRANGE //
            $name = "Sweater Swag";
            $city = "Brooklyn";
            $state = "NY";
            $id = null;
            $test_store = new Store($name, $city, $state, $id);
            $test_store->save();

            $name_2 = "The Sweat Factory";
            $city_2 = "San Francisco";
            $state_2 = "CA";
            $id = null;
            $test_store_2 = new Store($name_2, $city_2, $state_2, $id);
            $test_store_2->save();

            // ACT //
            $id_1 = $test_store->getId();
            $result = Store::find($id_1);

            // ASSERT //
            $this->assertEquals($test_store, $result);

        }

    }

?>

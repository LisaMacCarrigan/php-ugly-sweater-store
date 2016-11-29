<?php

/**
   *@backupGlobals disabled
   *@backupStaticAttributes disabled
   */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=sweaters_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO ($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function testGetId()
        {
            // ARRANGE //
            $name = "Satirical Sweaters Co.";
            $id = 1;
            $test_brand = new Brand($name, $id);

            // ACT //
            $result = $test_brand->getId();

            // ASSERT //
            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            // ARRANGE //
            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);

            // ACT //
            $test_brand->save();
            $result = Brand::getAll();

            // ASSERT //
            $this->assertEquals($test_brand, $result[0]);
        }

        function testDeleteAll()
        {
            // ARRANGE //
            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $name_2 = "Knit Amalgamations";
            $id = null;
            $test_brand_2 = new Brand($name, $id);
            $test_brand_2->save();

            // ACT //
            Brand::deleteAll();
            $result = Brand::getAll();

            // ASSERT //
            $this->assertEquals([], $result);
        }

        function testGetAll()
        {
            // ARRANGE //
            $name = "Satirical Sweaters Co.";
            $id = null;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $name_2 = "Knit Amalgamations";
            $id = null;
            $test_brand_2 = new Brand($name, $id);
            $test_brand_2->save();

            // ACT //
            $result = Brand::getAll();

            // ASSERT //
            $this->assertEquals([$test_brand, $test_brand_2], $result);
        }

    }

?>

<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once 'src/Brand.php';
    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $id = 1;
            $name = "Nike";
            $test_brand = new Brand($name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSetBrandName()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name);

            //Act
            $test_brand->setBrandName("Nike");
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function testGetBrandName()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);

            //Act
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);
            $test_brand->save();

            $name2 = "Addidas";
            $test_brand2 = new Brand($name2, $id2=null);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);
            $test_brand->save();

            $name2 = "Addidas";
            $test_brand2 = new Brand($name2, $id2=null);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function testFindBrands()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);
            $test_brand->save();

            $name2 = "Addidas";
            $test_brand2 = new Brand($name2, $id2=null);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);

        }

        function testAddStore()
        {
            //Arrange
            $name = "Nike";
            $test_brand = new Brand($name, $id=null);
            $test_brand->save();

            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

        function testGetStores()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $test_brand = new Brand($name, $id);
            $test_brand->save();

            $name = "DSW";
            $id2 = 2;
            $test_store = new Store($name, $id2);
            $test_store->save();

            $name2 = "Shoe City";
            $id3 = 3;
            $test_store2 = new Store($name2, $id3);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }
    }

?>

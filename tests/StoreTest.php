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

    class StoreTest extends PHPUnit_Framework_TestCase
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
            $name = "DSW";
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSetStoreName()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name);

            //Act
            $test_store->setStoreName("DSW");
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals("DSW", $result);
        }

        function testGetStoreName()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);

            //Act
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);

            //Act
            $test_store->save();

            //Assert
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $name2 = "Shoe City";
            $test_store2 = new Store($name2, $id2=null);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $name2 = "Shoe City";
            $test_store2 = new Store($name2, $id2=null);
            $test_store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function testFindStores()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $name2 = "Shoe City";
            $test_store2 = new Store($name2, $id2=null);
            $test_store2->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);

        }

        function testUpdate()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $new_name = "Shoe City";

            //Act
            $test_store->update($new_name);

            //Assert
            $this->assertEquals ("Shoe City", $test_store->getStoreName());

        }

        function testDeleteStore()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $name2 = "Shoe City";
            $test_store2 = new Store($name2, $id2=null);
            $test_store2->save();

            //Act

            $test_store->delete();

            //Assert

            $this->assertEquals([$test_store2], Store::getAll());

        }

        function testAddBrand()
        {
            //Arrange
            $name = "DSW";
            $test_store = new Store($name, $id=null);
            $test_store->save();

            $name = "Nike";
            $test_brand = new Brand($name, $id=null);
            $test_brand->save();

            //Act
            $test_store->addBrands($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
        }

        function testGetBrands()
        {
            //Arrange
            $name = "DSW";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name = "Nike";
            $id2 = 2;
            $test_brand = new Brand($name, $id2);
            $test_brand->save();

            $name = "Addidas";
            $id3 = 3;
            $test_brand2 = new Brand($name, $id3);
            $test_brand2->save();

            //Act
            $test_store->addBrands($test_brand);
            $test_store->addBrands($test_brand2);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }
    }

?>

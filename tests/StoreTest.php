<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Store.php";
    require_once 'src/Brand.php';
    $server = 'mysql:host=localhost;dbname=shoes_test';
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

            $name2 = "Water the lawn";
            $test_store2 = new Store($name2, $id2=null);
            $test_store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }
    }



?>

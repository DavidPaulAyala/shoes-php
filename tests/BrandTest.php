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

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // Store::deleteAll();
            // Brand::deleteAll();
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
    }



?>

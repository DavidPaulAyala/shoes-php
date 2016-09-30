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
    }



?>

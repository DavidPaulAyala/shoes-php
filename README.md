# _Shoes!_
#### _09-30-2016_

#### By _**David Ayala**_

## Description

_This website allows for shoe stores and brands to be created and linked to each other.  Stores can carry many brands and shoes can be found in many stores_

## Specifications

|Behavior|Input        |Output|
|--------|:-----------:|-----:|
|Saves Store Name|Foot Locker|Foot Locker|
|Retrieves List of Stores Names|Foot Locker, Shoe City, DSW|Foot Locker, Shoe City, DSW|
|Deletes entire List of Stores Names|Delete: Foot Locker, Shoe City, DSW|List Empty|
|Finds one Store from a list of stores|Find DSW from list of Foot Locker, Shoe City, DSW|DSW|
|Change the name of a store|Change Foot Locker to Lady Foot Locker|Lady Foot Locker|
|Save Brand Name|Nike|Nike|
|Assign Brands to Stores|Assign Nike to DSW|DSW Brands: Nike|
|View Store's Brands|View Foot Locker's Brands|Nike, Addidas, Asics|


##SQL Commands

* _CREATE DATABASE shoes;_
* _USE shoes;_
* _CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255));_
* _CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255));_
* _CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id int, brand_id int);_

## Technologies Used

_HTML,
CSS,
JS,
PHP,
Silex,
Twig,
PHPUnit,
MySQL_

## Setup Instructions

* _Clone the program from its github repository_
* _Navigate to the project directory in a command line software._
* _Type composer install_
* _Type: "cd web" to move into the "web" folder._
* _Type: "php -S localhost:8000" to create a local server for the project_
* _import the included sql.zip database files to MYSQL_
* _Open the browser of your choice and type in this URL to load the project: "localhost:8000"_

## Technologies Used

_HTML,
CSS,
JS,
PHP,
Silex,
Twig,
PHPUnit,
MySQL_

## Licensing

*This product can be used in accordance with the provisions under its MIT license.*

copyright (c) 2016 **_David Ayala_**

<?php
    class Brand
    {
      private $name;
      private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getBrandName()
        {
            return $this->name;
        }

        function setBrandName($new_name)
        {
            $this->name = (string) $new_name;
        }
    }
?>

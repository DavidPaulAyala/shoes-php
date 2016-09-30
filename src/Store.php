<?php
    class Store
    {
      private $name;
      private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getStoreName()
        {
            return $this->name;
        }

        function setStoreName($new_name)
        {
            $this->name = (string) $new_name;
        }
    }
?>

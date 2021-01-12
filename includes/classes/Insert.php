<?php

class Insert
{
    private $con;
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function insert($name, $age, $sex, $property, $comment)
    {
    }
}

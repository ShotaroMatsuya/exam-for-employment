<?php

class Insert
{
    private $con;
    private $errorArray = array();
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function validateAll($name, $age, $sex, $property, $comment)
    {
        $this->validateName($name);
        $this->validateAge($age);
        $this->validateSex($sex);
        $this->validateProp($property);
        $this->validateComment($comment);

        if (empty($this->errorArray)) {
            return $this->insertTable($name, $age, $sex, $property, $comment);
        }
        return false;
    }
    private function insertTable($name, $age, $sex, $property, $comment)
    {
        $property = serialize($property);
        $query = $this->con->prepare("INSERT INTO results (name,age,sex,property,comment) VALUES (:name,:age,:sex,:property,:comment)");

        $query->bindValue(":name", $name);
        $query->bindValue(":age", $age, PDO::PARAM_INT);
        $query->bindValue(":sex", $sex, PDO::PARAM_INT);
        $query->bindValue(":property", $property);
        $query->bindValue(":comment", $comment);

        return $query->execute();
    }
    private function validateName($name)
    {
        if (strlen($name) === 0) {
            array_push($this->errorArray, Constants::$nameChars);
        }
    }
    private function validateAge($age)
    {
        if (!in_array($age, ['0', '1', '2', '3'])) {
            array_push($this->errorArray, Constants::$ageInt);
        }
    }
    private function validateSex($sex)
    {
        if (!in_array($sex, ['0', '1'])) {
            array_push($this->errorArray, Constants::$sexInt);
        }
    }
    private function validateProp($property)
    {
        if (count($property) > 0) {

            foreach ($property as $el) {
                if (in_array($el, ['1', '2', '3', '4'])) {
                    continue;
                } else {
                    return array_push($this->errorArray, Constants::$propInt);
                }
            }
        } else {
            array_push($this->errorArray, Constants::$propInt);
        }
    }
    private function validateComment($comment)
    {
        if (strlen($comment) === 0) {
            array_push($this->errorArray, Constants::$commentChars);
        }
    }
    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<small class='text-danger'>$error</small>";
        }
    }
}

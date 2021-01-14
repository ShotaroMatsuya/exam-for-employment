<?php
class DetailProvider
{
    private $con;
    private $sqlData;
    public function __construct($con, $id)
    {
        $this->con = $con;
        $query = $this->con->prepare("SELECT * FROM results WHERE id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getConnect()
    {
        return "ok";
    }
    public function getId()
    {
        return $this->sqlData["id"];
    }
    public function getName()
    {
        return $this->sqlData["name"];
    }
    public function getAge()
    {
        $fetchedData = $this->sqlData["age"];
        switch ($fetchedData) {
            case "0":
                return "20歳未満";
            case "1":
                return "20歳〜39歳";
            case "2":
                return "40歳〜59歳";
            case "3":
                return "60歳以上";
            default:
                break;
        }
    }
    public function getSex()
    {
        $fetchedData = $this->sqlData["sex"];
        switch ($fetchedData) {
            case "0":
                return "男性";
            case "1":
                return "女性";
            default:
                break;
        }
    }
    public function getProperty()
    {
        $fetchedArray = unserialize($this->sqlData["property"]);
        $propertyArray = array();
        foreach ($fetchedArray as $data) {
            switch ($data) {
                case "1":
                    array_push($propertyArray, "新築一戸建て");
                    break;
                case "2":
                    array_push($propertyArray, "中古一戸建て");
                    break;
                case "3":
                    array_push($propertyArray, "マンション");
                    break;
                case "4":
                    array_push($propertyArray, "土地");
                    break;
                default:
                    break;
            }
        }
        return $propertyArray;
    }
    public function getComment()
    {
        return $this->sqlData["comment"];
    }
    public function getDate()
    {
        $data =  $this->sqlData["datePosted"];
        $date = new DateTime($data);
        return  $date->format('Y年n月j日');
    }
}

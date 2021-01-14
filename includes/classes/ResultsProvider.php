<?php
class ResultsProvider
{
    private $con;
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function getNumResults()
    {
        $query = $this->con->prepare("SELECT COUNT(*) as total FROM results");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row["total"];
    }
    public function getResultsHtml($page, $pageSize)
    {
        $from = ($page - 1) * $pageSize;

        $query = $this->con->prepare("SELECT * FROM results ORDER BY datePosted DESC LIMIT :from, :pageSize");

        $query->bindParam(":from", $from, PDO::PARAM_INT);
        $query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        $query->execute();

        $resultsHtml = "<tbody>";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $name = $row["name"];
            $date = new DateTime($row["datePosted"]);
            $datePosted = $date->format('Y年n月j日');

            $resultsHtml .= "<tr><td>$id</td>
                            <td><a href='details.php?id=$id' class='lead'>$name</a></td>
                            <td>($datePosted)</td>
                            <td><a href='details.php?id=$id' class='btn btn-secondary'><i class='fas fa-angle-double-right'></i> Details</a></td></tr>";
        }
        $resultsHtml .= "</tbody>";
        return $resultsHtml;
    }
}

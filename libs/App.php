<?php require "../config/config.php";?>
<style>
    marquee {
        background-color: red;
        padding: 20px;
        font-size: 32px;
        padding: 8px;
        color: #fff;
    }
</style>
<?php

class App
{
    public $host = HOST;
    public $dbname = DBNAME;
    public $user = USER;
    public $pass = PASS;

    public $link;

    // Create a constructor

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->link = new PDO("mysql:host" . $this->host . ";dbname=" . $this->dbname . "", $this->user, $this->pass);

        if ($this->link) {
            echo "<marquee>Database is working &nbsp; Database is working &nbsp; Database is working</marquee>";
        }
    }

    //Select All
    public function selectAll($query)
    {

        $rows = $this->link->query($query);
        $rows->execute();

        $allRows = $rows->fetchAll(PDO::FETCH_OBJ);

        if ($allRows) {
            return $allRows;
        } else {
            return false;
        }

    }

    //Select one row
    public function selectOne($query)
    {

        $row = $this->link->query($query);
        $row->execute();

        $singleRow = $row->fetch(PDO::FETCH_OBJ);

        if ($singleRow) {
            return $singleRow;
        } else {
            return false;
        }

    }

    // Insert Data
    public function insert($query, $arr, $path)
    {
        if ($this->validate($arr) == "empty") {
            echo "<script>alert('One or more inputs are empty!')</script>";
        } else {
            $insert_record = $this->link->prepare($query);
            $insert_record->execute($arr);

            header("location : " . $path . "");
        }
    }

    // Update Data
    public function update($query, $arr, $path)
    {
        if ($this->validate($arr) == "empty") {
            echo "<script>alert('Input updated successfully!')</script>";
        } else {
            $update_record = $this->link->prepare($query);
            $update_record->execute($arr);

            header("location : " . $path . "");
        }
    }

    // Delete Data
    public function delete($query, $path)
    {

        $delete_record = $this->link->query($query);
        $delete_record->execute();

        header("location : " . $path . "");
    }

    public function validate($arr)
    {
        if (in_array("", $arr)) {
            echo "empty";
        }
    }

}

$obj = new App;
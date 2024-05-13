<?php require"../config/config.php"; ?>

<?php

class App{
    public $host = HOST;
    public $db = DBNAME;
    public $user = USER;
    public $pass = PASS;
    

    public $link;

    // Create a constructor
    
    public function __construct(){
        $this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
    }


}
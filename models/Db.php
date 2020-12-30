<?php
class Db {
    function __construct() {
        $host = "127.0.0.1";
        $user = "root";
        $db = "ebsys";
        $password = "@Ae12345678";
        // $link = mysqli_connect($host, $user, $password, $db);
    }
    
    public function insert($sql){
        $link = mysqli_connect("127.0.0.1", "root", "@Ae12345678", "ebsys");

        if($link->query($sql) === TRUE){
            return true;
        }else{
            return $link->error;
        }
        $link->close();
    }

    public function get($sql) {
        $link = mysqli_connect("127.0.0.1", "root", "@Ae12345678", "ebsys");

        $data = array();
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }

        return json_encode($data);

        mysqli_close($link);
    }
}
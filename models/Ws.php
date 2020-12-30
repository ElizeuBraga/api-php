<?php
require_once('./config/constants.php');
class Ws {
    public $aMemberVar = 'aMemberVar Member Variable';
    public $aFuncName = 'aMemberFunc';
   
   
    public function index() {
        $productuction = false;
        if($productuction){
            $link = mysqli_connect("127.0.0.1", "root", "kw7PbvC25-SHtsv", "224617");
        }else{
            $link = mysqli_connect("127.0.0.1", "root", "@Ae12345678", "ebsys");
        }
        $table = $_REQUEST['table'];
        $sql = "SELECT * FROM {$table} WHERE updated = true";
        $result = $link->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }

        $myJSON = json_encode($data);

        echo $myJSON;

        mysqli_close($link);
    }

    public function store() {
        $productuction = true;
        if($productuction){
            echo "Salvo em produção";
            $link = mysqli_connect("127.0.0.1", "224617", "kw7PbvC25-SHtsv", "224617");
        }else{
            echo "Salvo em local";
            $link = mysqli_connect("127.0.0.1", "root", "@Ae12345678", "ebsys");
        }

        $table = $_REQUEST['table'];

        if($table == 'sections'){
            $name = (isset($_REQUEST['name'])) ? $_REQUEST['name'] : null;
            $sql = "INSERT INTO {$table} (name) VALUES ('{$name}');";
        }else if($table == 'products'){
            $name = $_REQUEST['name'];
            $price = $_REQUEST['price'];
            $section_id = $_REQUEST['section_id'];
            $sql = "INSERT INTO {$table} (name, price, section_id) VALUES ('{$name}', {$price}, {$section_id});";
        }
        
        $link -> query($sql);
        
        $link -> close();
    }
}
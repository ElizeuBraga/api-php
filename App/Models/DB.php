<?php
    namespace App\Models;

    class DB{
        public static function select($sql){
            $con = new \PDO(DNS,DBUSER,DBPASS);
            $stmt = $con->prepare($sql);
            $stmt->execute();

            $arrayData = array();
            if($stmt->rowCount() > 0){
                while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    array_push($arrayData,$data);
                }
            }
            return $arrayData;
        }

        public static function insert($array){
            $array = json_decode(file_get_contents("php://input"), true);
            $url = explode('/', $_GET['url']);
            $table = $url[1];
            $sql = 'INSERT INTO '. $table;
            $keys = '(';
            $values = 'values(';
            $count = 0;

            foreach ($array[0] as $key => $value) {
                $count ++;
                $keys .= ($count < count($array[0])) ? $key.',':$key.')';
                $values .= ($count < count($array[0])) ? ':'.$key.',':':'.$key.')';
            }
            $sql .= $keys . $values;
        
            $con = new \PDO(DNS,DBUSER,DBPASS);
            $con->beginTransaction();
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            try {
                $stmt= $con->prepare($sql);
                foreach ($array as $d) {
                    foreach ($d as $key => $value) {
                        $stmt->bindValue($key, $value);
                    }
                    $stmt->execute();
                }
            } catch (\PDOException $e) {
                $con->rollback();
                echo $e->getMessage();
                die();
            }

            $con->commit();
            return true;
        }
    }
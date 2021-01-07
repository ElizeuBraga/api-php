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

        public static function insert($sql, $array){
            $con = new \PDO(DNS,DBUSER,DBPASS);

            foreach ($array as $a) {
                $stmt= $con->prepare($sql);
                $stmt->execute($a);
            }
        }
    }
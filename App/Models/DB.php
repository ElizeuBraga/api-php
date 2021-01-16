<?php
    namespace App\Models;
    class DB{
        static $table, $id, $request;
        public function __construct($url = array()){
            self::$table = (isset($url[1])) ? $url[1] : false;
            self::$id = (isset($url[2])) ? $url[2] : false;
            self::$request = json_decode(file_get_contents("php://input"), true);
        }

        public static function select(){
            if(self::$id && self::$id != ""){
                $sql = "SELECT * FROM ".self::$table." WHERE id = ". self::$id. " AND deleted_at is null";
            }else{
                $sql = "SELECT * FROM ".self::$table." WHERE deleted_at is null";
            }
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

        public static function insert(){
            $request = self::$request;
            $sql = 'INSERT INTO '. self::$table;
            $keys = '(';
            $values = 'values(';
            $count = 0;

            // var_dump($request); die();
            foreach ($request[0] as $key => $value) {
                $count ++;
                $keys .= ($count < count($request[0])) ? $key.',':$key.')';
                $values .= ($count < count($request[0])) ? ':'.$key.',':':'.$key.')';
            }
            $sql .= $keys . $values;

        
            $con = new \PDO(DNS,DBUSER,DBPASS);
            $con->beginTransaction();
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            try {
                $stmt= $con->prepare($sql);
                foreach ($request as $r) {
                    foreach ($r as $key => $value) {
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

        public static function update(){
            $request = self::$request;
            $sql = "UPDATE ". self::$table;
            $count = 0;
            foreach ($request[0] as $key => $value) {
                $count ++;
                if($value != ""){
                    $sql .= ($count == 1) ? " set ".$key." = :".$key."," : $key." = :".$key.",";
                }
            }

            $sql .= "updated_at = now() WHERE id = " . self::$id;

            $con = new \PDO(DNS,DBUSER,DBPASS);
            $con->beginTransaction();
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            try {
                $stmt= $con->prepare($sql);
                foreach ($request as $r) {
                    foreach ($r as $key => $value) {
                        if($value != ""){
                            $stmt->bindValue($key, $value);
                        }
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

        public static function delete(){
            $sql = "UPDATE ". self::$table. " SET deleted_at = now() WHERE id = ". self::$id;
            $con = new \PDO(DNS,DBUSER,DBPASS);
            $stmt = $con->prepare($sql);
            $stmt->execute();
        }
    }
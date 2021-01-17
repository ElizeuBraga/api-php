<?php
    namespace App\Models;
    class DB{
        static $table, $id, $request;

        // this construct is initialized in index
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

        public static function sqlSelect($sql){
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
            
            //mount sql to insert
            $sql = Helper::sql_insert($request, self::$table);

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
                echo json_encode(array('message' => $e->getMessage()));
                die();
            }

            $con->commit();

            $lastid = self::sqlSelect("SELECT max(id) AS lastid from ". self::$table);
            self::$id = $lastid[0]['lastid'];
            return self::select();
        }

        public static function update(){
            $request = self::$request;
            
            //mount sql to update
            $sql = Helper::sql_update($request, self::$table, self::$id);

            // var_dump($request); die();
            // echo $sql; die();

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
                http_response_code(400);
                return json_encode(array('message' => $e->getMessage()));
                die();
            }

            $con->commit();
            http_response_code(200);
            return self::select();
        }

        public static function delete(){
            $sql = "UPDATE ". self::$table. " SET deleted_at = now() WHERE id = ". self::$id;
            $con = new \PDO(DNS,DBUSER,DBPASS);
            $stmt = $con->prepare($sql);
            $stmt->execute();
        }
    }
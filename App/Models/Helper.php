<?php
    namespace App\Models;

    class Helper{
        public static function sql_insert($request, $table){
            $sql = 'INSERT INTO '. $table;
            $keys = '(';
            $values = 'values(';
            $count = 0;
            foreach ($request[0] as $key => $value) {
                $count ++;
                $keys .= ($count < count($request[0])) ? $key.',':$key.')';
                $values .= ($count < count($request[0])) ? ':'.$key.',':':'.$key.')';
            }
            $sql .= $keys . $values;
            return $sql;
        }

        public static function sql_update($request, $table, $id){
            $sql = "UPDATE ". $table;
            $count = 0;
            foreach ($request[0] as $key => $value) {
                $count ++;
                if($value != ""){
                    $sql .= ($count == 1) ? " set ".$key." = :".$key."," : $key." = :".$key.",";
                }
            }

            $sql .= "updated_at = now() WHERE id = " . $id. " AND deleted_at is null";
            return $sql;
        }

        public static function checkRoute($url, $method){
            if(!isset($url[1]) || $url[1] == ""){
                echo "This route is not permited";
                die();
            }elseif($method == 'post'){
                if(isset($url[2]) && $url[2] != ""){
                    echo "Method not allowed for this route";
                    die;
                }
            }elseif($method == 'put' || $method == 'delete'){
                if(!isset($url[2]) || $url[2] == ""){
                    echo "Method not allowed for this route";
                    die;
                }
            }
        }

        public static function trateMessageDb($message){
            if (strpos($message, 'Duplicate')) {
                if(strpos($message, 'email')){
                    return "Email já cadastrado";
                }
                if(strpos($message, 'phone')){
                    return "Telefone já cadastrado";
                }
            }else{
                return $message;
            }
        }
    }
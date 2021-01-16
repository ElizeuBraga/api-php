<?php
    namespace App\Models;

    class Helper{
        public static function toArray($array){
            $array = json_decode(file_get_contents("php://input"), true);
            return $array;
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
    }
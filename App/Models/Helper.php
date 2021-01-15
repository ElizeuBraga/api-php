<?php
    namespace App\Models;

    class Helper{
        public static function toArray($array){
            $array = json_decode(file_get_contents("php://input"), true);
            return $array;
        }
    }
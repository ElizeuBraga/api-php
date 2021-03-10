<?php
    namespace App\Models;
    use App\Models\DB;

    class Order_type{
        static $table = 'order_types';
        public static function get(){
            return DB::select();
        }

        public static function post(){
            return DB::insert();
        }

        public static function put(){
            return DB::update();
        }

        public static function delete(){
            return DB::delete();
        }

        public static function getLastId(){
            $sql = "SELECT CASE WHEN MAX(id) IS NULL THEN 0 ELSE MAX(id) END AS lastId FROM " . self::$table;
            return DB::sqlSelect($sql);
        }

        public static function downloadData(){
            return DB::downloadData();
        }
    }
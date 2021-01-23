<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class Product{
        static $table = 'products';
        public static function getProductsWithSection(){
            $sql = "SELECT 
                        p.id, p.name, p.price, s.name as section, p.section_id
                    FROM
                        products p 
                    JOIN sections s on s.id = p.section_id WHERE p.deleted_at is null ORDER BY s.name, p.name";
            return DB::sqlSelect($sql);
        }

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
    }
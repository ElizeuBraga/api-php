<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class Product{
        
        public static function get(){
            $sql = "SELECT 
                        p.id, p.name, p.price, s.name as section, p.section_id
                    FROM
                        products p 
                    JOIN sections s on s.id = p.section_id WHERE p.deleted_at is null ORDER BY s.name, p.name";
            return DB::sqlSelect($sql);
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
    }
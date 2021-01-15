<?php
    namespace App\Models;
    use App\Models\DB;

    class Section{
        private static $table = "sections";

        public static function get(int $id){
            $section = DB::select('select * from '. self::$table .' where id = '. $id);
            return $section;
        }

        public static function all(){
            $sections = DB::select('select * from '. self::$table);
            return $sections;
        }

        public static function post(array $data){
            return DB::insert($data);
        }
    }
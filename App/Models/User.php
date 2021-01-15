<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class User{
        private static $table = "users";

        public static function get(int $id){
            $user = DB::select('select * from '. self::$table .' where id = '. $id);
            return $user;
        }

        public static function all(){
            $users = DB::select('select * from '. self::$table);
            return $users;
        }

        public static function post(array $data){
            return DB::insert($data);
        }
    }
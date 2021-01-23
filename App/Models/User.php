<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class User{
        static $table = 'users';
        public static function get(){
            $sql = "SELECT id, name, email, phone, password, change_password FROM " . self::$table . " WHERE updated = true";
            return DB::sqlSelect($sql);
        }

        public static function post(){
            $request = Helper::getInputs();
            $request[0]['password'] = password_hash('12345', PASSWORD_DEFAULT);
            $request[0]['role'] = 1;
            Helper::see($request);
            return DB::insert($request);
        }

        public static function put(){
            return DB::update();
        }

        public static function delete(){
            return DB::delete();
        }

        public static function getLastId(){
            $sql = "SELECT MAX(id) as lastId FROM " . self::$table;
            Helper::see(DB::sqlSelect($sql));
            return DB::sqlSelect($sql);
        }

        public static function updatedToFalse(){
            $sql = "UPDATE " .self::$table. " SET updated = FALSE WHERE updated = TRUE";
            return DB::update($sql);
        }
    }
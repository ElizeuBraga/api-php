<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class User{
        static $table = 'users';
        public static function get(){
            return DB::select();
        }

        public static function post(){
            $request = Helper::getInputs();
            $request[0]['password'] = password_hash('12345', PASSWORD_DEFAULT);
            // Helper::see($request);
            return DB::insert($request);
        }

        public static function put(){
            return DB::update();
        }

        public static function delete(){
            return DB::delete();
        }

        public static function getLastId(){
            return DB::maxId();
        }

        public static function downloadData(){
            return DB::downloadData();
        }
    }
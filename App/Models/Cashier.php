<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class Cashier{
        
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
    }
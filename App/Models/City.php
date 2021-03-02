<?php
    namespace App\Models;
    use App\Models\DB;

    class City{
        static $table = 'cities';
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

        public static function downloadData(){
            return DB::downloadData();
        }
    }
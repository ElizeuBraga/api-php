<?php
    namespace App\Controller;

    use App\Models\City;
    class CitieController{
        public function get(){
            return City::get();
        }

        public function post(){
            return City::post();
        }

        public function put(){
            return City::put();
        }

        public function delete(){
            return City::delete();
        }

        public function downloadData(){
            return City::downloadData();
        }
    }
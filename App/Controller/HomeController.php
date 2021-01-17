<?php
    namespace App\Controller;

    use App\Models\Home;
    use App\Models\Helper;
    class HomeController{
        public function get(){
            return Home::get();
        }

        // public function post(){
        //     return Home::post();
        // }

        // public function put(){
        //     return Home::put();
        // }

        // public function delete(){
        //     return Home::delete();
        // }
    }
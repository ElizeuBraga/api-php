<?php
    namespace App\Controller;

    use App\Models\Locality;
    use App\Models\Helper;
    class LocalityController{
        public function get(){
            return Locality::get();
        }

        public function post(){
            return Locality::post();
        }

        public function put(){
            return Locality::put();
        }

        public function delete(){
            return Locality::delete();
        }
    }
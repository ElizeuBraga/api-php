<?php
    namespace App\Controller;

    use App\Models\Profile;
    class ProfileController{
        public function get(){
            return Profile::get();
        }

        public function post(){
            return Profile::post();
        }

        public function put(){
            return Profile::put();
        }

        public function delete(){
            return Profile::delete();
        }

        public function downloadData(){
            return Profile::downloadData();
        }
    }
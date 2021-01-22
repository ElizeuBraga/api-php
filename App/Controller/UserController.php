<?php
    namespace App\Controller;

    use App\Models\User;
    use App\Models\Helper;
    class UserController{
        public function get(){
            return User::get();
        }

        public function post(){
            return User::post();
        }

        public function put(){
            return User::put();
        }

        public function delete(){
            return User::delete();
        }

        public function getLastId(){
            return User::getLastId();
        }
    }
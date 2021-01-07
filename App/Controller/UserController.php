<?php
    namespace App\Controller;

    use App\Models\User;
    class UserController{
        public function get($id = null){
            if($id){
                return User::get((int)$id);
            }else{
                return User::all();
            }
        }

        public function post(){

        }

        public function update(){

        }

        public function delete(){

        }
    }
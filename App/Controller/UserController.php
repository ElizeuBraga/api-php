<?php
    namespace App\Controller;

    use App\Models\User;
    use App\Models\Helper;
    class UserController{
        public function get($id = null){
            if($id){
                return User::get((int)$id);
            }else{
                return User::all();
            }
        }

        public function post(array $data){
            $response = User::post($data);

            if($response){
                echo "Sucesso!!";
            }
        }

        public function update(){

        }

        public function delete(){

        }
    }
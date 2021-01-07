<?php
    namespace App\Controller;

    use App\Models\Section;
    class SectionController{
        public function get($id = null){
            if($id){
                return Section::get((int)$id);
            }else{
                return Section::all();
            }
        }

        public function post(array $data){
            echo $data;
        }

        public function update(){

        }

        public function delete(){

        }
    }
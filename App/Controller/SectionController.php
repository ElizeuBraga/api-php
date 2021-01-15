<?php
    namespace App\Controller;

    use App\Models\Section;
    use App\Models\BD;
    use App\Models\Helper;
    class SectionController{
        public function get($id = null){
            if($id){
                return Section::get((int)$id);
            }else{
                return Section::all();
            }
        }

        public function post(array $data){
            Section::post($data);
        }

        public function update(){

        }

        public function delete(){

        }
    }
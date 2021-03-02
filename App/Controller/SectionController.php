<?php
    namespace App\Controller;

    use App\Models\Section;
    use App\Models\BD;
    use App\Models\Helper;
    class SectionController{
        public function get(){
            return Section::get();
        }

        public function post(){
            return Section::post();
        }

        public function put(){
            return Section::put();
        }

        public function delete(){
            return Section::delete();
        }

        public function getLastId(){
            return Section::getLastId();
        }

        public function downloadData(){
            return Section::downloadData();
        }
    }
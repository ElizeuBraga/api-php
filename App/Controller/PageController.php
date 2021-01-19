<?php
    namespace App\Controller;

    use App\Models\Page;
    use App\Models\Helper;
    class PageController{
        public function get(){
            return Page::get();
        }

        public function post(){
            return Page::post();
        }

        public function put(){
            return Page::put();
        }

        public function delete(){
            return Page::delete();
        }
    }
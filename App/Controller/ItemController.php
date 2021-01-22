<?php
    namespace App\Controller;

    use App\Models\Item;
    use App\Models\Helper;
    class ItemController{
        public function get(){
            return Item::get();
        }

        public function post(){
            return Item::post();
        }

        public function put(){
            return Item::put();
        }

        public function delete(){
            return Item::delete();
        }

        public function getLastId(){
            return Item::getLastId();
        }
    }
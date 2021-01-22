<?php
    namespace App\Controller;

    use App\Models\Product;
    use App\Models\Helper;
    class ProductController{
        public function get(){
            return Product::get();
        }

        public function post(){
            return Product::post();
        }

        public function put(){
            return Product::put();
        }

        public function delete(){
            return Product::delete();
        }

        public function getLastId(){
            return Product::getLastId();
        }
    }
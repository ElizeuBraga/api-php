<?php
    namespace App\Controller;

    use App\Models\Order_type;
    use App\Models\BD;
    use App\Models\Helper;
    class Order_typeController{
        public function get(){
            return Order_type::get();
        }

        public function post(){
            return Order_type::post();
        }

        public function put(){
            return Order_type::put();
        }

        public function delete(){
            return Order_type::delete();
        }

        public function getLastId(){
            return Order_type::getLastId();
        }

        public function downloadData(){
            return Order_type::downloadData();
        }
    }
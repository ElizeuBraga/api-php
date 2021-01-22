<?php
    namespace App\Controller;

    use App\Models\Order;
    use App\Models\Helper;
    class OrderController{
        public function get(){
            return Order::get();
        }

        public function post(){
            return Order::post();
        }

        public function put(){
            return Order::put();
        }

        public function delete(){
            return Order::delete();
        }

        public function getLastId(){
            return Order::getLastId();
        }
    }
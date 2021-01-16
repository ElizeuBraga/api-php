<?php
    namespace App\Controller;

    use App\Models\Cashier;
    use App\Models\Helper;
    class CashierController{
        public function get(){
            return Cashier::get();
        }

        public function post(){
            return Cashier::post();
        }

        public function put(){
            return Cashier::put();
        }

        public function delete(){
            return Cashier::delete();
        }
    }
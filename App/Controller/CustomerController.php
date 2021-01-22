<?php
    namespace App\Controller;

    use App\Models\Customer;
    use App\Models\Helper;
    class CustomerController{
        public function get(){
            return Customer::get();
        }

        public function post(){
            return Customer::post();
        }

        public function put(){
            return Customer::put();
        }

        public function delete(){
            return Customer::delete();
        }

        public function getLastId(){
            return Customer::getLastId();
        }
    }
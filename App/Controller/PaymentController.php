<?php
    namespace App\Controller;

    use App\Models\Payment;
    use App\Models\BD;
    use App\Models\Helper;
    class PaymentController{
        public function get(){
            return Payment::get();
        }

        public function post(){
            return Payment::post();
        }

        public function put(){
            return Payment::put();
        }

        public function delete(){
            return Payment::delete();
        }

        public function getLastId(){
            return Payment::getLastId();
        }

        public function downloadData(){
            return Payment::downloadData();
        }
    }
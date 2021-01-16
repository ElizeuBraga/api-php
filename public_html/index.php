<?php
    use App\Models\Helper;
    use App\Models\DB;
    header('Contentent-Type: aplication/json');
    require_once '../vendor/autoload.php';
    if($_GET['url']){
        $url = explode('/', $_GET['url']);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $db = new DB($url);
        Helper::checkRoute($url, $method);
        if($url[0] === 'api'){
            $controller = 'App\Controller\\'.ucfirst(substr($url[1], 0, -1)).'Controller';

            if($method === 'get'){
                try {
                    if(isset($url[2])){
                        $url = $url[2];
                    }else{
                        $url = null;
                    }
                    $response = call_user_func_array(array(new $controller, $method), array());
                    echo json_encode(array('status' => 'success', 'data' => $response));
                } catch (\Throwable $th) {
                    echo $th;
                }
            }elseif($method === 'post'){
                Helper::checkRoute($url, $method);
                try {
                    $response = call_user_func_array(array(new $controller, $method), array());
                } catch (\Throwable $th) {
                    echo $th;
                }
            }elseif($method === 'put'){
                Helper::checkRoute($url, $method);
                try {
                    $response = call_user_func_array(array(new $controller, $method), array());
                } catch (\Throwable $th) {
                    echo $th;
                }
            }elseif($method === 'delete'){
                try {
                    $response = call_user_func_array(array(new $controller, $method), array());
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
        }
    }
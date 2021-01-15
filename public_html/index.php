<?php
    header('Contentent-Type: aplication/json');
    require_once '../vendor/autoload.php';
    if($_GET['url']){
        $url = explode('/', $_GET['url']);
        if($url[0] === 'api'){
            array_shift($url);
            $controller = 'App\Controller\\'.ucfirst(substr($url[0], 0, -1)).'Controller';
            array_shift($url);
            $method = strtolower($_SERVER['REQUEST_METHOD']);

            if($method === 'get'){
                try {
                    $response = call_user_func_array(array(new $controller, $method), $url);
                    echo json_encode(array('status' => 'success', 'data' => $response));
                } catch (\Throwable $th) {
                    echo $th;
                }
            }elseif($method === 'post'){
                try {
                    $response = call_user_func_array(array(new $controller, $method), array($_REQUEST));
                    // echo json_encode(array('status' => 'success', 'data' => $response));
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
        }
    }
<?php
    use App\Models\Helper;
    use App\Models\DB;
    require_once '../vendor/autoload.php';
    $_SESSION['page'] = 'home';
    if(isset($_GET['url'])){
        $url = explode('/', $_GET['url']); 
        $_SESSION['page'] = $url[0];
    }

    if(isset($url) && $url[0] === 'api'){

        header('Content-Type: aplication/json');

        // the method acording to REQUEST_METHOD (get, post, put, delete)
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        // init database
        $db = new DB($url);

        $model = ucfirst(substr($url[1], 0, -1));
        $method = $url[2];
        $controller = '\App\Controller\\'.$model.'Controller';
        
        /*
            to adapt to hosts that don't acept PUT and DELETE methods
            the routes have looks like
            api/sections/get/114
            api/sections/put/114
        */
        $methods = ['get', 'post', 'put', 'delete', 'getLastId', 'getProductsWithSection', 'downloadData'];
        if(in_array($method, $methods)){
            $response = call_user_func_array(array(new $controller, $method), array());
            echo json_encode($response);
        }else{
            echo json_encode('Method ('.$method.') not allowed');
        }
    }else{
        include "../App/Views/Welcome.php";
    }
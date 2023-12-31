<?php

    require_once "Game/board.php";
    require_once "Game/game.php";
    require_once "Game/login.php";
    require_once "Game/users.php";

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);

    if($input==null) $input=[];  

    if(isset($_SERVER['HTTP_X_TOKEN'])) $input['token']=$_SERVER['HTTP_X_TOKEN'];
     else $input['token']='';
     
     function handle_board($method,$input) {
        if($method=='GET') show_board($input);
         else if ($method=='POST') {
            reset_board();
            show_board($input);
        } else header('HTTP/1.1 405 Method Not Allowed');
        
        
    }

    function handle_status($method) {
        if($method=='GET') show_status();
         else header('HTTP/1.1 405 Method Not Allowed');
        
    }

    function handle_player($method, $pl, $input) {
        switch ($pl = array_shift($p)) {
            case '1': 
            case '2': handle_user($method, $pl, $input);
                      break;
            default: header("HTTP/1.1 404 Not Found");
                     print json_encode(['errormesg'=>"O paixths $pl den vrethike."]);
                     break;
        }
    }

?>
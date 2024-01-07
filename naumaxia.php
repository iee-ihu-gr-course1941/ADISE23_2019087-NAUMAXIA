<?php

    require_once "lib/board.php";
    require_once "lib/game.php";
    require_once "lib/login.php";
    require_once "lib/users.php";

    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);

    if($input==null) $input=[];  

    if(isset($_SERVER['HTTP_X_TOKEN'])) $input['token'] = $_SERVER['HTTP_X_TOKEN'];
    else $input['token'] = '';

    switch ($handling = array_shift($request)) {
        case 'board' : 

            switch ($handling_ships = array_shift($request)) {
                case '':

                case null: handle_board($method, $input);
                break;

                case 'ship': handle_ship($method, $request[0], $request[1], $request[2], $request[3], $input);
                break;

                case 'moves': handle_moves($method, $request[0],$request[1],$inputt);
                break;     

                default: header("HTTP/1.1 404 Not Found");
                break;

                }
                break;

        case 'status': if(sizeof($request)==0) handle_status($method);
                    else header("HTTP/1.1 404 Not Found");
        break;

        case 'players': handle_player($method, $request, $input);
        break;

        case 'score': handle_score($method);
        break;

        default:  header("HTTP/1.1 404 Not Found");

        exit;
    }
     
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
            case '':
            case null: if($method=='GET') show_User($method);
                       else {header("HTTP/1.1 400 Bad Request"); 
                       print json_encode(['errormesg'=>"H methodos $method den epitrepetai edw."]);}
            break;

            case '1': 
            case '2': handle_user($method, $pl, $input);
                      break;

            default: header("HTTP/1.1 404 Not Found");
                     print json_encode(['errormesg'=>"O paixths $pl den vrethike."]);
                     break;
        }
    }

    function handle_ship($method, $name, $row, $col, $ori, $input) {

        if($method == 'GET') show_Ships();
        else if ($method == 'POST') insert_ship($input['name'], $input['row'], $input['col'], $input['ori'], 
        $input['token']);
        else header('HTTP/1.1 405 Method Not Allowed');
    }

    function handle_moves($method, $row, $col, $input){
        if($method == 'GET') show_moves();
        else if ($method == 'POST') insert_move($input['row'], $input['col'], $input['token']);
        else header('HTTP/1.1 405 Method Not Allowed');
    }

    function handle_score($method){
        if($method == 'GET') show_score();
        else header('HTTP/1.1 405 Method Not Allowed');
    }
            

?>
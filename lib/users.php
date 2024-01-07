<?php

    function show_all_Users(){

        global $mysqli;

	    $sql = 'SELECT username FROM players';
	    $st = $mysqli->prepare($sql);
	    $st->execute();
	    $res = $st->get_result();

	    header('Content-type: application/json');
	    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
    }

    function show_User($pl) {

        global $mysqli;

        $sql = 'SELECT username, pl_turn FROM players WHERE pl_turn = ?';
        $st = $mysqli->prepare($sql);
        $st->bind_param('s', $pl);
        $st->execute();
        $res = $st->get_result();

        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
    }

    function set_User($name,$input) {

        if(!isset($input['username']) || $input['username']=='') {
            header("HTTP/1.1 400 Bad Request");
            print json_encode(['errormesg'=>"Den dothike username."]);
            exit;
        }

        $username=$input['username'];

        global $mysqli;

        $sql = 'SELECT COUNT(*) as c FROM players WHERE pl_turn = ? AND username IS NOT NULL';
        $st = $mysqli->prepare($sql);
        $st->bind_param('s',$name);
        $st->execute();
        $res = $st->get_result();
        $r = $res->fetch_all(MYSQLI_ASSOC);

        if($r[0]['c']>0) {
            header("HTTP/1.1 400 Bad Request");
            print json_encode(['errormesg'=>"O paixths $name exei hdh oristei."]);
            exit;
        }

        $sql = 'UPDATE players SET username=?, token=md5(CONCAT( ?, NOW())) WHERE pl_turn = ?';
        $st2 = $mysqli->prepare($sql);
        $st2->bind_param('sss',$username,$username,$name);
        $st2->execute();
    
        update_game_status();

        $sql = 'SELECT * FROM players WHERE pl_turn =?';
        $st = $mysqli->prepare($sql);
        $st->bind_param('s',$name);
        $st->execute();
        $res = $st->get_result();

        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);     
        
    }

    function handle_User($method, $name, $input) {
        if($method=='GET') show_user($name);
        else if($method=='PUT') set_user($name,$input);      
    }

    function current_pl_turn($token) {
	
        global $mysqli;

        if($token==null) return(null);

        $sql = 'SELECT * FROM players WHERE token = ?';
        $st = $mysqli->prepare($sql);
        $st->bind_param('s',$token);
        $st->execute();
        $res = $st->get_result();

        if($row=$res->fetch_assoc()) return($row['pl_turn']);
              
        return(null);
    }
    

?>
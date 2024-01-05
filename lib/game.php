<?php
function show_status() {
	
	    global $mysqli;
	
	    check_abort_status();
	
	    $sql = 'SELECT * FROM game_status';
	    $st = $mysqli->prepare($sql);

	    $st->execute();
	    $res = $st->get_result();

	    header('Content-type: application/json');
	    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);

    }

    function check_abort_status() {
        global $mysqli;
        
        $sql = "UPDATE game_status SET status ='aborded', result = if(pl_turn='1','2','1'),
        pl_turn = NULL WHERE pl_turn IS NOT NULL AND last_change<(NOW()-INTERVAL 5 MINUTE) 
        AND status ='started'";

        $st = $mysqli->prepare($sql);
        $r = $st->execute();
    }

    function read_status() {
        global $mysqli;
        
        $sql = 'SELECT* FROM game_status';
        $st = $mysqli->prepare($sql);
    
        $st->execute();
        $res = $st->get_result();
        $status = $res->fetch_assoc();
        return($status);
    }

    function update_game_status() {
        global $mysqli;
        
        $status = read_status();    
        
        $new_status=null;
        $new_turn=null;
        
        $st3=$mysqli->prepare('SELECT(*) AS aborted FROM players 
        WHERE last_action < (NOW() - INTERVAL 5 MINUTE)');
        $st3->execute();
        $res3 = $st3->get_result();
        $aborted = $res3->fetch_assoc()['aborted'];

        if($aborted>0) {
            $sql = "UPDATE players SET username = NULL, toke n= NULL 
            WHERE last_action < (NOW() - INTERVAL 5 MINUTE)";
            $st2 = $mysqli->prepare($sql);
            $st2->execute();

            if($status['status']=='started') {
                $new_status='aborted';
            }
        }
    
        
        $sql = 'SELECT(*) AS c FROM players WHERE username IS NOT NULL';
        $st = $mysqli->prepare($sql);
        $st->execute();
        $res = $st->get_result();
        $active_players = $res->fetch_assoc()['c'];
        
        
        switch($active_players) {
            case 0: $new_status='Not active'; break;
            case 1: $new_status='Initialized'; break;
            case 2: $new_status='Started'; 
                    if($status['pl_turn']==null) {
                        $new_turn='1'; 
                    }
                    break;
        }
    
        $sql = 'UPDATE game_status SET status=?, pl_turn=?';
        $st = $mysqli->prepare($sql);
        $st->bind_param('ss', $new_status, $new_turn);
        $st->execute();
            
    }



?>
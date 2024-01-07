<?php 
    function read_board($turn) {

	    global $mysqli;

		if ($turn === 1) $sql = 'SELECT * FROM board_pl1';
	    else $sql = 'SELECT * FROM board_pl2';
	    $st = $mysqli->prepare($sql);
	    $st->execute();
	    $res = $st->get_result();

	    return($res->fetch_all(MYSQLI_ASSOC));
    }

    function reset_board() {

	    global $mysqli;
	
	    $sql = 'call clean_boards()';
	    $mysqli->query($sql);	
    }

	function show_board($input) {

		global $mysqli;
		
		$player = current_pl_turn($input['token']);

		if($player) show_board_by_player($player);
		 else {
			$turn =  current_pl_turn($player['token']);
			header('Content-type: application/json');
			print json_encode(read_board($turn), JSON_PRETTY_PRINT);
		}
	}

	function show_board_by_player($player) {
	
		$turn =  current_pl_turn($player['token']);
		if($turn == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den eisai paixths autou tou paixnidiou."]);
			exit;
		}

		$orig_board = read_board($turn);
		$board = convert_board($orig_board);
		$status = read_status();

		if($status['status'] =='started' && $status['pl_turn'] == $player && $player != null) {
			$count_Hits = check_Total_hits($board);

			if ($count_Hits === 17){
				echo 'Exases!';

				$count_Hits = 0;
				$end_status = 'ended';

				if($turn === 1) $winner = 2;
				else $winner = 1;

				global $mysqli;

				$sql = 'UPDATE game_status SET status = ?, pl_turn = NULL, result = ?';
				$st = $mysqli->prepare($sql);
				$st->bind_param('si', $end_status, $winner);
				$st->execute();
				$res = $st->get_result();

				header('Content-type: application/json');
				print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);

				header('Content-type: application/json');
				print json_encode(insert_Score($winner), JSON_PRETTY_PRINT);

				exit;				
			}
		}

		header('Content-type: application/json');
		print json_encode($orig_board, JSON_PRETTY_PRINT);

		exit;
	}

	function convert_board(&$orig_board) {

		$board = [];

		foreach($orig_board as $i=>&$num) {
			$board[$num['row']][$num['col']] = &$num;
		} 

		return($board);
	}

	function insert_ship($name, $row, $col, $ori, $token) {
	
		if($token == null || $token == '') {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"To token den oristhke."]);
			exit;
		}
		
		$turn = current_pl_turn($token);
		if($turn == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den eisai paixths autou tou paixnidiou."]);
			exit;
		}

		$status = read_status();
		if($status['status'] != 'started') {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"To paixnidi den einai se drasi."]);
			exit;
		}

		if($status['pl_turn'] != $turn) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den einai h seira sou."]);
			exit;
		}

		if($name == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike to onoma tou ploiou."]);
			exit;
		}

		if($row == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike h seira."]);
			exit;
		} else if($row < 1 || $row > 10) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike mh egkiri seira."]);
			exit;
		}

		if($col == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike h sthlh."]);
			exit;
		} else if($col < 1 || $col > 10) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike mh egkiri sthlh."]);
			exit;
		}

		$ori = strtoupper($ori);

		if($ori == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike to oriental."]);
			exit;
		} else if($ori != 'v' && $ori != 'h') {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike mh egkiro oriental."]);
			exit;
		}

		global $mysqli;

		$sql = 'SELECT ship_Name FROM ships WHERE ship_Name = ?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('s',$name);
	    $st->execute();
	    $result = $st->get_result();
		$res = $result->fetch_all(MYSQLI_ASSOC);

		if(!$res) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike lathos to onoma tou ploiou."]);
			exit;
		}

		switch($name){
			case 'Carrier': $size = 5;
			break;

			case 'Battleship': $size = 4;
			break;

			case 'Cruiser': $size = 3;
			break;
			
			case 'Submarine': $size = 3;
			break;

			case 'Destroyer': $size = 2; 
			break;

			default: header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike lathos to onoma tou ploiou."]);
			exit;
							
		}

		if ($ori === 'v'){
			$ship_row = $row + $size;
			if ($ship_row > 10){
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Dothike mh egkiri tipothetisi tou ploiou."]);
				exit;
			}
		} else {
			$ship_col = $col + $size;
			if ($ship_col > 10){
				header("HTTP/1.1 400 Bad Request");
				print json_encode(['errormesg'=>"Dothike mh egkiri tipothetisi tou ploiou."]);
				exit;
			}
		}

		$orig_board = read_board($turn);
		$board = convert_board($orig_board);

		foreach($board[$row][$col]['status'] as $i=>$status) {
			if($row==$status['row'] && $col==$status['col']) 
			complete_insertion($row, $col, $ori, $size, $board, $turn);		
		}

		exit;
	}

	function show_ships() {
		
		global $mysqli;
		
		$sql = 'SELECT * FROM ships';
		$st = $mysqli->prepare($sql);
		$st->execute();
		$res = $st->get_result();

		header('Content-type: application/json');
		print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);

		exit;
	}

	function insert_move($row, $col, $token){

		$turn = current_pl_turn($token);
		if($turn == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den eisai paixths autou tou paixnidiou."]);
			exit;
		}

		if($row == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike h seira."]);
			exit;
		} else if($row < 0 || $row > 10) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike mh egkiri seira."]);
			exit;
		}

		if($col == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den dothike h sthlh."]);
			exit;
		} else if($col < 0 || $col > 10) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Dothike mh egkiri sthlh."]);
			exit;
		}

		$orig_board = read_board($turn);
		$board = convert_board($orig_board);

		
		foreach($board[$row][$col]['status'] as $i=>$status) {
			if($board[$row][$col]['status'] === 1) {
				$board[$row][$col]['status'] = -1;
				$hit = 'Hit';
				break;
			} else{
				$hit = 'Miss';
				break;
			}
		}

		global $mysqli;

		$sql = 'call MakeMove_pl(?, ?, ?, ?)';

		$st = $mysqli->prepare($sql);
		$st->bind_param('iiis', $turn, $row, $col, $hit);
	    $st->execute();
	    $res = $st->get_result();

	    header('Content-type: application/json');
	    print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);

		exit;

	}

	function check_Total_hits($board){

		$total_hits = 0;

		for ($i = 0; $i < 10; $i++) {
			for ($j = 0; $j < 10; $j++) {
				if($board[$i][$j]['status'] === -1) $total_hits++;				
			}			
		}

		return($total_hits);
	}

	function complete_insertion($row, $col, $ori, $size, $board, $turn){

		if($ori === 'v'){
			foreach($board[$row][$col]['status'] as $i=>$status) {
				if($col==$status['col']) {
					for ($i = 0; $i < $size; $i++) {
						if($board[$row + $i][$col]['status'] === 1){
							header("HTTP/1.1 400 Bad Request");
							print json_encode(['errormesg'=>"Dothike shmeio opou vriskete allo ploio."]);
							exit;
						}
					}
					for ($i = 0; $i < $size; $i++) {
						$board[$row + $i][$col]['status'] = 1;

						header('Content-type: application/json');
	    				print json_encode(insert_dB($row, $col + $i, $turn), JSON_PRETTY_PRINT);
					}
				}
			}
		} else{
			foreach($board[$row][$col]['status'] as $i=>$status) {
				if($row == $status['row'] ) {
					for ($i = 0; $i < $size; $i++) {
						if ($board[$row][$col + $i]['status'] === 1){
							header("HTTP/1.1 400 Bad Request");
							print json_encode(['errormesg'=>"Dothike shmeio opou vriskete allo ploio."]);
							exit;
						}
					}
					for ($i = 0; $i < $size; $i++) {
						$board[$row][$col + $i]['status'] = 1;

						header('Content-type: application/json');
	    				print json_encode(insert_dB($row, $col + $i, $turn), JSON_PRETTY_PRINT);
					}
				}
			}
		}

		exit;

	}

	function insert_dB($row, $col, $turn){

		global $mysqli;

		$sql = 'call board_set(?, ?, ?)';
	
		$st = $mysqli->prepare($sql);
		$st->bind_param('iii', $row, $col, $turn);
		$st->execute();
		$res = $st->get_result();

		return($res->fetch_all(MYSQLI_ASSOC));
	}

	function insert_Score($w){
		global $mysqli;

		$sql = 'UPDATE scoreboard AS s SET Score = s.Score + 1 WHERE Player = ?';
		$st = $mysqli->prepare($sql);
		$st->bind_param('i', $w);
		$st->execute();
		$res = $st->get_result();

		return($res->fetch_all(MYSQLI_ASSOC));
	}

?>
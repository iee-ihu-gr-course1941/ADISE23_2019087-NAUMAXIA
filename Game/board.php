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

		global $mysqli;
	
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
			//$n = add_valid_moves_to_board($board,$player);
		}
		header('Content-type: application/json');
		print json_encode($orig_board, JSON_PRETTY_PRINT);
	}

	function convert_board(&$orig_board) {

		$board = [];

		foreach($orig_board as $i=>&$num) {
			$board[$num['row']][$num['col']] = &$num;
		} 

		return($board);
	}

	function insert_ship($row, $col, $ori, $token) {
	
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

		$orig_board = read_board($turn);
		$board = convert_board($orig_board);

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
	}

	$move = 0;
	function insert_move($row, $col, $token){

		$turn = current_pl_turn($token);
		if($turn == null ) {
			header("HTTP/1.1 400 Bad Request");
			print json_encode(['errormesg'=>"Den eisai paixths autou tou paixnidiou."]);
			exit;
		}

		$move = $this->move++;

		global $mysqli;

		if ($turn == 1) $sql = 'call MakeMove_pl1($move, $turn, $row, $col)';
		else $sql = 'call MakeMove_pl2($move, $turn, $row, $col)';

		$st = $mysqli->prepare($sql);
	    $st->execute();
	    $res = $st->get_result();

	    return($res->fetch_all(MYSQLI_ASSOC));

	}

	function show_moves(){
		global $mysqli;

		$sql = 'SELECT * FROM moves';
	    $st = $mysqli->prepare($sql);
	    $st->execute();
	    $res = $st->get_result();

	    return($res->fetch_all(MYSQLI_ASSOC));
	}

?>
<?php 
    function read_board() {

	    global $mysqli;
	    $sql = 'SELECT * FROM board';
	    $st = $mysqli->prepare($sql);
	    $st->execute();
	    $res = $st->get_result();

	    return($res->fetch_all(MYSQLI_ASSOC));
    }

    function reset_board() {

	    global $mysqli;
	
	    $sql = 'call clean_board()';
	    $mysqli->query($sql);	
    }

	function show_board($input) {

		global $mysqli;
		
		$player = current_pl_turn($input['token']);

		if($player) show_board_by_player($player);
		 else {
			header('Content-type: application/json');
			print json_encode(read_board(), JSON_PRETTY_PRINT);
		}
	}

	function show_board_by_player($player) {

		global $mysqli;
	
		$orig_board = read_board();
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

		foreach($orig_board as $i=>&$row) {
			$board[$row['x']][$row['y']] = &$row;
		} 

		return($board);
	}

?>
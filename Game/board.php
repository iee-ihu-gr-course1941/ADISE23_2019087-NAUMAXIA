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

?>
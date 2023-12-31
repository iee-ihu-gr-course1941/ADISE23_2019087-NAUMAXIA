<?php

    $host='localhost';
    $db = 'naumaxia';
    
    require_once "db_upass.php";

    $user=$DB_USER;
    $pass=$DB_PASS;


    if(gethostname()=='users.iee.ihu.gr') {
	    $mysqli = new mysqli($host, $user, $pass, $db, null,'~/mysql/run/mysql.sock');
    } else {
		$pass=null;
        $mysqli = new mysqli($host, $user, $pass, $db);
    }

    if ($mysqli->connect_errno) {
        echo "Apotyxia syndesis sto MySQL: (" . 
        $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else echo "Epityxhs syndesi";

?>

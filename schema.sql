-- --------------------------------------------------------
-- Διακομιστής:                  127.0.0.1
-- Έκδοση διακομιστή:            11.2.2-MariaDB - mariadb.org binary distribution
-- Λειτ. σύστημα διακομιστή:     Win64
-- HeidiSQL Έκδοση:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for naumaxia
CREATE DATABASE IF NOT EXISTS `naumaxia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `naumaxia`;

-- Dumping structure for πίνακας naumaxia.board_pl1
CREATE TABLE IF NOT EXISTS `board_pl1` (
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `status` enum('1','-1') DEFAULT NULL,
  PRIMARY KEY (`row`,`col`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.board_pl1: ~100 rows (approximately)
DELETE FROM `board_pl1`;
INSERT INTO `board_pl1` (`row`, `col`, `status`) VALUES
	(1, 1, NULL),
	(1, 2, NULL),
	(1, 3, NULL),
	(1, 4, NULL),
	(1, 5, NULL),
	(1, 6, NULL),
	(1, 7, NULL),
	(1, 8, NULL),
	(1, 9, NULL),
	(1, 10, NULL),
	(2, 1, NULL),
	(2, 2, NULL),
	(2, 3, NULL),
	(2, 4, NULL),
	(2, 5, NULL),
	(2, 6, NULL),
	(2, 7, NULL),
	(2, 8, NULL),
	(2, 9, NULL),
	(2, 10, NULL),
	(3, 1, NULL),
	(3, 2, NULL),
	(3, 3, NULL),
	(3, 4, NULL),
	(3, 5, NULL),
	(3, 6, NULL),
	(3, 7, NULL),
	(3, 8, NULL),
	(3, 9, NULL),
	(3, 10, NULL),
	(4, 1, NULL),
	(4, 2, NULL),
	(4, 3, NULL),
	(4, 4, NULL),
	(4, 5, NULL),
	(4, 6, NULL),
	(4, 7, NULL),
	(4, 8, NULL),
	(4, 9, NULL),
	(4, 10, NULL),
	(5, 1, NULL),
	(5, 2, NULL),
	(5, 3, NULL),
	(5, 4, NULL),
	(5, 5, NULL),
	(5, 6, NULL),
	(5, 7, NULL),
	(5, 8, NULL),
	(5, 9, NULL),
	(5, 10, NULL),
	(6, 1, NULL),
	(6, 2, NULL),
	(6, 3, NULL),
	(6, 4, NULL),
	(6, 5, NULL),
	(6, 6, NULL),
	(6, 7, NULL),
	(6, 8, NULL),
	(6, 9, NULL),
	(6, 10, NULL),
	(7, 1, NULL),
	(7, 2, NULL),
	(7, 3, NULL),
	(7, 4, NULL),
	(7, 5, NULL),
	(7, 6, NULL),
	(7, 7, NULL),
	(7, 8, NULL),
	(7, 9, NULL),
	(7, 10, NULL),
	(8, 1, NULL),
	(8, 2, NULL),
	(8, 3, NULL),
	(8, 4, NULL),
	(8, 5, NULL),
	(8, 6, NULL),
	(8, 7, NULL),
	(8, 8, NULL),
	(8, 9, NULL),
	(8, 10, NULL),
	(9, 1, NULL),
	(9, 2, NULL),
	(9, 3, NULL),
	(9, 4, NULL),
	(9, 5, NULL),
	(9, 6, NULL),
	(9, 7, NULL),
	(9, 8, NULL),
	(9, 9, NULL),
	(9, 10, NULL),
	(10, 1, NULL),
	(10, 2, NULL),
	(10, 3, NULL),
	(10, 4, NULL),
	(10, 5, NULL),
	(10, 6, NULL),
	(10, 7, NULL),
	(10, 8, NULL),
	(10, 9, NULL),
	(10, 10, NULL);

-- Dumping structure for πίνακας naumaxia.board_pl2
CREATE TABLE IF NOT EXISTS `board_pl2` (
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `status` enum('1','-1') DEFAULT NULL,
  PRIMARY KEY (`row`,`col`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.board_pl2: ~100 rows (approximately)
DELETE FROM `board_pl2`;
INSERT INTO `board_pl2` (`row`, `col`, `status`) VALUES
	(1, 1, NULL),
	(1, 2, NULL),
	(1, 3, NULL),
	(1, 4, NULL),
	(1, 5, NULL),
	(1, 6, NULL),
	(1, 7, NULL),
	(1, 8, NULL),
	(1, 9, NULL),
	(1, 10, NULL),
	(2, 1, NULL),
	(2, 2, NULL),
	(2, 3, NULL),
	(2, 4, NULL),
	(2, 5, NULL),
	(2, 6, NULL),
	(2, 7, NULL),
	(2, 8, NULL),
	(2, 9, NULL),
	(2, 10, NULL),
	(3, 1, NULL),
	(3, 2, NULL),
	(3, 3, NULL),
	(3, 4, NULL),
	(3, 5, NULL),
	(3, 6, NULL),
	(3, 7, NULL),
	(3, 8, NULL),
	(3, 9, NULL),
	(3, 10, NULL),
	(4, 1, NULL),
	(4, 2, NULL),
	(4, 3, NULL),
	(4, 4, NULL),
	(4, 5, NULL),
	(4, 6, NULL),
	(4, 7, NULL),
	(4, 8, NULL),
	(4, 9, NULL),
	(4, 10, NULL),
	(5, 1, NULL),
	(5, 2, NULL),
	(5, 3, NULL),
	(5, 4, NULL),
	(5, 5, NULL),
	(5, 6, NULL),
	(5, 7, NULL),
	(5, 8, NULL),
	(5, 9, NULL),
	(5, 10, NULL),
	(6, 1, NULL),
	(6, 2, NULL),
	(6, 3, NULL),
	(6, 4, NULL),
	(6, 5, NULL),
	(6, 6, NULL),
	(6, 7, NULL),
	(6, 8, NULL),
	(6, 9, NULL),
	(6, 10, NULL),
	(7, 1, NULL),
	(7, 2, NULL),
	(7, 3, NULL),
	(7, 4, NULL),
	(7, 5, NULL),
	(7, 6, NULL),
	(7, 7, NULL),
	(7, 8, NULL),
	(7, 9, NULL),
	(7, 10, NULL),
	(8, 1, NULL),
	(8, 2, NULL),
	(8, 3, NULL),
	(8, 4, NULL),
	(8, 5, NULL),
	(8, 6, NULL),
	(8, 7, NULL),
	(8, 8, NULL),
	(8, 9, NULL),
	(8, 10, NULL),
	(9, 1, NULL),
	(9, 2, NULL),
	(9, 3, NULL),
	(9, 4, NULL),
	(9, 5, NULL),
	(9, 6, NULL),
	(9, 7, NULL),
	(9, 8, NULL),
	(9, 9, NULL),
	(9, 10, NULL),
	(10, 1, NULL),
	(10, 2, NULL),
	(10, 3, NULL),
	(10, 4, NULL),
	(10, 5, NULL),
	(10, 6, NULL),
	(10, 7, NULL),
	(10, 8, NULL),
	(10, 9, NULL),
	(10, 10, NULL);

-- Dumping structure for procedure naumaxia.board_set
DELIMITER //
CREATE PROCEDURE `board_set`(IN row_in INT, IN col_in INT, IN turn_in INT)
BEGIN
	IF turn_in = 1 THEN
		UPDATE board_pl1
		SET STATUS = 1
		WHERE ROW = row_in AND col = col_in;
	ELSE
		UPDATE board_pl2
		SET STATUS = 1
		WHERE ROW = row_in AND col = col_in;
	END IF;
END//
DELIMITER ;

-- Dumping structure for procedure naumaxia.clean_boards
DELIMITER //
CREATE PROCEDURE `clean_boards`()
BEGIN
REPLACE INTO board_pl1 SELECT * FROM board_empty;
REPLACE INTO board_pl2 SELECT * FROM board_empty;
END//
DELIMITER ;

-- Dumping structure for procedure naumaxia.clean_moves
DELIMITER //
CREATE PROCEDURE `clean_moves`()
BEGIN
	DROP TABLE IF EXISTS moves;
	CREATE TABLE moves(
	Move INT(11) NOT NULL AUTO_INCREMENT,
	Player VARCHAR(255) NOT NULL,
	Row INT(11) NOT NULL,
	Col INT(11) NOT NULL,
	Result ENUM('Miss','Hit'),
	PRIMARY KEY (Move)
);
END//
DELIMITER ;

-- Dumping structure for πίνακας naumaxia.empty_board
CREATE TABLE IF NOT EXISTS `empty_board` (
  `row` int(11) NOT NULL,
  `col` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`row`,`col`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.empty_board: ~100 rows (approximately)
DELETE FROM `empty_board`;
INSERT INTO `empty_board` (`row`, `col`, `status`) VALUES
	(1, 1, NULL),
	(1, 2, NULL),
	(1, 3, NULL),
	(1, 4, NULL),
	(1, 5, NULL),
	(1, 6, NULL),
	(1, 7, NULL),
	(1, 8, NULL),
	(1, 9, NULL),
	(1, 10, NULL),
	(2, 1, NULL),
	(2, 2, NULL),
	(2, 3, NULL),
	(2, 4, NULL),
	(2, 5, NULL),
	(2, 6, NULL),
	(2, 7, NULL),
	(2, 8, NULL),
	(2, 9, NULL),
	(2, 10, NULL),
	(3, 1, NULL),
	(3, 2, NULL),
	(3, 3, NULL),
	(3, 4, NULL),
	(3, 5, NULL),
	(3, 6, NULL),
	(3, 7, NULL),
	(3, 8, NULL),
	(3, 9, NULL),
	(3, 10, NULL),
	(4, 1, NULL),
	(4, 2, NULL),
	(4, 3, NULL),
	(4, 4, NULL),
	(4, 5, NULL),
	(4, 6, NULL),
	(4, 7, NULL),
	(4, 8, NULL),
	(4, 9, NULL),
	(4, 10, NULL),
	(5, 1, NULL),
	(5, 2, NULL),
	(5, 3, NULL),
	(5, 4, NULL),
	(5, 5, NULL),
	(5, 6, NULL),
	(5, 7, NULL),
	(5, 8, NULL),
	(5, 9, NULL),
	(5, 10, NULL),
	(6, 1, NULL),
	(6, 2, NULL),
	(6, 3, NULL),
	(6, 4, NULL),
	(6, 5, NULL),
	(6, 6, NULL),
	(6, 7, NULL),
	(6, 8, NULL),
	(6, 9, NULL),
	(6, 10, NULL),
	(7, 1, NULL),
	(7, 2, NULL),
	(7, 3, NULL),
	(7, 4, NULL),
	(7, 5, NULL),
	(7, 6, NULL),
	(7, 7, NULL),
	(7, 8, NULL),
	(7, 9, NULL),
	(7, 10, NULL),
	(8, 1, NULL),
	(8, 2, NULL),
	(8, 3, NULL),
	(8, 4, NULL),
	(8, 5, NULL),
	(8, 6, NULL),
	(8, 7, NULL),
	(8, 8, NULL),
	(8, 9, NULL),
	(8, 10, NULL),
	(9, 1, NULL),
	(9, 2, NULL),
	(9, 3, NULL),
	(9, 4, NULL),
	(9, 5, NULL),
	(9, 6, NULL),
	(9, 7, NULL),
	(9, 8, NULL),
	(9, 9, NULL),
	(9, 10, NULL),
	(10, 1, NULL),
	(10, 2, NULL),
	(10, 3, NULL),
	(10, 4, NULL),
	(10, 5, NULL),
	(10, 6, NULL),
	(10, 7, NULL),
	(10, 8, NULL),
	(10, 9, NULL),
	(10, 10, NULL);

-- Dumping structure for πίνακας naumaxia.game_status
CREATE TABLE IF NOT EXISTS `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  `pl_turn` enum('1','2') DEFAULT NULL,
  `result` enum('1','2') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.game_status: ~0 rows (approximately)
DELETE FROM `game_status`;

-- Dumping structure for procedure naumaxia.MakeMove_pl
DELIMITER //
CREATE PROCEDURE `MakeMove_pl`(IN player INT, IN row_in INT, IN column_in INT, IN result VARCHAR(255))
BEGIN

    DECLARE status ENUM('Active', 'Finished');
    SELECT STATUS INTO status FROM game_status;
  
    IF STATUS = 'Active' THEN
    
        IF NOT EXISTS (SELECT * FROM moves WHERE (Row = row_in AND Col = column_in)) THEN
  				
            INSERT INTO moves (Player, Row, Col, Result)
            VALUES (player, row_in, column_in, result);
  
        ELSE
        
        		SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Mh egkiri kinisi - to shmeio to exeis hdh epitethei.';
        END IF;
        
    ELSE
    
    		SIGNAL SQLSTATE '45000'
         SET MESSAGE_TEXT = 'Mh egkiri kinisi - To paixnidi den einai energo.';
    END IF;
END//
DELIMITER ;

-- Dumping structure for πίνακας naumaxia.moves
CREATE TABLE IF NOT EXISTS `moves` (
  `Move` int(11) NOT NULL AUTO_INCREMENT,
  `Player` varchar(255) NOT NULL,
  `Row` int(11) NOT NULL,
  `Col` int(11) NOT NULL,
  `Result` enum('Miss','Hit') DEFAULT NULL,
  PRIMARY KEY (`Move`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.moves: ~0 rows (approximately)
DELETE FROM `moves`;

-- Dumping structure for πίνακας naumaxia.players
CREATE TABLE IF NOT EXISTS `players` (
  `username` varchar(20) DEFAULT NULL,
  `pl_turn` enum('1','2') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pl_turn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.players: ~2 rows (approximately)
DELETE FROM `players`;
INSERT INTO `players` (`username`, `pl_turn`, `token`, `last_action`) VALUES
	('Bill', '1', NULL, '2024-01-02 16:47:57'),
	('Jim', '2', NULL, '2024-01-02 16:47:57');

-- Dumping structure for πίνακας naumaxia.scoreboard
CREATE TABLE IF NOT EXISTS `scoreboard` (
  `Player` enum('1','2') DEFAULT NULL,
  `Score` int(11) DEFAULT NULL,
  KEY `Player` (`Player`),
  CONSTRAINT `scoreboard_ibfk_1` FOREIGN KEY (`Player`) REFERENCES `players` (`pl_turn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.scoreboard: ~2 rows (approximately)
DELETE FROM `scoreboard`;
INSERT INTO `scoreboard` (`Player`, `Score`) VALUES
	('1', 0),
	('2', 0);

-- Dumping structure for πίνακας naumaxia.ships
CREATE TABLE IF NOT EXISTS `ships` (
  `ship_Name` varchar(256) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`ship_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table naumaxia.ships: ~5 rows (approximately)
DELETE FROM `ships`;
INSERT INTO `ships` (`ship_Name`, `size`) VALUES
	('Battleship', 4),
	('Carrier', 5),
	('Cruiser', 3),
	('Destroyer', 2),
	('Submarine', 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

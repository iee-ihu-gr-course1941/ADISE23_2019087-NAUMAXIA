<?php
    class BattleshipGame {
        private $board;
        private $currentPlayer;
        private $playerShips;
        private $countMoves = 0;

        // Orismos synolikwn nikwn twn 2 paixtwn
        private $winsPl1 = 0;
        private $winsPl2 = 0;
    
        public function __construct() {
            // Gemisma enos adeiou 10x10 pinaka 
            $this->board = array_fill(0, 10, array_fill(0, 10, 0));

            // Orismos 1ou paixth
            $this->currentPlayer = 1;

            // Orismos ploiwn kai ta megethi tous
            $this->playerShips = [
                1 => ['Carrier', 5],
                2 => ['Battleship', 4],
                3 => ['Cruiser', 3],
                4 => ['Submarine', 3],
                5 => ['Destroyer', 2]
            ];
        }

                // Emfanisi olwn twn ploiwn pou tha topothetisei o paixths
                public function displayAvailableShips() {
                    
                    // Elegxos poios paixths einai
                    if ($this->currentPlayer === 1){
                        $player = $_SESSION['player1_name'];
                        echo "$player, Diathesima ploia:\n";
            
                        foreach ($this->playerShips as $shipID => $shipInfo) {
                            [$shipName, $shipSize] = $shipInfo;
                            echo "Ploio $shipID: $shipName (Megethos: $shipSize)\n";
                        }
                    }
                    else{
                        $player = $_SESSION['player2_name'];
                        echo "$player, Diathesima ploia:\n";
            
                        foreach ($this->playerShips as $shipID => $shipInfo) {
                            [$shipName, $shipSize] = $shipInfo;
                            echo "Ploio $shipID: $shipName (Megethos: $shipSize)\n";
                        }
                    }
                    
                }
        
                public function placeAllShips() {

                    // Elegxos poios paixths einai
                   if ($this->currentPlayer === 1) $player = $_SESSION['player1_name'];
                   else $player = $_SESSION['player2_name'];
                   
                   // Klisi methodou startPlacing()
                   $this->startPlacing($player);
                }

            public function startPlacing($player){

                echo "$player, topothetise ta ploia sto pinaka:\n";
            
                foreach ($this->playerShips as $shipID => $shipInfo) {
                    [$shipName, $shipSize] = $shipInfo;
    
                    echo "\nTopothetisi $shipName (Megethos: $shipSize)\n";
    
                    do {
                        echo "Dwse thn arxikh seira tou $shipName: ";
                        $handleR = fopen ("php://stdin","r");
                        $startRow = trim(fgets($handleR));
    
                        echo "Dwse thn arxikh sthlh tou $shipName: ";
                        $handleC = fopen ("php://stdin","r");
                        $startCol = trim(fgets($handleC));
    
                        echo "Dwse ton prosanatolismo (h gia horizontal / v gia vertical): ";
                        $handleO = fopen ("php://stdin","r");
                        $orientation = trim(fgets($handleO));
    
                        $placementResult = $this->placeShip($startRow, $startCol, $shipSize, $orientation);
    
                        if (!$placementResult) echo "Mh egkyri topothetisi, prospathise xana\n";
                    
                    } while (!$placementResult);
    
                    echo "To ploio $shipName topothetithike epityxws\n";
                }

                echo "Epityxhs topothetisi ploiwn apo $player\n";
            }
    
        public function placeShip($row, $col, $size, $orientation) {
    
            // Elegxos an to ploio einai ektos oriwn
            if ($row < 0 || $col < 0 || $row >= 10 || $col >= 10) return false;

            if ($orientation === 'h' && $col + $size > 10) return false;
            elseif ($orientation === 'v' && $row + $size > 10) return false;          
    
            // Elegxos an kapoio apo ta kelia exei hdh timh
            for ($i = 0; $i < $size; $i++) {
                if ($orientation === 'h' && $this->board[$row][$col + $i] == 1) return false;
                elseif ($orientation === 'v' && $this->board[$row + $i][$col] == 1) return false;             
            }
    
            // Eisagwgi ploiou stno pinaka
            for ($i = 0; $i < $size; $i++) {
                if ($orientation === 'h') $this->board[$row][$col + $i] = 1;
                elseif ($orientation === 'v') $this->board[$row + $i][$col] = 1;               
            }
    
            return true;
        }

        // Allagh seira paixth
        public function switchTurn(){
            if ($this->currentPlayer === 1) $this->currentPlayer = 1; 
            else $this->currentPlayer = 2;
        }

        public function startGame(){
            
            // Elegxos poios paixths einai
            if ($this->currentPlayer === 1) $player = $_SESSION['player1_name'];
            else $player = $_SESSION['player2_name'];

            // Klisi methodou startAttack()
            $this->startAttack($player);
        }

        public function startAttack($player){
            // Emfanisi mynhmatos
            echo "H seira tou $player na epitethei\n";

            do {
                // Orismos row kai column pou tha epitethei o paixths
                echo "Dwse thn seira tou (0-10): ";
                $handleR = fopen ("php://stdin","r");
                $row = trim(fgets($handleR));

                echo "Dwse thn sthlh (0-10): ";
                $handleC = fopen ("php://stdin","r");
                $col = trim(fgets($handleC));

                // Emfanisi apotelesmatos egkiris epithesis (true/false)
                // Klisi methodou attackCell() 
                $placementResult = $this->attackCell($row, $col);
            
            } while (!$placementResult);

            // Auxisi plithos kinisewn
            $countMoves = $this->countMoves++;
        }

        public function attackCell($row, $col) {
            // Elegxos an h epithesi einai ektos oriwn
            if ($row < 0 || $col < 0 || $row >= 10 || $col >= 10) {
                echo "Mh egkiri eisagwgi keliou. Epanalipsi epithesis.\n";
                return false;
            }
            
    
            // Elegxos an sto sigkekrimeno keli exei ginei epithesi
            if ($this->board[$row][$col] === -1) {
                echo "Exeis hdh epitethei auto to keli. Epanalipsi epithesis.\n";
                return false;
            }
            
    
            // Orise to keli oti exei epitethei
            $this->board[$row][$col] = -1;
    
            // Elegxos an xtypaei to karavi
            if ($this->board[$row][$col] === 1) echo "Epityxhs epithesi!\n";
            else echo "Astoxia!\n";

            return true;
            
        }

        public function checkWinner(){
            // Orismos synolikwn kinhsewn tou paixnidiou
            $countMoves = $this->countMoves;

            // Elegxos an exei perastei to elaxisto plithos kinisewn
            // An dn perastei epistrefei false gia na synexistei to paixnidi
            if ($countMoves >= 34) return false;

            // Orismos metavlhtwn typou boolean, gia na vrethei o nikiths
            $sunkShipsPl1 = $this->sunkShips(1);
            $sunkShipsPl2 = $this->sunkShips(2);

            // Elegxos an yparxei nikhths/isopalia
            if ($sunkShipsPl1 && $sunkShipsPl2){
                echo "Isopalia metaxy twn 2 paiktwn!";
                $winsPl1 = $this->winsPl1++;
                $winsPl2 = $this->winsPl2++;
            }
            elseif ($sunkShipsPl1){
                $winner = $_SESSION['player2_name'];
                echo "Nikitis paixnidiou: $winner!";
                $winsPl2 = $this->winsPl2++;
            }
            elseif ($sunkShipsPl2){
                $winner = $_SESSION['player1_name'];
                echo "Nikitis paixnidiou: $winner!";
                $winsPl1 = $this->winsPl1++;
            }
            else return false;

            return true;
        }

        public function sunkShips($player){
            // Orismos pinaka analoga me ton paixth
            $playerShips = $this->board;

            // Elegxos an exoun xtyphthei ola ta ploia tou paixth
            foreach ($playerShips[$player] as $shipRow) {
                foreach ($shipRow as $cell) {
                    // An vrethei keli iso me 1 tote den xtyphthikan plhrws ola ta ploia
                    if ($cell === 1) return false;                   
                }
            }
            // An den vrethei kapoio gemato keli tote epistrefei pws xtyphthikan ola ta ploia
            return true;
        }

        public function displayScore(){
            // Orismos xrhstwn kai skor
            $player1 = $_SESSION['player1_name'];
            $player2 = $_SESSION['player2_name'];
            $score1 = $this->winsPl1;
            $score2 = $this->winsPl2;

            // Emfanisi apotelesmatos
            echo($player1 . ": " . $score1 . "\n");
            echo($player2 . ": " . $score2 . "\n");
        }
    }

    // Dimiourgia neou paixnidiou
    $game = new BattleshipGame();

    // Ekkinish session
    session_start();

    // Anamoni mexri na syndethei o 1os paixths
    while (true){
        if (!isset($_SESSION['player1_name'])) {
            $_SESSION['player1_name'] = $_SESSION['player_name'];
            break;
        }
    } 

    // Emfanisi kai topothetisi ploiwn apo ton paixth 1
    $game->displayAvailableShips();
    $game->placeAllShips();

    // Allagh seiras
    $game->switchTurn();

    // Emfanisi mynhmatos anamonhs
    echo("Anamoni syndesis 2ou paixth\n");

    // Anamoni mexri na syndethei o 2os paixths
    while (true){
        if (!isset($_SESSION['player2_name'])) {
            $_SESSION['player2_name'] = $_SESSION['player_name'];
            break;
        }
    }

    // Emfanisi kai topothetisi ploiwn apo ton paixth 2
    $game->displayAvailableShips();
    $game->placeAllShips();

    // Allagh seiras
    $game->switchTurn();

    // Emfanisi mynhmatos ekkinishs paixnidiou
    echo("Ekkinish paixnidiou\n");

    // Loop mexris otou na prokypsei nikhths
    while (true){
        // Klisi methodou startGame()
        $game->startGame();

        // Orismos metavliths winner typou boolean
        $winner = $game->checkWinner();

        // An den yparxei nikhths ginetai allagh seiras paixth
        if ($winner) break;
        else $game->switchTurn();

    }

    while(true){
        // Emfanisi kai apanthsh mhnymatos gia to skor
        echo "Thelete na deite to skor? (y/n)";
        $handleS = fopen ("php://stdin","r");
        $answer = trim(fgets($handleS));

        // Elegxos ths apanthshs tou xristi
        // An dwsei mh egkhrh apanthsh tha synexistei mexriw otou na dwthei egkyrh
        if ($answer === "y") {
            $game->displayScore();
            break;
        }
        elseif ($answer === "n") break;
        else ("Mh egkhrh apanthsh. Dwse pali apantisi");
    }
?>
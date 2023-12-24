<?php
    class BattleshipGame {
        private $board;
        private $currentPlayer;
        private $playerShips;
    
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
                    if ($this->currentPlayer == 1){
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
                   if ($this->currentPlayer == 1) $player = $_SESSION['player1_name'];
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
                        $startRow = (int)trim(fgets(STDIN));
    
                        echo "Dwse thn arxikh sthlh tou $shipName: ";
                        $startCol = (int)trim(fgets(STDIN));
    
                        echo "Dwse ton prosanatolismo (h gia horizontal / v gia vertical): ";
                        $orientation = trim(fgets(STDIN));
    
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

            if ($orientation == 'h' && $col + $size > 10) return false;
            elseif ($orientation == 'v' && $row + $size > 10) return false;          
    
            // Elegxos an kapoio apo ta kelia exei hdh timh
            for ($i = 0; $i < $size; $i++) {
                if ($orientation == 'h' && $this->board[$row][$col + $i] == 1) return false;
                elseif ($orientation == 'v' && $this->board[$row + $i][$col] == 1) return false;             
            }
    
            // Eisagwgi ploiou stno pinaka
            for ($i = 0; $i < $size; $i++) {
                if ($orientation == 'h') $this->board[$row][$col + $i] = 1;
                elseif ($orientation == 'v') $this->board[$row + $i][$col] = 1;               
            }
    
            return true;
        }

        // Allagh seira paixth
        public function switchTurn(){
            if ($this->currentPlayer == 1) $this->currentPlayer = 1; 
            else $this->currentPlayer = 2;
        }

        public function attackCell($row, $col) {
            // Elegxos an h epithesi einai ektos oriwn
            if ($row < 0 || $col < 0 || $row >= 10 || $col >= 10) return "Mh egkiri eisagwgi keliou\n";
            
    
            // Elegxos an sto sigkekrimeno keli exei ginei epithesi
            if ($this->board[$row][$col] == -1) return "Exeis hdh epitethei auto to keli\n";
            
    
            // Orise to keli oti exei epitethei
            $this->board[$row][$col] = -1;
    
            // Elegxos an xtypaei to karavi
            if ($this->board[$row][$col] == 1) return "Epityxhs epithesi!\n";
            else return "Astoxia!\n";
            
        }
    }

    // Dimiourgia neou paixnidiou
    $game = new BattleshipGame();

    // Ekkinish session
    session_start();

    if (!isset($_SESSION['player1_name'])) $_SESSION['player1_name'] = $_SESSION['player_name'];

    // Emfanisi kai topothetisi ploiwn apo ton paixth 1
    $game->displayAvailableShips();
    $game->placeAllShips();

    // Allagh seiras
    $game->switchTurn();

    // Emfanisi mynhmatos anamonhs
    echo("Anamoni syndesis 2ou paixth\n");

    // Anamoni mexri na syndethei o 2os paixths
    do{
        if (!isset($_SESSION['player2_name'])) $_SESSION['player2_name'] = $_SESSION['player_name'];
    } while (!isset($_SESSION['player2_name']));

    // Emfanisi kai topothetisi ploiwn apo ton paixth 2
    $game->displayAvailableShips();
    $game->placeAllShips();

    // Emfanisi mynhmatos ekkinishs paixnidiou
    echo("Ekkinish paixnidiou\n");
?>
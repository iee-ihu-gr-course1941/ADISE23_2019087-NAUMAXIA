<?php
    class BattleshipGame {
        private $board;
    
        public function __construct() {
            // Gemisma enos adeiou 10x10 pinaka 
            $this->board = array_fill(0, 10, array_fill(0, 10, 0));
        }
    
        public function placeShip($row, $col, $size, $orientation) {
    
            // Elegxos an to ploio einai ektos oriwn
            if ($row < 0 || $col < 0 || $row >= 10 || $col >= 10) {
                return false;
            }
    
            if ($orientation == 'horizontal' && $col + $size > 10) {
                return false;
            } elseif ($orientation == 'vertical' && $row + $size > 10) {
                return false;
            }
    
            // Elegxos an kapoio apo ta kelia exei hdh timh
            for ($i = 0; $i < $size; $i++) {
                if ($orientation == 'horizontal' && $this->board[$row][$col + $i] == 1) {
                    return false;
                } elseif ($orientation == 'vertical' && $this->board[$row + $i][$col] == 1) {
                    return false;
                }
            }
    
            // Eisagwgi ploiou stno pinaka
            for ($i = 0; $i < $size; $i++) {
                if ($orientation == 'horizontal') {
                    $this->board[$row][$col + $i] = 1;
                } elseif ($orientation == 'vertical') {
                    $this->board[$row + $i][$col] = 1;
                }
            }
    
            return true;
        }
    
        public function attackCell($row, $col) {
            // Elegxos an h epithesi einai ektos oriwn
            if ($row < 0 || $col < 0 || $row >= 10 || $col >= 10) {
                return "Invalid cell coordinates.";
            }
    
            // Elegxos an sto sigkekrimeno keli exei ginei epithesi
            if ($this->board[$row][$col] == -1) {
                return "Exeis hdh epitethei auto to keli";
            }
    
            // Orise to keli oti exei epitethei
            $this->board[$row][$col] = -1;
    
            // Elegxos an xtypaei to karavi
            if ($this->board[$row][$col] == 1) {
                return "Epityxhs epithesi!";
            } else {
                return "Astoxia!";
            }
        }
    }

    
?>
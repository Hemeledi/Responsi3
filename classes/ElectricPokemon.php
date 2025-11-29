<?php
require_once 'Pokemon.php';

class ElectricPokemon extends Pokemon {
    public function __construct($name, $level, $hp) {
        parent::__construct($name, 'Electric', $level, $hp, 'Thunderbolt');
    }

    // Override specialMove (Polymorphism) - Tampilkan semua jurus spesial
    public function specialMove() {
        $moves = implode(', ', $this->specialMoves);
        $description = "Jurus Spesial: $moves.";
        if ($this->level > 10) {
            $description .= " (Level tinggi membuat jurus lebih kuat!)";
        }
        return $description;
    }
}
?>
<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $specialMoves;  // Array untuk menyimpan jurus spesial yang diperoleh
    protected $image;  // URL gambar Pokémon

    public function __construct($name, $type, $level, $hp, $initialMove) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->specialMoves = [$initialMove];  // Mulai dengan jurus awal
        // Set gambar berdasarkan nama (gunakan gambar Pikachu sebagai default untuk Electric)
        $this->image = $this->setImage($name);
    }

    // Method untuk set gambar berdasarkan nama
   private function setImage($name) {
    switch (strtolower($name)) {
        case 'pikachu':
            return 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/59.png'; 
        default:
            return 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/59.png';
    }
}



    // Method __wakeup() untuk memastikan properti diinisialisasi saat unserialize
    public function __wakeup() {
        if (!is_array($this->specialMoves)) {
            $this->specialMoves = ['Thunderbolt'];  // Default jurus awal jika NULL
        }
        if (!$this->image) {
            $this->image = $this->setImage($this->name);  // Pastikan gambar ada
        }
    }

    // Getters (Encapsulation)
    public function getName() { return $this->name; }
    public function getType() { return $this->type; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
    public function getSpecialMoves() { return $this->specialMoves; }
    public function getImage() { return $this->image; }  // Getter untuk gambar

    // Setters (Encapsulation)
    public function setLevel($level) { $this->level = $level; }
    public function setHp($hp) { $this->hp = $hp; }

    // Method train (Polymorphism: bisa di-override)
    public function train($trainingType, $intensity) {
        $levelIncrease = 0;
        $hpIncrease = 0;
        $newMove = '';

        switch ($trainingType) {
            case 'Attack':
                $levelIncrease = ceil($intensity / 8);  // Lebih cepat naik level untuk Attack
                $hpIncrease = $intensity * 1.5;  // HP naik sedang
                $newMove = 'Thunder Punch';  // Jurus spesial baru untuk Attack
                break;
            case 'Defense':
                $levelIncrease = ceil($intensity / 12);  // Naik level lebih lambat
                $hpIncrease = $intensity * 3;  // HP naik tinggi untuk Defense
                $newMove = 'Thunder Wave';  // Jurus spesial baru untuk Defense
                break;
            case 'Speed':
                $levelIncrease = ceil($intensity / 6);  // Naik level cepat untuk Speed
                $hpIncrease = $intensity * 1;  // HP naik rendah
                $newMove = 'Quick Attack';  // Jurus spesial baru untuk Speed
                break;
        }

        $this->level += $levelIncrease;
        $this->hp += $hpIncrease;

        // Tambahkan jurus spesial baru jika belum ada
        if (!in_array($newMove, $this->specialMoves)) {
            $this->specialMoves[] = $newMove;
        }
    }

    // Abstract method untuk specialMove (Abstraction) - Sekarang mengembalikan array jurus
    abstract public function specialMove();
}
?>
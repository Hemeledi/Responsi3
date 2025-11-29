<?php
require_once 'classes/ElectricPokemon.php';  // Pindahkan ke sini sebelum session_start()
session_start();

// Inisialisasi Pokémon jika belum ada di session
if (!isset($_SESSION['pokemon'])) {
    $_SESSION['pokemon'] = new ElectricPokemon('Arcanine', 5, 35);
}
$pokemon = $_SESSION['pokemon'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRTC - Pokémon Trainer Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #ffcc00; }
        .info { margin: 20px 0; }
        img { width: 150px; height: 150px; border-radius: 10px; margin: 10px; }
        button { padding: 10px 20px; margin: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PRTC - Pokémon Trainer Dashboard</h1>
        <div class="info">
            <img src="<?php echo $pokemon->getImage(); ?>" alt="Gambar <?php echo $pokemon->getName(); ?>">
            <h2><?php echo $pokemon->getName(); ?></h2>
            <p><strong>Tipe:</strong> <?php echo $pokemon->getType(); ?></p>
            <p><strong>Level Awal:</strong> <?php echo $pokemon->getLevel(); ?></p>
            <p><strong>HP Awal:</strong> <?php echo $pokemon->getHp(); ?></p>
            <p><strong>Jurus Spesial:</strong> <?php echo $pokemon->specialMove(); ?></p>
        </div>
        <button onclick="window.location.href='train.php'">Mulai Latihan</button>
        <button onclick="window.location.href='history.php'">Riwayat Latihan</button>
    </div>
</body>
</html>
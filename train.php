<?php
require_once 'classes/ElectricPokemon.php';
require_once 'classes/TrainingSession.php';
session_start();

$pokemon = $_SESSION['pokemon'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trainingType = $_POST['trainingType'];
    $intensity = (int)$_POST['intensity'];

    // Simpan nilai sebelum latihan
    $levelBefore = $pokemon->getLevel();
    $hpBefore = $pokemon->getHp();

    // Lakukan latihan
    $pokemon->train($trainingType, $intensity);

    // Simpan sesi latihan
    $session = new TrainingSession($trainingType, $intensity, $levelBefore, $pokemon->getLevel(), $hpBefore, $pokemon->getHp());
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = [];
    }
    $_SESSION['history'][] = $session;

    // Update session
    $_SESSION['pokemon'] = $pokemon;

    // Tentukan jurus spesial baru berdasarkan tipe latihan
    $newMove = '';
    switch ($trainingType) {
        case 'Attack': $newMove = 'Thunder Punch'; break;
        case 'Defense': $newMove = 'Thunder Wave'; break;
        case 'Speed': $newMove = 'Quick Attack'; break;
    }

    $message = "Latihan selesai! Level: {$levelBefore} → {$pokemon->getLevel()}, HP: {$hpBefore} → {$pokemon->getHp()}.<br>Jurus Spesial Baru: {$newMove}.<br>Total Jurus: {$pokemon->specialMove()}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latihan Pokémon</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form { margin: 20px 0; }
        select, input { padding: 10px; margin: 10px; width: 200px; }
        button { padding: 10px 20px; margin: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
        .message { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Latihan Pokémon: <?php echo $pokemon->getName(); ?></h1>
        <form method="POST">
            <label>Jenis Latihan:</label>
            <select name="trainingType">
                <option value="Attack">Attack</option>
                <option value="Defense">Defense</option>
                <option value="Speed">Speed</option>
            </select><br>
            <label>Intensitas (1-100):</label>
            <input type="number" name="intensity" min="1" max="100" required><br>
            <button type="submit">Latih Pokémon</button>
        </form>
        <?php if ($message) echo "<p class='message'>$message</p>"; ?>
        <button onclick="window.location.href='index.php'">Kembali ke Beranda</button>
        <button onclick="window.location.href='history.php'">Riwayat Latihan</button>
    </div>
</body>
</html>
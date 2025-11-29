<?php
require_once 'classes/TrainingSession.php';
session_start();

$history = isset($_SESSION['history']) ? $_SESSION['history'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Latihan</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f8ff; text-align: center; }
        .container { max-width: 800px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f2f2f2; }
        button { padding: 10px 20px; margin: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Latihan Pokémon</h1>
        <?php if (empty($history)): ?>
            <p>Belum ada sesi latihan.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Jenis Latihan</th>
                    <th>Intensitas</th>
                    <th>Level Sebelum</th>
                    <th>Level Sesudah</th>
                    <th>HP Sebelum</th>
                    <th>HP Sesudah</th>
                    <th>Waktu</th>
                </tr>
                <?php foreach ($history as $session): ?>
                    <tr>
                        <td><?php echo $session->getTrainingType(); ?></td>
                        <td><?php echo $session->getIntensity(); ?></td>
                        <td><?php echo $session->getLevelBefore(); ?></td>
                        <td><?php echo $session->getLevelAfter(); ?></td>
                        <td><?php echo $session->getHpBefore(); ?></td>
                        <td><?php echo $session->getHpAfter(); ?></td>
                        <td><?php echo $session->getTime(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <button onclick="window.location.href='index.php'">Kembali ke Beranda</button>
        <button onclick="window.location.href='train.php'">Mulai Latihan</button>
    </div>
</body>
</html>
<?php
include("config.php");

$result = mysqli_query($conn, "SELECT * FROM sayuran ORDER BY id ASC");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Sayuran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Sayuran</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sayuran</th>
                    <th>Harga (Rp)</th>
                    <th>Stok (kg)</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$user_data['id']}</td>";
                echo "<td>{$user_data['nama']}</td>";
                echo "<td>" . number_format($user_data['harga'], 0, ',', '.') . "</td>";
                echo "<td>{$user_data['stok']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>
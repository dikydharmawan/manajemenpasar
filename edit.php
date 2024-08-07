<?php
include_once("config.php");

// Memeriksa apakah form telah di-submit untuk update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Memperbarui data
    $result = mysqli_query($conn, "UPDATE sayuran SET nama='$nama', harga='$harga', stok='$stok' WHERE id=$id");

    // Redirect ke halaman utama (index.php) setelah update
    header("Location: index.php");
    exit;
}
?>

<?php
$id = $_GET['id'];

// Mengambil data sayuran berdasarkan id
$result = mysqli_query($conn, "SELECT * FROM sayuran WHERE id=$id");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$user_data = mysqli_fetch_assoc($result);
$nama = $user_data['nama'];
$harga = $user_data['harga'];
$stok = $user_data['stok'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sayuran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <br/><br/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Data Sayuran</h4>
                    </div>
                    <div class="card-body">
                        <form name="update_user" method="post" action="edit.php">
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Nama Sayuran</td>
                <td><input type="text" name="nama" value="<?php echo ($nama); ?>"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="number" name="harga" value="<?php echo ($harga); ?>"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="number" name="stok" value="<?php echo ($stok); ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo ($id); ?>"></td>
                <td><input type="submit" name="update" value="Update" class="btn btn-primary mb-6" ></td>
            </tr>
            <a href="index.php"class="btn btn-warning mb-3">Home</a>
        </table>
    </form>
</body>
</html>
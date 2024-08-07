<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sayuran</title>
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
                        <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Sayuran Baru</h4>
                    </div>
    <div class="card-body">
    <form action="add.php" method="post" name="sayurForm" onsubmit="return validateForm()">
        <table width="25%" border="0">
            <tr>
                <td>Nama Sayuran</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>   
                <td>Harga</td>
                <td><input type="number" name="harga"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="number" name="stok"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="btn btn-success mb-3" name="Submit" value="Tambah"></td>
            </tr>
            <a href="index.php"class="btn btn-warning mb-3">Kembali ke Beranda</a>
        </table>
    </form>
</div>
   <?php
   if(isset($_POST['Submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    include_once("config.php");
    $result = mysqli_query($conn,"INSERT INTO sayuran(nama,harga,stok) VALUES('$nama',$harga,$stok)");

    echo "Sayuran berhasil ditambahkan. <a href='index.php'  class='alert-link btn btn-primary mb-3'>Lihat Daftar Sayuran</a>";
   } 
   ?>
</body>
</html>